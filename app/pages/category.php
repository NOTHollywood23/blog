<?php include '../app/pages/includes/header.php'; ?>
    <h3 class="mx-4">Category</h3>
    <div class="row my-2 justify-content-center">

    <?php
    $limit = 10;
    $offset = ($PAGE['page_number'] - 1) * $limit;

    $category = $url[1] ?? null;

    if ($category) {

        $query = "select posts.*,categories.category from posts join categories on posts.category_id = categories.id where posts.category_id in (select id from categories where slug = :category_slug && disabled=0) order by posts.id desc limit $limit offset $offset";
        $rows = query($query, ['category_slug' => $category]);
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
