<?php
$flash = $this->data['flash'];
if (count($flash['errors'])>0 || count($flash['messages'])>0) {
    ?>

  <div class="message-box">
      <?php
      foreach ($flash as $group => $messages) {
          foreach ($messages as $message) { ?>
            <div class="messages-<?php echo $group; ?>"><?php echo $message; ?></div>
          <?php } ?>
      <?php } ?>
  </div>
<?php } ?>