<html>
    <head>
        <title> Portfolio </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Rammetto+One&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">        <link rel='stylesheet' type='text/css' media='screen' href='main2.css'>
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Rammetto+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <div class="nav">
            <div class="logo">
                <a href="index.php"><img src="img/logo.png" alt="logo"></a>
                <a href="#">About</a>
                <a href="gallery.php">Portfolio</a>
                <a href="contact.php">Contact</a>
            </div>

            <div class="icons">
                <a href="user.php"><img src="img/user.png" alt="User"></a>
                <a href="#"><img src="img/instagram.png" alt="insta"></a>
                <a href="#"><img src="img/behance.png" alt="behance"></a>
                <a href="#"><img src="img/linkedin.png" alt="linkedin"></a>
            </div>
        </div>

        <div class="landing">
            <div class="landing-wrapper">
                <div class="landingL">
                    <h1> Miriam Khenissi</h1>
                    <p> Hello! I'm a <span style="color:#17e9e0;font-weight:bold">designer, developer and film maker </span>focused on creating </br> coherent and aesthetically pleasing visual interfaces.</p>
                    <ul>
                        <li><p> Graphic Designer </p></li>
                        <li><p> Web Designer </p></li>
                        <li><p> 2D Animation </p></li>
                        <li><p> 3D Modeling </p></li>
                        <li><p> Front end developer  </p></li>
                    </ul>
                </div>
                <div class="landingR">
                        <img src="img/portrait.png" alt="portrait" width="500px">
                </div>
            </div>
            <img src="img/Scroll.png" alt="scroll" class="scroll">
        </div>

        <div class="skills">
            <h2> Skills</h2>
            <p>Over 3 years of experience using </br> these programs</p>
            <div class="programs">
                    <img src="img/photoshop.png" alt="photoshop">
                    <img src="img/illustrator.png" alt="illustrator">
                    <img src="img/premierpro.png" alt="premierpro">
                    <img src="img/aftereffects.png" alt="aftereffects">
            </div>
        </div>

        <div class="work clearfix">
            <div class="workText">
                <h1>eCommerce Branding</h1>
                <a href="#"><h5>View Project</h5></a>   
                <div class="underline"></div>         
            </div>
            <ul>
                <li><a href="#"><img src="img/behanceBlack.png" alt="Behance"></a></li>
                <li><a href="#"><img src="img/linkedinBlack.png" alt="Linkedin"></a></li>
                <li><a href="#"><img src="img/InstagramBlack.png" alt="Instagram"></a></li>
            </ul>
            <img src="img/projectecommerce.jpg" alt="eCommerce project" class="workImg">
        </div>

        
        <div class="work2 clearfix">
                <div class="workText">
                    <h1>Scotts Rum</h1>
                    <a href="#"><h5>View Project</h5></a>   
                    <div class="underline"></div>         
                </div>
                <ul>
                    <li><a href="#"><img src="img/behanceBlack.png" alt="Behance"></a></li>
                    <li><a href="#"><img src="img/linkedinBlack.png" alt="Linkedin"></a></li>
                    <li><a href="#"><img src="img/InstagramBlack.png" alt="Instagram"></a></li>
                </ul>
                <img src="img/projectrum.jpg" alt="rum project" class="workImg">
            </div>



            <?php require('footer.php'); ?>
            
    </body>
</html>
