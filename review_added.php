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
    <title>Review Added</title>
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
        <form class="register" method="POST" action="game.php">
            <fieldset>
            <?php
                if(!$_SESSION['loggedin']) {
                    $result = "You must be logged in to review.";
                } else {
                    $result = addReview($_SESSION['id'], $_POST["gameId"], $_POST["rating"], $_POST["review"]);
                }
                echo "<h2 class='post-result'>" . $result . "</h2>"
            ?>
            <input type="hidden" name="gameId" value="<?=$_POST["gameId"]?>">
            <input type="submit" name="submit" value="Return to game page">
            </fieldset>
        </form>
    </div>
    <?php
    include 'footer.php';
    ?>