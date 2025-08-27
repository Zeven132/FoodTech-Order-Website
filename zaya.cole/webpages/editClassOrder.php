<html>
    <?php include("../PHP_Components/headNav.php");?>

    <body>
        <div class="wrapper">
            <div>
                
        <?php
            $sql = "SELECT * FROM zayacole_class_order WHERE RowID = ".$_POST["rowSelected"];
            $result = $dbconnect->query($sql);

            //creates a 2d array
            function DecodeJSON($string)
            {
            
                $string = str_replace("{[", "", $string);
                $string = str_replace("]}", "", $string);
                $data = explode("], [", $string);
                for($i = 0; $i < count($data); $i++) 
                {
                    $output[$i] = explode(", ", $data[$i]);
                }

                
                return $output;
            }
            echo '<h1>Editing Class Order #'.$_POST["rowSelected"].'</h1>';
            echo "<form>";
            while ($row = $result->fetch_assoc()) 
            {
                $bakingArr = DecodeJSON($row['Baking']);
                for ($i = 0; $i < count($bakingArr); $i++)
                {
                    echo '<h3>Ingredient #'.($i+1).'</h3>';
                    echo 'Name: <input type="text" value='.$bakingArr[$i][1].'>';
                    echo '<br>';
                    echo 'Quantity: <input type="text" value='.$bakingArr[$i][0].'>';
                    echo '<br><br>';
                }

                $breadArr = DecodeJSON($row['Bread']);
                for ($i = 0; $i < count($breadArr); $i++)
                {
                    echo '<h3>Ingredient #'.($i+1).'</h3>';
                    echo 'Name: <input type="text" value='.$breadArr[$i][1].'>';
                    echo '<br>';
                    echo 'Quantity: <input type="text" value='.$breadArr[$i][0].'>';
                    echo '<br><br>';
                }

                $chilledArr = DecodeJSON($row['Chilled']);
                for ($i = 0; $i < count($chilledArr); $i++)
                {
                    echo '<h3>Ingredient #'.($i+1).'</h3>';
                    echo 'Name: <input type="text" value='.$chilledArr[$i][1].'>';
                    echo '<br>';
                    echo 'Quantity: <input type="text" value='.$chilledArr[$i][0].'>';
                    echo '<br><br>';
                }

                $dairyArr = DecodeJSON($row['Dairy']);
                for ($i = 0; $i < count($dairyArr); $i++)
                {
                    echo '<h3>Ingredient #'.($i+1).'</h3>';
                    echo 'Name: <input type="text" value='.$dairyArr[$i][1].'>';
                    echo '<br>';
                    echo 'Quantity: <input type="text" value='.$dairyArr[$i][0].'>';
                    echo '<br><br>';
                }

                $driedArr = DecodeJSON($row['Dried']);
                for ($i = 0; $i < count($driedArr); $i++)
                {
                    echo '<h3>Ingredient #'.($i+1).'</h3>';
                    echo 'Name: <input type="text" value='.$driedArr[$i][1].'>';
                    echo '<br>';
                    echo 'Quantity: <input type="text" value='.$driedArr[$i][0].'>';
                    echo '<br><br>';
                }

                $freshArr = DecodeJSON($row['Fresh']);
                for ($i = 0; $i < count($freshArr); $i++)
                {
                    echo '<h3>Ingredient #'.($i+1).'</h3>';
                    echo 'Name: <input type="text" value='.$freshArr[$i][1].'>';
                    echo '<br>';
                    echo 'Quantity: <input type="text" value='.$freshArr[$i][0].'>';
                    echo '<br><br>';
                }

                $frozenArr = DecodeJSON($row['Frozen']);
                for ($i = 0; $i < count($frozenArr); $i++)
                {
                    echo '<h3>Ingredient #'.($i+1).'</h3>';
                    echo 'Name: <input type="text" value='.$frozenArr[$i][1].'>';
                    echo '<br>';
                    echo 'Quantity: <input type="text" value='.$frozenArr[$i][0].'>';
                    echo '<br><br>';
                }

                $otherArr = DecodeJSON($row['Other']);
                for ($i = 0; $i < count($otherArr); $i++)
                {
                    echo '<h3>Ingredient #'.($i+1).'</h3>';
                    echo 'Name: <input type="text" value='.$otherArr[$i][1].'>';
                    echo '<br>';
                    echo 'Quantity: <input type="text" value='.$otherArr[$i][0].'>';
                    echo '<br><br>';
                }

                $rawArr = DecodeJSON($row['Raw']);
                for ($i = 0; $i < count($rawArr); $i++)
                {
                    echo '<h3>Ingredient #'.($i+1).'</h3>';
                    echo 'Name: <input type="text" value='.$rawArr[$i][1].'>';
                    echo '<br>';
                    echo 'Quantity: <input type="text" value='.$rawArr[$i][0].'>';
                    echo '<br><br>';
                }
            }
            echo '</form>';

        ?>
        
                <form action="editClassOrder.php" method="POST">
                    <label for="rowSelect">Input RowID of Existing Order:</label>
                    <input type="text" id="rowSelect" name="rowSelected">
                    <input type="submit">
                </form>
            </div>
        </div>
    </body>
</html>
