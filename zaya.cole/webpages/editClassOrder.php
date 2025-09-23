<html>
    <?php include("../PHP_Components/headNav.php");?>
    <head>
        <script>
            var newData = Array(12).fill("").map(() =>  Array(999).fill("").map(() => Array(2).fill("")));
            var newDataSimple = [];
            var lengths = new Array(12);

            function CompileInputs()
            {
                for(let i = 0; i < 12; i++)
                {
                    let k = 0;
                    while(document.getElementById("k"+i+"n"+k) != null)
                    {
                        newData[i][k][1] = CleanInput(document.getElementById("k"+i+"q"+k).value); // [][][1] is quantity, [][][0] is name
                        newData[i][k][0] = CleanInput(document.getElementById("k"+i+"n"+k).value);
                        k++;
                    }
                    lengths[i] = k;
                    //JSEncodeJSON(newData[i], k);
                }

                newDataSimple[0] = document.getElementById("teacher").value;
                newDataSimple[1] = document.getElementById("date").value;
                newDataSimple[2] = document.getElementById("class").value;
                newDataSimple[3] = document.getElementById("room").value;
                newDataSimple[4] = document.getElementById("students").value;
                newDataSimple[5] = document.getElementById("recipe").value;
                newDataSimple[6] = document.getElementById("block").value;
                newDataSimple[7] = document.getElementById("techReq").value;

                let rowNum = document.getElementById("rowNum").innerHTML;

                $.post("updateClassDataUpload.php", { 
                    row: rowNum.replace("Editing Class Order #", ""), 
                    teacher: newDataSimple[0], 
                    date: newDataSimple[1], 
                    class: newDataSimple[2], 
                    roomNum: newDataSimple[3], 
                    students: newDataSimple[4], 
                    recipe: newDataSimple[5], 
                    block: newDataSimple[6], 
                    techReq: newDataSimple[7], 
                    baking: JSEncodeJSON(newData[0], lengths[0]),
                    bread: JSEncodeJSON(newData[1], lengths[1]), 
                    chilled: JSEncodeJSON(newData[2], lengths[2]), 
                    dairy: JSEncodeJSON(newData[3], lengths[3]), 
                    dried: JSEncodeJSON(newData[4], lengths[4]), 
                    fresh: JSEncodeJSON(newData[5], lengths[5]), 
                    frozen: JSEncodeJSON(newData[6], lengths[6]), 
                    other: JSEncodeJSON(newData[7], lengths[7]), 
                    raw: JSEncodeJSON(newData[8], lengths[8]), 
                    sauces: JSEncodeJSON(newData[9], lengths[9]), 
                    tinned: JSEncodeJSON(newData[10], lengths[10]), 
                    vegetables: JSEncodeJSON(newData[11], lengths[11])});
            }
        </script>
    </head>

    <body>
        <div class="wrapper">
            <div>
                <form>
                <button type="button" onclick="CompileInputs()">Save and Update Database</button>
                </form>
            </div>
            <div>
                <?php
                    $dispNames = array("Baking Ingredients", "Bread, Pasta, Rice", "Chilled Food (Bacon, Salami, etc)", "Dairy & Eggs", "Dried Herbs & Spices", "Fresh Fruit & Herbs", "Frozen Food", "Other", "Raw Meat", "Chicken, Fish", "Sauces, Condiments", "Tinned Food", "Vegetables");
                    $internalNames = array("Baking", "Bread", "Chilled", "Dairy", "Dried", "Fresh", "Frozen", "Other", "Raw", "Sauces", "Tinned", "Vegetables");

                    $sql = "SELECT * FROM zayacole_class_order WHERE RowID = ".$_POST["rowSelected"];
                    $result = $dbconnect->query($sql);

                    echo '<h1 id="rowNum">Editing Class Order #'.$_POST["rowSelected"].'</h1>';
                    DataToInputField($result, $internalNames, $dispNames);
                ?>
            </div>
        </div>
    </body>
</html>