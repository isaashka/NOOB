<?php
session_start();
// Whenever home is accessed, the user needs to login again. 
// Without first defining the 'loggedin' index, other pages will return an error whenever not logged in.
// This also provides an easy way to create a log out button!
$_SESSION['loggedin'] = FALSE;
?>

<!DOCTYPE html>
<html lang="en">
 	<head>
    	<meta charset="UTF-8">
    	<title>NOOB</title>
    	<link rel="stylesheet" href="css/styles.css">
    	<link rel="stylesheet" href="css/styles_home.css">
    	
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

    	<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/react/17.0.2/umd/react.development.js"></script>
    	<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/17.0.2/umd/react-dom.development.min.js"></script>
    	<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.38/browser.js"></script>

	</head>

	<body>
		<?php 
			/*include 'header.php';*/
		?>
		<div id="main">
  			<script type="text/babel" src="App.js"></script>

  		</div>

  		
		<!--
		<div id="main">
			<div class = "welcome">
				<p>Welcome to NOOB!</p><br>
				<p>We are a video game review platform for noobs and pro gamers alike.</p>
			</div>

			<div class="hook">
				<h1>Find new games.</h1> <br>
				<h1>Leave reviews.</h1> <br>
				<h1>Meet other Noobs</h1> <br>
				<h1>from all over the</h1> <br>
				<h1>world!</h1> <br>
			</div>

			<div class="welcome">
				<p>Begin your adventure with us today!</p>
			</div>

			<div class="image">
				<a href="register.php"><img src="css/start.png" alt="A button that says start on it" class="start"></a>
			</div>
		</div>
	-->

		

<?php
include 'footer.php';
?>