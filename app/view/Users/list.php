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
  <link href="/css/messages.css" type="text/css" rel="stylesheet">

</head>
<body>
<div class="wrap">
  <div class="title">
    <h1>Users</h1>
  </div>
    <?php require __DIR__.'/../Core/menu.php'; ?>
    <?php require __DIR__.'/../Core/messages.php'; ?>

  <div class="add">
    <a href="/users/create" class="button">Create new user</a>
  </div>

  <table class="table" width="100%" cellspacing="0" style="text-align: center">
    <thead>
    <tr>
      <th>Login</th>
      <th>Roles</th>
      <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->data['users'] as $user) { ?>
      <tr>
        <td><?php echo $user['login'] ?></td>
        <td><?php echo $user['role'] ?></td>
        <td>
          <div class="actions">
            <a href="/users/<?php echo $user['id']; ?>/edit" class="button">Edit</a>
            <a href="/users/<?php echo $user['id']; ?>/delete" class="button">Delete</a>
          </div>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
    <?php require __DIR__.'/../Core/footer.php'; ?>
</div>
</body>
</html>
