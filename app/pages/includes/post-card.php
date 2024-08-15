<div class="col-md-6">

    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-3" style="color: #001962;"><?= esc($row['category'] ?? 'Unknown') ?></strong>
            <h3 class="mb-2" style="font-family: 'Helvetica', sans-serif; font-size: 40px; color: #000000;"><?= esc($row['title']) ?></h3>
            <h3 class="mb-3" style="font-family: 'Helvetica', sans-serif; font-size: 24px; color: #000000;"><?= esc($row['writer']) ?></h3>
            <div class="mb-1" style="font-family: 'Helvetica', sans-serif; font-size: 14px; color: #3b3b3b;">
                                                <?= date("F j, Y", strtotime($row['date'])) ?>
                                            </div>
            <a href="<?=ROOT?>/post/<?= $row['slug'] ?>">
                <button class="btn btn-link p-0 stretched-link"  style="font-family: 'Helvetica', sans-serif; font-size: 1px; color: #ffffff;">.</button>
            </a>
        </div>
        <div class="col-lg-5 col-12 d-lg-block">   
            <a href="<?=ROOT?>/post/<?= $row['slug'] ?>">
                <img class="bd-placeholder-img w-100" width="200" height="250" src="<?= get_image($row['image']) ?>" alt="Thumbnail" style="object-fit: cover;">
            </a>
        </div>
    </div>
</div>
