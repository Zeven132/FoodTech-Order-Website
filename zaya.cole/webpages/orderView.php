<html>
    <?php include("../PHP_Components/headNav.php"); ?>
    <body>
        <h1>Food Order Database</h1>
        <p>
            <?php 
                $sql = "SELECT * FROM zayacole_class_order";
                $result = $dbconnect->query($sql);
                DisplayClassTable($result, "class");
            ?>
        </p>
    </body>
</html>