<?php
  declare(strict_types = 1);

  class User {
    public int $id;
    public string $username;
    public string $firstName;
    public string $lastName;
    public string $adress;
    public string $email;
    public string $phone;

    public function __construct(int $id, string $username, string $firstName, string $lastName, string $adress, string $email, string $phone)
    {
      $this->id = $id;
      $this->username = $username;
      $this->firstName = $firstName;
      $this->lastName = $lastName;
      $this->adress = $adress;
      $this->email = $email;
      $this->phone = $phone;
    }

    function name() {
      return $this->firstName . ' ' . $this->lastName;
    }

    function save($db) {
      $stmt = $db->prepare('
        UPDATE users SET Fname = ?, Lname = ?
        WHERE userId = ?
      ');

      $stmt->execute(array($this->firstName, $this->lastName, $this->id));
    }
    
    static function getUserWithPassword(PDO $db, string $email, string $password) : ?User {
      $stmt = $db->prepare('
        SELECT userId, username,Fname, Lname, adress,email, phone
        FROM users
        WHERE lower(email) = ? AND password = ?
      ');
      $realPass=hash('sha256',$password);
      $stmt->execute(array(strtolower($email), $realPass));
      
      if ($user = $stmt->fetch()) {
        return new User(
          (int)$user['userId'],
          $user['username'],      
          $user['Fname'],
          $user['Lname'],
          $user['adress'],
          $user['email'],
          $user['phone']
        );
      }else return null;
    }

    static function getUser(PDO $db, int $id) : User {
      $stmt = $db->prepare('
      SELECT userId, username,Fname, Lname, adress,email, phone
      FROM users
      WHERE userId = ?
      ');

      $stmt->execute(array($id));
      $user = $stmt->fetch();
      
      return new User(
        (int)$user['userId'],
        $user['username'],      
        $user['Fname'],
        $user['Lname'],
        $user['adress'],
        $user['email'],
        $user['phone']
      );
    }

    function existsUsername(PDO $db, string $username) {
      try {
        $stmt = $db->prepare('SELECT userId FROM users WHERE username = ?');
        $stmt->execute(array($username));
        
        return $stmt->fetch()  !== false;
      
      }catch(PDOException $e) {
        return true;
      }
    }

    function existsEmail(PDO $db, string $email) {
      try {
        $stmt = $db->prepare('SELECT userId FROM users WHERE email = ?');
        $stmt->execute(array($email));
        return $stmt->fetch()  !== false;
      
      }catch(PDOException $e) {
        return true;
      }
    }

    function getID(PDO $db,string $username) {
      try {
        $stmt = $db->prepare('SELECT userId FROM users WHERE username = ?');
        $stmt->execute(array($username));
        if($id = $stmt->fetch()){
          return $id['userId'];
        }
      
      }catch(PDOException $e) {
        return -1;
      }
    }

    function createUser(PDO $db, string $username, string $password, string $firstname, string $lastname ,string $email) {
      
      $password = hash('sha256', $password);
      
      
      try {
        $stmt = $db->prepare('INSERT INTO users(username, password, Fname, Lname,email) VALUES (:username,:password,:firstname,:lastname,:email)');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':email', $email);
        
        if($stmt->execute()){
          
          $id = User::getID($db,$username);
          return $id;
        }
        else
          return -1;
      }catch(PDOException $e) {
        
        return -1;
      }
      
    }
  }
?>