<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <title>Authorization</title>
  <link href="/css/wrap.css" type="text/css" rel="stylesheet">
  <link href="/css/title.css" type="text/css" rel="stylesheet">
  <link href="/css/footer.css" type="text/css" rel="stylesheet">
  <link href="/css/in-form.css" type="text/css" rel="stylesheet">
  <link href="/css/form-errors.css" type="text/css" rel="stylesheet">

</head>
<body>
<div class="wrap">
  <div class="title">
    <h1>Login</h1>
  </div>

    <?php require __DIR__.'/../Core/form_errors.php'; ?>

  <div class="form">
    <form class="in-form" method="POST">
      <input type="text" name="login" placeholder="login" required value="<?php echo $form->getData(
          )['login'] ?? ''; ?>">
      <input type="password" name="password" placeholder="password" required>
      <button type="submit" name="submit">Login</button>
    </form>
  </div>
  <footer>
      <?php require __DIR__.'/../Core/footer.php'; ?>
  </footer>
</div>
</body>
</html>
