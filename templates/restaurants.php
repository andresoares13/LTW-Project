<?php declare(strict_types = 1); ?>

<?php function drawRestaurants(array $restaurants) { ?>
  <header>
    <h2>Restaurants</h2>
    <input id="searchrestaurant" type="text" placeholder="search">
  </header>
  <section id="restaurants">
    <?php foreach($restaurants as $restaurant) { ?> 
      <article>
        <img src="../pictures/<?=$restaurant['photo']?>">
        <a href="../pages/restaurant.php?id=<?=$restaurant['id']?>"><?=$restaurant['name']?></a>
      </article>
    <?php } ?>
  </section>
<?php } ?>

<?php function drawRestaurant(Restaurant $restaurant, array $menus) { ?>
  <h2><?=$restaurant->name?></h2>
  <section id="menu">
    <?php foreach ($menus as $menu) { ?>
    <article>
      <img src="https://picsum.photos/200?<?=$menu['id']?>">
      <a href="../pages/menu.php?id=<?=$menu['id']?>"><?=$menu['name']?></a>
    </article>
    <?php } ?>
  </section>
<?php } ?>