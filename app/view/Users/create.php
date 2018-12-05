<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
</head>
<body>
<?php
$form = $this->data['form'];
if (!$form->isValid()) {
        foreach ($form->getViolations() as $key => $violation){
        echo $key;
        echo $violation.'<br>';
    }
}
print_r($form->getData()['roles']);
?>

<form method="POST" action="/app.php/users/<?php echo $this->data['action'] ?>">
    <!-- return field value -->
    <input type="text" name="login" placeholder="login" required value="<?php echo $form->getData()['login']; ?>">
    <input type="password" name="password" placeholder="password" required>
    <select name="roles" multiple required>
        <option value=""></option>
        <?php foreach (\Enum\RolesEnum::getAll() as $role) { ?>
            <!-- TODO if in array => selected-->
            <option value="<?php echo $role ?>"
                <?php
                foreach ($form->getData()['roles'] as $role_){
                    if($role_ === $role){
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
