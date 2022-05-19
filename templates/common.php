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
    <script src="../javascript/search.js" defer></script>
    <script src="../javascript/dialogs.js" defer></script>
    <script src="../javascript/radio.js" defer></script>
    <script src="../javascript/stateSlider.js" defer></script>
    <script src="../javascript/header.js" defer></script>
  </head>
  <body>
  <header id="header">
    <div id="wrap2">
            <h1 class="tit"><a href="../pages/main.php">Restaurant Helper</a></h1>
            <?php if (isset($_SESSION['id'])) drawLogoutForm($_SESSION['name']);?>
    </div>
              <div id="wrapper">
                  <nav id="menu">
                    <ul>
                        <li class="item"><a href="#">Home</a></li>
                        <li class="item"><a href="#">Restaurants</a></li>
                        <li class="item"><a href="#">Dishes</a></li>
                        <li class="item"><a href="#">Order</a></li>
                    </ul>
                    <div id="hamb">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </div>
                </nav>
                <div class="signup">
                    <form id="search" action="header.php" method="post">
                        <input type="text" name="src" placeholder="Search...">
                        <button type="submit"><i class="fa fa-search"></i>
                            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
                        </button>
                    </form>
                    <!--<a href="login.html">Login</a>-->
                </div>
              </div>
        </header>
    <main>
<?php } ?>

<?php function drawFooter() { ?>
    </main>
    <footer id="footer">
      <p id="cp">Copyright &copy; Restaurant helper</p>
    </footer>
  </body>
</html>
<?php } ?>


<?php function drawLogoutForm(string $name) { ?>
  <form action="../action/action_logout.php" method="post" class="logout">
  <a href="../pages/profile.php"><?=$name?></a>
    <button id="logout-but" type="submit" >Logout</button>
  </form>
<?php } ?>