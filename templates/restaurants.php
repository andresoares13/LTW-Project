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
  <h3>Category: <?=$restaurant->category?></h3>
  <section id="menu">
  <h2>Menus:</h2>
    <?php foreach ($menus as $menu) { ?>
    <article>
      <h3><a href="../pages/menu.php?id=<?=$menu['id']?>"><?=$menu['name']?></a></h3>
    </article>
    <?php } ?>
  </section>
  <p>
    Restaurant's Adress: <?=$restaurant->adress?>
  </p>
<?php } ?>

<?php function drawRestaurantOwner(Restaurant $restaurant, array $menus) { ?>
  <h2><?=$restaurant->name?></h2>
  <a href="../pages/restaurant.php?id=<?=$restaurant->id?>&id2=edit">Edit restaurant information</a> |
  <a href="../pages/restaurant.php?id=<?=$restaurant->id?>&id2=edit2">Add a menu</a>
  <h3>Category: <?=$restaurant->category?></h3>
  <section id="menu">
    <h2>Menus:</h2>
    <?php foreach ($menus as $menu) { ?>
    <article>
      <h3><ul><li><a href="../pages/menu.php?id=<?=$menu['id']?>"><?=$menu['name']?></a></li></ul></h3>
    </article>
    <?php } ?>
    
  </section>
  <p>
    Restaurant's Adress: <?=$restaurant->adress?>
  </p>
<?php } ?>

<?php function drawProfileRestaurants(int $id) { ?>
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


<?php function drawRestaurantInfoForm(Restaurant $restaurant) { ?>
<h2>Restaurant details</h2>
<form action="../action/action_edit_restaurant.php" method="post" class="restaurant">

  <label for="name">Name:</label>
  <input id="name" type="text" name="name" value="<?=$restaurant->name?>" required="required">
  
  <label for="adress">Address:</label>
  <input id="adress" type="text" name="adress" value="<?=$restaurant->adress?>" required="required">
  
  <label for="category">Category:</label>
  <input id="category" type="text" name="category" value="<?=$restaurant->category?>" required="required">
  
  <input id="id" type="hidden" name="id" value="<?=$restaurant->id?>" required="required">

  <button type="submit">Save</button>

  <p id="error_messages" style="color: black">
    <?php if(isset($_SESSION['ERROR'])) echo htmlentities($_SESSION['ERROR']); unset($_SESSION['ERROR'])?>
  </p>
</form>
<?php } ?>



<?php function drawNewMenuForm(Restaurant $restaurant) { ?>
  <h2>Create new menu</h2>
  <form action="../action/action_add_menu.php" method="post" class="restaurant">

    <label for="name">Menu name:</label>
    <input id="name" type="text" name="name" value="<?=$restaurant->name?>" required="required">
  
    <input id="id" type="hidden" name="id" value="<?=$restaurant->id?>" required="required">

    <button type="submit">Create</button>

    <p id="error_messages" style="color: black">
      <?php if(isset($_SESSION['ERROR'])) echo htmlentities($_SESSION['ERROR']); unset($_SESSION['ERROR'])?>
    </p>
  </form>
<?php } ?>