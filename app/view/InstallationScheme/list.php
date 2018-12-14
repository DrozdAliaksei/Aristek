<!DOCTYPE html>
<html>
<head></head>
<body>
<h1>Installation scheme</h1>
<a href="/app.php/installation_scheme/create">Add new scheme</a>
<table width="100%" cellspacing="0" style="text-align: center">
    <thead>
    <tr>
        <th>Id</th>
        <th>Room</th>
        <th>Equipment</th>
        <th>Displayable Name</th>
        <th>Status</th>
        <th>Role</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->data['schems'] as $scheme) { ?>
        <tr>
            <td><?php echo $scheme['id'] ?></td>
            <td><?php echo $scheme['room_name'] ?></td>
            <td><?php echo $scheme['equipment_name'] ?></td>
            <td><?php echo $scheme['displayable_name'] ?></td>
            <td><?php if($scheme['status'] == 1){echo "On";}else{echo "Off";} ?></td>
            <td><?php echo implode(', ', $scheme['role']); ?></td>
            <td>
                <a href="/app.php/installation_scheme/<?php echo $scheme['id']; ?>/edit">Edit</a>
                <a href="/app.php/installation_scheme/<?php echo $scheme['id']; ?>/delete">Delete</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>
