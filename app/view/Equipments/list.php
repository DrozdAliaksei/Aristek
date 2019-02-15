<!DOCTYPE html>
<html>
<head></head>
<body>
<h1>Equipments</h1>

<?php require __DIR__.'/../Core/menu.php'; ?>
<a href="/app.php/equipments/create">Add new equipment</a>

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
    <?php foreach ($this->data['equipments'] as $equipment) { ?>
        <tr>
            <td><?php echo $equipment['id'] ?></td>
            <td><?php echo $equipment['name'] ?></td>
            <td><?php echo $equipment['description'] ?></td>
            <td>
                <a href="/app.php/equipments/<?php echo $equipment['id']; ?>/edit">Edit</a>
                <a href="/app.php/equipments/<?php echo $equipment['id']; ?>/delete">Delete</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>
