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
    public bool $owner;

    public function __construct(int $id, string $username, string $firstName, string $lastName, string $adress, string $email, string $phone, bool $owner)
    {
      $this->id = $id;
      $this->username = $username;
      $this->firstName = $firstName;
      $this->lastName = $lastName;
      $this->adress = $adress;
      $this->email = $email;
      $this->phone = $phone;
      $this->owner = $owner;
    }

    function name() {
      return $this->firstName . ' ' . $this->lastName;
    }

    function save($db) {
      $stmt = $db->prepare('
        UPDATE users SET Fname = ?, Lname = ?, adress = ?, phone = ?
        WHERE userId = ?
      ');

      $stmt->execute(array($this->firstName, $this->lastName,$this->adress,$this->phone, $this->id));
    }
    
    static function getUserWithPassword(PDO $db, string $email, string $password) : ?User {
      $isEmail=false;
      for ($i=0;$i<strlen($email);$i++){
        if($email[$i]=='@'){
          $isEmail=true;
        }
      }
      if ($isEmail){
        $stmt = $db->prepare('
        SELECT userId, username,Fname, Lname, adress,email, phone
        FROM users
        WHERE lower(email) = ? AND password = ?
        ');
        $realPass=hash('sha256',$password);
        $stmt->execute(array(strtolower($email), $realPass));
      }
      else{
        $stmt = $db->prepare('
        SELECT userId, username,Fname, Lname, adress,email, phone
        FROM users
        WHERE username = ? AND password = ?
        ');
        $realPass=hash('sha256',$password);
        $stmt->execute(array($email, $realPass));
      }
      
  
      if ($user = $stmt->fetch()) {
        
        $owner=User::isOwner($db,(int)$user['userId']);
        return new User(
          (int)$user['userId'],
          $user['username'],      
          $user['Fname'],
          $user['Lname'],
          $user['adress'],
          $user['email'],
          $user['phone'],
          $owner
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
      $owner=User::isOwner($db,(int)$user['userId']);
      return new User(
        (int)$user['userId'],
        $user['username'],      
        $user['Fname'],
        $user['Lname'],
        $user['adress'],
        $user['email'],
        $user['phone'],
        $owner
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

    function isOwner(PDO $db, int $id) {
      try {
        $stmt = $db->prepare('SELECT user FROM restaurantOwner WHERE user = ?');
        $stmt->execute(array($id));
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

    function existsPhone(PDO $db, string $phone, int $id) {
      try {
        $stmt = $db->prepare('SELECT userId FROM users WHERE phone = ?');
        $stmt->execute(array($phone));
        
        if($userId=$stmt->fetch()){
          if ((int)$userId['userId']!=$id){
            return true;
          }
        }
        else{
          return false;
        }
      
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

    function createUser(PDO $db, string $username, string $password, string $firstname, string $lastname ,string $email,string $check) {
      
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
          if ($check=='owner'){
            $stmt = $db->prepare('INSERT INTO restaurantOwner(user) VALUES (:user)');
            $stmt->bindParam(':user', $id);
            if($stmt->execute()){
              return $id;
            }
          }
          else{
            $stmt = $db->prepare('INSERT INTO customer(id,name) VALUES (:user,:name)');
            $name= $firstname . ' ' . $lastname;
            $stmt->bindParam(':user', $id);
            $stmt->bindParam(':name',$name);
            if($stmt->execute()){
              return $id;
            }
          }

        }
        else
          return -1;
      }catch(PDOException $e) {
        
        return -1;
      }
      
    }

    function updatePassword(PDO $db, int $id, string $password){
      $password = hash('sha256', $password);
  
      try {
        $stmt = $db->prepare('UPDATE users SET password = ? WHERE userId = ?');
        if($stmt->execute(array($password, $id)))
            return true;
        else{
          return false;
        }   
      }catch(PDOException $e) {
        return false;
      }
    }
    function deleteUser(PDO $db,int $id) {
      try {
        $name='anonymous';
        $stmt = $db->prepare('DELETE FROM users WHERE userId = ?');
        $stmt->execute(array($id));
        $stmt = $db->prepare('UPDATE customer SET name = ? WHERE id = ?');
        $stmt->execute(array($name,$id));
        return true;
      }
      catch(PDOException $e) {
        return false;
      }
    }
  }


?>