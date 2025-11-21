<html>
    <?php 
        include("../PHP_Components/headNav.php");

        // defining functions & vars
/*
        $inconsistantNum = 0;
        
        function CompareCombine($string, $string1, $j, $k)
        {
            strtolower($string);
            strtolower($string1);

            // input: 42l, 1 liter
            // isolate: l, liter
            // comparing: false -> then???

            //isolate units
            $stringLetters = preg_replace('/[^A-z]/', "", $string);
            $string1Letters = preg_replace('/[^A-z]/', "", $string1);

            //comparing units (case irrespective)
            if (strcasecmp($stringLetters, $string1Letters) == 0)
            {
                //strings identical; isolate numbers and sum
                $stringVal = preg_replace('/[^0-9.]/', "", $string);
                $string1Val = preg_replace('/[^0-9.]/', "", $string1);

                //echo '<script type="text/javascript">document.write("<input type=\"text\" value=\"'.(((int) $stringVal) + ((int) $string1Val)).$stringLetters.'\">");</script>';

                //return sum with units
                return (((int) $stringVal) + ((int) $string1Val)).$stringLetters;

            }
            else
            {
                //inconsistant units; throw error
                //echo "Error: inconsistant measurement units for identical ingredients.";
                echo '<script type="text/javascript">
                var answer = prompt("Error: the units for '.$string.' and '.$string1.' are not identical despite being used for the same ingredient. Please resolve this by inputting the sum of these two ingredient quantities");
                document.write(\'<input type="text" class="invis" id="'.$j.'-'.$k.'-0" value="\'+answer+\'">\');</script>';
                return false;
                
            }
        }*/

        $ingredientData = array();


        $ClassRowIDs = preg_replace('/[^0-9,]/', "", $_POST["rowSelect"]);
       // echo $ClassRowIDs;
        $ClassRowIDs = explode(",", $ClassRowIDs);
        sort($ClassRowIDs);
        //echo var_dump($ClassRowIDs);

        $validQuery = true;
        for ($i = 0; $i < count($ClassRowIDs); $i++)
        {
            $sql = 'SELECT RowID FROM zayacole_class_order WHERE RowID = '.$ClassRowIDs[$i];
            $result = $dbconnect->query($sql);

            if ($result->num_rows == 0)
            {
                $validQuery = false;
            }
        }

        if ($validQuery == false)
        {
            //Redirect("https://php.papamoacollege.school.nz/3DIG/zaya.cole/webpages/selectClassOrders.php");
            //echo '<script>window.location.replace("https://php.papamoacollege.school.nz/3DIG/zaya.cole/webpages/selectClassOrders.php?error=true");</script>';
            //echo '<script>window.location.replace("https://php.papamoacollege.school.nz/3DIG/zaya.cole/webpages/selectClassOrders.php");</script>';
            echo '<script>history.back();</script>';
            exit;
        }

        $classData = array_fill(0, 9, "");
        $classData[0] = implode("; ", $ClassRowIDs);

        $otherDataNames = array("RowID", "TeacherCode", "PracticalDay", "Class", "RoomNum", "Recipe", "NumOfStudents", "Block", "TechnicianReq");
        $Catagories = array("Baking", "Bread", "Chilled", "Dairy", "Dried", "Fresh", "Frozen", "Other", "Raw", "Sauces", "Tinned", "Vegetables");
        $id = 0;
        
        // SCRIPT EXEC STARTS HERE ----------------------------------------------------------------------------------


        foreach ($ClassRowIDs as $ClassRow) // exec per class order
        {
            $sql = "SELECT * FROM zayacole_class_order WHERE RowID = $ClassRow";
            $result = $dbconnect->query($sql);

            while ($row = $result->fetch_assoc()) 
            {
                for ($i = 1; $i < count($otherDataNames); $i++) // exec per other row
                {
                    $classData[$i] = $classData[$i].$row[$otherDataNames[$i]].'; ';
                }

                for ($cata = 0; $cata < 12; $cata++) // exec per food type
                {
                    $ingredientData[$id][$cata] = DecodeJSON($row[$Catagories[$cata]], 1);
                }
            } 
            $id++;
        }

        //echo var_dump($classData);
        echo '<div id="otherDataDiv">';
        for ($i = 0; $i < count($otherDataNames); $i++)
        {
            echo '<input type="text" class="invis" value="'.$classData[$i].'">';
        }
        echo '</div>';


        $consolidatedArr = array();

        for ($i = 0; $i < count($ingredientData); $i++)
        {
            for ($j = 0; $j < count($ingredientData[$i]); $j++)
            {
                for ($k = 0; $k < count($ingredientData[$i][$j]); $k++)
                {
                    $consolidatedArr[$j][][0] = $ingredientData[$i][$j][$k][0];
                    $consolidatedArr[$j][count($consolidatedArr[$j])-1][1] = $ingredientData[$i][$j][$k][1];
                    $consolidatedArr[$j][count($consolidatedArr[$j])-1][2] = $j;
                }
            }
        }

        for ($i = 0; $i < count($consolidatedArr); $i++) // for each category
        {
            for ($j = 0; $j < count($consolidatedArr[$i]); $j++) // for each ingredient
            {
                if (strlen($consolidatedArr[$i][$j][1]) > 0)
                {
                    for ($k = 0; $k < count($consolidatedArr); $k++) // for each category (again)
                    {
                        for ($l = 0; $l < count($consolidatedArr[$k]); $l++) // for each ingredient (again)
                        {
                            if(!($i == $k && $j == $l))
                            {
                                if (strcasecmp($consolidatedArr[$i][$j][1], $consolidatedArr[$k][$l][1]) == 0 && strlen($consolidatedArr[$i][$j][1]) > 0)
                                {
                                    //$inconsistantArr[$k][][0] = $consolidatedArr[$k][$l][0];
                                    //$inconsistantArr[$k][count($inconsistantArr[$k])-1][1] = $consolidatedArr[$k][$l][1];
                                    $consolidatedArr[$k][$l][2] = $k;
                                    //array_splice($consolidatedArr[$k], $l, 1);
                                }
                            }
                        }
                    }
                }
            }
        }



        echo '<div id="contentDiv">';
        for($i = 0; $i < 12; $i++) //$i < count($formattedArr)
        {
            for ($j = 0; $j < count($consolidatedArr[$i]); $j++)
            {
                if ($consolidatedArr[$i][$j][1] != "")
                {
                    echo '<input type="text" class="invis" value="'.$consolidatedArr[$i][$j][1].'"><input type="text" class="invis" value="'.$consolidatedArr[$i][$j][0].'"><input type="text" class="invis" value="'.$consolidatedArr[$i][$j][2].'">';
                }
                

            }
        }
        echo '</div>';


        /*


        // for each ingredient name, check if there are any duplicates across the whole thing

        $inconsistantArr = array();


        for ($i = 0; $i < count($consolidatedArr); $i++) // for each category
        {
            for ($j = 0; $j < count($consolidatedArr[$i]); $j++) // for each ingredient
            {
                //echo "<br>";
                //echo $consolidatedArr[$i][$j][1];
                //echo "<br>";
                if (strlen($consolidatedArr[$i][$j][1]) > 0)
                {
                    for ($k = 0; $k < count($consolidatedArr); $k++) // for each category (again)
                    {
                        for ($l = 0; $l < count($consolidatedArr[$k]); $l++) // for each ingredient (again)
                        {
                            if(!($i == $k && $j == $l))
                            {
                                //echo $consolidatedArr[$k][$l][1];
                                //echo "   ";
                                if (strcasecmp($consolidatedArr[$i][$j][1], $consolidatedArr[$k][$l][1]) == 0 && strlen($consolidatedArr[$i][$j][1]) > 0)
                                {
                                    $inconsistantArr[$k][][0] = $consolidatedArr[$k][$l][0];
                                    $inconsistantArr[$k][count($inconsistantArr[$k])-1][1] = $consolidatedArr[$k][$l][1];
                                    $inconsistantArr[$k][count($inconsistantArr[$k])-1][2] = $k;
                                    //$inconsistantArr[$k][count($inconsistantArr[$k])-1][2] = 'i'.$i.'j'.$j;
                                    array_splice($consolidatedArr[$k], $l, 1);
                                }
                            }
                        }
                    }
                }

            }
        }


        $formattedArr = array();

        for ($i = 0; $i < 12; $i++)
        {
            if(isset($inconsistantArr[$i]))
            {
                for ($j = 0; $j < count($inconsistantArr[$i]); $j++)
                {
                    if(isset($inconsistantArr[$i][$j][1]))
                    {
                        //echo '<input type="text" id="inconsistant i'.$i.'j'.$j.'n" value="'.$inconsistantArr[$i][$j][1].'"><input type="text" id="inconsistant i'.$i.'j'.$j.'q" value="'.$inconsistantArr[$i][$j][0].'"><input type="text" id="inconsistant i'.$i.'j'.$j.'key" value="'.$inconsistantArr[$i][$j][1].'"><br>';
                        $formattedArr[][][0] = $inconsistantArr[$i][$j][0];
                        $formattedArr[count($formattedArr)-1][count($formattedArr[count($formattedArr)-1])-1][1] = $inconsistantArr[$i][$j][1];
                        $formattedArr[count($formattedArr)-1][count($formattedArr[count($formattedArr)-1])-1][2] = $inconsistantArr[$i][$j][2];
                        //echo $inconsistantArr[$i][$j][1];
                        
                        //echo EncodeJSON($inconsistantArr[$i][$j]);

                    }
                    
                }
                echo ("<br>");
            }

        }



        


        echo '<div id="inconsistantDiv">';
        for($i = 0; $i < 12; $i++) //$i < count($formattedArr)
        {
            for ($j = 0; $j < count($formattedArr[$i]); $j++)
            {
                if ($formattedArr[$i][$j][1] != "")
                {
                    echo '<input type="text" class="invis" value="'.$formattedArr[$i][$j][1].'"><input type="text" class="invis" value="'.$formattedArr[$i][$j][0].'"><input type="text" class="invis" value="'.$formattedArr[$i][$j][2].'">';
                }
                

            }
        }
        echo '</div>';

        echo '<div class="wrapper">';

        echo '<div id="contentDiv">';
        for ($i = 0; $i < 12; $i++)
        {
            for ($j = 0; $j < count($consolidatedArr[$i]); $j++)
            {

                if ($consolidatedArr[$i][$j][1] != "")
                {
                    echo '<input type="text" class="invis" value="'.$consolidatedArr[$i][$j][1].'"><input class="invis" type="text" value="'.$consolidatedArr[$i][$j][0].'"><input type="text" class="invis" value="'.$i.'">';
                }
                     // }
                
            }
            echo ("<br>");
        }
        echo '</div>';
        echo '</div>';
/*
        for($i = 0; $i < count($formattedArr); $i++)
        {
            for ($j = 0; $j < count($formattedArr[$i]); $j++)
            {
                echo '<script>CompareCombine('.$i.', '.$j.');</script>';
            }
        }*/




