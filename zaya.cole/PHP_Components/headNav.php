<html lang="en">
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
    <head>
        <link rel="stylesheet" href="../stylesheet.css">
        <link rel="icon" href="../faviconPlaceholder.ico">
        <meta charset="UTF-8">
        <meta name="description" content="To be done.. later">
        <meta name="keywords" content="Food order form">
        <meta name="author" content="Zaya Cole">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <!--<ul class="decoNav">
            <li class="activePage">Main</li>
            <li class="navItems">About</li>
            <li class="navItems">Rules</li>
            <li class="navItems">Create</li>
            <li class="navItems">Profile</li>
        </ul>-->
    </body>
</html>