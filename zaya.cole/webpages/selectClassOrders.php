<html>
    <?php include("../PHP_Components/headNav.php"); ?>
    <body>
        <div class="wrapper">
            <div>
                <h1>Create Department Order</h1>
                <form action="creatingDepartmentOrder.php" method="POST">
                    
                    <label for="rowSelect">Rows to combine into department order:</label>
                    <input type="text" id="rowSelect" name="rowSelect">
                    <p>Type the RowID of each class order, seperating each by a comma and a space.<br>Example: this input would choose RowID 5, 6, 7, and 8 to be combined into a department order.<br>5, 6, 7, 8</p>
                </form>
            </div>
            <?php
                $sql = "SELECT * FROM zayacole_class_order ORDER BY RowID DESC LIMIT 5";
                $result = $dbconnect->query($sql);
                DisplayClassTable($result, "class");
            ?>
        </div>
    </body>
</html>
