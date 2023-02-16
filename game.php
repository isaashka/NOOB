<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
 	<head>
    	<meta charset="UTF-8">
    	<title>NOOB</title>
    	<link rel="stylesheet" href="css/styles.css">
    	<link rel="stylesheet" href="css/styles_game.css">
    	
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

	</head>

	<body>
		<?php 
			include 'header.php';

            require 'model.php';
            $db = connectToDatabase();
        ?>

        <div id="game_review">
            <div id="review">
                <form action="review_added.php" method="post">
                    <h2><strong>Add a Review</strong></h2><br>
                    <label for="rate">Rating<label>
                    <select id="rate" name="rating">
                        <option value="0">...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select><br>
                    <label for="review">Review</label><br>
                    <textarea id="review" name="review" cols="50" rows="30"></textarea><br>
                    <input type="submit" name="submit" value="Publish">
                    <input type="hidden" name="gameId" value="<?=$_POST["gameId"]?>">
                </form>
            </div>


            <div id="game_info">
                <?php
                    /*if(isset($_POST["submit"])){
                        $gameId = $_POST["gameId"];
                    }*/
                    $gameId = $_POST["gameId"];
                    //$sql = "SELECT * FROM games WHERE id = $gameId;";

                    //$gameInfo = $db->query($sql);

                    $rows = $db->query("SELECT * FROM games;");

                    $rate = $db->query("SELECT * FROM collections;");
                    $total = 0;
                    $numRates = 0;
                    foreach($rate as $rates){
                        if($rates[1]==$gameId){
                            $total += $rates[3];
                            $numRates++;
                        }
                    }
                    if($numRates > 0){
                        $avg_rate = $total / $numRates;
                    }
                    else{ 
                        $avg_rate = "N/A";
                    }
                    

                    foreach($rows as $row){
                        if($row[0] == $gameId){
                            if(strlen($row[3]) > 0) {
                                echo "<img src=\"". $row[3] ."\"><br>";
                            } else {
                                echo "<img src='img/default.png'><br>";
                            }
                            echo "<h2><strong>". $row[1] ."</strong></h2><br>";
                            echo "<strong>Released: </strong>".$row[7]." <br>";
                            echo "<strong>Genres: </strong>".$row[8] ."<br>";
                            echo "<strong>Platforms: </strong>". $row[6]."<br>";
                            echo "<strong>Developer: </strong>". $row[4]."<br>";
                            echo "<strong>Publisher: </strong>". $row[5]."<br>";
                            
                            
                            echo "<strong>Average Rating: </strong>".$avg_rate ."<br><br>";

                            echo " ".$row[2]." <br><br>";
                        }
                    }    
                ?>

            </div>
            <br>
            <div id="other_reviews">
                <h2>Reviews</h2>
                <?php
                    $reviews = $db->query("SELECT * FROM collections;");
                    foreach($reviews as $review){
                        if($review[1] == $gameId){
                            echo "<div class=\"review_box\">";
                            $user_pdos = $db->query("SELECT name FROM users WHERE id = $review[0];");
                            $user = $user_pdos->fetch();
                            echo "<strong>".$user['name']."</strong><br>";
                            echo "<strong>".$review[3]."</strong><br>";
                            echo "".$review[4]."<br>";

                            echo "</div>";
                        }
                    }
                ?>

            </div>

        </div>

    </body>

</html>