<?php

if (!empty($_POST)) 
{
    //validate
    $errors = [];

    $query = "select id from users where email = :email limit 1";
    $email = query($query, ['email' => $_POST['email']]);

    if (empty($_POST['email'])) {
        $errors['email'] = "A email is required";
    } else if ($email) {
        $errors['email'] = "That email is already in use";
    }

    if (empty($_POST['password'])) {
        $errors['password'] = "A password is required";
    } else if (strlen($_POST['password']) < 8) {
        $errors['password'] = "Password must be 8 character or more";
    }

    if (empty($errors)) {
        //save to database
        $data = [];
        $data['email'] = $_POST['email'];
        $data['role'] = "user";
        $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $query = "insert into users (email, password, role) values (:email, :password, :role)";
        query($query, $data);

        redirect('login');
    }
}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Untitled Posts Login  · Bootstrap v5.2</title>

    <link href="<?= ROOT ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    <link href="<?= ROOT ?>/assets/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin w-100 m-auto">
  <form method="post">
    <img class="mb-4" src="<?= ROOT ?>/assets/images/circlenavy.png" alt="" width="110" height="110"> 
    <h1 class="h3 mb-3 fw-normal">Create an account</h1>
    
    <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">Please fix the errors below</div>
    <?php endif; ?>

    <?php if (!empty($errors['email'])): ?>
    <div class="text-danger"><?= $errors['email'] ?></div>
    <?php endif; ?>

    <div class="form-floating">
      <input value="<?= old_value('email')?>" name="email" type="email" class="form-control mb-3" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>

    <?php if (!empty($errors['password'])): ?>
    <div class="text-danger"><?= $errors['password'] ?></div>
    <?php endif; ?>

    <div class="form-floating">
      <input value="<?= old_value('password') ?>" name="password" type="password" class="form-control mb-3" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <div class="form-floating">
      <input value="<?= old_value('retype_password') ?>" name="retype_password" type="password" class="form-control mb-3" id="floatingRetypePassword" placeholder="Retype Password">
      <label for="floatingRetypePassword">Retype Password</label>
    </div>

    <div class="my-2">Already have an account? <a href="login">Login here!</a></div>
    <div class="checkbox mb-3">
      <label>
        <input <?= old_checked('remember') ?> name="remember" type="checkbox" value="1"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary"  style="background-color: #001962; color: #ffffff;" type="submit">Create Account</button>
    <p class="mt-5 mb-3 text-muted">&copy; <?= date("Y") ?></p>
  </form>
</main>
    
  </body>
</html>
