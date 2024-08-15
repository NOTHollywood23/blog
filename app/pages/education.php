<?php include '../app/pages/includes/header.php'; ?>
<div> 
    <!-- Featured Posts Section -->
    <div class="featured-posts">
        <h3 class="mx-4">Featured</h3>
        <div class="row my-2">
            <?php
                    $limit = 10;
                    $offset = ($PAGE['page_number'] - 1) * $limit;
                $query="select posts.*,categories.category from posts join categories on posts.category_id = categories.id order by id desc limit $limit offset $offset";
                $rows=query($query);
                if($rows)
                {
                  foreach($rows as $row) {
                      include '../app/pages/includes/post-card.php';
                  }
                }else{
                  echo "No items found!";
                }
            ?>
        </div>
    </div>
</div>

<a href="<?=$PAGE['first_link']?>">
        <button class= "btn btn-primary mb-4">First Page</button>
    </a>
    <a href="<?=$PAGE['prev_link']?>">
        <button class= "btn btn-primary mb-4">Prev Page</button>
    </a>
    <a href="<?=$PAGE['next_link']?>">
        <button class= "btn btn-primary mb-4 float-end">Next Page</button>
    </a>
            </div>
<?php include '../app/pages/includes/footer.php'; ?>
