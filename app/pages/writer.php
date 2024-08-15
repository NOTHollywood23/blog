<?php include '../app/pages/includes/header.php'; ?>

<h3 class="mx-4">Writer</h3>
<div class="row my-2 justify-content-center">

<?php
$limit = 10;
$offset = ($PAGE['page_number'] - 1) * $limit;

$writer_slug = $url[1] ?? null;

if ($writer_slug) {
    $query = "SELECT posts.*, users.name AS writer_name FROM posts 
              JOIN users ON posts.author_id = users.id 
              WHERE posts.author_id IN (SELECT id FROM users WHERE slug = :writer_slug) 
              ORDER BY posts.id DESC 
              LIMIT $limit OFFSET $offset";
    
    $rows = query($query, ['writer_slug' => $writer_slug]);
}

if (!empty($rows)) {
    foreach ($rows as $row) {
        include '../app/pages/includes/post-card.php';
    }
} else {
    echo "No items found!";
}
?>

</div>

<!-- Pagination Buttons -->
<div class="container">
    <a href="<?=$PAGE['first_link']?>">
        <button class="btn btn mb-4" style="background-color: #001962; color: #ffffff;">First Page</button>
    </a>
    <a href="<?=$PAGE['prev_link']?>">
        <button class="btn btn-primary mb-4" style="background-color: #001962; color: #ffffff;">Prev Page</button>
    </a>
    <a href="<?=$PAGE['next_link']?>">
        <button class="btn btn-primary mb-4 float-end" style="background-color: #001962; color: #ffffff;">Next Page</button>
    </a>
</div>

<?php include '../app/pages/includes/footer.php'; ?>
