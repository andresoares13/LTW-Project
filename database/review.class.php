<?php
  declare(strict_types = 1);

  class Review {
    public int $id;
    public string $customer;
    public int $restaurant;
    public int $rating;
    public string $comment;
    public string $reply;


    public function __construct(int $id, string $customer, int $restaurant, int $rating, string $comment, string $reply) {
      $this->id = $id;
      $this->customer = $customer;
      $this->restaurant = $restaurant;
      $this->rating = $rating;
      $this->comment = $comment;
      $this->reply = $reply;
    }

    static function getRestaurantReviews(PDO $db, int $id)  {
        $stmt = $db->prepare('SELECT review.id,name,restaurant,rating,comment,reply from review,customer where review.restaurant = ? and review.customer=customer.id');
        $stmt->execute(array($id));
    
        $reviews = [];
    
        while ($review = $stmt->fetch()) {
          $reviews[] = new Review(
            (int) $review['id'],
            $review['name'],
            (int) $review['restaurant'],
            (int) $review['rating'],
            $review['comment'],
            $review['reply']
          );
        }
    
        return $reviews;
    }

    function addReview(PDO $db,int $Rid ,int $Cid, int $rating, string $comment){
      $reply="";
      try {
        $stmt = $db->prepare('INSERT INTO review(customer,restaurant,rating,comment,reply) VALUES (:customer,:restaurant,:rating,:comment,:reply)');
        $stmt->bindParam(':customer', $Cid);
        $stmt->bindParam(':restaurant', $Rid);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':reply', $reply);
        if ($stmt->execute()){
          return true;
        }
        else{
          return false;
        }
      
      }catch(PDOException $e) {
        var_dump($e);
        exit();
        return true;
      }
    }

    function existsReview(PDO $db, int $Rid, int $Cid) {
      try {
        $stmt = $db->prepare('SELECT id FROM review WHERE restaurant = ? AND customer = ?');
        $stmt->execute(array($Rid,$Cid));
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