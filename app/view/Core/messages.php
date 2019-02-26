<div>
    <?php
    $flash = $this->data['flash'];
    foreach ($flash as $group => $messages) {
      foreach ($messages as $message) { ?>
        <div class="messages-<?php echo $group; ?>"><?php echo $message; ?>
        </div>
      <?php } ?>
    <?php } ?>
</div>