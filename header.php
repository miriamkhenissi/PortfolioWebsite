<!DOCTYPE html>
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

<html lang = "en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Mayakh" content="Digital Design & Developer Online Portfolio Based in Edinburgh.">
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title><?= isset($title) ? "MAYAKH | $title" : "MAYAKH"; ?></title>
    <link href='main.css' rel='stylesheet' type='text/css' media='screen' />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" href="img/logo.png">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" /> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat|Rammetto+One&display=swap" rel="stylesheet" /> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

</head>



<body>

<!--- Navigation Menu ---->
<header id="nav-bar" class="navigation">
    <div class="container">
        <nav class="navbar">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" alt="Mayakh logo">
            </a>

            <div id="toggle-menu" class="nav-icon">
              <div></div>
            </div>

            <div id="side-navigation" class="mobile-sidenav sidenav">
                <div class="container d-block">
                    <ul class="list-unstyled list-mobile-sidenav-items">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
<!--                        <li class="nav-item">
                            <a class="nav-link" href="gallery.php">Portfolio</a>
                        </li>  -->
                        
                    </ul>

                    <ul class="list-group list-group-horizontal list-unstyled mobile-sidenav-social">
                        <li>
                            <a href="https://www.instagram.com/miriamsdesigns" aria-label="Instagram">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.behance.net/mkhenissi28b4f/projects" aria-label="Behance">
                                <i class="fa fa-behance"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/in/meriam-kh/" aria-label="Linkedin">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://codepen.io/miriam-khenissi" aria-label="Codepen">
                                <i class="fa fa-codepen"></i>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>

        </nav>
    </div>
</header>

<script>

    var menuState = false;

    document.getElementById("toggle-menu").addEventListener('click',function(e){
        e.currentTarget.classList.toggle('active')
        menuState = !menuState;
        if(menuState) {
            __showMenuItems();
            document.querySelector('#side-navigation .mobile-sidenav-social').classList.add('active');
            return document.getElementById("side-navigation").style.width = "100vw";
        }

        __hideMenuItems();
        document.querySelector('#side-navigation .mobile-sidenav-social').classList.remove('active');
        return document.getElementById("side-navigation").style.width = "0";
    });

    function __showMenuItems() {
        var menuStateTimeOut = 200;
        document.querySelectorAll('#side-navigation .list-mobile-sidenav-items li').forEach(function(elem) {
            menuStateTimeOut = menuStateTimeOut + 200;
            setTimeout(()=>{
                elem.classList.add('visible')
            } ,menuStateTimeOut);
        });
    }

    function __hideMenuItems() {
        var menuStateTimeOut = 80;
        document.querySelectorAll('#side-navigation .list-mobile-sidenav-items li').forEach(function(elem) {
            menuStateTimeOut = menuStateTimeOut + 80;
            setTimeout(()=>{
                elem.classList.remove('visible')
            } ,menuStateTimeOut);
        });
    }


</script>
