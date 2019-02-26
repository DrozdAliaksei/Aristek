<nav>
  <div >
    <ul class="menu">
        <?php
        /**
         * @var \Core\Template\Menu $menu
         */
        $menu = $this->data['menu'];
        foreach ($menu as $item) { ?>
          <li><a class='menu_item' href="<?php echo $item['url'] ?>"><?php echo $item['title'] ?></a></li>
        <?php } ?>
    </ul>
  </div>
</nav>