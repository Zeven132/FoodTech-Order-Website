<html>
    <?php include("../PHP_Components/headNav.php"); ?>
    <body>
        <div class="wrapper">
            <div>
                <h1>Edit Existing Class Order</h1>
                <form action="editClassOrder.php" method="POST">
                    <label for="rowSelect">Input RowID of Existing Order:</label>
                    <input type="number" id="rowSelect" name="rowSelected" min="0" step="1">
                    <input type="submit">
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
