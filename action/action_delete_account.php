<?php
    declare(strict_types = 1);

    session_start();
  
    require_once('../database/connection.php');
    require_once('../database/user.class.php');
  
    $db = getDatabaseConnection();
    
    
    if(($id = $_SESSION['id']) != null) {
        
        
        if(User::deleteUser($db,$id)) {
            unset($_SESSION['id']);
            unset($_SESSION['name']);
            header("Location:../pages/login.php");
        }
        else {
            $_SESSION['ERROR'] = "Error deleting your user account!";
            header("Location:".$_SERVER['HTTP_REFERER']."");
        }
    }
?>