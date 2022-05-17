<?php declare(strict_types = 1); ?>

<?php function drawHeader() { ?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Restaurant Helper</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../pictures/logo.png">
    <script src="../javascript/script.js" defer></script>
    <script src="../javascript/dialogs.js" defer></script>
    <script src="../javascript/radio.js" defer></script>
  </head>
  <body>
    <header>
      <h1><a href="../pages/main.php">Restaurant helper</a></h1>
      <?php if (isset($_SESSION['id'])) drawLogoutForm($_SESSION['name']);?>
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


<?php function drawLogoutForm(string $name) { ?>
  <form action="../action/action_logout.php" method="post" class="logout">
  <a href="../pages/profile.php"><?=$name?></a>
    <button type="submit">Logout</button>
  </form>
<?php } ?>