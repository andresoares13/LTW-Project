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


   

  }
?>    