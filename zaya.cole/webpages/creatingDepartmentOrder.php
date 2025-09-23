<html>
    <?php 
        include("../PHP_Components/headNav.php");

        // defining functions & vars

       /* function RemoveDoublequotes($value, $key)
        {
            $value = str_replace('"', "", $value);
        }*/
        
        function CompareCombine($string, $string1)
        {
            strtolower($string);
            strtolower($string1);

            //isolate units
            $stringLetters = preg_replace('/[^A-z]/', "", $string);
            $string1Letters = preg_replace('/[^A-z]/', "", $string1);

            //comparing units (case irrespective)
            if (strcasecmp($stringLetters, $string1Letters) == 0)
            {
                //strings identical; isolate numbers and sum
                $stringVal = preg_replace('/[^0-9.]/', "", $string);
                $string1Val = preg_replace('/[^0-9.]/', "", $string1);

                //return sum with units
                return (((int) $stringVal) + ((int) $string1Val)).$stringLetters;

            }
            else
            {
                //inconsistant units; throw error
                //echo "Error: inconsistant measurement units for identical ingredients.";
                $inconsistantArr[] = '"$string" and "$string1"';
                return false;
                //echo "<script type='text/javascript'>promt('$message');</script>";
            }
        }

        $ingredientData = array();
        $ClassRowIDs = explode(", ", $_POST["rowSelect"]);
        $Catagories = array("Baking", "Bread", "Chilled", "Dairy", "Dried", "Fresh", "Frozen", "Other", "Raw", "Sauces", "Tinned", "Vegetables");
        $id = 0;
        
        // SCRIPT EXEC STARTS HERE ----------------------------------------------------------------------------------

        foreach ($ClassRowIDs as $ClassRow) //exec per class order
        {
            echo "<table>";
            $sql = "SELECT Baking, Bread, Chilled, Dairy, Dried, Fresh, Frozen, Other, Raw, Sauces, Tinned, Vegetables FROM zayacole_class_order WHERE rowID = $ClassRow";
            $result = $dbconnect->query($sql);

            while ($row = $result->fetch_assoc()) 
            {
                
                for ($cata = 0; $cata < 12; $cata++) //exec per food type
                {
                    //echo ($row[$cata]);
                    echo '<tr><td>'."$Catagories[$cata]<br>";
                    
                    
                    $ingredientData[$id][$cata] = DecodeJSON($row[$Catagories[$cata]], 1);
                    

                    for ($foodItem = 0; $foodItem < count($ingredientData[$id][$cata]); $foodItem++) //exec per food item
                    {
                        if (isset($ingredientData[$id][$cata][$foodItem][1]))
                        {
                            echo '</td><td>'.$ingredientData[$id][$cata][$foodItem][0]." : ".$ingredientData[$id][$cata][$foodItem][1];
                        }
                        


                        //echo $foodItem;
                            //echo "<br>";
                        //$ingredientNames[] = ingredientData[$foodItem];
                        //echo var_dump($ingredientNames);
                        //echo "<br>";
                        
                    }

                    echo "</td></tr>";


                    
                    
                        
                }
                //echo var_dump($ingredientData);   
                
            } 
            echo "</table><br>";
            $id++;
        }
    
        echo var_dump($ingredientData);

        // COMPARING INGREDIENT DATA AND COMBINING ---------------------------------------------------

        $consolidatedArr = array(); // output

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
                                        if (CompareCombine($consolidatedArr[$j][$k][0], $ingredientData[$i][$l][$m][0]) != false)
                                        {
                                            $consolidatedArr[$j][$k][0] = CompareCombine($consolidatedArr[$j][$k][0], $ingredientData[$i][$l][$m][0]);
                                        }
                                    }
                                }
                            }
                        }
                        if ($newVal == true && $ingredientData[$i][$j][$k][1] != null)
                        {
                            $consolidatedArr[$j][][0] = $ingredientData[$i][$j][$k][1];
                            $consolidatedArr[$j][count($consolidatedArr[$j])-1][1] = $ingredientData[$i][$j][$k][0];
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

                    }*/
                    
                    

                }
            }
        }

        echo "<br><br>";
        //echo var_dump($consolidatedArr);
        for ($i = 0; $i < 12; $i++)
        {
            for($k = 0; $k < count($consolidatedArr[$i]); $k++)
            {
                echo var_dump($consolidatedArr[$i][$k]);
                echo ("<br>");
            }
            echo ("<br>");

        }
        /*
        $sql = '
        INSERT INTO zayacole_department_order (Baking, Bread, Chilled, Dairy, Dried, Fresh, Frozen, Other, Raw, Sauces, Tinned, Vegetables, TechnicianReq, DateCreated)
        VALUES ('.EncodeJSON($consolidatedArr[0]).', '.EncodeJSON($consolidatedArr[1].', '.EncodeJSON($consolidatedArr[2].', '.EncodeJSON($consolidatedArr[3].', '.EncodeJSON($consolidatedArr[4].', '.EncodeJSON($consolidatedArr[5].', '.EncodeJSON($consolidatedArr[6].', '.EncodeJSON($consolidatedArr[7].', '.EncodeJSON($consolidatedArr[8].', '.EncodeJSON($consolidatedArr[9].', '.EncodeJSON($consolidatedArr[10].', '.EncodeJSON($consolidatedArr[11].', $requests, '.date("Y-m-d"));
*/

        ?>
            
    <body>
        <div class="wrapper">
        </div>
    </body>
</html>