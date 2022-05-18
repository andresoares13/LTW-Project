<?php
  declare(strict_types = 1);


  class Request {
    public int $id;
    public string $customer;
    public string $state;
    public string $restaurant;


    public function __construct(int $id, string $customer, string $state, string $restaurant) {
      $this->id = $id;
      $this->customer = $customer;
      $this->state = $state;
      $this->restaurant = $restaurant;
    }

    static function getOwnerOrders(PDO $db, int $id)  {
        $stmt = $db->prepare('select request.id,customer.name,state from request,customer where request.id in (select distinct request from requestMenuItem where menu_item in (select id from menu_item where menu in (select id from menu where restaurant in (select id from restaurants where owner in (select id from restaurantOwner where user = ?))))) and customer.id=customer');
        $stmt->execute(array($id));
    
        $requests = [];
    
        while ($request = $stmt->fetch()) {
          $requests[] = new Request(
            (int) $request['id'],
            $request['name'],
            $request['state'],
            Request::getRestaurantByRequest($db,(int) $request['id']),
          );
        }
    
        return $requests;
    }

    static function getRestaurantByRequest(PDO $db, int $id){
        $stmt = $db->prepare('select name from restaurants where id in (select restaurant from menu where id in (select menu from menu_item where id in (select menu_item from requestMenuItem where request = ?)))');
        $stmt->execute(array($id));
        if($name = $stmt->fetch()){
            return $name['name'];
          }
        
    }

    static function getRestaurantIdByRequest(PDO $db, int $id){
        $stmt = $db->prepare('select id from restaurants where id in (select restaurant from menu where id in (select menu from menu_item where id in (select menu_item from requestMenuItem where request = ?)))');
        $stmt->execute(array($id));
        if($id = $stmt->fetch()){
            return (int)$id['id'];
          }
        
    }

    function updateState(PDO $db, int $id, string $state){
        try {
          $stmt = $db->prepare('UPDATE request SET state = ? WHERE id = ?');
          if($stmt->execute(array($state, $id)))
              return true;
          else{
            return false;
          }   
        }catch(PDOException $e) {
          return false;
        }
    }

    static function getRequest(PDO $db, int $id) : Request {
        
        $stmt = $db->prepare('SELECT request.id,name,state FROM request,customer WHERE request.id = ? and request.customer=customer.id ');
        $stmt->execute(array($id));
        $request = $stmt->fetch();
        $restaurant=Request::getRestaurantByRequest($db,(int)$request['id']);
        return new Request(
            (int) $request['id'],
            $request['name'],
            $request['state'],
            $restaurant
        );
      }

      function isCustomerCompletedRequest(PDO $db, string $username, int $restaurant) {
        try {
          $stmt = $db->prepare('select id from request where state="Delivered" and customer = (select id from customer where username = ?) and id in (select request from requestMenuItem where menu_item in (select id from menu_item where menu in (select id from menu where restaurant in (select id from restaurants where id = ?))))');
          $stmt->execute(array($username,$restaurant));
          
          return $stmt->fetch()  !== false;
        
        }catch(PDOException $e) {
          return true;
        }
      }  
    






   

  }
?>    