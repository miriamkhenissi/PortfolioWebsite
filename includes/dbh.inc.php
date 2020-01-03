<?php
//database info
$servername = "localhost";
$dBUser = "root";
$dBPassword = "root";
$dBName = "login-system";

//Connect to database
$conn = mysqli_connect($servername, $dBUser, $dBPassword, $dBName);

if(!$conn)
{
    //display error msg
    die("Connection Failed:" .mysqli_connect_error()); 
}