<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a game</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/styles_addgame.css">
    
    
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
    </div>

    <form class="add-game-form" method="POST"  enctype="multipart/form-data" action="upload.php">
	<fieldset>
		<h2>Add a new game</h2>
		<hr>
		<br>
        <label for="">Title</label>
        <br>
		<input type="text" name="game-title">
		<br>
        <br>
        <label for="">Synopsis</label>
        <br>
		<input id="game-synopsis" type="text" name="game-synopsis">
		<br>
        <br>
        <label for="">Developer</label>
        <br>
		<input type="text" name="game-developer">
		<br>
        <br>
        <label for="">Publisher</label>
        <br>
		<input type="text" name="game-publisher">
        <br>
        <br>
        <label for="">Platforms</label>
        <br>
        <input type="text" name="game-platforms">
        <br>
        <br>
        <label for="">Release date (YYYY-MM-DD)</label>
        <br>
        <input type="text" name="game-releasedate">
        <br>
       <br>
        <label for="">Genres</label>
        <br>
        <input type="text" name="game-genres">
        <br>
       <br>
        <label for="">Notes (early access, other important attributes)</label>
        <br>
        <input type="text" name="game-notes">
        <br>
        <br>
        <label for="">Cover Art</label>
        <br>
        <input type="text" name="img-url" placeholder="Image url..."> 
        <br>
        <!--
        <p> or</p>
        
		<input type="file" name="file-input" class="file-input">
        <br>
        -->


		<button type="submit">Create Game</button>
	</fieldset>
    </form>    

</body>
</html>
