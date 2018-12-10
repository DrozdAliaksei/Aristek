<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
</head>
<body>
<a href="/app.php/users">Main page</a>

<h1><?php echo isset($this->data['user']) ? 'Edit User' : 'Create user'; ?></h1>

<div class="errors-bl"><?php
    $form = $this->data['form'];
    foreach ($form->getViolations() as $key => $violation) { ?>
      <div class="error-item"><?php echo $violation; ?></div>
    <?php } ?></div>

<form method="POST">
    <!-- return field value -->
    <input type="text" name="login" placeholder="login" required value="<?php echo $form->getData()['login']; ?>">
    <input type="password" name="password" placeholder="password" required>
    <select name="roles[]" multiple required>
        <option value=""></option>
        <?php foreach (\Enum\RolesEnum::getAll() as $role) { ?>
            <!-- TODO if in array => selected-->
            <option value="<?php echo $role ?>"
                <?php
                foreach ($form->getData()['roles'] as $role_) {
                    if ($role_ === $role) {
                        echo 'selected';
                    }
                }  //TODO dont work multiple selection in create
                ?>>
                <?php echo $role ?>
            </option>
        <?php } ?>
    </select>
    <button type="submit" name="submit">Accept</button>
</form>
</body>
</html>
