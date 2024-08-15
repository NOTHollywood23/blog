<?php

function query(string $query, array $data = [])
{
    $string = "mysql:hostname=".DBHOST.";dbname=".DBNAME;
    $con = new PDO($string, DBUSER, DBPASS);

    $stm = $con->prepare($query);
    $stm->execute($data);

    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    if (is_array($result) && !empty($result)) {
        return $result;
    }
    return false;
}

function query_row(string $query, array $data = [])
{
    $string = "mysql:hostname=".DBHOST.";dbname=".DBNAME;
    $con = new PDO($string, DBUSER, DBPASS);

    $stm = $con->prepare($query);
    $stm->execute($data);

    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    if (is_array($result) && !empty($result)) {
        return $result[0];
    }
    return false;
}

function authenticate($row)
{
    $_SESSION['USER']=$row;
}

function user($key='')
{
    if(empty($key))
        return $_SESSION['USER'];
    if(!empty($_SESSION['USER'][$key]))
        return $_SESSION['USER'][$key];

    return '';
}

function logged_in()
{
    if (!empty($_SESSION['USER'])) {
        return true;
    }
    
    return false;
}

function redirect($page)
{
    header('Location: '.ROOT. '/' . $page);
    die;
}

function old_value($key, $default = '')
{
    if (!empty($_POST[$key]))
        return $_POST[$key];

    return $default;
}


function old_select($key, $value, $current = '')
{
    if (!empty($_POST[$key]) && $_POST[$key] == $value) {
        return 'selected';
    } elseif ($current == $value) {
        return 'selected';
    }

    return '';
}


function old_checked($key)
{
    return !empty($_POST[$key]) ? 'checked' : '';
}

function str_to_url($url)
{
    $url = str_replace("'", "", $url);
    $url = preg_replace('~[^\pL0-9_]+~u', '-', $url);
    $url = trim($url, "-");
    $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
    $url = strtolower($url);
    $url = preg_replace('~[^-a-z0-9_]+~', '', $url);

    return $url;
}

function esc($str)
{
    return htmlspecialchars($str ?? '');
}

function get_image($file)
{
    $file=$file ?? '';
    if(file_exists($file))
    {
        return ROOT. '/'.$file;
    }
    return ROOT.'/assets/images/no_image_available.jpg';
}

function remove_images_from_content($content, $folder = 'uploads/')
{
    preg_match_all("/<img[^>]+>/", $content, $matches);

    if (is_array($matches[0]) && count($matches[0]) > 0) 
    {
        foreach ($matches[0] as $img) 
        {
            if (!strstr($img, "data:")) 
            {
                continue;
            }

            preg_match('/src="[^"]+/', $img, $match);
            $parts = explode("base64,", $match[0]);

            preg_match('/data-filename="[^"]+/', $img, $file_match);
            $filename = $folder.str_replace('data-filename="', "", $file_match[0]);

            file_put_contents($filename, base64_decode($parts[1]));
            $content = str_replace($match[0], 'src="'.$filename, $content);
        }
    }
    return $content;
}

function is_admin() {
    return isset($_SESSION['USER']['role']) && $_SESSION['USER']['role'] === 'admin';
}



function add_root_to_images_from_content($content)
{
    preg_match_all("/<img[^>]+>/", $content, $matches);

    if (is_array($matches[0]) && count($matches[0]) > 0) 
    {
        foreach ($matches[0] as $img) 
        {

            preg_match('/src="[^"]+/', $img, $match);

            $new_img = str_replace('src="', 'src="'.ROOT."/", $img);
            $content = str_replace($img, $new_img, $content);
        }
    }
    return $content;
}

function remove_root_from_content($content)
{
    $content=str_replace(ROOT, "", $content);
    return $content;
}



