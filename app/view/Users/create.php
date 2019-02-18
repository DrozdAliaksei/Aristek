<?php $isCreate = !isset($this->data['user']); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
</head>
<body>

<h1><?php echo $isCreate ? 'Create user' : 'Edit User'; ?></h1>

<?php require __DIR__.'/../Core/menu.php'; ?>
<?php require __DIR__.'/../Core/form_errors.php'; ?>

<form method="POST">
    <!-- return field value -->
    <input type="text" name="login" placeholder="login" required value="<?php echo $form->getData()['login']; ?>">
    <input type="password" name="plain_password" placeholder="password" <?php if($isCreate) {echo 'required';} ?> >
    <input type="password" name="plain_password_confirm" placeholder="password" <?php if($isCreate) {echo 'required';} ?> >
    <select name="roles[]" multiple required>
        <option value=""></option>
        <?php foreach (\Enum\RolesEnum::getAll() as $role) { ?>
            <option value="<?php echo $role ?>"
                <?php
                if($this->data['roles'] === false && $role ==='admin'){
                  continue;
                }
                foreach ($form->getData()['roles'] as $role_) {
                    if ($role_ === $role) {
                        echo 'selected';
                    }
                }
                ?>>
                <?php echo $role ?>
            </option>
        <?php } ?>
    </select>
    <button type="submit" name="submit">Accept</button>
</form>
</body>
</html>
