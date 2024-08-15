<?php include '../app/pages/includes/header.php'; ?>
<div> 
            <?php
                
                $slug = $url[1] ?? null;
                if ($slug) {
                    $query = "select posts.*,categories.category from posts join categories on posts.category_id = categories.id where posts.slug = :slug limit 1";
                    $row = query_row($query, ['slug' => $slug]);
                }

                if (!empty($row)) { ?>

                    <div class="col-md-12">
                        <div class="g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative">
                            <div class="col p-4 d-flex flex-column position-static">                        
                            <strong class="d-inline-block mb-2" style="color: #001962;"><?= esc($row['category'] ?? 'Unknown') ?></strong>
                                <h3 class="mb-2" style="font-family: 'Helvetica', sans-serif; font-size: 72px; color: #000000;"><?= esc($row['title']) ?></h3>
                                <h3 class="mb-2" style="font-family: 'Helvetica', sans-serif; font-size: 27px; color: #000000;"><?= esc($row['writer']) ?></h3>
                                <div class="mb-3" style="font-family: 'Helvetica', sans-serif; font-size: 14px; color: #3b3b3b;">
                                                <?= date("F j, Y", strtotime($row['date'])) ?>
                                            </div>
                                <div class="mb-4 col-12 d-lg-block">
                                    <img class="bd-placeholder-img w-100" width="100%" src="<?= get_image($row['image']) ?>" alt="Thumbnail" style="object-fit: cover;">
                                </div>
                                <p class="card-text mb-auto" ><?= nl2br(add_root_to_images_from_content(($row['content']))) ?></p>
                            </div>
                        </div>
                    </div>

                <?php } else { 
                    echo "No items found!";
                }
            ?>
        </div>
    </div>
</div>

<?php include '../app/pages/includes/footer.php'; ?>
