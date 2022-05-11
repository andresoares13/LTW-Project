<?php
  declare(strict_types = 1);

  function getRestaurants(PDO $db, int $count) {
    $stmt = $db->prepare('SELECT id, name,photo FROM restaurants LIMIT ?');
    $stmt->execute(array($count));
  
    return $stmt->fetchAll();
  }

  function getRestaurant(PDO $db, int $id) : array {
    $stmt = $db->prepare('SELECT id, name FROM restaurants WHERE id = ?');
    $stmt->execute(array($id));

    $restaurant = $stmt->fetch();

    return array(
      'id' => (int) $restaurant['id'], 
      'name' => $restaurant['name'], 
      'menus' => getRestaurantMenus($db, $id)
    );
  }

  function getRestaurantMenus(PDO $db, int $id) : array {
    $stmt = $db->prepare('
      SELECT id, name
      FROM menu  
      WHERE restaurant = ?
    ');
    $stmt->execute(array($id));

    

    return $stmt->fetchAll();
  }

?>