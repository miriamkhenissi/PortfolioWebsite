<?php session_start(); ?>
<?php
include_once 'includes/dbh.inc.php';
$current_use = isset($_SESSION['userId']) && !empty($_SESSION['userId']) ? $_SESSION['userId'] : 0;
?>
<!DOCTYPE html>
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
                <a href="index.html"><img src="img/logo.png" alt="logo"></a>
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
    </header>
    <main>
        <section class="gallery-links">
            <div class="wrapper">
                <h2> Gallery </h2>
                <div class="gallery-container">
                    <?php
                        //public gallery
                        $sql = "
                            SELECT * FROM ( 
                                SELECT DISTINCT idGallery FROM gallery AS G 
                                INNER JOIN meta AS M ON M.picture_id = G.idGallery 
                                AND M.meta_key = 'visibility' 
                                AND M.meta_value != 1 OR M.meta_value = 1 
                                AND G.userGallery = ".$current_use." 
                                LIMIT 50 
                            ) AS ID 
                            INNER JOIN gallery AS G ON G.idGallery = ID.idGallery 
                            INNER JOIN meta AS M ON M.picture_id = G.idGallery 
                            AND M.meta_key = 'visibility' ORDER BY orderGallery DESC
                        ";

                        //private gallery
                        //$userGallery = $_SESSION['userId'];
                        //$sql = "SELECT * from gallery WHERE userGallery=$userGallery";

                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "SQL statement failed!";
                        } else {
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            while ($row = mysqli_fetch_assoc($result)) { ?>

                                <a href="#">
                                    <div 
                                        style="background-image: url(img/gallery/<?= $row["imgFullNameGallery"]; ?>);"
                                    >
                                        <?= $row["meta_value"] == '1' ? '<div class="lock"></div>' : '' ?>
                                    </div>
                                    <h3><?= $row["titleGallery"] ?></h3>
                                    <p><?= $row["descGallery"] ?></p>
                                </a>
                               
                            <?php }

                        }
                        ?>
                         
                </div>

                <?php if (isset($current_use)){ ?>
                <div class="gallery-upload">
                    <form action="includes/gallery-upload.inc.php" method="post" enctype="multipart/form-data">
                        <input type="text" name="filename" placeholder="File name...">
                        <input type="text" name="filetitle" placeholder="Image title...">
                        <input type="text" name="filedesc" placeholder="Image description...">
                        <input class="submit-btn" type="file" name="file" label="uploadfile" >

                        <div class="visibility-option">';
                        <label>Private <input type="radio" name="visibility" value="1" checked /></label>
                        <span> | </span>
                        <label>Public <input type="radio" name="visibility" value="0" /></label>
                        </div>
                        <button  type="submit" name="submit">Upload</button>
                    </form>
                </div>
                <?php } ?>
            </div>
        </section>

        <footer id="footer">
		<div class = "footer-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-6 footer-info">
						<h3>MayaKh</h3>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
					</div>
					<div class="col-lg-2 col-md-6 footer-links">
						<h4>Quick links</h4>
						<ul>
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>							
						</ul>
					</div>
					<div class="col-lg-3 col-md-6 footer-contact">
						<h4>Contact me</h4>
						<p> 39/02 <br>
							CodeBase <br>
							Edinburgh <br>
							EH2 14D <br>
							United Kingdom <br>
							<strong>Phone:</strong> +44 07498912518 <br>
							<strong>Email:</strong> MayaKh@gmail.com <br>
						</p>
						<div class="social-links">
							<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
							<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>	
							<a href="#" class="instagram"><i class="fa fa-instagram"></i></a>	
							<a href="#" class="behance"><i class="fa fa-behance"></i></a>							
							<a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>					
						</div>
					</div>
					<div class="col-lg-3 col-md-6 footer-newsletter">
						<h4>My Newsletter</h4>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>				
						<form accept="" method="post">
							<input type="email" name="email">
							<input type="submit" value="Subscribe">
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="copyright">
				&copy; Copyright <strong>MayaKh.com</strong>. All Rights Reserved
			</div>
			<div class="credits">
				Designed by <a href="#">MayaKh.com</a>
			</div>
		</div>
	</footer>
</body>
</html>
