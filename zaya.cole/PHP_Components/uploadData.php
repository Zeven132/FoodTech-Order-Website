<html lang>
    <?php include("../PHP_Components/headNav.php"); 
    $sql = 'INSERT INTO zayacole_class_order (TeacherCode, PracticalDay, Class, RoomNum, Recipe, NumOfStudents, Block, Baking, Bread, Chilled, Dairy, Dried, Fresh, Frozen, Other, Raw, Sauces, Tinned, Vegetables, TechnicianReq)
    VALUES ($_POST["teacher"], $_POST["date"], $_POST["class"], $_POST["roomNum"], $_POST["recipe"], $_POST["students"], $_POST["block"], $_POST["baking"], $_POST["bread"], $_POST["chilled"], $_POST["dairy"], $_POST["dried"], $_POST["fresh"], $_POST["frozen"], $_POST["other"], $_POST["raw"], $_POST["sauces"], $_POST["tinned"], $_POST["vegetables"], $_POST["techReq"])'
    ?>
    <body>
        <p>Processing Request...</p>
    </body>
</html>