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
    <link href='main.css' rel='stylesheet' type='text/css' media='screen' />
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
                                    <svg width="85px" height="85px" viewBox="0 0 85.04 85.04" xml:space="preserve">
                                        <rect fill="#000000" width="85" height="85"></rect>
                                        <path fill="#FFFFFF" d="M77.54,77.54H53.67v-0.69h2.06c2.06,0,3.02-1.8,3.02-3.76V42.13l-9.1,35.41h-6.99l-10.27-35.2v25.88 c0,5.35,2.65,8.63,5.13,8.63h2.01v0.69H24.56v-0.69h1.85c2.43,0,5.24-3.02,5.24-8.68V41.44c0-4.13-2.38-5.61-5.13-5.61h-1.43V35.2 h18.68l8.36,29.59l7.67-29.59h17.52v0.64h-2.17c-3.23,0-4.23,0.74-4.23,2.96v35.04c0,2.01,1.32,3.02,3.02,3.02h3.6V77.54z"></path></svg>                                    
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