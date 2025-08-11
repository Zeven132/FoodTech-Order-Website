<html>
    <?php
    include("../PHP_Components/headNav.php");



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

    //echo ("$teacher, $date, $class, $roomNum, $recipe, $students, $block, $baking, $bread, $chilled, $dairy, $dried, $fresh, $frozen, $other, $raw, $sauces, $tinned, $vegetables, $techReq");
    //echo ($_POST['teacher']);
    $sql = "INSERT INTO zayacole_class_order (TeacherCode, PracticalDay, Class, RoomNum, Recipe, NumOfStudents, Block, Baking, Bread, Chilled, Dairy, Dried, Fresh, Frozen, Other, Raw, Sauces, Tinned, Vegetables, TechnicianReq)
    VALUES ('$teacher', '$date', '$class', '$roomNum', '$recipe', '$students', '$block', '$baking', '$bread', '$chilled', '$dairy', '$dried', '$fresh', '$frozen', '$other', '$raw', '$sauces', '$tinned', '$vegetables', '$techReq')";
    
    //https://stackoverflow.com/questions/49515724/insert-into-with-php-post
    /*$sql = 'INSERT INTO 
    zayacole_class_order (TeacherCode, PracticalDay, Class, RoomNum, Recipe, NumOfStudents, Block, Baking, Bread, Chilled, Dairy, Dried, Fresh, Frozen, Other, Raw, Sauces, Tinned, Vegetables, TechnicianReq)
    VALUES 
    (
      ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
    )';
    if ($stmt = $dbconnect->prepare($sql))
    {
      $stmt->bind_param('ssssssssssssssssssss', $_POST['teacher'], $_POST['date'], $_POST['class'], $_POST['roomNum'], $_POST['recipe'], $_POST['students'], $_POST['block'], $_POST['baking'], $_POST['bread'], $_POST['chilled'], $_POST['dairy'], $_POST['dried'], $_POST['fresh'], $_POST['frozen'], $_POST['other'], $_POST['raw'], $_POST['sauces'], $_POST['tinned'], $_POST['vegetables'], $_POST['techReq']);

      if($stmt->execute())
      {
        echo "New record created successfully";
        //https://stackoverflow.com/questions/4871942/how-to-redirect-to-another-page-using-php
        header("Location: https://php.papamoacollege.school.nz/3DIG/zaya.cole/index.php");
        exit();
      } else {
          echo "Error: " . $sql . "<br>" . $dbconnect->error;
      } 
    }*/

    /*$sql = 'INSERT INTO 
    zayacole_class_order (TeacherCode, PracticalDay, Class, RoomNum, Recipe, NumOfStudents, Block, Baking, Bread, Chilled, Dairy, Dried, Fresh, Frozen, Other, Raw, Sauces, Tinned, Vegetables, TechnicianReq)
    VALUES ($_POST["teacher"], $_POST['date'], $_POST['class'], $_POST['roomNum'], $_POST['recipe'], $_POST['students'], $_POST['block'], $_POST['baking'], $_POST['bread'], $_POST['chilled'], $_POST['dairy'], $_POST['dried'], $_POST['fresh'], $_POST['frozen'], $_POST['other'], $_POST['raw'], $_POST['sauces'], $_POST['tinned'], $_POST['vegetables'], $_POST['techReq']);

    */
    
    
    
    if ($dbconnect->query($sql) == TRUE) 
    {
      echo "New record created successfully";
      //https://stackoverflow.com/questions/4871942/how-to-redirect-to-another-page-using-php
      header("Location: https://php.papamoacollege.school.nz/3DIG/zaya.cole/index.php");
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
