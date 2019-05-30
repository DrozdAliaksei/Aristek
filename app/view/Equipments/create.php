<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <title><?php echo isset($this->data['equipment']) ? 'Edit Equipment' : 'Create equipment'; ?></title>
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
    <h1><?php echo isset($this->data['equipment']) ? 'Edit Equipment' : 'Create equipment'; ?></h1>
  </div>

    <?php require __DIR__.'/../Core/menu.php'; ?>
    <?php require __DIR__.'/../Core/form_errors.php'; ?>
<div class="form">
  <form class="in-form" method="POST">
    <!-- return field value -->
    <label for="name">Name</label>
    <input type="text" id="name" name="name" placeholder="name" required value="<?php echo $form->getData()['name']; ?>">
    <label for="description">Description</label>
    <input type="text" id="description" name="description" placeholder="description" required value="<?php echo $form->getData(
    )['description']; ?>">
      <label for="gpio">BCM GPIO</label>
      <input type="number" id="gpio" name="gpio" placeholder="gpio" required value="<?php echo $form->getData()['BCM_GPIO']; ?>">
    <button type="submit" name="submit">Accept</button>
  </form>
</div>
<footer>
    <?php require __DIR__.'/../Core/footer.php'; ?>
</footer>
</div>
</body>
</html>
