<?php $title = "Contact"; ?>
<?php require("header.php"); ?>


<main class="wrapper">
    <div class="container">
        <div class="signup-form">
            <h2>Sign up</h2>
            <?php
                if( isset($_GET['error'])){
                    if($_GET['error'] == 'emptyfields') echo"<p class='signuperror'> Fill in all fields! </p>";
                    else if ($_GET['error'] == 'invalidmail&uid') echo"<p class='signuperror'> Invalid email ad username! </p>";
                    else if ($_GET['error'] == 'invalidmail') echo"<p class='signuperror'> Invalid email! </p>";
                    else if ($_GET['error'] == 'invaliduid') echo"<p class='signuperror'> Invalid username! </p>";
                    else if ($_GET['error'] == 'passwordsnotmatching') echo"<p class='signuperror'> Error password! </p>";
                    else if ($_GET['error'] == 'usertaken') echo"<p class='signuperror'> User already exists! </p>";
                    else if ($_GET['error'] == 'emailtaken') echo"<p class='signuperror'> Email address already in use! </p>";
                    else if ($_GET['error'] == 'unknown') echo"<p class='signuperror'> Unknown error please try signing up later. </p>";
                }else if(isset($_GET['sign']) && $_GET['sign'] == 'success'){
                    echo"<p class='signupsuccess'> You are now signed up! </p>";
                }
            ?>
            <form action="includes/signup.inc.php" method="post">
                <div class="field">
                    <label for="uid">Username</label>
                    <input type = "text" name="uid" placeholder="Username" >
                    <div style="margin-top:-8px;"><small>Username length must be at leaset 5 characters.</small></div>
                </div>

                <div class="field">
                    <label for="mail">E-mail</label>
                    <input type = "text" name="mail" placeholder="E-mail">
                </div>

                <div class="field">
                    <label for="pwd">Password</label>
                    <input type = "password" name="pwd" placeholder="Password">
                    <div style="margin-top:-8px;"><small>Password must combine at least of 6 characters.</small></div>
                </div>

                <div class="field">
                    <label for="pwd-repeat">Repeat Password</label>
                    <input type = "password" name="pwd-repeat" placeholder="Repeat password">
                </div>

                <button class="btn-purple" type="submit" name="signup-submit">Signup</button>
            </form>
        </div>
    </div>
</main>

<?php
    require"footer.php";
?>