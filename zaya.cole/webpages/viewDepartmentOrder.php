<html>
    <?php include("../PHP_Components/headNav.php"); ?>
    <body>
        <h1>Department Order Database</h1>
        <p>
            <?php
                $sql = "SELECT * FROM zayacole_department_order";
                $result = $dbconnect->query($sql);
                DisplayClassTable($result, "department");
            ?>
        </p>
    </body>
</html>