/*for ($i = 0; $i < 12; $i++)
{
    for($k = 0; $k < count($consolidatedArr[$i]); $k++)
    {
        // rest in peace, atrocious code..
        echo 
        '<script type="text/javascript">
        if(document.getElementById("'.$i.'-'.$k.'-0") != null)
        {
            document.write(\'<input type="text" value="'.$consolidatedArr[$i][$k][1].'"><input type="text" value="\'+document.getElementById("'.$i.'-'.$k.'-0").value+\'">\');

        }
        else
        {
            document.write(\'<input type="text" id="'.$i.'-'.$k.'-1" value="'.$consolidatedArr[$i][$k][1].'"><input type="text" id="'.$i.'-'.$k.'-0" value="'.$consolidatedArr[$i][$k][0].'">\');
        } 
        </script>';
        echo ("<br>");
    }
}*/


/*
        foreach ($ClassRowIDs as $ClassRow) //exec per class order
        {
            //echo "<table>";
            $sql = "SELECT Baking, Bread, Chilled, Dairy, Dried, Fresh, Frozen, Other, Raw, Sauces, Tinned, Vegetables FROM zayacole_class_order WHERE rowID = $ClassRow";
            $result = $dbconnect->query($sql);

            while ($row = $result->fetch_assoc()) 
            {
                for ($cata = 0; $cata < 12; $cata++) //exec per food type
                {
                    //echo '<tr><td>'."$Catagories[$cata]<br>";
                    
                    
                    $ingredientData[$id][$cata] = DecodeJSON($row[$Catagories[$cata]], 1);
                    

                    for ($foodItem = 0; $foodItem < count($ingredientData[$id][$cata]); $foodItem++) //exec per food item
                    {
                        if (isset($ingredientData[$id][$cata][$foodItem][1]))
                        {
                            //echo '</td><td>'.$ingredientData[$id][$cata][$foodItem][0]." : ".$ingredientData[$id][$cata][$foodItem][1];
                        }
                    }

                    //echo "</td></tr>";


                    
                    
                        
                }
                //echo var_dump($ingredientData);   
                
            } 
            //echo "</table><br>";
            $id++;
        }
    
        //echo var_dump($ingredientData);

        // COMPARING INGREDIENT DATA AND COMBINING ---------------------------------------------------

        /*$consolidatedArr = array(); // output

        for ($i = 0; $i < count($ingredientData); $i++) // for each order
        {
            for ($j = 0; $j < count($ingredientData[$i]); $j++) // for each catagory
            {
                for ($k = 0; $k < count($ingredientData[$i][$j]); $k++) // for each food item
                {
                    if (!(isset($consolidatedArr[$j][$k][1]))) // if value empty (only really used on first pass)
                    {
                        $consolidatedArr[$j][$k][1] = $ingredientData[$i][$j][$k][1];
                        $consolidatedArr[$j][$k][0] = $ingredientData[$i][$j][$k][0];
                        

                    }
                    else
                    {
                        $newVal = true;
                        for ($l = 0; $l < count($ingredientData[$i]); $l++) // for each catagory
                        {
                            for ($m = 0; $m < count($ingredientData[$i][$l]); $m++) // for each food item
                            {
                                if (isset($ingredientData[$i][$l][$m][1]))
                                {
                                    //echo("<br>DOES EXIST: ".$ingredientData[$i][$l][$m][1]."<br>");
                                    if ($consolidatedArr[$j][$k][1] == $ingredientData[$i][$l][$m][1]) // if same ingredient exists somewhere
                                    {
                                        $newVal = false;
                                        //$consolidatedArr[$j][$k][0] = CompareCombine($consolidatedArr[$j][$k][0], $ingredientData[$i][$l][$m][0]);
                                        if (CompareCombine($consolidatedArr[$j][$k][0], $ingredientData[$i][$l][$m][0], $j, $k) != false)
                                        {
                                            $consolidatedArr[$j][$k][0] = CompareCombine($consolidatedArr[$j][$k][0], $ingredientData[$i][$l][$m][0], $j, $k);
                                            //echo '<script type="text/javascript">document.write("<input type=\"text\" value=\"'.$consolidatedArr[$j][$k][0].'\"><input type=\"text\" value=\"'.$consolidatedArr[$j][$k][1].'\">");</script>';
                                        }
                                    }
                                }
                            }
                        }
                        if ($newVal == true && $ingredientData[$i][$j][$k][1] != null)
                        {
                            $consolidatedArr[$j][][1] = $ingredientData[$i][$j][$k][1];
                            $consolidatedArr[$j][count($consolidatedArr[$j])-1][0] = $ingredientData[$i][$j][$k][0];
                        }
                    }
                    















                    /*else // check current order for duplicates [of this ingredient (?)]
                    {
                        
                        echo $consolidatedArr[$j][$k][1];
                        for ($l = 0; $l < count($ingredientData[$i]); $l++) // for each catagory
                        {
                            //echo "NEXT CATEGORY===================================<br>";
                                                           
                            for ($m = 0; $m < count($ingredientData[$i][$l]); $m++) // for each food item
                            {
                                
                                if (isset($ingredientData[$i][$l][$m][1]))
                                {
                                    echo("<br>DOES EXIST: ".$ingredientData[$i][$l][$m][1]."<br>");
                                    $newVal = true;
                                    if ($consolidatedArr[$j][$k][1] == $ingredientData[$i][$l][$m][1]) // if same ingredient exists somewhere
                                    {
                                        $newVal = false;
                                        //$consolidatedArr[$j][$k][0] = CompareCombine($consolidatedArr[$j][$k][0], $ingredientData[$i][$l][$m][0]);
                                        if (CompareCombine($consolidatedArr[$j][$k][0], $ingredientData[$i][$l][$m][0]) != false)
                                        {
                                            $consolidatedArr[$j][$k][0] = CompareCombine($consolidatedArr[$j][$k][0], $ingredientData[$i][$l][$m][0]);
                                        }
                                        else
                                        {
                                            echo "what";
                                        }
                                    }
                                    else
                                    {
                                        echo ("new val:".$ingredientData[$i][$l][$m][1]);
                                        $consolidatedArr[$j][][1] = $ingredientData[$i][$l][$m][1];
                                        $consolidatedArr[$j][][0] = $ingredientData[$i][$l][$m][0];
                                        $newVal = false;
                                    }
                                }
                                else // if category empty
                                {
                                    //$newVal = false;
                                    //echo("does not exist ".$i." ".$l." ".$m);
                                }



                            }
                        }

                    }
                    
                    

                }
            }
        }*/

        //echo "<br><br>";
        //echo var_dump($consolidatedArr);

        /*
        $sql = '
        INSERT INTO zayacole_department_order (Baking, Bread, Chilled, Dairy, Dried, Fresh, Frozen, Other, Raw, Sauces, Tinned, Vegetables, TechnicianReq, DateCreated)
        VALUES ('.EncodeJSON($consolidatedArr[0]).', '.EncodeJSON($consolidatedArr[1].', '.EncodeJSON($consolidatedArr[2].', '.EncodeJSON($consolidatedArr[3].', '.EncodeJSON($consolidatedArr[4].', '.EncodeJSON($consolidatedArr[5].', '.EncodeJSON($consolidatedArr[6].', '.EncodeJSON($consolidatedArr[7].', '.EncodeJSON($consolidatedArr[8].', '.EncodeJSON($consolidatedArr[9].', '.EncodeJSON($consolidatedArr[10].', '.EncodeJSON($consolidatedArr[11].', $requests, '.date("Y-m-d"));
*/


/*
                    document.write(\'<input type="text" id="temp" value="'.$consolidatedArr[$i][$k][1].'"><input type="text" value="\'+document.getElementById("'.$i.'-'.$k.'").value+\'">\');
                    document.getElementById("'.$i.'-'.$k.'").remove;
                    document.getElementById("temp").id = "'.$i.'-'.$k.'";
*/
        ?>

            
    <body onload="">
        <script>
            window.addEventListener("DOMContentLoaded", (event) => {
                CompareCombine();
            });

            $(document).ajaxComplete(function()
            {
                Redirect();
            });
        </script>
        <div class="wrapper" id="wrapper">

            
        </div>
    </body>
</html>