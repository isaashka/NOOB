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
                if(strlen($_REQUEST['game-title']) == 0) {
                    echo "<h2 class='post-register'>Error: 'Title' field is required.</h2>";
                    echo "<a href='admin.php' class='post-result'>Try again</a>";
                } else if($_SESSION['loggedin'] == false){
                    echo "<h2 class='post-register'>Error: You must be logged in to add a game.</h2>";
                    echo "<a href='admin.php' class='post-result'>Try again</a>";
                } else if(!isUserAdmin($_SESSION['id'])) {
                    echo "<h2 class='post-register'>Error: You must be an Admin to add a game to the library.</h2>";
                } else if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$_POST['game-releasedate'])) {
                    echo "<h2 class='post-register'>Error: Enter date in the format YYYY-MM-DD.</h2>";
                    echo "<a href='admin.php' class='post-result'>Try again</a>";
                } else {
                    $result = addGame($_POST['game-title'], $_POST['game-synopsis'], $_POST['img-url'], $_POST['game-developer'], $_POST['game-publisher'], $_POST['game-platforms'], $_POST['game-releasedate'], $_POST['game-genres'], $_POST['game-notes']);
                    echo "<h2 class='post-register'>" . $result . "</h2>";
                    echo "<a href='library.php' class='post-result'>Go to Library</a>";
                }
            ?>
            </fieldset>
        </form>
    </div>
    <?php
    include 'footer.php';
    ?>