<!DOCTYPE html>
<head>
  <meta charset=UTF-8">
  <title>Exception</title>
  <link href="/css/wrap.css" type="text/css" rel="stylesheet">
  <link href="/css/title.css" type="text/css" rel="stylesheet">
  <link href="/css/menu.css" type="text/css" rel="stylesheet">
  <link href="/css/footer.css" type="text/css" rel="stylesheet">
  <link href="/css/messages.css" type="text/css" rel="stylesheet">
  <link href="/css/exceptions.css" type="text/css" rel="stylesheet">

</head>
<body>
<div class="wrap">
  <div class="title">
    <h1>Exception</h1>
  </div>
    <?php require __DIR__.'/../Core/menu.php'; ?>
    <?php require __DIR__.'/../Core/messages.php'; ?>

  <div class="exception">
    <div class="exception-code">
        <?php echo $this->data['code']; ?>
    </div>
    <div class="exception-message">
        <?php echo $this->data['message']; ?>
    </div>
  </div>

    <?php require __DIR__.'/../Core/footer.php'; ?>
</div>
</body>
