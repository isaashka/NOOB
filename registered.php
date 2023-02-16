<?php
session_start();
require 'model.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/styles_register.css">
    
    
    <script type="application/javascript" 
        src="https://cdnjs.cloudflare.com/ajax/libs/react/17.0.2/umd/react.development.js"></script>
    <script type="application/javascript" 
        src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/17.0.2/umd/react-dom.development.min.js"></script>
    <script type="application/javascript" 
        src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.38/browser.js"></script>


</head>
<body>
    
    <div id="main">
        <?php 
			include 'header.php';
		?>
        <form class="register" method="POST" action="">
            <fieldset>
            <?php
            // Input validation, then submit using addUser(name, pw, email, is_admin)
            // Password requirements: 8+ characters, at least 1 uppercase, 1 lowercase, and 1 number, can contain special characters
            if(isset($_REQUEST['submit'])) {
                if(!isset($_REQUEST['user']) || !isset($_REQUEST['email']) || !isset($_REQUEST['pw']) || !isset($_REQUEST['pw2']) || $_REQUEST['user'] == "" || $_REQUEST['email'] == "" || $_REQUEST['pw'] == "" || $_REQUEST['pw2'] == "") {
                    echo "<h2 class='post-result'>Error: All fields are required.</h2>";
                    echo "<a href='register.php' class='post-result'>Try again</a>";
                } else if(strcmp($_REQUEST['pw'], $_REQUEST['pw']) != 0) {
                    echo "<h2 class='post-result'>Error: Passwords must match</h2>";
                    echo "<a href='register.php' class='post-result'>Try again</a>";
                } else if(strlen($_REQUEST['pw']) < 8) {
                    echo "<h2 class='post-result'>Error: Password must be 8+ characters</h2>";
                    echo "<a href='register.php' class='post-result'>Try again</a>";
                } else if(!strpbrk($_REQUEST['pw'], 'qwertyuiopasdfghjklzxcvbnm')) {
                    echo "<h2 class='post-result'>Error: Password must contain a lowercase letter</h2>";
                    echo "<a href='register.php' class='post-result'>Try again</a>";
                } else if(!strpbrk($_REQUEST['pw'], 'QWERTYUIOPASDFGHJKLZXCVBNM')) {
                    echo "<h2 class='post-result'>Error: Password must contain an uppercase letter</h2>";
                    echo "<a href='register.php' class='post-result'>Try again</a>";
                } else if(!strpbrk($_REQUEST['pw'], '0123456789')) {
                    echo "<h2 class='post-result'>Error: Password must contain a number</h2>";
                    echo "<a href='register.php' class='post-result'>Try again</a>";
                } else {
                    //checkboxes submit no value by default, this db column expects either a 0 (false) or 1 (true)
                    $is_admin = 0;
                    if($_REQUEST['is_admin'] == 1) { //this returns "index does not exist" error when unchecked
                        $is_admin = 1;
                    }
                    $username = $_REQUEST['user'];
                    $pwhash = password_hash($_REQUEST['pw'], PASSWORD_DEFAULT); 
                    addUser($_REQUEST['user'], $pwhash, $_REQUEST['email'], $is_admin);
                    $rows = getUser($username);
                    $result = $rows->fetch(PDO::FETCH_ASSOC);
                    session_regenerate_id();
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['name'] = $username;
                    $_SESSION['id'] = $result['id'];
                    echo "<h2 class='post-result'>Success! Welcome, $username!</h2>";
                    echo "<a href='library.php' class='post-result'>Review your first game</a>";
                }
            }
            ?>
            </fieldset>
        </form>
    </div>
    <?php
    include 'footer.php';
    ?>