<?php
  declare(strict_types = 1);

  session_start();

  require_once('../templates/logins.php');
  require_once('../templates/common.php');
  drawLogin();
  drawFooter();
?>