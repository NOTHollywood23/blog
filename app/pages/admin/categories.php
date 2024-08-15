<?php if($action=='add'):?>

<div class="col-md-6 mx-auto">
    <form method="post">

    <h1 class="h3 mb-3 fw-normal">Create category</h1>
    
    <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">Please fix the errors below</div>
    <?php endif; ?>

    <?php if (!empty($errors['category'])): ?>
    <div class="text-danger"><?= $errors['category'] ?></div>
    <?php endif; ?>

    <div class="form-floating">
    <input value="<?= old_value('category') ?>" name="category" type="category" class="form-control mb-3" id="floatingInput" placeholder="name@example.com">
    <label for="floatingInput">Category</label>
    </div>

        <div class="form-floating my-3">
    <select name="disabled" class="form-select">
        <option value="0">Yes</option>
        <option value="1">No</option>
    </select>
    <label for="floatingInput">Active</label>
    </div>
    <?php if(!empty($errors['role'])):?>
    <div class="text-danger"><?= $errors['role']?></div>
    <?php endif;?>


    <a href="<?=ROOT?>/admin/c">
        <button class="mt-4 btn btn-lg btn-primary" type="button">Back</button>
        </a>
    <button class="mt-4 btn btn-lg btn-primary float-end" type="submit">Create Category</button>

</form>
</div>

<?php elseif($action=='edit'):?>

<div class="col-md-6 mx-auto">
    <form method="post">

    <h1 class="h3 mb-3 fw-normal">Edit category</h1>
    
    <?php if(!empty($row)):?>
   
        <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">Please fix the errors below</div>
        <?php endif; ?>

        <?php if (!empty($errors['category'])): ?>
        <div class="text-danger"><?= $errors['category'] ?></div>
        <?php endif; ?>

        <div class="form-floating">
        <input value="<?= old_value('category', $row['category']) ?>" name="category" type="category" class="form-control mb-3" id="floatingInput" placeholder="category">
        <label for="floatingInput">Category</label>
        </div>


        <div class="form-floating my-3">
                <select name="disabled" class="form-select">
                    <option <?=old_select('disabled','0',$row['disabled'])?> value="0">Yes</option>
                    <option <?=old_select('disabled','1',$row['disabled'])?> value="1">No</option>
                </select>
                <label for="floatingInput">Active</label>
            </div>

        <a href="<?=ROOT?>/admin/categories">
        <button class="mt-4 btn btn-lg btn-primary" type="button">Back</button>
        </a>
        <button class="mt-4 btn btn-lg btn-primary float-end" type="submit">Save</button>
    <?php endif;?>
</form>
</div>

<?php elseif($action=='delete'):?>

<div class="col-md-6 mx-auto">
    <form method="post">

    <h1 class="h3 mb-3 fw-normal">Delete category</h1>
    
    <?php if(!empty($row)):?>
   
        <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">Please fix the errors below</div>
        <?php endif; ?>

        <?php if (!empty($errors['category'])): ?>
        <div class="text-danger"><?= $errors['category'] ?></div>
        <?php endif; ?>

        <div class="form-floating">
        <input value="<?= old_value('category', $row['category']) ?>" name="category" type="category" class="form-control mb-3" id="floatingInput" placeholder="category">
        </div>

        <?php if (!empty($errors['slug'])): ?>
        <div class="text-danger"><?= $errors['slug'] ?></div>
        <?php endif; ?>

        <div class="form-floating">
        <input value="<?= old_value('slug', $row['slug']) ?>" name="slug" type="slug" class="form-control mb-3" id="floatingInput" placeholder="slug">
        </div>


        <a href="<?=ROOT?>/admin/categories">
        <button class="mt-4 btn btn-lg btn-primary" type="button">Back</button>
        </a>
        <button class="mt-4 btn-danger btn btn-lg btn-primary float-end" type="submit">Delete</button>
    <?php endif;?>
</form>
</div>
<?php else:?>

<h4>Categories 
<a href="<?=ROOT?>/admin/categories/add">
<button class="btn btn-primary">Add New</button>
</a>
</h4>

<div class="table-responsive">
<table class="table">

<tr>
    <th>#</th>
    <th>Category</th>
    <th>Slug</th>
    <th>Active</th>
    <th>Action</th>
</tr>
<?php
    $limit = 10;
    $offset = ($PAGE['page_number'] - 1) * $limit;

    $query = "select * from categories order by id desc limit $limit offset $offset";
    $rows = query($query);

?>

<?php if (!empty($rows)): ?>
    <?php foreach ($rows as $row): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= esc($row['category']) ?></td>
        <td><?= $row['slug'] ?></td>
        <td><?= $row['disabled'] ? 'No':'Yes'?></td>
        <td>
            <a href="<?=ROOT?>/admin/categories/edit/<?=$row['id']?>">
            <button class="btn btn-small"><i class="bi bi-pen-fill"></i></button>
            </a>
            <a href="<?=ROOT?>/admin/categories/delete/<?=$row['id']?>">
            <button class="btn btn-small"><i class="bi bi-trash-fill"></i></button>
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
<?php endif; ?>
</table>
<div class="col-md-12">
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
    </div>


<?php endif;?>
