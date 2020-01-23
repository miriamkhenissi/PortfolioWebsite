<?php

if (isset($_POST['login-submit']) )
{
    require 'dbh.inc.php';
    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    if ( empty($mailuid) || empty($password) ) //check if both fields are full
    {
        header("Location: ../user.php?error=emptyfields");
        exit();
    }
    else
    {
        $sql= "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) 
        {
            header("Location: ../user.php?error=sqlerror");
            exit();
        }

        else
        {
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt); //execute to get result from database
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)) //if condition is true, means greater than one
            {
                $pwdCheck = password_verify($password, $row['pwdUsers']);
                if ($pwdCheck == false)
                {
                    header("Location: ../user.php?error=wrong-password");
                    exit();
                }
                else if ($pwdCheck == true)
                {
                    // create a session
                    session_start();
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['userUid'] = $row['uidUsers'];
                    header("Location: ../user.php?success");
                    exit();
                }
            }
            else
            {
                header("Location: ../user.php?error=no-usertest");
                exit();
            }
        }
    }

}

else
{
    header("Location: ../user.php");
    exit();
}