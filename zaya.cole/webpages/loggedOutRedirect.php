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
<html style="background: url(../Images/aNiceView.jpg) no-repeat center fixed; background-size: cover; background-color: transparent">
    <head>
        <link rel="stylesheet" href="../stylesheet.css">
        <link rel="icon" href="../faviconFTD.png">
        <title>Foodtech Order Dashboard</title>
        <meta charset="UTF-8">
        <meta name="description" content="To be done.. later">
        <meta name="keywords" content="Food order form">
        <meta name="author" content="Zaya Cole">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- jquery init -->
        <script src="../Plugins/jquery-3.7.1.min.js"></script>
    </head>
<body style="background-color: unset">
    <div class="foggyGlass">
        <h1>You are currently logged out</h1>
        <div style="padding-bottom: 15px; margin: auto; width: 30%">
            <form action="authenticate.php" method="post">
            <p>Login with existing account details below<p>
            <label for="username">Username:</label>
            <input type="text" name="username">
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password">
            <br>
            <input type="submit" value="Submit">
        </form>
        </div>

    </div>
</body>
</html>