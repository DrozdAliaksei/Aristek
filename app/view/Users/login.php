<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Authorization</title>
</head>
<body>

<h1>Login</h1>

<?php require __DIR__.'/../Core/form_errors.php'; ?>

<form method="POST">
  <input type="text" name="login" placeholder="login" required value="<?php echo $form->getData()['login'] ?? ''; ?>">
  <input type="password" name="password" placeholder="password" required>
  <button type="submit" name="submit">Login</button>
</form>
</body>
</html>
