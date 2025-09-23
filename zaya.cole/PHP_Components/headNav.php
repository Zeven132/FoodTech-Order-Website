<html lang="en">
<?php
        session_start();
        include("../PHP_Components/config.php");
    
        //Connect to the database … passing host, database, username and password info. 
        //If these change then update config.php
    
        $dbconnect=mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if (mysqli_connect_errno())
        {
            echo "Connection Failed: ".mysqli_connect_error();
            exit;
        }
        //echo "Successfully Connected!";

        if(!isset($_SESSION['account_loggedin']))
        {
            header('Location: loggedOutRedirect.php');
            exit;
        }

        /*function Redirect()
        {
            header('Location: https://php.papamoacollege.school.nz/3DIG/zaya.cole/index.php');
            exit;
        }*/

        // decodes JSON from database. initially attempted to use existing JSON framework but it wouldnt work
        function DecodeJSON($string, $formatCase) // 1 = decode to 2d arr; 2 = decode to string for display
        {
        
            $string = str_replace("{[", "", $string);
            $string = str_replace("]}", "", $string);

            

            switch($formatCase)
            {
                case 1:
                    $string = str_replace("{}", "", $string); // this line only matters if the ingredient category is empty
                    $data = explode("], [", $string);
                    for($i = 0; $i < count($data); $i++) 
                    {
                        $output[$i] = explode(", ", str_replace('"', "", $data[$i]));
                    }
                    //$output = array_walk_recursive($output, "RemoveDoublequotes");

                    //echo var_dump($output);
                    return $output;
                break;
                
                case 2:
                    $string = str_replace("], [", ";<br>", $string);
                    $string = str_replace('"', "", $string);
                    $string = str_replace(",", " ", $string);
                    $string = str_replace("{}", "none", $string); // this line only matters if the ingredient category is empty
                    return $string;
                break;
            }

        }
        
        // takes a 2d arr and formats it for database submission
        function EncodeJSON($arr)
        {
            $output = '{';
            for($i = 0; $i < count($arr); $i++)
            {
                if ($output == '{')
                {
                    $output += '['.$arr[$i][1].', '.$arr[$i][0].']';
                }
                else
                {
                    $output += ', ['.$arr[$i][1].', '.$arr[$i][0].']';
                }
            }
            $output += '}';
            return $output;
        }

        function DisplayClassTable($tabledata, $tableType)
        {
            if($tableType == "class") // if querying class order
            {
                echo '<table class="databaseDispTable"><tr><th>RowID</th><th>Teacher Code</th><th>Practical Day</th><th>Class</th><th>Room</th><th>Recipe</th><th>Students</th><th>Block</th><th>Baking Ingredients</th><th>Bread, Pasta, Rice</th><th>Chilled Food (Bacon, Salami, etc)</th><th>Dairy & Eggs</th><th>Dried Herbs & Spices</th><th>Fresh Fruit & Herbs</th><th>Frozen Food</th><th>Other</th><th>Raw Meat, Chicken, Fish</th><th>Sauces, Condiments</th><th>Tinned Food</th><th>Vegetables</th><th>Technician Requests/equipment</th><tr>';
                while ($row = $tabledata->fetch_assoc()) 
                {   
                    echo '<tr><td id="RowID">'.$row['RowID'].
                    '</td><td id="TeacherCode">'.$row['TeacherCode'].
                    "</td><td>".$row['PracticalDay'].
                    "</td><td>".$row['Class'].
                    "</td><td>".$row['RoomNum'].
                    "</td><td>".$row['Recipe'].
                    "</td><td>".$row['NumOfStudents'].
                    "</td><td>".$row['Block'].
                    "</td><td>".DecodeJson($row['Baking'], 2).
                    "</td><td>".DecodeJson($row['Bread'], 2).
                    "</td><td>".DecodeJson($row['Chilled'], 2).
                    "</td><td>".DecodeJson($row['Dairy'], 2).
                    "</td><td>".DecodeJson($row['Dried'], 2).
                    "</td><td>".DecodeJson($row['Fresh'], 2).
                    "</td><td>".DecodeJson($row['Frozen'], 2).
                    "</td><td>".DecodeJson($row['Other'], 2).
                    "</td><td>".DecodeJson($row['Raw'], 2).
                    "</td><td>".DecodeJson($row['Sauces'], 2).
                    "</td><td>".DecodeJson($row['Tinned'], 2).
                    "</td><td>".DecodeJson($row['Vegetables'], 2).
                    "</td><td>".$row['TechnicianReq']."</td></tr>";
                }
                echo "</table";
            }
            else if ($tableType == "department") // if querying department order
            {
                echo '<table class="databaseDispTable"><tr><th>RowID</th><th>Recipe</th><th>Baking Ingredients</th><th>Bread, Pasta, Rice</th><th>Chilled Food (Bacon, Salami, etc)</th><th>Dairy & Eggs</th><th>Dried Herbs & Spices</th><th>Fresh Fruit & Herbs</th><th>Frozen Food</th><th>Other</th><th>Raw Meat, Chicken, Fish</th><th>Sauces, Condiments</th><th>Tinned Food</th><th>Vegetables</th><th>Date Created</th><th>Technician Requests/equipment</th><tr>';
                while ($row = $tabledata->fetch_assoc()) 
                {   
                    echo '<tr><td id="RowID">'.$row['RowID'].
                    "</td><td>".$row['Recipes'].
                    "</td><td>".DecodeJson($row['Baking'], 2).
                    "</td><td>".DecodeJson($row['Bread'], 2).
                    "</td><td>".DecodeJson($row['Chilled'], 2).
                    "</td><td>".DecodeJson($row['Dairy'], 2).
                    "</td><td>".DecodeJson($row['Dried'], 2).
                    "</td><td>".DecodeJson($row['Fresh'], 2).
                    "</td><td>".DecodeJson($row['Frozen'], 2).
                    "</td><td>".DecodeJson($row['Other'], 2).
                    "</td><td>".DecodeJson($row['Raw'], 2).
                    "</td><td>".DecodeJson($row['Sauces'], 2).
                    "</td><td>".DecodeJson($row['Tinned'], 2).
                    "</td><td>".DecodeJson($row['Vegetables'], 2).
                    "</td><td>".$row['TechnicianReq'].
                    "</td><td>".$row['DateCreated']."</td></tr>";
                }
                echo "</table";
            }
        }

        function DataToInputField($tabledata, $names, $titleNames)
        {
            echo "<form>";
            while ($row = $tabledata->fetch_assoc()) 
            {
                echo '<table class="databaseDispTable">';
                echo '<input type="text" id="teacher" value="'.$row["TeacherCode"].'">';
                echo '<input type="text" id="date" value="'.$row["PracticalDay"].'">';
                echo '<input type="text" id="class" value="'.$row["Class"].'">';
                echo '<input type="text" id="room" value="'.$row["RoomNum"].'">';
                echo '<input type="text" id="recipe" value="'.$row["Recipe"].'">';
                echo '<input type="text" id="students" value="'.$row["NumOfStudents"].'">';
                echo '<input type="text" id="block" value="'.$row["Block"].'">';
                echo '<input type="text" id="techReq" value="'.$row["TechnicianReq"].'">';

                for ($k = 0; $k < count($names); $k++)
                {
                    
                    $output = DecodeJSON($row[$names[$k]], 1);
                    //echo var_dump($output);
                    echo '<tr><th><h2>'.$titleNames[$k].'</h2></th></tr><tr>';
                    for ($i = 0; $i < count($output); $i++)
                    {
                        echo '<td>';
                        echo '<h3>Ingredient #'.($i+1).'</h3>';
                        echo 'Name: <input type="text" id="k'.$k.'n'.$i.'" value="'.$output[$i][1].'">'; // id="k3n4" = dairy ingredient number[4] name
                        echo '<br>';
                        echo 'Quantity: <input type="text" id="k'.$k.'q'.$i.'" value="'.$output[$i][0].'">';
                        echo '<td>';
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
            echo "</form>";


        }
    ?>
    <head>
        <link rel="stylesheet" href="../stylesheet.css">
        <link rel="icon" href="../faviconFTD.png">
        <meta charset="UTF-8">
        <!--<meta name="description" content="To be done.. later">
        <meta name="keywords" content="Food order dashboard">-->
        <meta name="author" content="Zaya Cole">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Foodtech Order Dashboard</title>
        
        <!-- jquery init -->
        <script src="../Plugins/jquery-3.7.1.min.js"></script>
        <script>
            // input validation
            function CleanInput(input)
            {
                input = input.replaceAll(",", "");
                input = input.replaceAll("\"", "");
                input = input.replaceAll("'", "");
                input = input.replaceAll("[", "");
                input = input.replaceAll("]", "");
                input = input.replaceAll("{", "");
                input = input.replaceAll("}", "");
                return input;
            }

            function JSEncodeJSON(data, length)
            {
                output = '{';
                for(i = 0; i < length; i++)
                {
                    if (output == '{')
                    {
                        output += '['+data[i][1]+', '+data[i][0]+']';
                    }
                    else
                    {
                        output += ', ['+data[i][1]+', '+data[i][0]+']';
                    }
                }
                output += '}';
                return output;
            }

            function Redirect()
            {
                window.location.replace("https://php.papamoacollege.school.nz/3DIG/zaya.cole/index.php");
            }
        </script>
    </head>
</html>