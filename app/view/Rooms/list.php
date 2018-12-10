<!DOCTYPE html>
<html>
<head></head>
<body>
<h1>Users</h1>
<a href="/app.php/rooms/create">Add new room</a>
<table width="100%" cellspacing="0" style="text-align: center">
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Description</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->data['rooms'] as $room) { ?>
        <tr>
            <td><?php echo $room['id'] ?></td>
            <td><?php echo $room['name'] ?></td>
            <td><?php echo $room['description'] ?></td>
            <td>
                <a href="/app.php/rooms/<?php echo $room['id']; ?>/edit">Edit</a>
                <a href="/app.php/rooms/<?php echo $room['id']; ?>/delete">Delete</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>