function get_pagination_vars()
{
        /** set pagination vars **/
    $page_number=$_GET['page'] ?? 1;
    $page_number=empty($page_number) ? 1 : (int)$page_number;
    $page_number=$page_number < 1 ? 1 : $page_number;

    $current_link = $_GET['url'] ?? 'home';
    $current_link = ROOT . "/" . $current_link;
    $query_string = "";

    foreach ($_GET as $key => $value)
    {
        if($key != 'url')
        {
            $query_string .= "&".$key."=".$value;
        }
    }

    if(!strstr($query_string, "page="))
    {
        $query_string .= "&page=".$page_number;
    }

    $query_string = trim($query_string,"&");
    $current_link .= "?".$query_string;

    $current_link = preg_replace("/page=.*/", "page=".($page_number), $current_link);
    $next_link = preg_replace("/page=.*/", "page=".($page_number+1), $current_link);
    $first_link = preg_replace("/page=.*/", "page=", $current_link);
    $prev_page_number = $page_number < 2 ? 1 : $page_number - 1;
    $prev_link = preg_replace("/page=.*/", "page=".$prev_page_number, $current_link);

    $result=[
        'current_link' => $current_link,
        'next_link' => $next_link,
        'prev_link' => $prev_link,
        'first_link' => $first_link,
        'page_number' => $page_number,
    ];
    return $result;
}


create_tables();

function create_tables()
{
    $string = "mysql:hostname=localhost;";
    $con = new PDO($string, DBUSER, DBPASS);
    
    $query = "create database if not exists " . DBNAME;
    $stm = $con->prepare($query);
    $stm->execute();

    $query = "use " . DBNAME;
    $stm = $con->prepare($query);
    $stm->execute();

    $query = "create table if not exists users(
        id int primary key auto_increment,
        email varchar(100) not null,
        password varchar(255) not null,
        date datetime default current_timestamp,
        role varchar(10) not null,
        key email (email)
    )";
    $stm = $con->prepare($query);
    $stm->execute();

    // Create categories table if not exists
    $query = "CREATE TABLE IF NOT EXISTS categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        category VARCHAR(50) NOT NULL,
        slug VARCHAR(100) NOT NULL,
        disabled TINYINT(1) DEFAULT 0,
        KEY slug (slug),
        KEY category (category)
    )";
    $stm = $con->prepare($query);
    $stm->execute();

    // Create posts table if not exists
    $query = "CREATE TABLE IF NOT EXISTS posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        category_id INT,
        title VARCHAR(255) NOT NULL,
        writer VARCHAR(100) NOT NULL,
        image VARCHAR(1024) NULL,
        content TEXT NULL,
        slug VARCHAR(100) NOT NULL,
        date DATETIME DEFAULT CURRENT_TIMESTAMP,
        KEY user_id (user_id),
        KEY category_id (category_id),
        KEY title (title),
        KEY slug (slug),
        KEY date (date)
    )";
    $stm = $con->prepare($query);
    $stm->execute();
}
function resize_image($filename, $max_size = 1000)
{
    if (file_exists($filename)) {
        $type = mime_content_type($filename);
        switch ($type) {
            case 'image/jpeg':
            case 'image/jpg':  // Combined cases for JPEG and JPG
                $image = imagecreatefromjpeg($filename);
                break;
            case 'image/png':
                $image = imagecreatefrompng($filename);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($filename);
                break;
            case 'image/webp':
                if (function_exists('imagecreatefromwebp')) {
                    $image = imagecreatefromwebp($filename);
                } else {
                    error_log("WebP is not supported on this server.");
                    return; // Exit the function if WebP is not supported
                }
                break;
            default:
                error_log("Unsupported image type: $type");
                return; // Exit the function if the image type is unsupported
        }

        $src_width = imagesx($image);
        $src_height = imagesy($image);

        if ($src_width > $src_height) {
            if ($src_width < $max_size) {
                $max_size = $src_width;
            }

            $dst_width = $max_size;
            $dst_height = ($src_height / $src_width) * $max_size;
        } else {
            if ($src_height < $max_size) {
                $max_size = $src_height;
            }

            $dst_height = $max_size;
            $dst_width = ($src_width / $src_height) * $max_size;
        }

        $dst_height = round($dst_height);
        $dst_width = round($dst_width);

        error_log("Resizing image to width: $dst_width, height: $dst_height");

        $dst_image = imagecreatetruecolor($dst_width, $dst_height);
        imagecopyresampled($dst_image, $image, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

        switch ($type) {
            case 'image/jpeg':
            case 'image/jpg':
                imagejpeg($dst_image, $filename, 90);
                break;
            case 'image/png':
                imagepng($dst_image, $filename);
                break;
            case 'image/gif':
                imagegif($dst_image, $filename);
                break;
            case 'image/webp':
                imagewebp($dst_image, $filename, 90);
                break;
        }

        imagedestroy($image);
        imagedestroy($dst_image);
    } else {
        error_log("File does not exist: $filename");
    }
}





?>
