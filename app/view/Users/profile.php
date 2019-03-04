<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <title>Profile</title>
  <link href="/css/wrap.css" type="text/css" rel="stylesheet">
  <link href="/css/title.css" type="text/css" rel="stylesheet">
  <link href="/css/menu.css" type="text/css" rel="stylesheet">
  <link href="/css/footer.css" type="text/css" rel="stylesheet">
  <link href="/css/profile.css" type="text/css" rel="stylesheet">
  <link href="/css/form-errors.css" type="text/css" rel="stylesheet">
  <link href="/css/messages.css" type="text/css" rel="stylesheet">

</head>
<body>
<div class="wrap">
  <div class="title">
    <h1>Profile</h1>
  </div>
    <?php require __DIR__.'/../Core/menu.php'; ?>
    <?php require __DIR__.'/../Core/form_errors.php'; ?>

  <div class="profile">

    <div class="profile-info">
      <h1>Profile info</h1>
        <?php $user = $this->data['user']; ?>
      <div class="info-item">
        <h2>Login:</h2>
        <div class="user-info"><?php echo $user['login']; ?></div>
      </div>
      <div class="info-item">
      <h2>Role:</h2>
        <div class="user-info"><?php echo $user['role']; ?></div>
      </div>
    </div>

      <?php require __DIR__.'/../Core/messages.php'; ?>

    <div class="form">
      <form class="profile-form" method="post">
        <h1>Change password</h1>
        <label for="password">Password</label>
        <input type="password" id="password" name="plain_password" placeholder="password">
        <label for="confirm-password">Confirm password</label>
        <input type="password" id="confirm-password" name="plain_password_confirm" placeholder="confirm password">
        <button type="submit" name="submit">Change password</button>
      </form>
    </div>

  </div>

    <?php require __DIR__.'/../Core/footer.php'; ?>

</div>
</body>
</html>
