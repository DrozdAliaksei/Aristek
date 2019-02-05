<!DOCTYPE html>
<html>
<head>
    <title>Authorization</title>
</head>
<body>
<a href="/installation_scheme">Installation schems</a>

<h1>Login</h1>

<?php require __DIR__.'/../Core/form_errors.php'; ?>

<form method="POST">
    <!-- return field value -->
    <input type="text" name="login" placeholder="login" required value="<?php echo $form->getData()['login']??''; ?>">
    <input type="password" name="password" placeholder="password" required>
    <button type="submit" name="submit">Login</button>
</form>
</body>
</html>
