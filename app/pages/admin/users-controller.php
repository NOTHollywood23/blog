<?php
// add new
if ($action == 'add') {
    if (!empty($_POST)) {
        //validate
        $errors = [];

        $query = "select id from users where email = :email limit 1";
        $email = query($query, ['email' => $_POST['email']]);

        if (empty($_POST['email'])) {
            $errors['email'] = "An email is required";
        } else if ($email) {
            $errors['email'] = "That email is already in use";
        }

        if (empty($_POST['password'])) {
            $errors['password'] = "A password is required";
        } else if (strlen($_POST['password']) < 8) {
            $errors['password'] = "Password must be 8 characters or more";
        }

        if (empty($errors)) {
            //save to database
            $data = [];
            $data['email'] = $_POST['email'];
            $data['role'] = $_POST['role'];
            $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $query = "insert into users (email, password, role) values (:email, :password, :role)";
            query($query, $data);

            redirect('admin/users');
        }
    }
} else if ($action == 'edit') {

    $query = "select * from users where id = :id limit 1";
    $row = query_row($query, ['id' => $id]);

    if (!empty($_POST)) {
        if ($row) {
            //validate
            $errors = [];

            $query = "select id from users where email = :email and id != :id limit 1";
            $email = query($query, ['email' => $_POST['email'], 'id' => $id]);

            if (empty($_POST['email'])) {
                $errors['email'] = "An email is required";
            } else if ($email) {
                $errors['email'] = "That email is already in use";
            }

            if (empty($_POST['password'])) {
                // Do not validate password if not provided
            } else if (strlen($_POST['password']) < 8) {
                $errors['password'] = "Password must be 8 characters or more";
            }

            if (empty($errors)) {
                //save to database
                $data = [];
                $data['email'] = $_POST['email'];
                $data['role'] = $_POST['role'];
                $data['id'] = $id;

                if (empty($_POST['password'])) {
                    $query = "update users set email = :email, role = :role where id = :id limit 1";
                } else {
                    $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $query = "update users set email = :email, password = :password, role = :role where id = :id limit 1";
                }
                query($query, $data);

                redirect('admin/users');
            }
        }
    }
} else if ($action == 'delete') {

    $query = "select * from users where id = :id limit 1";
    $row = query_row($query, ['id' => $id]);

    if (!empty($_POST)) {
        if ($row) {
            //validate
            $errors = [];

            $query = "select id from users where email = :email and id != :id limit 1";
            $email = query($query, ['email' => $_POST['email'], 'id' => $id]);

            if (empty($errors)) {
                //delete from database
                $data = [];

                $data['id'] = $id;

                $query = "delete from users where id = :id limit 1";
                query($query, $data);

                redirect('admin/users');
            }
        }
    }
}
?>