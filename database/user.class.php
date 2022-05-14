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
  }
?>