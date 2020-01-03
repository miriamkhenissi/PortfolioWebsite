<?php
	session_start();

    if ( isset($_POST['submit'])) {  //when the submit buton is clicked
        $newFileName = $_POST['filename']; //the file name is store in the $newFileName variable
        if (empty($_POST['filename'])) { //what if I do not fill in the file name?
            $newFileName = "gallery";  //the default file name would be gallery
        } else {
            $newFileName = strtolower(str_replace(" ","-",$newFileName));  //if the user did input the file name we want to replace he spaces with a dash and lowercase the string
        }
        $imageTitle = $_POST['filetitle']; //the file title is stored in the $imageTitle variable
        $imageDesc = $_POST['filedesc'];
        $userGallery = $_SESSION['userId'];

        $file = $_FILES['file'];

        //print_r($file); //test to get information about the file like size

        $fileName = $file["name"]; //when testing print_r we got an array with info, we are now grabbing the name info from that array
        $fileType = $file["type"];
        $fileTempName = $file["tmp_name"];
        $fileError = $file["error"];
        $fileSize = $file["size"];

        $fileExt = explode (".", $fileName); //we are only storing the file extension by using the explode command to sepearate what in between the dot "."
        $fileActualExt = strtolower(end($fileExt));   //lowercase the string and choose the last part of the exploded name which is now an array

        //what file types are allowed
        $allowed = array("jpg","jpeg","png");

        //error handling
        if (in_array($fileActualExt, $allowed)) {  // the in_array method checks if $fileActualExt is included in the $allowed array
            if ($fileError == 0){
                if ($fileSize < 200000000){
                    $imageFullName = $newFileName . "-" . uniqid("", false) . "." . $fileActualExt; //create a unique full name for each valid photo
                    $fileDestination = "../img/gallery/" . $imageFullName;

                    include_once "dbh.inc.php";

                    if (empty($imageTitle) || empty($imageDesc)){
                        header("Location: ../gallery.php?upload=empty");
                        exit();
                    } else {
                        $sql = "SELECT * FROM gallery;";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "SQL statement failed!";
                        } else {
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            $rowCount = mysqli_num_rows($result);
                            $setImageOrder = $rowCount + 1;

                            $sql = " INSERT INTO gallery (titleGallery,	descGallery, imgFullNameGallery, orderGallery, userGallery) VALUES (?,?,?,?,?);";
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "SQL statement failed!";
                            } else {
                                mysqli_stmt_bind_param($stmt, "sssss", $imageTitle, $imageDesc, $imageFullName, $setImageOrder, $userGallery);
                                mysqli_stmt_execute($stmt);

                                move_uploaded_file($fileTempName, $fileDestination);

                                header("Location: ../gallery.php?upload=success");
    
                            }

                        }
                        
                    }
                } else {
                    echo "File size is too large!";
                    exit();                     
                }
            } else {
                echo "You had an error!";
                exit();                
            }

        } else {
            echo "Error! Unexpected file format.";
            exit();
        }
    }