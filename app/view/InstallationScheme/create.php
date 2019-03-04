<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <title>Create Installation scheme</title>
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
      <?php $form = $this->data['form']; ?>
    <h1><?php echo isset($this->data['scheme']) ? 'Edit scheme' : 'Create scheme'; ?></h1>
  </div>
    <?php require __DIR__.'/../Core/menu.php'; ?>
    <?php require __DIR__.'/../Core/form_errors.php'; ?>
  <div class="form">
    <form class="in-form" method="POST">
      <!-- return field value -->
      <label for="room">Room</label>
      <select id="room" name="room_id" required>
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
      <label for="equipment">Equipment</label>
      <select id="equipment" name="equipment_id" required>
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
      <label for="description">Description</label>
      <input type="text" id="description" name="displayable_name" placeholder="description" required
             value="<?php echo $form->getData()['displayable_name']; ?>">
      <label for="status">Status</label>
      <select id="status" title="status" name="status" required>
          <?php foreach (\Enum\StatusEnum::getAll() as $status) { ?>
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
      <label for="role">Role</label>
      <select id="role" class="multi-select" name="role[]" multiple required>
          <?php foreach (\Enum\RolesEnum::getAll() as $role) { ?>

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
  </div>
</div>
<div class="v2footer">
    <?php require __DIR__.'/../Core/footer.php'; ?>
</div>
</body>
</html>