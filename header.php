<?php
    session_start();
    $session = $_SESSION;
    $is_logged_in = isset($_SESSION['userId']) ? true : false;

?>

<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title><?= isset($title) ? "MAYAKH | $title" : "MAYAKH"; ?></title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href='main2.css' rel='stylesheet' type='text/css' media='screen' />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Rammetto+One&display=swap" rel="stylesheet" />
</head>

<body>

    <header>
        <nav class="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <ul class="main-menu">
                            <li>
                                <a href="index.php">
                                    <img src="img/logo.png" class="logo" alt="logo">
                                </a>
                            </li>
                            <li><a href="#">About</a></li>
                            <li><a href="gallery.php">Portfolio</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </div>
                    <?php if(isset($show_login_form) && $show_login_form){ ?>
                        <div class="col-sm-12 col-md-7 text-right login-form">
                            <?php if($is_logged_in) { ?>
                                <form action="includes/logout.php" method="post">
                                    <button type="submit" name="logout-submit">Logout</button>
                                </form>
                            <?php } else { ?>
                                <form action="includes/login.php" method="post" autocomplete="off">
                                    <input type = "text" name="mailuid" placeholder="Username/E-mail...">
                                    <input type = "password" name="pwd" placeholder="Password...">
                                    <button type="submit" name="login-submit">Login</button> 
                                    <a href="signup.php" class="alt sign-up-btn">Sign up</a>
                                </form>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <div class="col-sm-12 col-md-7 text-right left-menu icons">
                            <ul>
                                <li><a href="user.php"><img src="img/user.png" alt="User"></a></li>
                                <li><a href="#"><img src="img/instagram.png" alt="insta"></a></li>
                                <li><a href="#"><img src="img/behance.png" alt="behance"></a></li>
                                <li><a href="#"><img src="img/linkedin.png" alt="linkedin"></a></li>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </header>


<?php /* ?>
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
                <a href="index.php"><img src="img/logo.png" alt="logo"></a>
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

<?php */ ?>