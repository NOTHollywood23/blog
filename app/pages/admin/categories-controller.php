<?php
// add new
if ($action == 'add') {
    if (!empty($_POST)) {
        //validate
        $errors = [];

        $query = "select id from categories where category = :category limit 1";
        $category = query($query, ['category' => $_POST['category']]);

        if (empty($_POST['category'])) {
            $errors['category'] = "A category is required";
        } 
        
        $slug = str_to_url($_POST['category']);

        $query = "select id from categories where slug = :slug limit 1";
        $slug_row = query($query, ['slug'=>$slug]);
        
        if($slug_row)
        {
            $slug .= rand(1000,9999);
        }
        
        if(empty($errors))
        {
            //save to database
            $data = [];
            $data['category'] = $_POST['category'];
            $data['slug'] = $slug;
            $data['disabled'] = $_POST['disabled'];
        }
        

            $query = "insert into categories (category, slug, disabled) values (:category, :slug, :disabled)";
            query($query, $data);

            redirect('admin/categories');
        }
    }
else if ($action == 'edit') {
    
    $query = "select * from categories where id = :id limit 1";
    $row = query_row($query, ['id' => $id]);

    if (!empty($_POST)) {
        //validate
        $errors = [];

        $query = "select id from categories where category = :category limit 1";
        $category = query($query, ['category' => $_POST['category']]);

        if (empty($_POST['category'])) {
            $errors['category'] = "A category is required";
        } else if ($category) {
            $errors['category'] = "This category is already in use";
        }
        
        $slug = str_to_url($_POST['category']);

        $query = "select id from categories where slug = :slug limit 1";
        $slug_row = query($query, ['slug'=>$slug]);
        
        if($slug_row)
        {
            $slug .= rand(1000,9999);
        }

            if (empty($errors)) {
                //save to database
                $data = [];
                $data['category'] = $_POST['category'];
                $data['disabled'] = $row['disabled'];
                $data['id'] = $id;

                $query="update categories set category=:category,disabled=:disabled where id=:id limit 1";
                query($query, $data);

                redirect('admin/categories');
            }
        }
    }
else if ($action == 'delete') {

    $query = "select * from categories where id = :id limit 1";
    $row = query_row($query, ['id'=>$id]);
    
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if($row)
        {
            //validate
            $errors = [];
    
            if(empty($errors))
            {
                //delete from database
                $data = [];
                $data['id'] = $id;
    
                $query = "delete from categories where id = :id limit 1";
                query($query, $data);
    
                redirect('admin/categories');
            }
        }
    }
}
?>