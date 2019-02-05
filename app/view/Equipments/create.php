<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($this->data['equipment']) ? 'Edit Equipment' : 'Create equipment'; ?></title>
</head>
<body>
<a href="/app.php/equipments">Equipments list</a>

<h1><?php echo isset($this->data['equipment']) ? 'Edit Equipment' : 'Create equipment'; ?></h1>

<?php require __DIR__.'/../Core/form_errors.php'; ?>

<form method="POST">
    <!-- return field value -->
    <input type="text" name="name" placeholder="name" required value="<?php echo $form->getData()['name']; ?>">
    <input type="text" name="description" placeholder="description" required value="<?php echo $form->getData()['description']; ?>">
    <button type="submit" name="submit">Accept</button>
</form>
</body>
</html>
