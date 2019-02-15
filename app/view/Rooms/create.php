<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($this->data['room']) ? 'Edit Room' : 'Create room'; ?></title>
</head>
<body>

<?php require __DIR__.'/../Core/menu.php'; ?>

<h1><?php echo isset($this->data['room']) ? 'Edit Room' : 'Create room'; ?></h1>

<?php require __DIR__.'/../Core/form_errors.php'; ?>

<form method="POST">
    <!-- return field value -->
    <input type="text" name="name" placeholder="name" required value="<?php echo $form->getData()['name']; ?>">
    <input type="text" name="description" placeholder="description" required value="<?php echo $form->getData()['description']; ?>">
    <button type="submit" name="submit">Accept</button>
</form>
</body>
</html>
