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
            header('Location: webpages/loggedOutRedirect.php');
            exit;
        }
        //echo "Successfully Connected!";
    ?>
    
<html style="background: url(Images/aNiceView.jpg) no-repeat center fixed; background-size: cover; background-color: transparent">
    <!--"background-color: #2F333C -->
<head>
<link rel="stylesheet" href="stylesheet.css">
<link rel="icon" href="faviconFTD.png">
<title>Foodtech Order Dashboard</title>
</head>
<body style="background-color: unset">
    <div class="wrapper">
        <div style="background-color: #21252E">
        <h1>Food Tech Order Website<div class="logoutButton"><p style="margin: 7px"><a href="webpages/logOut.php">Log Out</p></div></h1>
        </div>
        
        <div class="IndexNavRow">
            <div class="responsive">
            <div class="gallery">
                <a href="webpages/createClassOrder.php">
                <img src="Images/Wheat.png" alt="Create a New Class Order" width="600" height="400">
                </a>
            </div>
            </div>

            <div class="responsive">
            <div class="gallery">
                <a href="webpages/selectClassOrder.php">
                <img src="Images/Cheese.png" alt="Edit an Existing Class Order" width="600" height="400">
                </a>
            </div>
            </div>
            
            <div class="responsive">
            <div class="gallery">
                <a href="webpages/orderView.php">
                <img src="Images/Sauce.png" alt="View the Class Order Database" width="600" height="400">
                </a>
            </div>
            </div>
        </div>

        <div class="IndexNavRow">
            <div class="responsive">
            <div class="gallery">
                <a href="webpages/selectClassOrders.php">
                <img src="Images/Meat.png" alt="Create a new Department Order" width="600" height="400">
                </a>
            </div>
            </div>

            <div class="responsive">
            <div class="gallery">
                <a href="webpages/selectDepartmentOrder.php">
                <img src="Images/Vegetables.png" alt="Edit an Existing Department Order" width="600" height="400">
                </a>
            </div>
            </div>
            
            <div class="responsive">
            <div class="gallery">
                <a href="Images/websitePlaceholderImage.png">
                <img src="Images/DriedHerbs.png" alt="View the Department Order Database" width="600" height="400">
                
                </a>
            </div>
            </div>
        </div>
    </div>
    
    <div class="clearfix"></div>

    <div class="imageAttribution">
        <h1>Image Attributions</h1>
        
        <ul>
            <li> <a href="https://commons.wikimedia.org/wiki/File:Wheat-flour.jpg" target="_blank">"Wheat-flour.jpg"</a> by <a>هارون يحيى</a> is licensed under <a href="http://creativecommons.org/licenses/by-sa/4.0" target="_blank">CC BY-SA 4.0</a>
            <li> <a href="https://commons.wikimedia.org/wiki/File:Delicious_Cheese.jpg" target="_blank">"Delicious Cheese.jpg"</a> by <a href="https://www.flickr.com/people/46328592@N00" target="_blank">Chris Buecheler</a> is licensed under <a href="http://creativecommons.org/licenses/by/2.0" target="_blank">CC BY 2.0</a></a>
            <li> <a href="https://commons.wikimedia.org/wiki/File:Fresh_Tomato_Sauce_(Unsplash).jpg" target="_blank">"Fresh Tomato Sauce (Unsplash).jpg"</a> by <a>Dennis Klein</a> is in the <a href="http://creativecommons.org/publicdomain/zero/1.0/" target="_blank">Public Domain, CC0</a>
            <li> <a href="https://commons.wikimedia.org/wiki/File:Meat_at_the_butcher_shop.JPG" target="_blank">"Meat at the butcher shop.JPG"</a> by <a href="https://commons.wikimedia.org/wiki/User:Revital9" target="_blank">Revital Salomon</a> is licensed under <a href="http://creativecommons.org/licenses/by-sa/4.0" target="_blank">CC BY-SA 4.0</a>
            <li> <a href="https://commons.wikimedia.org/wiki/File:Ecologically_grown_vegetables.jpg" target="_blank">"Ecologically grown vegetables.jpg"</a> by <a>Elina Mark</a> is licensed under <a href="http://creativecommons.org/licenses/by-sa/3.0" target="_blank">CC BY-SA 3.0</a>
            <li> <a href="https://cariblens.com/download/heap-of-dry-hibiscus-tea-background-tea-dried-hibiscus-flowers-top-view-free-photo/" target="_blank">"Heap of dry hibiscus tea background tea dried hibiscus flowers top view"</a> is designed by Freepik
            
            
        </ul>
        <p style="font-size: smaller; text-align: center">All listed works have been digitally altered from their original state.</p> 
    </div>
</body>
</html>