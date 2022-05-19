<?php
  declare(strict_types = 1);

  class Menu_Item {
    public int $id;
    public string $name;
    public int $price;
    public string $photo;
    public string $category;
    public int $menu;


    public function __construct(int $id, string $name, int $price, string $photo, string $category, int $menu) {
      $this->id = $id;
      $this->name = $name;
      $this->price = $price;
      $this->photo = $photo;
      $this->category = $category;
      $this->menu = $menu;
    }

    static function getMenuItems(PDO $db, int $id) : array {
        $stmt = $db->prepare('SELECT id, name, price, photo, category, menu FROM menu_item WHERE menu = ?');
        $stmt->execute(array($id));
    
        $menu_items = [];
    
        while ($item = $stmt->fetch()) {
          $menu_items[] = new Menu_Item(
            (int) $item['id'],
            $item['name'],
            (int) $item['price'],
            $item['photo'],
            $item['category'],
            (int) $item['menu']
          );
        }
    
        return $menu_items;
    }


    static function getMenuItem(PDO $db, int $id) : Menu_Item {
      $stmt = $db->prepare('SELECT id,name,price,photo,category,menu FROM menu_item WHERE id = ?');
      $stmt->execute(array($id));
      $item = $stmt->fetch();
      return new Menu_Item(
        (int) $item['id'],
        $item['name'],
        (int) $item['price'],
        $item['photo'],
        $item['category'],
        (int) $item['menu']
      );
    }

    function updateItemPhoto(PDO $db,int $id, string $photoPath) {
      try {
        $stmt = $db->prepare('UPDATE menu_item SET photo = ? WHERE id = ?');
        if($stmt->execute(array($photoPath, $id)))
            return true;
        else
            return false;
      }catch(PDOException $e) {
        return false;
      }
    } 
    
  
    function getItemPhoto(PDO $db, int $id) {
      try {
        $stmt = $db->prepare('SELECT photo FROM menu_item WHERE id = ?');
        $stmt->execute(array($id));
        return $stmt->fetch();
      
      }catch(PDOException $e) {
        return null;
      }
    }


    static function getItemsByRequest(PDO $db, int $id) : array {
      $stmt = $db->prepare('select id,name,price,photo,category,menu from menu_item where id in (select menu_item from requestMenuItem where request = ?)');
      $stmt->execute(array($id));
  
      $menu_items = [];
  
      while ($item = $stmt->fetch()) {
        $menu_items[] = new Menu_Item(
          (int) $item['id'],
          $item['name'],
          (int) $item['price'],
          $item['photo'],
          $item['category'],
          (int) $item['menu']
        );
      }
  
      return $menu_items;
    }

    static function getFavoriteItems(PDO $db, int $id) : array {
      $stmt = $db->prepare('select id,name,price,photo,category,menu from menu_item where id in (select menu_item from favouriteMenuItem where customer = ?)');
      $stmt->execute(array($id));
  
      $menu_items = [];
  
      while ($item = $stmt->fetch()) {
        $menu_items[] = new Menu_Item(
          (int) $item['id'],
          $item['name'],
          (int) $item['price'],
          $item['photo'],
          $item['category'],
          (int) $item['menu']
        );
      }
  
      return $menu_items;
    }
  }
?>