<html>
<head>
        <title>Contact</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Rammetto+One&display=swap" rel="stylesheet">
        <link 
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous"
        rel="stylesheet"
        >
        <link rel='stylesheet' type='text/css' media='screen' href='main2.css'>
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Rammetto+One&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<main>
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
		<div class="container contact-form">
            <div class="contact-image">
                <img src="img/envelope.svg" alt="envelope_contact"/>
            </div>
            <form action="contactform.php" method="post">
                <h3>Drop Us a Message</h3>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Name *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="mail" class="form-control" placeholder="Your Email *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="subject" class="form-control" placeholder="Subject *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btnContact" value="Send Message" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea name="txtMsg" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;"></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
<?php require"footer.php"; ?>