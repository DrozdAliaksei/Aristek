<?php $isCreate = !isset($this->data['user']); ?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <title>Create User</title>
  <link href="/css/wrap.css" type="text/css" rel="stylesheet">
  <link href="/css/title.css" type="text/css" rel="stylesheet">
  <link href="/css/menu.css" type="text/css" rel="stylesheet">
  <link href="/css/footer.css" type="text/css" rel="stylesheet">
  <link href="/css/in-form.css" type="text/css" rel="stylesheet">
  <link href="/css/form-errors.css" type="text/css" rel="stylesheet">

</head>
<body>
<div class="wrap">
  <div class="title">
    <h1><?php echo $isCreate ? 'Create user' : 'Edit User'; ?></h1>
  </div>
    <?php require __DIR__.'/../Core/menu.php'; ?>
    <?php require __DIR__.'/../Core/form_errors.php'; ?>
  <div class="form">
    <form class="in-form" method="POST">
      <!-- return field value -->
      <label for="login">Login</label>
      <input type="text" name="login" id="login" required value="<?php echo $form->getData()['login']; ?>">
      <label for="password">Password</label>
      <input type="password" id="password" name="plain_password" <?php if ($isCreate) {
          echo 'required';
      } ?> >
      <label for="confirm_password">Confirm password</label>
      <input type="password" id="confirm_password" name="plain_password_confirm" <?php if ($isCreate) {
          echo 'required';
      } ?> >
      <label for="role">Role</label>
      <select name="role" id="role" required>
        <option value=""></option>
          <?php foreach (\Enum\RolesEnum::getAll() as $role) { ?>
            <option value="<?php echo $role ?>"
                <?php
                if ($this->data['role'] == false && $role == 'admin') {
                    continue;
                }
                if ($form->getData()['role'] === $role) {
                    echo 'selected';
                }
                ?>>
                <?php echo $role ?>
            </option>
          <?php } ?>
      </select>
      <button type="submit" name="submit">Accept</button>
    </form>
  </div>
      <?php require __DIR__.'/../Core/footer.php'; ?>
</div>
</body>
</html>
