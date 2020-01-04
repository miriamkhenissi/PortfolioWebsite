<?php session_start(); ?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Header</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main2.css'>
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Rammetto+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">        <link rel='stylesheet' type='text/css' media='screen' href='main2.css'>
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Rammetto+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body>
    <header>
        <nav> 
        <div class="nav">
            <div class="logo">
                <a href="index.html"><img src="img/logo.png" alt="logo"></a>
                <a href="#">About</a>
                <a href="gallery.php">Portfolio</a>
                <a href="contact.php">Contact</a>
            </div>

            <div class="login">
            <?php
                if (isset($_SESSION['userId']))
                {
                 echo '<form action="includes/logout.php" method="post">
                 <button type="submit" name="logout-submit">Logout</button>
                 </form>   ';
                }

                else{
                echo'<form action="includes/login.php" method="post">
                <input type = "text" name="mailuid" placeholder="Username/E-mail...">
                <input type = "password" name="pwd" placeholder="Password...">
                <button type="submit" name="login-submit">Login</button> 
                <a href="signup.php" class="btn">Sign up</a>
                </form>';
                }
            ?>                 
            </div>
            </nav>

    </header>
</body>
</html>