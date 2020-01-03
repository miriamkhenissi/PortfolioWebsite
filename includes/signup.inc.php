<?php
    //Check if user accessed this page after clicking on the "Sign up - submit" button
    if(isset($_POST["signup-submit"])) 
    {
        //connect to database
        require "dbh.inc.php";

        //Storing the information inputted by the user in variables
        $username = $_POST['uid'];
        $email = $_POST['mail'];
        $password = $_POST['pwd'];
        $password_repeat = $_POST['pwd-repeat'];

        //error handling
            //checking if any of the fields are empty
            if(empty($username) || empty($email) || empty($password) || empty($password_repeat))
            {
                //url will display entered information except passwords
                header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
                exit(); //the rest of the code won't execute
            }

            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) //if BOTH email and username do not match requirements
            {
                header("Location: ../signup.php?error=invalidmail&uid");
                exit();
            }

            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) //filter which verifies validity of an email
            {
                header("Location: ../signup.php?error=invalidmail&uid=".$username);
                exit();
            }

            elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username )) //filter which checks if username is all valid characters
            {
                header("Location: ../signup.php?error=invaliduid&mail=".$email);
                exit();
            }

            elseif($password !== $password_repeat) //check if passwords do match
            {
                header("Location: ../signup.php?error=passwordsnotmatching&uid=".$username."&mail=".$email);
                exit();
            }

            else
            {
                //checking if the username already exists
                $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql))   //check if connection path is valid
                {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                } 
                else
                {
                    mysqli_stmt_bind_param($stmt,"s", $username);  //take information from user and send to database, which information is it and what kind of data type is it
                    mysqli_stmt_execute($stmt); //actually running the information inside the database
                    mysqli_stmt_store_result($stmt);
                    $resultCheck = mysqli_stmt_num_rows($stmt);
                    if ( $resultCheck > 0)
                    {
                        header("Location: ../signup.php?error=usertaken&mail=".$email);
                        exit();    
                    }
                    else //we have now checked all possible errors and it's time to actually store the correct info in the database
                    {
                        $sql = "INSERT INTO users (uidUsers,	emailUsers,	pwdUsers) VALUES (?, ?, ?) ";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql))   //check if connection path is valid
                        {
                            header("Location: ../signup.php?error=sqlerror");
                            exit();
                        } 
                        else
                        {
                            $hashedPwd = password_hash($password, PASSWORD_DEFAULT); //encrypt password
                    
                            mysqli_stmt_bind_param($stmt,"sss", $username,	$email,	$hashedPwd);  //we have to USE THE HASHED PASSWORD
                            mysqli_stmt_execute($stmt); 
                            header("Location: ../signup.php?sign=success"); 
                            exit();
                        }
                    }
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
    }
    else //if username did not access page from correct link redirect them to the signup page
    {
        header("Location: ../signup.php");
        exit();
    }

