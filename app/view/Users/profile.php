<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Profile</title>
</head>
<body>

  <?php require __DIR__.'/../Core/menu.php'; ?>
  <?php require __DIR__.'/../Core/form_errors.php'; ?>
<h1>Profile</h1>

<table width="100%" cellspacing="0" style="text-align: center">
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
    <td><?php echo $user['id'] ?></td>
    <td><?php echo $user['login'] ?></td>
    <td><?php echo implode(', ', $user['roles']); ?></td>
  </tr>
  </tbody>
</table>
<form method="post">
  <input type="password" name="plain_password" placeholder="password">
  <input type="password" name="plain_password_confirm" placeholder="password">
  <button type="submit" name="submit">Change password</button>
</form>
</body>
</html>
