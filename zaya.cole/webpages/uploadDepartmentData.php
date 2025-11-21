<html>
    <?php
    include("../PHP_Components/headNav.php");

    $classIDs = $_POST["classIDs"];
    $practicalDay = $_POST["practicalDay"]; // can be used in the future if needed
    $dateCreated = $_POST["dateCreated"];
    $class = $_POST["class"]; // can be used in the future if needed
    $roomNum = $_POST["roomNum"]; // can be used in the future if needed
    $students = $_POST["students"]; // can be used in the future if needed
    $recipes = $_POST["recipes"];
    $block = $_POST["block"]; // can be used in the future if needed
    $techReq = $_POST["techReq"];
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

    $sql = "INSERT INTO zayacole_department_order (ClassRowIDs, Recipes, Baking, Bread, Chilled, Dairy, Dried, Fresh, Frozen, Other, Raw, Sauces, Tinned, Vegetables, TechnicianReq, DateCreated)
    VALUES ('$classIDs', '$recipes', '$baking', '$bread', '$chilled', '$dairy', '$dried', '$fresh', '$frozen', '$other', '$raw', '$sauces', '$tinned', '$vegetables', '$techReq', '$dateCreated')";
    
    if ($dbconnect->query($sql) == TRUE) 
    {
      echo "New record created successfully";
      exit();
    } 
    else 
    {
      echo "Error: " . $sql . "<br>" . $dbconnect->error;
    }
    ?>
    <body>
        <p>uploading to Database...</p>
    </body>
</html>
