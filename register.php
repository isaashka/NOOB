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
        <form class="register" method="POST" action="registered.php">
            <fieldset>
                <h2>Register for a new account</h2>
                <input type="text" id="user" name="user" placeholder="Username"><br>
                <input type="email" id="email" name="email" placeholder="Email address"><br>
                <label for="pw" id="password-reqs">Password requirements: 8+ characters, at least 1 uppercase, 1 lowercase, and 1 number</label>
                <input type="password" id="pw" name="pw" minlength="8" placeholder="Password"><br>
                <input type="password" id="pw2" name="pw2" minlength="8" placeholder="Password (retype)"><br>

                <label for="is_admin">Are you a game developer?</label>
                <input type="checkbox" name="is_admin" id="is_admin" value="1">

                <input type="submit" name="submit" value="Register">
            </fieldset>
        </form>
    </div>
    <?php
    include 'footer.php';
    ?>