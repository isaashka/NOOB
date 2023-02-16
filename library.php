<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
 	<head>
    	<meta charset="UTF-8">
    	<title>NOOB</title>
    	<link rel="stylesheet" href="css/styles.css">
    	<link rel="stylesheet" href="css/styles_library.css">
    	
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

	</head>

	<body>
		<?php 
			include 'header.php';
        ?>
        <table id="gallery">
            <tr class="row">
        <?php

            require 'model.php';
            $db = connectToDatabase();

            $rows = $db->query("SELECT id, title, img FROM games;");
            $max_id = $db->query("SELECT id FROM games ORDER BY id DESC LIMIT 1;");
            $rowCount = 0;
            foreach ($rows as $row) {
                $rowCount++;
                echo "<td id=\"piece\">";
                for($i = 0; $i < count($row)-3; $i++){
                    if($i == 0){
                        echo "<form action=\"game.php\" method=\"post\"> 
                              <input type = \"hidden\" name = \"gameId\" value = \" ".$row[0]."\" />";

                    }
                    else if($i == 1){
                        echo " ". $row[$i] ."<br> ";
                    }
                    else{
                        if(strlen($row[$i]) > 0) {
                            echo "<input type=\"image\" name=\"submit\" src=\"". $row[$i] ."\" style=\"width: 70%;\"> ";
                        } else {
                            echo "<input type=\"image\" name=\"submit\" src=\"img/default.png\" style=\"width: 70%;\"> ";
                        }
                        
                    }
                }
                echo "</form> </td>";

                if($rowCount % 5 == 0){
                    echo "</tr> <tr>";
                }
                
            }  
		?>
            </tr>
        </div>
    </body>


    <?php
        include 'footer.php'
    ?>
