<div class = "header">
	
	<nav>
		<!--<img src="css/NOOB_logo.png" alt="NOOB logo with a game controller" class="logo"> -->
		<ul class= "nav-links">
			<li><a href="admin.php">+ Add game</a></li>
			<li><a href="library.php">Library</a></li>
		</ul>

		<a href="#"><img src="css/NOOB_logo.png" alt="NOOB logo with a game controller" class="logo"></a>
		
		<ul class= "nav-links">
			<li><a href="register.php">Register</a></li>
			<li>
				<?php
					if($_SESSION['loggedin']) {
						$header_uname = $_SESSION['name'];
						echo "<a href='home.php'>Hello $header_uname - Logout</a>";
					} else {
						echo "<a href='home.php' class='loggedin-text'>Login</a>";
					}
				?>
			</li>
		</ul>
		
	</nav>
</div>