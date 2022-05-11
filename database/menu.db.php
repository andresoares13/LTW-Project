<?php
  declare(strict_types = 1);

  function getMenu(PDO $db, int $id) {
    $stmt = $db->prepare('SELECT id,name,restaurant FROM menu WHERE id = ?');
    $stmt->execute(array($id));
    $menu = $stmt->fetch();
    return array(
      'id' => (int) $menu['id'], 
      'name' => $menu['name'], 
      'restaurant' =>(int) $menu['restaurant'], 
      'dishes' => getMenuDishes($db, $id)
    );
  }

  function getMenuDishes(PDO $db, int $id) {
    $stmt = $db->prepare('SELECT id, name, price, photo, category FROM dish WHERE menu = ?');
    $stmt->execute(array($id));

    $dishes = [];

    while ($dish = $stmt->fetch()) {
      $dishes[] = array(
        'id' => $dish['id'],
        'name' => $dish['name'],
        'price' => $dish['price'],
        'photo' => $dish['photo'],
        'category' => $dish['category']
      );
    }

    return $dishes;
  }

?>