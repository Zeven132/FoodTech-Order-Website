<html>
<?php
    include("../PHP_Components/headNav.php");
        $row = $_POST["row"];
        $classIDs = $_POST["classRowIDs"];
        $recipes = $_POST["recipes"];
        $baking = $_POST["baking"];
        $bread = $_POST["bread"];
        $chilled = $_POST["chilled"];
        $dairy = $_POST["dairy"];
        $dried = $_POST["dried"];
        $fresh = $_POST["fresh"];
        $frozen = $_POST["frozen"];
        $other = $_POST["other"];
        $raw = $_POST["raw"];
        $sauces = $_POST["sauces"];
        $tinned = $_POST["tinned"];
        $vegetables = $_POST["vegetables"];
        $techReq = $_POST["techReq"];
        $dateCreated = $_POST["dateCreated"];

    $sql = "
    UPDATE zayacole_department_order 
    SET ClassRowIDs = '$classIDs', Recipes = '$recipes', Baking = '$baking', Bread = '$bread', Chilled = '$chilled', Dairy = '$dairy', Dried = '$dried', Fresh = '$fresh', Frozen = '$frozen', Other = '$other', Raw = '$raw', Sauces = '$sauces', Tinned = '$tinned', Vegetables = '$vegetables', TechnicianReq = '$techReq', DateCreated = '$dateCreated'
    WHERE RowID = '$row'";

    if (!($dbconnect->query($sql) == TRUE)) 
    {
        echo "Error: " . $sql . "<br>" . $dbconnect->error;
    }
?>
</html>