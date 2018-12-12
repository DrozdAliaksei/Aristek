<!DOCTYPE html>
<html>
<head>
    <title>Create Installation scheme</title>
</head>
<body>
<a href="/app.php/installation_scheme">Installation scheme list</a>

<h1><?php echo isset($this->data['scheme']) ? 'Edit scheme' : 'Create scheme'; ?></h1>

<div class="errors-bl"><?php
    $form = $this->data['form'];
    foreach ($form->getViolations() as $key => $violation) { ?>
        <div class="error-item"><?php echo $violation; ?></div>
    <?php } ?></div>

<form method="POST">
    <!-- return field value -->
    <select name="room_id" required>
        <option value=""></option>
        <?php foreach ($this->data['rooms'] as $room) { ?>
            <option value="<?php echo $room['id'] ?>"
                <?php
                if ($form->getData()['room_id'] === $room) {
                    echo 'selected';
                }
                ?>>
                <?php echo $room['name'] ?>
            </option>
        <?php } ?>
    </select>
    <input type="text" name="desplayable name" placeholder="desplayable name" required
           value="<?php echo $form->getData()['desplayable name']; ?>">
    <input type="text" name="status" placeholder="status" requiredvalue="<?php echo $form->getData()['status']; ?>">
    <input type="text" name="role" placeholder="role" requiredvalue="<?php echo $form->getData()['role']; ?>">
    <button type="submit" name="submit">Accept</button>
</form>
</body>
</html>
