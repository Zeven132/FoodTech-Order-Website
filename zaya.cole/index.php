<!DOCTYPE html>
<?php
        session_start();
        include("PHP_Components/config.php");
        //include("../PHP_Components/functions.php");
    
        //Connect to the database … passing host, database, username and password info. 
        //If these change then update config.php
    
        $dbconnect=mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if (mysqli_connect_errno())
        {
            echo "Connection Failed: ".mysqli_connect_error();
            exit;
        }
        if(!isset($_SESSION['account_loggedin']))
        {
            header('Location: /3DIG/zaya.cole/webpages/loggedOutRedirect.php');
            exit;
        }
        //echo "Successfully Connected!";
    ?>
<html>
<head>
<link rel="stylesheet" href="stylesheet.css">
<link rel="icon" href="faviconPlaceholder.ico">
<title>Welcome to my awsome website!</title>
</head>
<body>

<div class="loginDiv">
<h1 style="text-align: left">hiii :3 Welcome to Index.php!</h1>
<p>This is a placeholder webpage!<br>you can view the in progress website pages here: </p> 
<ul>
    <li><a href="webpages/orderView.php">Food order view</a></li>
    <li><a href="webpages/login.php">Class Order Form</a></li>
    <li><a href="webpages/logOut.php">Logout</a></li>
    <li><p>below are the pages that I'm not going to be using anymore, since the purpose of the website has changed</p></li>
    
    <li><a href="webpages/signup.php">Signup</a></li>
    <li><a href="webpages/mainPage.php">Mainpage</a></li>
    <li><p>below are the components that will be used in the final website</p></li>
    <li><a href="PHP_Components/headNav.php">HeadNav</a></li>
    <li><p>this page below is used to control automatic webcrawlers.<br>If you have a website I'd recommend doing this too.</p></li>
    <li><a href="robots.txt">robots.txt</a></li>
</ul>
</div>
</body>
</html>