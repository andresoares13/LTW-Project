<?php
  declare(strict_types = 1);

  class Restaurant {
    public int $id;
    public string $name;
    public string $adress;
    public string $category;
    public string $photo;
    

    public function __construct(int $id, string $name, string $adress, string $category,string $photo)
    { 
      $this->id = $id;
      $this->name = $name;
      $this->adress = $adress;
      $this->category = $category;
      $this->photo = $photo;
      
    }

    function save($db) {
      $stmt = $db->prepare('
        UPDATE restaurants SET name = ?, adress = ?, category = ?
        WHERE id = ?
      ');

      $stmt->execute(array($this->name, $this->adress,$this->category,$this->id));
    }

    static function getRestaurants(PDO $db, int $count) {
        $stmt = $db->prepare('SELECT id, name,photo FROM restaurants LIMIT ?');
        $stmt->execute(array($count));
      
        return $stmt->fetchAll();
    }

    static function getRestaurantsWithOwner(PDO $db, int $id) {
      $stmt = $db->prepare('SELECT id, name,photo FROM restaurants WHERE owner = (SELECT id FROM restaurantOwner where user = ?)');
      $stmt->execute(array($id));
    
      return $stmt->fetchAll();
    }

    static function getRestaurant(PDO $db, int $id) : Restaurant {
        $stmt = $db->prepare('SELECT id, name, adress, category,photo FROM restaurants WHERE id = ?');
        $stmt->execute(array($id));
        $restaurant = $stmt->fetch();
    
        return new Restaurant(
          (int) $restaurant['id'], 
          $restaurant['name'],
          $restaurant['adress'],
          $restaurant['category'],
          $restaurant['photo']
        );
    }

  

    static function searchRestaurants(PDO $db, string $search, int $count) : array {
      $stmt = $db->prepare('SELECT id, name FROM restaurants WHERE name LIKE ? LIMIT ?');
      $stmt->execute(array($search . '%', $count));
      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
          $restaurant['id'],
          $restaurant['name'],
          $restaurant['adress'],
          $restaurant['category'],
          $restaurant['photo']
        );
      }
      
  
      return $restaurants;
    }

    function isOwnerOfRestaurant(PDO $db, int $Rid, int $id) {
      try {
        $stmt = $db->prepare('SELECT id FROM restaurants WHERE id = ? AND owner = (SELECT id FROM restaurantOwner WHERE user = ?)');
        $stmt->execute(array($Rid,$id));
        if ($stmt->fetch()){
          return true;
        }
        else{
          return false;
        }
      
      }catch(PDOException $e) {
        return true;
      }
    }

  }
?>