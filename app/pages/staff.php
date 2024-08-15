<?php include '../app/pages/includes/header.php'; ?>
<link href="<?= ROOT ?>/assets/css/staff.css" rel="stylesheet">

<h1 class="mb-4" style="font-family: 'Helvetica', sans-serif; color: #001962;">Untitled Posts Staff</h1>

<div class="container mt-5">
    <div class="row g-1"> <!-- Use Bootstrap's g-1 for 5px spacing -->
        <div class="col-md-4 mb-4">
            <a href="<?=ROOT?>/jake" class="staff-member" style="display: block; width: 350px; height: 350px;">
                <img src="<?= ROOT ?>/assets/images/jake.jpeg" alt="Jake Pfeiffer" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                <div class="overlay">
                    <div class="text">Jake Pfeiffer</div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-4">
    <a href="<?=ROOT?>/javen" class="staff-member" style="display: block; width: 350px; height: 350px;">
        <img src="<?= ROOT ?>/assets/images/javen.jpg" alt="Javen Oswald" class="img-fluid" 
             style="width: 100%; height: 100%; object-fit: cover; object-position: center 0%;">
        <div class="overlay">
            <div class="text">Javen Oswald</div>
        </div>
    </a>
</div>

        <div class="col-md-4 mb-4">
            <a href="<?=ROOT?>/jay" class="staff-member" style="display: block; width: 350px; height: 350px;">
                <img src="<?= ROOT ?>/assets/images/jay.jpeg" alt="Jay Deegan" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                <div class="overlay">
                    <div class="text">Jay Deegan</div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="<?=ROOT?>/mack" class="staff-member" style="display: block; width: 350px; height: 350px;">
                <img src="<?= ROOT ?>/assets/images/mack.jpg" alt="Mack Gowan" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                <div class="overlay">
                    <div class="text">Mack Gowan</div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="<?=ROOT?>/nolan" class="staff-member" style="display: block; width: 350px; height: 350px;">
                <img src="<?= ROOT ?>/assets/images/nolan.jpg" alt="Nolan Shen" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                <div class="overlay">
                    <div class="text">Nolan Shen</div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php include '../app/pages/includes/footer.php'; ?>
