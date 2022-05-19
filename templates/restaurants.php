<?php declare(strict_types = 1); ?>

<?php function drawRestaurants(array $restaurants) { ?>
  <!--<header>
    <input id="searchrestaurant" type="text" placeholder="search">
  </header>-->
  <section id="restaurants">
    <?php foreach($restaurants as $restaurant) { ?> 
      <article>
        <img src="../restaurantPictures/<?=$restaurant['photo']?>">
        <a href="../pages/restaurant.php?id=<?=$restaurant['id']?>"><?=$restaurant['name']?></a>
      </article>
    <?php } ?>
  </section>
<?php } ?>

<?php function drawRestaurant(Restaurant $restaurant, array $menus, bool $favorite) { ?>
  <h2><?=$restaurant->name?></h2> 
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
  <p>
    <a href="../pages/review.php?id=<?=$restaurant->id?>">Reviews</a>
  </p>
  <?php if (!$favorite){ ?>
  <form action="../action/action_add_favorite.php" method="post" class="favorite">
  <label class="rating">
    
  <label>
    <input type="checkbox" name="stars" value="1" onchange='this.form.submit();' />
    <span class="icon">★</span>
  </label>
</label>
<input id="id" type="hidden" name="id" value="<?=$restaurant->id?>" required="required">
<input id="id" type="hidden" name="type" value="restaurant" required="required">
Add to your favorites
  </form>
<?php } else {?>
  <form action="../action/action_remove_favorite.php" method="post" class="favorite">
  <label class="rating">
    
  <label>
    <input type="checkbox" name="stars" value="1" checked  onclick='this.form.submit();' />
    <span class="icon">★</span>
  </label>
</label>
<input id="id" type="hidden" name="id" value="<?=$restaurant->id?>" required="required">
<input id="id" type="hidden" name="type" value="restaurant" required="required">
Remove from your favorites
</form>
  <?php }?>
<?php } ?>

<?php function drawRestaurantOwner(Restaurant $restaurant, array $menus) { ?>
  <h2><?=$restaurant->name?></h2>
  <a href="../pages/restaurant.php?id=<?=$restaurant->id?>&id2=edit">Edit restaurant information</a> |
  <a href="../pages/restaurant.php?id=<?=$restaurant->id?>&id2=edit2">Add a menu</a>
  <h3>Category: <?=$restaurant->category?></h3>
  <section id="menu">
    <?php foreach ($menus as $menu) { ?>
    <article>
      <h3><ul><li><a href="../pages/menu.php?id=<?=$menu['id']?>"><?=$menu['name']?></a></li></ul></h3>
    </article>
    <?php } ?>
    
  </section>
  <p>
    Restaurant's Adress: <?=$restaurant->adress?>
  </p>
  <p>
    <a href="../pages/review.php?id=<?=$restaurant->id?>">Reviews</a>
  </p>
<?php } ?>

<?php function drawProfileRestaurants(array $restaurants) { ?>
  <header>
    <h2>My Restaurants</h2>
    <input id="searchrestaurant" type="text" placeholder="search">
  </header>
  <section id="restaurants">
  <a href="../pages/restaurant.php?id=add">Add a restaurant</a>
    <?php foreach($restaurants as $restaurant) { ?> 
      <article>
        <img src="../restaurantPictures/<?=$restaurant['photo']?>">
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
    <input id="name" type="text" name="name" required="required">
  
    <input id="id" type="hidden" name="id" value="<?=$restaurant->id?>" required="required">

    <button type="submit">Add menu</button>

    <p id="error_messages" style="color: black">
      <?php if(isset($_SESSION['ERROR'])) echo htmlentities($_SESSION['ERROR']); unset($_SESSION['ERROR'])?>
    </p>
  </form>
<?php } ?>


<?php function drawNewRestaurantForm() { ?>
<h2>Restaurant details</h2>
<form action="../action/action_add_restaurant.php" method="post" class="restaurant">

  <label for="name">Name:</label>
  <input id="name" type="text" name="name"  required="required">
  
  <label for="adress">Address:</label>
  <input id="adress" type="text" name="adress"  required="required">
  
  <label for="category">Category:</label>
  <input id="category" type="text" name="category"  required="required">
  

  <button type="submit">Add restaurant</button>

  <p id="error_messages" style="color: black">
    <?php if(isset($_SESSION['ERROR'])) echo htmlentities($_SESSION['ERROR']); unset($_SESSION['ERROR'])?>
  </p>
</form>
<?php } ?>