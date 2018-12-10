<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($this->data['equipment']) ? 'Edit Equipment' : 'Create equipment'; ?></title>
</head>
<body>
<a href="/app.php/equipments">Equipments list</a>

<h1><?php echo isset($this->data['equipment']) ? 'Edit Equipment' : 'Create equipment'; ?></h1>

<div class="errors-bl"><?php
    $form = $this->data['form'];
    foreach ($form->getViolations() as $key => $violation) { ?>
        <div class="error-item"><?php echo $violation; ?></div>
    <?php } ?></div>

<form method="POST">
    <!-- return field value -->
    <input type="text" name="name" placeholder="name" required value="<?php echo $form->getData()['name']; ?>">
    <input type="text" name="description" placeholder="description" required value="<?php echo $form->getData()['description']; ?>">
    <button type="submit" name="submit">Accept</button>
</form>
</body>
</html>
