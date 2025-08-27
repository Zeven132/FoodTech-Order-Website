<html>
    <?php include("../PHP_Components/headNav.php"); ?>
    <body>
        <div class="wrapper">
            <div>
                <h1>Edit Existing Class Order</h1>
                <form action="editClassOrder.php" method="POST">
                    <label for="rowSelect">Input RowID of Existing Order:</label>
                    <input type="text" id="rowSelect" name="rowSelected">
                    <input type="submit">
                </form>
            </div>
        </div>
    </body>
</html>
