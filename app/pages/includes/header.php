<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Admin - Untitled Posts</title>

    <link href="<?= ROOT ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT ?>/assets/css/font/bootstrap-icons.css" rel="stylesheet">
  </head>
  <body>
  <header class="p-3 mb-3 border-bottom">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-end">
      <form action="<?=ROOT?>/search" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
      <div class="input-group">
        <input value="<?=$_GET['find'] ?? ''?>" name="search" type="search" class="form-control" placeholder="Search..." aria-label="Search">
        <button class="btn btn-outline-secondary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
      </div>
      </form>
    
      <?php if(logged_in()):?>
      <div class="dropdown text-end">
        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <img ><i class="bi bi-list"></i>
        </a>
        <ul class="dropdown-menu text-small">
          <li><a class="dropdown-item" href="<?=ROOT?>/admin">Admin</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="<?=ROOT?>/logout">Sign out</a></li>
        </ul>
      </div>
      <?php endif;?>
    </div>
  </div>


    <script src="<?= ROOT ?>/assets/dist/js/bootstrap.bundle.min.js"></script>

    <style>
      html, body {
        margin: 0;
        padding: 0;
      }
      .header-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 200px;
        width: 100%;
        margin-top: 0px; /* Lower the image by 40 pixels */
        margin-left: 40px;
      }
      .movable-image img {
        width: 100%;
        max-width: 1400px;
      }
    </style>

    <header class="header-container">
      <div class="movable-image">
        <a href="<?=ROOT?>/home">
          <img src="<?= ROOT ?>/assets/images/fixed.jpg" alt="masthead">
        </a>
      </div>
      </header>
<div class="container">
    <div class="nav-scroller py-1 mb-3">
        <nav class="nav d-flex justify-content-between">
            <a class="p-2" style="font-family: 'Helvetica', sans-serif; font-size: 18px; color: #001962; font-weight: bold;" href="<?=ROOT?>/category/education">Education</a>
            <a class="p-2" style="font-family: 'Helvetica', sans-serif; font-size: 18px; color: #001962; font-weight: bold;" href="<?=ROOT?>/category/entertainment">Entertainment</a>
            <a class="p-2" style="font-family: 'Helvetica', sans-serif; font-size: 18px; color: #001962; font-weight: bold;" href="<?=ROOT?>/category/politics">Politics</a>
            <a class="p-2" style="font-family: 'Helvetica', sans-serif; font-size: 18px; color: #001962; font-weight: bold;" href="<?=ROOT?>/category/sports">Sports</a>
            <a class="p-2" style="font-family: 'Helvetica', sans-serif; font-size: 18px; color: #001962; font-weight: bold;" href="<?=ROOT?>/category/urban">Urban</a>
            
            <!-- Dropdown as part of nav -->
            <a class="p-2 dropdown-toggle" style="font-family: 'Helvetica', sans-serif; font-size: 18px; color: #001962; font-weight: bold;" href="#" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                About
            </a>
            <ul class="dropdown-menu text-small" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" style="font-family: 'Helvetica', sans-serif; font-size: 18px; color: #001962;" href="<?=ROOT?>/about-us">About Us</a></li>
                <li><a class="dropdown-item" style="font-family: 'Helvetica', sans-serif; font-size: 18px; color: #001962;" href="<?=ROOT?>/staff">Staff</a></li>
                <li><a class="dropdown-item" style="font-family: 'Helvetica', sans-serif; font-size: 18px; color: #001962;" href="<?=ROOT?>/editorial-policy">Editorial Policy</a></li>
            </ul>
        </nav>
    </div>
