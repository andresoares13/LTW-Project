<?php declare(strict_types = 1); ?>

<?php function drawRestaurants(array $restaurants) { ?>
  <h2>Restaurants</h2>
  <section id="restaurants">
    <?php foreach($restaurants as $restaurant) { ?> 
      <article>
        <img src="https://picsum.photos/200?<?=$restaurant['id']?>">
        <a href="restaurant.php?id=1"><?=$restaurant['name']?></a>
      </article>
    <?php } ?>
  </section>
<?php } ?>

<?php function drawRestaurant(string $restaurantName, array $restaurants) { ?>
  <h2><?=$artistName?></h2>
  <section id="menu">
    <?php foreach ($restaurants as $restaurant) { ?>
    <article>
      <img src="https://picsum.photos/200?<?=$menu['id']?>">
      <a href="menu.php?id=1"><?=$menu['name']?>Menu Name</a>
      <p class="info"><?=$menu['dish']?> dishes <?=$menu['id']?></p>
    </article>
    <?php } ?>
  </section>
<?php } ?>