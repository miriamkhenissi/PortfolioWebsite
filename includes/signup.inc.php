<?php
/**
 * @version 1.0.0
 * @author Miriam Habiba Khenissi
 */

require "dbh.inc.php";
    

add_post_action('signup-submit',function(){
    global $conn;

    //Check if the user submitted all the requested data.
    if(empty($_POST['uid']) || empty($_POST['mail']) || empty($_POST['pwd']) || empty($_POST['pwd-repeat'])) {
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit();
    }

    $username =         $_POST['uid'];
    $email =            $_POST['mail'];
    $password =         $_POST['pwd'];
    $password_repeat =  $_POST['pwd-repeat'];    

    //If the username length is less than 4 then break.
    if(strlen($username) < 4){
        header("Location: ../signup.php?error=invaliduid&uid");
        exit();
    }

    //Validate the email address.
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?error=invalidmail&uid");
        exit();
    }

    if(strlen($password) < 6 || $password !== $password_repeat){
        header("Location: ../signup.php?error=passwordsnotmatching&uid=".$username."&mail=".$email);
        exit();
    }


    //Check if username exists at the database...
    $sql = "SELECT COUNT(*) AS count FROM users WHERE uidUsers =  '$username' ";
    $query =  mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);

    if($result['count']){
        header("Location: ../signup.php?error=usertaken");
        exit();
    } 

    //Reset previous variables anf check if email address exists at the database...
    $sql = "SELECT COUNT(*) AS count FROM users WHERE emailUsers =  '$email' ";
    $query =  mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);


    if($result['count']){
        header("Location: ../signup.php?error=emailtaken");
        exit();
    }  

    //If all the conditions are met then insert the user into the database.
    $password = password_hash($password, PASSWORD_DEFAULT);//Encrypt the password.
    $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers, role) VALUES ('$username', '$email', '$password', NULL) ";
    $query = mysqli_query($conn, $sql);
    if(!$query){
        header("Location: ../signup.php?error=unknown");
        exit();
    }


    //If all is good then sign in the user and redirect to dashboard
    // create a session
    session_start();
    $_SESSION['userId'] = $conn->insert_id;
    $_SESSION['userUid'] = $username;
    header("Location: ../user.php?success");
    exit();

});

