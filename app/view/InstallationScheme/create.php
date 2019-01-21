<!DOCTYPE html>
<html>
<head>
    <title>Create Installation scheme</title>
</head>
<body>
<a href="/app.php/installation_scheme">Installation scheme list</a>
<?php $form = $this->data['form']; echo json_encode($form->getData()); ?>
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
                if ($form->getData()['room_id'] === $room['id']) {
                    echo 'selected';
                }
                ?>>
                <?php echo $room['name'] ?>
            </option>
        <?php } ?>
    </select>
    <select name="equipment_id" required>
        <option value=""></option>
        <?php foreach ($this->data['equipments'] as $equipment) { ?>
            <option value="<?php echo $equipment['id'] ?>"
                <?php
                if ($form->getData()['equipment_id'] === $equipment['id']) {
                    echo 'selected';
                }
                ?>>
                <?php echo $equipment['name'] ?>
            </option>
        <?php } ?>
    </select>
    <input type="text" name="displayable_name" placeholder="displayable name" required
           value="<?php echo $form->getData()['displayable_name']; ?>">
    <select title="status" name="status" required>
        <option value=""></option>
        <?php foreach (\Enum\StatusEnum::getAll() as $status) { ?>
            <!-- TODO if in array => selected-->
            <option value="<?php echo $status[1] ?>"
                <?php
                    if ($form->getData()['status'] == $status[1]) {
                        echo 'selected';
                    }
                ?>>
                <?php echo $status[0] ?>
            </option>
        <?php } ?>
    </select>
    <select name="role[]" multiple required>
        <option value=""></option>
        <?php foreach (\Enum\RolesEnum::getAll() as $role) { ?>
            <!-- TODO if in array => selected-->
            <option value="<?php echo $role ?>"
                <?php
                foreach ($form->getData()['role'] as $role_) {
                    if ($role_ === $role) {
                        echo 'selected';
                    }
                }
                ?>>
                <?php echo $role ?>
            </option>
        <?php } ?>
    </select>
    <button type="submit" name="submit">Accept</button>
</form>
</body>
</html>
