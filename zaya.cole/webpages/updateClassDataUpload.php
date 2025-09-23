<html>
<?php


    include("../PHP_Components/headNav.php");
        $row = $_POST["row"];
        $teacher = $_POST["teacher"];
        $date = $_POST["date"];
        $class = $_POST["class"];
        $roomNum = $_POST["roomNum"];
        $recipe = $_POST["recipe"];
        $students = $_POST["students"];
        $block = $_POST["block"];
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

    $sql = "
    UPDATE zayacole_class_order 
    SET TeacherCode = '$teacher', PracticalDay = '$date', Class = '$class', RoomNum = '$roomNum', Recipe = '$recipe', NumOfStudents = '$students', Block = '$block', Baking = '$baking', Bread = '$bread', Chilled = '$chilled', Dairy = '$dairy', Dried = '$dried', Fresh = '$fresh', Frozen = '$frozen', Other = '$other', Raw = '$raw', Sauces = '$sauces', Tinned = '$tinned', Vegetables = '$vegetables', TechnicianReq = '$techReq'
    WHERE RowID = '$row'";

    if ($dbconnect->query($sql) == TRUE) 
    {
        //echo "Record updated successfully";
        //header("Location: https://php.papamoacollege.school.nz/3DIG/zaya.cole/index.php/", true);
        //echo '<html><head><script></script></head></html>';
        //exit();
        ?>
        <script>
        Redirect();
        </script>
        <?php
        
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $dbconnect->error;
    }
?>
</html>