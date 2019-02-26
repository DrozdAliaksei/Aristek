<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <title>Equipments</title>
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
    <h1>Equipments</h1>
  </div>
    <?php require __DIR__.'/../Core/menu.php'; ?>

  <table class="table" width="100%" cellspacing="0" style="text-align: center">
    <thead>
    <div class="add">
      <tr>
        <th>
          <a href="/app.php/equipments/create" class="button">Add new equipment</a>
        </th>
      </tr>
    </div>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Description</th>
      <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->data['equipments'] as $equipment) { ?>
      <tr>
        <td><?php echo $equipment['id'] ?></td>
        <td><?php echo $equipment['name'] ?></td>
        <td><?php echo $equipment['description'] ?></td>
        <td>
          <div class="actions">
            <a href="/app.php/equipments/<?php echo $equipment['id']; ?>/edit" class="button">Edit</a>
            <a href="/app.php/equipments/<?php echo $equipment['id']; ?>/delete" class="button">Delete</a>
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
