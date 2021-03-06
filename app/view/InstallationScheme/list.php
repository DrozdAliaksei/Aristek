<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <title>Installation scheme</title>
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
    <h1>Installation scheme</h1>
  </div>
    <?php require __DIR__.'/../Core/menu.php'; ?>
    <?php require __DIR__.'/../Core/messages.php'; ?>

  <div class="add">
      <?php if (in_array($this->data['role'], ['admin', 'user'])) { ?>
        <a href="/installation-scheme/create" class="button">Add new scheme</a><?php } ?>
  </div>

  <table class="table" width="100%" cellspacing="0" style="text-align: center">
    <thead>
    <tr>
      <th>Room</th>
      <th>Equipment</th>
      <th>Description</th>
      <th>Status</th>
      <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->data['schems'] as $scheme) { ?>
      <tr>
        <td><?php echo $scheme['room_name'] ?></td>
        <td><?php echo $scheme['equipment_name'] ?></td>
        <td><?php echo $scheme['displayable_name'] ?></td>
        <td><?php if ($scheme['status'] == 1) {
                echo "On";
            } else {
                echo "Off";
            } ?></td>
        <td>
          <div class="actions">
            <a href="/installation-scheme/<?php echo $scheme['id']; ?>/<?php echo $scheme['status']; ?>/change-status" class="button">Toggle
              status</a>
              <?php if (in_array($this->data['role'], ['admin', 'user'])) { ?>
                <a href="/installation-scheme/<?php echo $scheme['id']; ?>/edit" class="button">Edit</a>
                <a href="/installation-scheme/<?php echo $scheme['id']; ?>/delete" class="button">Delete</a>
              <?php } ?>
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
