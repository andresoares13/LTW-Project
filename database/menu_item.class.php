<?php
  declare(strict_types = 1);

  class Menu_Item {
    public int $id;
    public string $name;
    public int $price;
    public string $photo;
    public string $category;


    public function __construct(int $id, string $name, int $price, string $photo, string $category) {
      $this->id = $id;
      $this->name = $name;
      $this->price = $price;
      $this->photo = $photo;
      $this->category = $category;
    }

    static function getMenuItems(PDO $db, int $id) : array {
        $stmt = $db->prepare('SELECT id, name, price, photo, category FROM menu_item WHERE menu = ?');
        $stmt->execute(array($id));
    
        $menu_items = [];
    
        while ($item = $stmt->fetch()) {
          $menu_items[] = new Menu_Item(
            (int) $item['id'],
            $item['name'],
            (int) $item['price'],
            $item['photo'],
            $item['category']
          );
        }
    
        return $menu_items;
    }
  }
?>