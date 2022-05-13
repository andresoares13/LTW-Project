<?php
  declare(strict_types = 1);

  class Restaurant {
    public int $id;
    public string $name;
    

    public function __construct(int $id, string $name)
    { 
      $this->id = $id;
      $this->name = $name;
      
    }

    static function getRestaurants(PDO $db, int $count) {
        $stmt = $db->prepare('SELECT id, name,photo FROM restaurants LIMIT ?');
        $stmt->execute(array($count));
      
        return $stmt->fetchAll();
    }

    static function getRestaurant(PDO $db, int $id) : Restaurant {
        $stmt = $db->prepare('SELECT id, name FROM restaurants WHERE id = ?');
        $stmt->execute(array($id));
        $restaurant = $stmt->fetch();
    
        return new Restaurant(
          (int) $restaurant['id'], 
          $restaurant['name']
        );
    }
  }
?>