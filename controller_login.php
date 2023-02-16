<?php
session_start();
require 'model.php';
$action=$_REQUEST['action'];

if ($action == "login")
{
    $username=$_REQUEST['username'];
    $password=$_REQUEST['password'];
    $rows = getUser($username);
    if ($rows->rowCount() == 1) 
    {
        $result = $rows->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $result['pw'])) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $username;
            $_SESSION['id'] = $result['id'];
            echo 1;
            
        } 
        else 
        {
            //password verify fail - Incorrect password
            echo 0;
        }
    } 
    else 
    {
        // Username not found in db - Incorrect username
        echo 0;
    }
}
else
{
    echo 'no data';
}
?>