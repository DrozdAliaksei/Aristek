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
      <input type="text" name="login" placeholder="login" required value="<?php echo $form->getData()['login']; ?>">
      <input type="password" name="plain_password" placeholder="password" <?php if ($isCreate) {
          echo 'required';
      } ?> >
      <input type="password" name="plain_password_confirm" placeholder="password" <?php if ($isCreate) {
          echo 'required';
      } ?> >
      <select name="role" required >
        <option value=""></option>
          <?php foreach (\Enum\RolesEnum::getAll() as $role) { ?>
            <option value="<?php echo $role ?>"
                <?php
                if ($this->data['role'] === false && $role === 'admin') {
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
  <footer>
      <?php require __DIR__.'/../Core/footer.php'; ?>
  </footer>
</div>
</body>
</html>
