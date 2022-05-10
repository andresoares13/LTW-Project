<?php declare(strict_types = 1); ?>

<?php function drawMenu(int $id, string $menuName, int $restaurantId, string $restaurantName, array $dishes) { ?>
  <h2><?=$menuName?></h2>
  <h3><a href="menu.php?id=<?=$restaurantId?>"><?=$restaurantName?></a></h3>      
  <table id="menus">
    <tr><th scope="col">#</th><th scope="col">Dish</th><th scope="col">Price</th><th scope="col">Category</th></tr>
    <?php foreach ($dishes as $dish) { ?>
      <tr><td><?=$dish['id']?></td><td><?=$dish['name']?></td><td><?=$dish['price']?></td><td><?=$dish['category']?></td></tr>
    <?php } ?>
  </table>
<?php } ?>