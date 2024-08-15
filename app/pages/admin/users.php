<?php if($action=='add'):?>

    <div class="col-md-6 mx-auto">
        <form method="post">

        <h1 class="h3 mb-3 fw-normal">Create an account</h1>
        
        <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">Please fix the errors below</div>
        <?php endif; ?>

        <?php if (!empty($errors['email'])): ?>
        <div class="text-danger"><?= $errors['email'] ?></div>
        <?php endif; ?>

        <div class="form-floating">
        <input value="<?= old_value('email') ?>" name="email" type="email" class="form-control mb-3" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
        </div>

        <div class="form-floating">
    <select name="role" class="form-select mb-3">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select>
    <label for="floatingInput">Role</label>
</div>
<?php if (!empty($errors['role'])): ?>
    <div class="text-danger"><?= $errors['role'] ?></div>
<?php endif; ?>



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
        
        <a href="<?=ROOT?>/admin/users">
            <button class="mt-4 btn btn-lg btn-primary" type="button">Back</button>
            </a>
        <button class="mt-4 btn btn-lg btn-primary float-end" type="submit">Create Account</button>

    </form>
    </div>

<?php elseif($action=='edit'):?>

    <div class="col-md-6 mx-auto">
        <form method="post">

        <h1 class="h3 mb-3 fw-normal">Edit account</h1>
        
        <?php if(!empty($row)):?>
       
            <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">Please fix the errors below</div>
            <?php endif; ?>

            <?php if (!empty($errors['email'])): ?>
            <div class="text-danger"><?= $errors['email'] ?></div>
            <?php endif; ?>

            <div class="form-floating">
            <input value="<?= old_value('email', $row['email']) ?>" name="email" type="email" class="form-control mb-3" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
            <select name="role" class="form-select mb-3">
                <option <?= old_select('role', 'user',$row['role'])?> value="user">User</option>
                <option <?= old_select('role', 'admin',$row['role'])?> value="admin">Admin</option>
            </select>
            <label for="floatingInput">Role</label>
           </div>
             <?php if(!empty($errors['role'])):?>
             <div class="text-danger"><?= $errors['role'] ?></div>
            <?php endif;?>

            <?php if (!empty($errors['password'])): ?>
            <div class="text-danger"><?= $errors['password'] ?></div>
            <?php endif; ?>

            <div class="form-floating">
            <input value="<?= old_value('password') ?>" name="password" type="password" class="form-control mb-3" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password (leave empty to keep old password)</label>
            </div>
            <div class="form-floating">
            <input value="<?= old_value('retype_password') ?>" name="retype_password" type="password" class="form-control mb-3" id="floatingRetypePassword" placeholder="Retype Password">
            <label for="floatingRetypePassword">Retype Password</label>
            </div>

            <a href="<?=ROOT?>/admin/users">
            <button class="mt-4 btn btn-lg btn-primary" type="button">Back</button>
            </a>
            <button class="mt-4 btn btn-lg btn-primary float-end" type="submit">Save</button>
        <?php endif;?>
    </form>
    </div>

<?php elseif($action=='delete'):?>

    <div class="col-md-6 mx-auto">
        <form method="post">

        <h1 class="h3 mb-3 fw-normal">Delete account</h1>
        
        <?php if(!empty($row)):?>
       
            <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">Please fix the errors below</div>
            <?php endif; ?>

            <?php if (!empty($errors['email'])): ?>
            <div class="text-danger"><?= $errors['email'] ?></div>
            <?php endif; ?>

            <div class="form-floating">
            <input value="<?= old_value('email', $row['email']) ?>" name="email" type="email" class="form-control mb-3" id="floatingInput" placeholder="name@example.com">
            </div>


            <a href="<?=ROOT?>/admin/users">
            <button class="mt-4 btn btn-lg btn-primary" type="button">Back</button>
            </a>
            <button class="mt-4 btn-danger btn btn-lg btn-primary float-end" type="submit">Delete</button>
        <?php endif;?>
    </form>
    </div>
<?php else:?>

<h4>Users 
    <a href="<?=ROOT?>/admin/users/add">
    <button class="btn btn-primary">Add New</button>
    </a>
</h4>

<div class="table-responsive">
<table class="table">

    <tr>
        <th>#</th>
        <th>Email</th>
        <th>Role</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    <?php
        $limit = 10;
        $offset = ($PAGE['page_number'] - 1) * $limit;

        $query = "select * from users order by id desc limit $limit offset $offset";
        $rows = query($query);

    ?>

    <?php if (!empty($rows)): ?>
        <?php foreach ($rows as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= esc($row['email']) ?></td>
            <td><?= $row['role'] ?></td>
            <td><?= date("jS M, Y", strtotime($row['date'])) ?></td>
            <td>
                <a href="<?=ROOT?>/admin/users/edit/<?=$row['id']?>">
                <button class="btn btn-small"><i class="bi bi-pen-fill"></i></button>
                </a>
                <a href="<?=ROOT?>/admin/users/delete/<?=$row['id']?>">
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
