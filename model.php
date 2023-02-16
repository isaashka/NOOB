<?php
// Functions for database queries and edits, all return PDOStatement objects
function connectToDatabase() {
    try {
        //replace localhost with mysqlweb.cs.wwu.edu when done testing
        //return new PDO("mysql:dbname=ilinska_noob_test;host=mysqlweb.cs.wwu.edu", "ilinska", "@*J!3`X%k-T");
        return new PDO("mysql:dbname=aboudan_noob;host=mysqlweb.cs.wwu.edu","aboudan", ">_VQ}I(gE9");
    } catch(PDOException $e) {
        echo 'Message: ' .$e->getMessage();
        exit('Error: could not establish database connection');
    }
}
// Fetch first user in table with a given name (exact string)
function getUser($name) {
    $db = connectToDatabase();

    if(!isset($name)) {
        return "Error: Username not provided";
    }

    $sql = "SELECT * FROM users WHERE name=? LIMIT 1";
    $stmt = $db->prepare($sql);
    $status = $stmt->execute([$name]);
    return $stmt;
}
// Returns if a given user_id is admin or not. Required for add game form
function isUserAdmin($user_id) {
    $db = connectToDatabase();

    $sql = "SELECT is_admin FROM users WHERE id=?";
    $stmt = $db->prepare($sql);
    $status = $stmt->execute([$user_id]);
    $arr = $stmt->fetch();
    if($arr[0] == 1) {
        return true;
    } else {
        return false;
    }
}
// Checks if a given game has an image url set, if so, returns it, if else returns default.png
// Adds new row to users table, given name, hashed password, email, and is_admin (0=False, 1=True)
// TODO What if that username is taken? (return error)
function addUser($name, $pw, $email, $is_admin) {
    $db = connectToDatabase();

    if(!isset($name)) {
        return "Error: Username not provided";
    }
    if(!isset($pw)) {
        return "Error: Password not provided";
    }
    if(!isset($email)) {
        return "Error: Email not provided";
    }
    if(!isset($is_admin)) {
        $is_admin = 0;
    }

    $sql = "INSERT INTO users (name, pw, email, is_admin) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $status = $stmt->execute([$name, $pw, $email, $is_admin]);
    return $status;
}
// Fetch first game in table with a given title (exact string)
function getGame($title) {
    $db = connectToDatabase();

    if(!isset($title)) {
        return "Error: Game title not provided";
    }

    $sql = "SELECT * FROM games WHERE title=? LIMIT 1";
    $stmt = $db->prepare($sql);
    $status = $stmt->execute([$title]);
    return $stmt;
}
// Fetch most recent 50 games in database (for library page)
function getAllGames() {
    $db = connectToDatabase();

    $sql = "SELECT * FROM games LIMIT 50 ORDER BY id DESC";
    $stmt = $db->prepare($sql);
    $status = $stmt->execute();
    return $stmt;
}
// Fetch all rows in collections matching a given game_id (from getGame)
function getReviews($game_id) {
    $db = connectToDatabase();

    if(!isset($game_id)) {
        return "Error: Game ID not provided";
    }

    $sql = "SELECT user_id, rating, review FROM collections WHERE game_id=?";
    $stmt = $db->prepare($sql);
    $status = $stmt->execute([$game_id]);
    return $stmt;
}
// Fetch just ratings from the collections table (for averaging)
function getRatings($game_id) {
    $db = connectToDatabase();

    if(!isset($game_id)) {
        return "Error: Game ID not provided";
    }

    $sql = "SELECT rating FROM collections WHERE game_id=?";
    $stmt = $db->prepare($sql);
    $status = $stmt->execute([$game_id]);
    return $stmt;
}
// Insert a new entry to the games table (for admins only)
// TODO What if a game by that title already exists? (delete it)
function addGame($title, $synopsis, $img, $developer, $publisher, $platforms, $released, $genres, $notes) {
    $db = connectToDatabase();

    if(!isset($title)) {
        $title = "";
    }
    if(!isset($synopsis)) {
        $synopsis = "";
    }
    if(!isset($img)) {
        $img = "";
    }
    if(!isset($developer)) {
        $developer = "";
    }
    if(!isset($publisher)) {
        $publisher = "";
    }
    if(!isset($platforms)) {
        $platforms = "";
    }
    if(!isset($released)) {
        $released = date("Y-m-d");
    }
    if(!isset($genres)) {
        $genres = "";
    }
    if(!isset($notes)) {
        $notes = "";
    }

    $sql = "INSERT INTO games (title, synopsis, img, developer, publisher, platforms, released, genres, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $status = $stmt->execute([$title, $synopsis, $img, $developer, $publisher, $platforms, $released, $genres, $notes]);
    return "$title added to library!";
}
// Add a rating and review to the collections table. If review already exists, overwrite it.
function addReview($user_id, $game_id, $rating, $review) {
    $db = connectToDatabase();

    if(!isset($user_id)) {
        return "Error: User ID not provided";
    }
    if(!isset($game_id)) {
        return "Error: Game ID not provided";
    }
    if(!isset($rating)) {
        $rating = 0;
    }
    if(!isset($review)) {
        $review = "";
    }

    $sql1 = "DELETE FROM collections WHERE user_id=? AND game_id=?";
    $stmt1 = $db->prepare($sql1);
    $status1 = $stmt1->execute([$user_id, $game_id]);
    if((1 <= $rating && $rating <= 10) || (strlen($review) < 0)){
        $sql2 = "INSERT INTO collections (user_id, game_id, rating, review) VALUES (?, ?, ?, ?)";
        $stmt2 = $db->prepare($sql2);
        $status2 = $stmt2->execute([$user_id, $game_id, $rating, $review]);
        return 'Review posted!';
    } else {
        return 'Review deleted.';
    }
}
?>