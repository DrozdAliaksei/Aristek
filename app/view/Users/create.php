<?php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
</head>
<body>
<form method="POST" action="/app.php/users/create">
    <input name="login" type="text" placeholder="Login: " required/>
    <input name="password" type="password" placeholder="Password: " required/>
    <select name="roles" placeholder="Roles: " multiple required>
        <?php foreach (\Enum\RolesEnum::getAll() as $role) { ?>
            <option value="<?php echo $role; ?>">
                <?php echo $role; ?>
            </option>
        <?php } ?>
    </select>
    <button type="submit">Create</button>
</form>
</body>
</html>
