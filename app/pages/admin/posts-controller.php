<?php
// add new post
if ($action == 'add') {
    if (!empty($_POST)) {
        // Validate
        $errors = [];

        // Other validation code...

        // Validate image
        $allowed = ['image/jpeg', 'image/png', 'image/webp'];
        if (!empty($_FILES['image']['name'])) {
            $destination = "";
            if (!in_array($_FILES['image']['type'], $allowed)) {
                $errors['image'] = "Image format not supported";
            } else {
                $folder = "uploads/";
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }

                $filename = time() . "_" . basename($_FILES['image']['name']);
                $destination = $folder . $filename;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                    resize_image($destination);
                } else {
                    $errors['image'] = "Failed to move uploaded file.";
                }
            }
        }

        // Generate slug
        $slug = str_to_url($_POST['title']);

        $query = "SELECT id FROM posts WHERE slug = :slug LIMIT 1";
        $slug_row = query($query, ['slug' => $slug]);

        if ($slug_row) {
            $slug .= rand(1000, 9999);
        }

        // If no errors, save the data
        if (empty($errors)) {

            $new_content=remove_images_from_content($_POST['content']);

            // Save to database
            $data = [
                'title' => $_POST['title'],
                'writer' => $_POST['writer'],
                'content' => $new_content,
                'slug' => $slug,
                'category_id' => $_POST['category_id'],
                'user_id' => user('id')
            ];

            if (!empty($destination)) {
                $data['image'] = $destination;
                $query = "INSERT INTO posts (title, writer, content, slug, category_id, user_id, image) 
                          VALUES (:title, :writer, :content, :slug, :category_id, :user_id, :image)";
            } else {
                $query = "INSERT INTO posts (title, writer, content, slug, category_id, user_id) 
                          VALUES (:title, :writer, :content, :slug, :category_id, :user_id)";
            }

            query($query, $data);
            redirect('admin/posts');
        }
    }
} else if ($action == 'edit') {
    $query = "SELECT * FROM posts WHERE id = :id LIMIT 1";
    $row = query_row($query, ['id' => $id]);

    if (!empty($_POST)) {
        if ($row) {
            // Validate
            $errors = [];

            // Validate image
            $allowed = ['image/jpeg', 'image/png', 'image/webp'];
            if (!empty($_FILES['image']['name'])) {
                $destination = "";
                if (!in_array($_FILES['image']['type'], $allowed)) {
                    $errors['image'] = "Image format not supported";
                } else {
                    $folder = "uploads/";
                    if (!file_exists($folder)) {
                        mkdir($folder, 0777, true);
                    }

                    $filename = time() . "_" . basename($_FILES['image']['name']);
                    $destination = $folder . $filename;

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                        resize_image($destination);
                    } else {
                        $errors['image'] = "Failed to move uploaded file.";
                    }
                }
            }

            if (empty($errors)) {

                $new_content=remove_images_from_content($_POST['content']);
                $new_content=remove_root_from_content($new_content);


                // Update in database
                $data = [
                    'title' => $_POST['title'],
                    'content' => $new_content,
                    'writer' => $_POST['writer'],
                    'category_id' => $_POST['category_id'],
                    'id' => $id
                ];

                $image_str = "";
                if (!empty($destination)) {
                    $image_str = ", image = :image";
                    $data['image'] = $destination;
                }

                $query = "UPDATE posts SET title = :title, content = :content, writer = :writer $image_str, category_id = :category_id WHERE id = :id LIMIT 1";
                query($query, $data);

                redirect('admin/posts');
            }
        }
    }
} else if ($action == 'delete') {
    $query = "SELECT * FROM posts WHERE id = :id LIMIT 1";
    $row = query_row($query, ['id' => $id]);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($row) {
            // Validate
            $errors = [];

            if (empty($errors)) {
                // Delete from database
                $data = ['id' => $id];
                $query = "DELETE FROM posts WHERE id = :id LIMIT 1";
                query($query, $data);

                if (file_exists($row['image'])) {
                    unlink($row['image']);
                }

                redirect('admin/posts');
            }
        }
    }
}
