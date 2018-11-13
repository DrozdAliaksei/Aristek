<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 06.11.18
 * Time: 19:31
 */
?>
<html>
<head></head>
<body>

<h1>Users: <?php echo count($users); ?></h1>
<ol>
    <?php foreach ($users as $user) { ?>
        <li><?php echo $user['login'] ?></li>
    <?php } ?>
</ol>
</body>
</html>
