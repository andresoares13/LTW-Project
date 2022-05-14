<?php declare(strict_types = 1);

require_once('../database/restaurant.class.php');
require_once('../database/menu.class.php');
?>

<?php function drawMenu(Menu $menu, Restaurant $restaurant, array $menu_items) { ?>
  <h2><?=$menu->name?></h2>
  <h3><a href="../pages/restaurant.php?id=<?=$restaurant->id?>"><?=$restaurant->name?></a></h3>      
  <table id="menus">
    <tr><th scope="col">#</th><th scope="col">Menu Item</th><th scope="col">Price</th><th scope="col">Category</th></tr>
    <?php foreach ($menu_items as $i => $item) { ?>
      <tr><td><?=$item->id?></td><td><?=$item->name?></td><td><?=$item->price?></td><td><?=$item->category?></td></tr>
    <?php } ?>
  </table>
<?php } ?>