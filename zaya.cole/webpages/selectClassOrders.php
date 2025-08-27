<html>
    <?php
    include("../PHP_Components/headNav.php");
    ?>
    <body>

        <div class="wrapper">
            <div>
                <h1>Create Department Order</h1>
                <form action="creatingDepartmentOrder.php" method="POST">
                    
                    <label for="rowSelect">Rows to combine into department order:</label>
                    <input type="text" id="rowSelect" name="rowSelect">
                    <p>Type the RowID of each class order, seperating each by a comma and a space.<br>Example: this input would choose RowID 5, 6, 7, and 8 to be combined into a department order.<br>5, 6, 7, 8</p>
                </form>
            </div>
            <?php
                
                function DecodeJSON($string)
                {
                
                    $string = str_replace("{[", "", $string);
                    $string = str_replace("]}", "", $string);
                    //$string = str_replace("", "]", $string);
                    //$data = preg_split("/ ("
                    $data = explode("], [", $string);
                    for($i = 0; $i < count($data); $i++) 
                    {
                        $output[$i] = explode(", ", $data[$i]);
                    }
                    return $output;
                }

                


                $sql = "SELECT * FROM zayacole_class_order ORDER BY RowID DESC LIMIT 5";
                $result = $dbconnect->query($sql);
                
                echo '<table class="databaseDispTable"><tr><th>RowID</th><th>Teacher Code</th><th>Practical Day</th><th>Class</th><th>Room</th><th>Recipe</th><th>Students</th><th>Block</th><th>Baking Ingredients</th><th>Bread, Pasta, Rice</th><th>Chilled Food (Bacon, Salami, etc)</th><th>Dairy & Eggs</th><th>Dried Herbs & Spices</th><th>Fresh Fruit & Herbs</th><th>Frozen Food</th><th>Other</th><th>Raw Meat, Chicken, Fish</th><th>Sauces, Condiments</th><th>Tinned Food</th><th>Vegetables</th><th>Technician Requests/equipment</th><tr>';
                while ($row = $result->fetch_assoc()) 
                {
                    /*$freshArr = DecodeJSON($row['Fresh']);
                    echo $freshArr[0][0];
                        echo "<br>";
                    echo $freshArr[0][1];
                    echo "<br>";
                    echo $freshArr[1][0];
                    echo "<br>";
                    echo $freshArr[1][1];
                    echo "<br>";
                    /*for ($i = 0; $i < count($freshArr[0]); $i++)
                    {
                        echo $freshArr[0][$i];
                        echo "<br>";
                    }*/
                    
                    
                    
                    echo '<tr><td id="RowID">'.$row['RowID'].'</td><td id="TeacherCode">'.$row['TeacherCode']."</td><td>".$row['PracticalDay']."</td><td>".$row['Class']."</td><td>".$row['RoomNum']."</td><td>".$row['Recipe']."</td><td>".$row['NumOfStudents']."</td><td>".$row['Block'].'</td><td id="Baking">'.$row['Baking']."</td><td>".$row['Bread']."</td><td>".$row['Chilled']."</td><td>".$row['Dairy']."</td><td>".$row['Dried'].
                "</td><td>".$row['Fresh'].
                "</td><td>".$row['Frozen']."</td><td>".$row['Other']."</td><td>".$row['Raw']."</td><td>".$row['Sauces']."</td><td>".$row['Tinned']."</td><td>".$row['Vegetables']."</td><td>".$row['TechnicianReq']."</td></tr>"/*The recipe for today: " . $row['Recipe']. " with a side of " .$row['Tinned']*/;
                }
                
                echo "</table";
                
            ?>

        </div>
    </body>
</html>
