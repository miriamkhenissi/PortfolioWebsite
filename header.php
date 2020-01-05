<?php
    session_start();
    $session = $_SESSION;
    $is_logged_in = isset($_SESSION['userId']) ? true : false;
    $current_user = false;

    if(isset($_SESSION['userId']) && isset($_SESSION['userUid'])) {
        $current_user = (object) ['ID' => $_SESSION['userId'], 'username' => $_SESSION['userUid']];
    }else {
        $current_user = (object) ['ID' => 0, 'username' => 0];
    }

    include("includes/dbh.inc.php");
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
                    <?php if(isset($show_tools_menu) && $show_tools_menu){ ?>
                        <div class="col-sm-12 col-md-7 text-right left-menu icons">
                            <ul>
                                <li><a href="user.php"><i class="fa fa-user"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-behance"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    <?php } else { ?>
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
                    <?php } ?>
                </div>
            </div>
        </nav>
    </header>