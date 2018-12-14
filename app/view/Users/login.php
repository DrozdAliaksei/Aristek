<!DOCTYPE html>
<html>
<head>
    <title>Authorization</title>
</head>
<body>
<a href="/app.php">Main page</a>

<h1>Login</h1>

<div class="errors-bl"><?php
    $form = $this->data['form'];
    foreach ($form->getViolations() as $key => $violation) { ?>
        <div class="error-item"><?php echo $violation; ?></div>
    <?php } ?></div>

<form method="POST">
    <!-- return field value -->
    <input type="text" name="login" placeholder="login" required value="<?php echo $form->getData()['login']??''; ?>">
    <input type="password" name="password" placeholder="password" required>
    <button type="submit" name="submit">Login</button>
</form>
</body>
</html>
