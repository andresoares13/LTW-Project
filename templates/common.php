<?php declare(strict_types = 1); ?>

<?php function drawHeader() { ?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Restaurant Helper</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    <header>
      <h1><a href="/">Restaurant helper</a></h1>
      <?php drawLoginForm() ?>
    </header>
    <main>
<?php } ?>

<?php function drawFooter() { ?>
    </main>

    <footer>
      Restaurant helper
    </footer>
  </body>
</html>
<?php } ?>

<?php function drawLoginForm() { ?>
  <form action="action_login.php" method="post" class="login">
    <input type="text" name="username" placeholder="username">
    <input type="password" name="password" placeholder="password">
    <a href="register.php">Register</a>
    <button type="submit">Login</button>
  </form>
<?php } ?>