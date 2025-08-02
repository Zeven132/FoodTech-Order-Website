<!DOCTYPE html>
<?php
        session_start();
        include("../PHP_Components/config.php");
        //include("../PHP_Components/functions.php");
    
        //Connect to the database … passing host, database, username and password info. 
        //If these change then update config.php
    
        $dbconnect=mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if (mysqli_connect_errno())
        {
            echo "Connection Failed: ".mysqli_connect_error();
            exit;
        }
        //echo "Successfully Connected!";
    ?>
<html>
<head>
<link rel="stylesheet" href="stylesheet.css">
<link rel="icon" href="faviconPlaceholder.ico">

    <div>
        <form action="authenticate.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username">
            <label for="password">Password:</label>
            <input type="password" name="password">
            <input type="submit" value="Submit">
        </form>
    </div>