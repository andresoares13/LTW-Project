<?php
  declare(strict_types = 1);

  class Review {
    public int $id;
    public int $customer;
    public int $restaurant;
    public int $rating;
    public string $comment;


    public function __construct(int $id, int $customer, int $restaurant, int $rating, string $comment) {
      $this->id = $id;
      $this->customer = $customer;
      $this->restaurant = $restaurant;
      $this->rating = $rating;
      $this->comment = $comment;
    }

    static function getRestaurantReviews(PDO $db, int $id)  {
        $stmt = $db->prepare('SELECT id, customer, restaurant, rating, comment FROM review WHERE restaurant = ?');
        $stmt->execute(array($id));
    
        $reviews = [];
    
        while ($review = $stmt->fetch()) {
          $reviews[] = new Review(
            (int) $review['id'],
            (int) $review['customer'],
            (int) $review['restaurant'],
            (int) $review['rating'],
            $review['comment']
          );
        }
    
        return $reviews;
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

  }
?>