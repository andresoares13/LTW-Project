<?php
  declare(strict_types = 1);

  class Menu {
    public int $id;
    public string $name;
    public int $restaurant;

    public function __construct(int $id, string $name, int $restaurant)
    {
      $this->id = $id;
      $this->name = $name;
      $this->restaurant = $restaurant;
      
    }

    static function getRestaurantMenus(PDO $db, int $id) : array {
        $stmt = $db->prepare('
          SELECT id, name, restaurant
          FROM menu  
          WHERE restaurant = ?
        ');
        $stmt->execute(array($id));
    
        
    
        return $stmt->fetchAll();
    }

    static function getMenu(PDO $db, int $id) : Menu {
        $stmt = $db->prepare('SELECT id,name,restaurant FROM menu WHERE id = ?');
        $stmt->execute(array($id));
        $menu = $stmt->fetch();
        return new Menu(
          (int) $menu['id'], 
          $menu['name'], 
          (int) $menu['restaurant']
        );
    }
  
  }
?>