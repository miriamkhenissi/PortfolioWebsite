<?php
    require"header.php";
?>

<main>
<h1> Sign up </h1>
<?php
    if( isset($_GET['error'])){
        if($_GET['error'] == 'emptyfields')
        {
            echo"<p class='signuperror'> Fill in all fields! </p>";
        }
        else if ($_GET['error'] == 'invalidmail&uid')
        {
            echo"<p class='signuperror'> Invalid email and username! </p>";
        }

        else if ($_GET['error'] == 'invalidmail')
        {
            echo"<p class='signuperror'> Invalid email! </p>";
        }

        else if ($_GET['error'] == 'invaliduid')
        {
            echo"<p class='signuperror'> Invalid username! </p>";
        }

        else if ($_GET['error'] == 'passwordsnotmatching')
        {
            echo"<p class='signuperror'> Passwords not matching! </p>";
        }

        else if ($_GET['error'] == 'usertaken')
        {
            echo"<p class='signuperror'> User already exists! </p>";
        }
    }

    else if(isset($_GET['sign']) && $_GET['sign'] == 'success'){
        echo"<p class='signupsuccess'> You are now signed up! </p>";
    }
?>
    <form action="includes/signup.inc.php" method="post">
        <input type = "text" name="uid" placeholder="Username" >
        <input type = "text" name="mail" placeholder="E-mail">
        <input type = "password" name="pwd" placeholder="Password">
        <input type = "password" name="pwd-repeat" placeholder="Repeat password">
        <button type="submit" name="signup-submit">Signup</button>

    </form>
</main>

<?php
    require"footer.php";
?>
