<?php
  declare(strict_types = 1);

  session_start();

  if (!isset($_SESSION['id'])) die(header('Location: /'));

  require_once('../database/connection.php');
  require_once('../database/user.class.php');

  $db = getDatabaseConnection();

  $user = User::getUser($db, $_SESSION['id']);

  if ($user) {
    if ($_POST['password']!=$_POST['repeat']){
      $_SESSION['ERROR'] = 'Passwords dont match';
    }
    else if (!(4<=strlen($_POST['password'])&&strlen($_POST['password'])<=20)){
      $_SESSION['ERROR'] = 'Password must be between 4 and 20 characters';
    }
    else if (User::updatePassword($db,$user->id,$_POST['password'])){

    }
    else{
      $_SESSION['ERROR'] = 'ERROR';
    }
  }

  header("Location:".$_SERVER['HTTP_REFERER']."");
?>
