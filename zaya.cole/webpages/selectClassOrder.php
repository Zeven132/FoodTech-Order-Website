<html>
    <?php include("../PHP_Components/headNav.php"); ?>
    <body>
        <div class="wrapper">
            <div>
                <h1>Edit Existing Class Order</h1>
                <form action="editClassOrder.php" method="POST">
                    <label for="rowSelect">Input RowID of Existing Order:</label>
                    <?php
                        $sql = "SELECT MAX(RowID) FROM zayacole_class_order";
                        $result = $dbconnect->query($sql);
                        while ($data = $result->fetch_assoc()) 
                        {
                            echo '<input type="number" style="width:100px;" id="rowSelect" name="rowSelected" min="0" max="'.$data["MAX(RowID)"].'"step="1">';
                        }
                     ?>
                    
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
