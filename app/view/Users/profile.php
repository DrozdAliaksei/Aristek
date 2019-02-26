<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <title>Profile</title>
  <link href="/css/wrap.css" type="text/css" rel="stylesheet">
  <link href="/css/title.css" type="text/css" rel="stylesheet">
  <link href="/css/addButton.css" type="text/css" rel="stylesheet">
  <link href="/css/menu.css" type="text/css" rel="stylesheet">
  <link href="/css/footer.css" type="text/css" rel="stylesheet">
  <link href="/css/table.css" type="text/css" rel="stylesheet">
  <link href="/css/in-form.css" type="text/css" rel="stylesheet">
  <link href="/css/form-errors.css" type="text/css" rel="stylesheet">

</head>
<body>
<div class="wrap">
  <div class="title">
    <h1>Profile</h1>
  </div>
    <?php require __DIR__.'/../Core/menu.php'; ?>
    <?php require __DIR__.'/../Core/form_errors.php'; ?>

  <table class="table" width="100%" cellspacing="0" style="text-align: center">
    <thead>
    <tr>
      <th>Id</th>
      <th>Login</th>
      <th>Roles</th>
    </tr>
    </thead>
    <tbody>
    <?php $user = $this->data['user']; ?>
    <tr>
      <td><?php echo $user['id']; ?></td>
      <td><?php echo $user['login']; ?></td>
      <td><?php echo $user['role']; ?></td>
    </tr>
    </tbody>
  </table>
  <div class="form">
    <form class="in-form" method="post">
      <input type="password" name="plain_password" placeholder="password">
      <input type="password" name="plain_password_confirm" placeholder="password">
      <button type="submit" name="submit">Change password</button>
    </form>
  </div>
  <footer>
      <?php require __DIR__.'/../Core/footer.php'; ?>
  </footer>
</div>
</body>
</html>
