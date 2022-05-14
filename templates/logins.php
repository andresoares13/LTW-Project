<?php function drawLogin() { ?>
    <!DOCTYPE html>
    <html lang="en-US">
        <head>
            <title>Restaurant Helper</title>
            <meta charset="utf-8">
            <link rel="stylesheet" href="../css/style.css">
            <link rel="shortcut icon" href="../pictures/logo.png">
            <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>

        <body>
            <div id="register_container">
                <div class="register_header">
                    <a href="register.php">Register</a>
                    <img src="../pictures/logo.png" alt="logo">
                    <h1>Restaurant Helper</h1>
                    <p>Eat from everywhere.</p>
                </div>
                <div class="register_content">
                    <h1>Login</h1>
                    <form action="../action/action_login.php" method="post" class="login">
                        <input type="email" name="email" placeholder="email">
                        <input type="password" name="password" placeholder="password">
                        <button type="submit">Login</button>
                    </form>
                    <p id="error_messages" style="color: black">
                        <?php if(isset($_SESSION['ERROR'])) echo htmlentities($_SESSION['ERROR']); unset($_SESSION['ERROR'])?>
                    </p>
                </div>
            </div>
        </body>
    </htlm>     
<?php } ?>


<?php function drawRegister() { ?>
    <!DOCTYPE html>
    <html lang="en-US">
        <head>
            <title>Restaurant Helper</title>
            <meta charset="utf-8">
            <link rel="stylesheet" href="../css/style.css">
            <link rel="shortcut icon" href="../pictures/logo.png">
            <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>

        <body>
            <div id="register_container">
                <div class="register_content">
                    <h1>Register</h1>
                    <form action="../action/action_register.php" method="post" class="register">
                        <input type="email" name="email" placeholder="email">
                        <input type="password" name="password" placeholder="password">
                        <input type="password" name="password" placeholder="repeat password">
                        <button type="submit">Register</button>
                    </form>
                    <p id="error_messages" style="color: black">
                        <?php if(isset($_SESSION['ERROR'])) echo htmlentities($_SESSION['ERROR']); unset($_SESSION['ERROR'])?>
                    </p>
                    <p>
                        Already have an account? 
                        <a href="../pages/login.php"> Log in</a>
                    </p>
                </div>
            </div>
        </body>
    </htlm>     
<?php } ?>

 