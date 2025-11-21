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

        // if logged out then redirect to login page
        if(!isset($_SESSION['account_loggedin']))
        {
            header('Location: loggedOutRedirect.php');
            exit;
        }

        function Redirect($targetURL)
        {
            header(`Location: $targetURL`);
            exit;
        }

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
                    "</td><td>".DecodeJSON($row['Baking'], 2).
                    "</td><td>".DecodeJSON($row['Bread'], 2).
                    "</td><td>".DecodeJSON($row['Chilled'], 2).
                    "</td><td>".DecodeJSON($row['Dairy'], 2).
                    "</td><td>".DecodeJSON($row['Dried'], 2).
                    "</td><td>".DecodeJSON($row['Fresh'], 2).
                    "</td><td>".DecodeJSON($row['Frozen'], 2).
                    "</td><td>".DecodeJSON($row['Other'], 2).
                    "</td><td>".DecodeJSON($row['Raw'], 2).
                    "</td><td>".DecodeJSON($row['Sauces'], 2).
                    "</td><td>".DecodeJSON($row['Tinned'], 2).
                    "</td><td>".DecodeJSON($row['Vegetables'], 2).
                    "</td><td>".$row['TechnicianReq']."</td></tr>";
                }
                echo "</table";
            }
            else if ($tableType == "department") // if querying department order
            {
                echo '<table class="databaseDispTable"><tr><th>RowID</th><th>Recipe</th><th>Baking Ingredients</th><th>Bread, Pasta, Rice</th><th>Chilled Food (Bacon, Salami, etc)</th><th>Dairy & Eggs</th><th>Dried Herbs & Spices</th><th>Fresh Fruit & Herbs</th><th>Frozen Food</th><th>Other</th><th>Raw Meat, Chicken, Fish</th><th>Sauces, Condiments</th><th>Tinned Food</th><th>Vegetables</th><th>Technician Requests/equipment</th><th>Date Created</th><tr>';
                while ($row = $tabledata->fetch_assoc()) 
                {   
                    echo '<tr><td id="RowID">'.$row['RowID'].
                    "</td><td>".$row['Recipes'].
                    "</td><td>".DecodeJSON($row['Baking'], 2).
                    "</td><td>".DecodeJSON($row['Bread'], 2).
                    "</td><td>".DecodeJSON($row['Chilled'], 2).
                    "</td><td>".DecodeJSON($row['Dairy'], 2).
                    "</td><td>".DecodeJSON($row['Dried'], 2).
                    "</td><td>".DecodeJSON($row['Fresh'], 2).
                    "</td><td>".DecodeJSON($row['Frozen'], 2).
                    "</td><td>".DecodeJSON($row['Other'], 2).
                    "</td><td>".DecodeJSON($row['Raw'], 2).
                    "</td><td>".DecodeJSON($row['Sauces'], 2).
                    "</td><td>".DecodeJSON($row['Tinned'], 2).
                    "</td><td>".DecodeJSON($row['Vegetables'], 2).
                    "</td><td>".$row['TechnicianReq'].
                    "</td><td>".$row['DateCreated']."</td></tr>";
                }
                echo "</table";
            }
        }

        function DataToInputField($tabledata, $names, $titleNames, $orderType)
        {   
            switch($orderType)
            {
                case "class":
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

                        for ($k = 0; $k < count($names); $k++) // for each food type
                        {
                            $output = DecodeJSON($row[$names[$k]], 1);
                            echo '<tr><th><h2>'.$titleNames[$k].'</h2></th></tr><tr id="InputRow'.$k.'">';
                            
                            for ($i = 0; $i < count($output); $i++)
                            {
                                /*try 
                                {
                                    if(strlen($output[$i][1]) > 0)
                                    {*/
                                        echo '<td>';
                                        echo '<h3>Ingredient #'.($i+1).'</h3>';
                                        echo 'Name: <input type="text" id="k'.$k.'n'.$i.'" value="'.$output[$i][1].'">'; // id="k3n4" = dairy ingredient number[4] name
                                        echo '<br>';
                                        echo 'Quantity: <input type="text" id="k'.$k.'q'.$i.'" value="'.$output[$i][0].'">';
                                        echo '</td>';
                                    /*}
                                }
                                catch
                                {
                                    
                                }*/

                            }
                            echo '<td id="createNew'.$k.'#'.$i.'"><button  type="button" onclick="AddIngredient('.$k.', '.count($output).')">Add Another Ingredient</button></td>';
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                    echo "</form>";
                    break;

                case "department":
                    echo "<form>";
                    while ($row = $tabledata->fetch_assoc()) 
                    {
                        echo '<table class="databaseDispTable">';
                        echo '<h2>Department Order Information</h2>';
                        echo '<label>Class Order RowIDs:</label><input type="text" id="classIDs" value="'.$row["ClassRowIDs"].'"><br>';
                        echo '<label>Recipies:	</label><input type="text" id="recipes" value="'.$row["Recipes"].'"><br>';
                        echo '<label>Date & Time Created:	</label><input type="text" id="dateCreated" value="'.$row["DateCreated"].'"><br>';
                        echo '<label>Technician/Equipment Requests:	</label><input type="text" id="techReq" value="'.$row["TechnicianReq"].'"><br>';
                        echo '<h2>Ingredient Information</h2>';

                        for ($k = 0; $k < count($names); $k++) // for each food type
                        {
                            $output = DecodeJSON($row[$names[$k]], 1);
                            echo '<tr><th><h2>'.$titleNames[$k].'</h2></th></tr><tr id="InputRow'.$k.'">';
                            
                            for ($i = 0; $i < count($output); $i++)
                            {
                                echo '<td>';
                                echo '<h3>Ingredient #'.($i+1).'</h3>';
                                echo 'Name: <input type="text" id="k'.$k.'n'.$i.'" value="'.$output[$i][1].'">'; // id="k3n4" = dairy ingredient number[4] name
                                echo '<br>';
                                echo 'Quantity: <input type="text" id="k'.$k.'q'.$i.'" value="'.$output[$i][0].'">';
                                echo '</td>';
                            }
                            echo '<td id="createNew'.$k.'#'.$i.'"><button  type="button" onclick="AddIngredient('.$k.', '.count($output).')">Add Another Ingredient</button></td>';
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                    echo "</form>";
                    break;         
            }
            
        }

        
        /*
        function CreateInputFieldsWithError($i, $k, $data)
        {
            echo 
            '<script type="text/javascript">
            if(document.getElementById("'.$i.'-'.$k.'") != null)
            {
                document.write(\'<input type="text" value="'.$data[$i][$k][1].'"><input type="text" value="\'+document.getElementById("'.$i.'-'.$k.'").value+\'">\');
            }
            else
            {
                document.write("<input type=\"text\" value=\"'.$data[$i][$k][1].'\"><input type=\"text\" value=\"'.$data[$i][$k][0].'\">");
            } 
            </script>';
        }*/
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

        <!-- defining cross-site JS functions -->
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

            function AddIngredient(foodType, i)
            {
                document.getElementById("createNew"+foodType+"#"+i).innerHTML = '<td><h3>Ingredient #'+(i+1)+'</h3> Name: <input type="text" id="k'+foodType+'n'+i+'" value=""><br>Quantity: <input type="text" id="k'+foodType+'q'+i+'" value=""></td>';
                document.getElementById("InputRow"+foodType).innerHTML += '<td id="createNew'+foodType+'#'+(i+1)+'"><button  type="button" onclick="AddIngredient('+foodType+', '+(i+1)+')">Add Another Ingredient</button></td>';
            }

            var allIngredients2D = Array();
            var otherData = Array ();

            function CompareCombine()
            {
                //var inconsistant = new Array();
                var content = new Array();
                
                // get data from DOM elements

                let otherDataDiv = document.getElementById("otherDataDiv");
                //let inconsistantDiv = document.getElementById("inconsistantDiv");
                let contentDiv = document.getElementById("contentDiv");
            
                for (const child of otherDataDiv.children) 
                {
                    if (child.value != undefined && child.value != "")
                    {
                        otherData.push(child.value);
                    }
                }

                /*for (const child of inconsistantDiv.children) 
                {
                    if (child.value != undefined && child.value != "")
                    {
                        inconsistant.push(child.value);
                    }
                }*/

                for (let child of contentDiv.children) 
                {
                    if (child.value != undefined && child.value != "")
                    {
                        content.push(child.value);
                    }
                }

                var content2D = new Array();
                //var inconsistant2D = new Array();

                // format data into 2D arr. [0] is quantity, [1] is name, [2] is the category index for sorting later
                for (let i = 0; i < content.length; i++)
                {
                    content2D[i] = new Array(3);
                    content2D[i][0] = content[i+1];
                    content2D[i][1] = content[i];
                    content2D[i][2] = content[i+2];
                    i += 2;
                }

                /*for (let i = 0; i < inconsistant.length; i++)
                {
                    inconsistant2D[i] = new Array(3);
                    inconsistant2D[i][0] = inconsistant[i+1];
                    inconsistant2D[i][1] = inconsistant[i];
                    inconsistant2D[i][2] = inconsistant[i+2];
                    i += 2;
                }*/

                allIngredients2D = content2D;//inconsistant2D.concat(content2D);
                allIngredients2D = allIngredients2D.filter(item => 1 == 1); // filter ignores empty and undefined elements
                //console.log(allIngredients2D[1]);


                for (let i = 0; i < allIngredients2D.length; i++) // for each ingredient
                {
                    let matches = new Array(2);
                    matches[0] = new Array().fill("");
                    matches[1] = new Array().fill("");
                    matches[0][0] = allIngredients2D[i][0];
                    matches[1][0] = i;

                    for (let j = 0; j < allIngredients2D.length; j++) // for each ingredient
                    {
                        if (i != j && allIngredients2D[i][1].toLowerCase() == allIngredients2D[j][1].toLowerCase()) // if ingredient j has the same name as ingredient i then add it to matches
                        {
                            matches[0].push(allIngredients2D[j][0]);
                            matches[1].push(j);
                            console.log(allIngredients2D[j][0]);
                            console.log(allIngredients2D[j][1]);
                        }
                    }

                    // matches is now a list of all identically named ingredient's quantities (+original)

                    if (matches[0].length > 1) // if any matches found
                    {
                        let matchesLetters = Array();
                        //matchesLetters = matches[0].forEach(item => item = item.replace(/[^A-z]/g, ""));

                        for (let k = 0; k < matches[0].length; k++)
                        {
                            matchesLetters[k] = matches[0][k].replace(/[^A-z]/g, "");
                        }

                        if (matchesLetters.every(item => item == matchesLetters[0])) // if every match uses the same units
                        {
                            let matchesNumbers = Array();

                            for (let k = 0; k < matches[0].length; k++)
                            {
                                matchesNumbers[k] = matches[0][k].replace(/[^0-9.]/g, "");
                            }
                            //atchesNumbers = matches[0].forEach(item => item = item.replace(/[^0-9.]/g, ""));

                            let ingredientSum = 0;

                            for (let k = 0; k < matches[0].length; k++)
                            {
                                ingredientSum = ingredientSum + parseInt(matchesNumbers[k]);
                            }

                            allIngredients2D[i][0] = allIngredients2D[i][0].replace(matchesNumbers[0], ingredientSum);
                        }
                        else
                        {

                            // if not combinable:
                            allIngredients2D[i][0] = CleanInput(prompt("Error: the units used for "+allIngredients2D[i][1]+" are inconsistant across these class orders despite being the same ingredient.\nPlease sum these quantities: "+matches[0]));
                        }
                        
                        // after either, remove copies
                        for (let k = 1; k < matches[0].length; k++)
                        {
                            allIngredients2D.splice(matches[1][k], 1); // depending on how splice works this could break the index
                        }
                    }
                    else
                    {
                        console.log("passed");
                    }
                }

                // Consolidation done. Now creating input fields

                let dispNames = ["Baking Ingredients", "Bread, Pasta, Rice", "Chilled Food (Bacon, Salami, etc)", "Dairy & Eggs", "Dried Herbs & Spices", "Fresh Fruit & Herbs", "Frozen Food", "Other", "Raw Meat, Chicken, Fish", "Sauces, Condiments", "Tinned Food", "Vegetables"];
                let internalNames = ["Baking", "Bread", "Chilled", "Dairy", "Dried", "Fresh", "Frozen", "Other", "Raw", "Sauces", "Tinned", "Vegetables"];      
                
                document.getElementById("wrapper").innerHTML += "<h1>Creating Department Order</h1>";
                document.getElementById("wrapper").innerHTML += '<button type="button" onclick="SubmitDepartmentOrder()">Upload to Database and Exit Page</button>';

                document.getElementById("wrapper").innerHTML += '<h2>Department Order Information</h2>'+
                '<label>Class Order RowIDs:</label><input type="text" id="classIDs" value="'+otherData[0]+'"><br>'+
                '<label>Recipies:</label><input type="text" id="recipes" value="'+otherData[5]+'"><br>'+
                //'<label>Date & Time Created:</label><input type="text" id="dateCreated" value="'.$row["DateCreated"].'"><br>'+
                '<label>Technician/Equipment Requests:</label><input type="text" id="techReq" value="'+otherData[7]+'"><br>'+
                '<h2>Ingredient Information</h2>';
                

                let outputHTMLTable = '<table><tr>';
                
                for (let i = 0; i < 12; i++)
                {
                    //document.getElementById("wrapper").innerHTML += '<td><h3>'+dispNames[i]+'</h3>';
                    outputHTMLTable += '<td><div style="width:100%; height:100%;"><h3>'+dispNames[i]+'</h3>';
                    for (let j = 0; j < allIngredients2D.length; j++)
                    {
                        if (allIngredients2D[j][2] == i)
                        {
                            outputHTMLTable += ('<input type="text" id="k'+i+'q'+j+'" style="width:50%;" value="'+allIngredients2D[j][0]+'"><input type="text" id="k'+i+'n'+j+'" style="width:50%;" value="'+allIngredients2D[j][1]+'"><br>')
                        }   
                    } 
                    outputHTMLTable += '</div></td>';
                    if (i == 5)
                    {
                        outputHTMLTable += '</tr><tr>';
                    }
                }
                document.getElementById("wrapper").innerHTML += outputHTMLTable+'</tr></table>';
                console.log(allIngredients2D);
            }

            function SubmitDepartmentOrder()
            {
                let output = Array(12).fill("");

                for (let i = 0; i < 12; i++)
                {
                    output[i] += '{'
                    for (let j = 0; j < allIngredients2D.length; j++)
                    {
                        if (allIngredients2D[j][2] == i)
                        {
                            if (document.getElementById("k"+i+"q"+j).value.length == 0)
                            {
                                document.getElementById("k"+i+"q"+j).value = "N/A";
                            }

                            if (output[i] == '{')
                            {
                                output[i] += '['+document.getElementById("k"+i+"q"+j).value+", "+document.getElementById("k"+i+"n"+j).value+"]";
                            }
                            else
                            {
                                output[i] += ', ['+document.getElementById("k"+i+"q"+j).value+", "+document.getElementById("k"+i+"n"+j).value+"]";
                            }
                        }
                    } 
                    output[i] += "}";
                }

                let timeNow = ((new Date().getFullYear())+"-"+(new Date().getMonth() + 1)+"-"+(new Date().getDate())+" "+(new Date().getHours())+":"+(new Date().getMinutes())+":"+(new Date().getSeconds()));

                otherData[0] = document.getElementById("classIDs").value;
                otherData[5] = document.getElementById("recipes").value;
                otherData[7] = document.getElementById("techReq").value;
                
                $.post("uploadDepartmentData.php", { 
                    classIDs: otherData[0],
                    practicalDay: otherData[1],
                    dateCreated: timeNow,
                    class: otherData[2], 
                    roomNum: otherData[3], 
                    students: otherData[4], 
                    recipes: otherData[5], 
                    block: otherData[6], 
                    techReq: otherData[7], 
                    baking: output[0], 
                    bread: output[1], 
                    chilled: output[2], 
                    dairy: output[3], 
                    dried: output[4], 
                    fresh: output[5], 
                    frozen: output[6], 
                    other: output[7], 
                    raw: output[8], 
                    sauces: output[9], 
                    tinned: output[10], 
                    vegetables: output[11]});


            }

            function CheckForInputField(data)
            {
                if (data.startsWith("<input ") == true)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }


        </script>
    </head>
</html>