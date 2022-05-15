<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.php');
  require_once('../database/user.class.php');

  $db = getDatabaseConnection();

  if ($_POST['check']==null){
    $_SESSION['ERROR'] = 'ERROR';
    header("Location:".$_SERVER['HTTP_REFERER']."");
  }
  
  
  if(User::existsUsername($db, $_POST['username'])){
    $_SESSION['ERROR'] = 'User already exists';
    header("Location:".$_SERVER['HTTP_REFERER']."");
  }
  
  
  else if(User::existsEmail($db, $_POST['email'])){
    $_SESSION['ERROR'] = 'User already exists';
    header("Location:".$_SERVER['HTTP_REFERER']."");
  }
  
  else if ((User::createUser($db, $_POST['username'], $_POST['password'], $_POST['first_name'],$_POST['last_name'], $_POST['email'],$_POST['check'])) != -1) {
    echo 'User Registered successfully';
    $user=User::getUserWithPassword($db,$_POST['email'],$_POST['password']);
    $_SESSION['id'] = $user->id;
    $_SESSION['name'] = $user->name();
    header("Location:../index.php");	
    
  }
  
  else{
    $_SESSION['ERROR'] = 'ERROR';
    header("Location:".$_SERVER['HTTP_REFERER']."");
  }
  


?>