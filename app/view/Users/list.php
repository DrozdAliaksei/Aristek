<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <title>Users</title>
  <link href="/css/wrap.css" type="text/css" rel="stylesheet">
  <link href="/css/title.css" type="text/css" rel="stylesheet">
  <link href="/css/addButton.css" type="text/css" rel="stylesheet">
  <link href="/css/menu.css" type="text/css" rel="stylesheet">
  <link href="/css/footer.css" type="text/css" rel="stylesheet">
  <link href="/css/table.css" type="text/css" rel="stylesheet">

</head>
<body>
<div class="wrap">
  <div class="title">
    <h1>Users</h1>
  </div>
    <?php require __DIR__.'/../Core/menu.php'; ?>

  <table class="table" width="100%" cellspacing="0" style="text-align: center">
    <thead>
    <div class="add">
      <tr>
        <th>
          <a href="/app.php/users/create" class="button">Create new user</a>
        </th>
      </tr>
    </div>
    <tr>
      <th>Id</th>
      <th>Login</th>
      <th>Roles</th>
      <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->data['users'] as $user) { ?>
      <tr>
        <td><?php echo $user['id'] ?></td>
        <td><?php echo $user['login'] ?></td>
        <td><?php echo $user['role'] ?></td>
        <td>
          <div class="actions">
            <a href="/app.php/users/<?php echo $user['id']; ?>/edit" class="button">Edit</a>
            <a href="/app.php/users/<?php echo $user['id']; ?>/delete" class="button">Delete</a>
          </div>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <footer>
      <?php require __DIR__.'/../Core/footer.php'; ?>
  </footer>
</div>
</body>
</html>
