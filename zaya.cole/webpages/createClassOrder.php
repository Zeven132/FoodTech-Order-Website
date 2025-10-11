<html lang>
    <?php include("../PHP_Components/headNav.php"); ?>
    <head>
        <script>
            //https://stackoverflow.com/questions/19322435/loading-javascript-function-on-start-using-javascript
            window.onload = onLoadFunctions;
            var inputItem = "";
            var inputQuantity = "";
            var dataJSONArray = ["teacherFormat", "dateFormat", "classFormat", "roomNumFormat", "recipeFormat", "studentsFormat", "blockFormat", "techreqFormat", "bakingFormat", "breadFormat", "chilledFormat", "dairyFormat", "driedFormat", "freshFormat", "frozenFormat", "otherFormat", "rawFormat", "saucesFormat", "tinnedFormat", "vegetablesFormat"];
            var dataInputArray = ["teacherInput", "dateInput", "classInput", "roomNumInput", "recipeInput", "studentsInput", "blockInput", "techreqInput"];

            // ran on document loaded
            function onLoadFunctions()
            {
                for(let i = 0; i < 8; i++)
                {
                    document.getElementById("Format"+i).value = "none";
                }
            }

            function SaveItemToFormatter()
            {
                // get values from non ingredient inputs
                for(let i = 0; i < 8; i++)
                {
                    document.getElementById("Format"+i).value = document.getElementById(dataInputArray[i]).value;
                }

                if (document.getElementById("itemInput").value != "")
                {
                    inputQuantity = document.getElementById("quantityInput").value;
                    inputQuantity = CleanInput(inputQuantity);

                    inputItem = document.getElementById("itemInput").value;
                    inputItem = CleanInput(inputItem);

                    let type = document.getElementById("foodType").value;

                    for (let i = 1; i < 13; i++)
                    {
                        if (i == Number(type))
                        {
                            let k = i+7;
                            SumIngredientsAndSave(document.getElementById("Format"+k).value, inputQuantity, inputItem, k);
                        }
                    }
                    
                    document.getElementById("quantityInput").value = document.getElementById("itemInput").value = "";
                    inputQuantity = inputItem = "";
                }
                DisplayInput();
            }

            function SumIngredientsAndSave(prevData, quantity, name, k)
            {
                console.log(prevData.indexOf(name));
                if (prevData.indexOf('"'+name+'"') != -1) // existing ingredient
                {
                    let existingQuantityStart = prevData.substring(0 , prevData.indexOf('"'+name+'"') - 1);
                    existingQuantityStart = existingQuantityStart.lastIndexOf("[");
                    let existingQuantity = prevData.substring(existingQuantityStart , prevData.indexOf('"'+name+'"') - 1);
                    let existingQuantityInt = existingQuantity.replace(/\D/g, "");
                    console.log(existingQuantity+" -> "+existingQuantityInt);
                    let quantityInt = quantity.replace(/[a-zA-Z]/g, "");
                    let newQuantity = parseInt(existingQuantityInt) + parseInt(quantityInt);

                    document.getElementById("Format"+k).value = prevData.replace(existingQuantity, existingQuantity.replace(existingQuantityInt, newQuantity));
                    //DisplayInput();
                    
                }
                else // unique ingredient
                {
                    document.getElementById("Format"+k).value += '["'+quantity+'", "'+name+'"]';
                    //DisplayInput(quantity, name);
                }
                console.log(prevData);
            }

            function DisplayInput()
            {
                
                document.getElementById("inputDisplay").innerHTML = "";
                document.getElementById("classDetailsDisplay").innerHTML = "";
                for (let i = 8; i < 20; i++)
                {
                    document.getElementById("inputDisplay").innerHTML += CleanInput((document.getElementById("Format"+i).value).replaceAll("]", "<br>"));
                }
                for (let i = 0; i < 8; i++)
                {
                    document.getElementById("classDetailsDisplay").innerHTML += document.getElementById("Format"+i).value + "<br>";
                }

                
            }

            //https://tecadmin.net/submit-form-without-page-refresh-php-jquery/
            function SubmitFormData()
            {
                for(let i = 8; i < 20; i++) // formats to JSON
                {
                    document.getElementById("Format"+i).value = "{" + document.getElementById("Format"+i).value + "}";
                    //document.getElementById("Format"+i).value = (document.getElementById("Format"+i).value).replace("/][/g", "], [");
                }

                var uploadData = []; // writing values to arr

                for (let i = 0; i < 20; i++)
                {
                    uploadData[i] = document.getElementById("Format"+i).value;
                    uploadData[i] = uploadData[i].replaceAll("][", "], [");
                }

                for (let i = 0; i < 20; i++)
                {
                    console.log(uploadData[i]);
                    console.log("\n");
                }

                $.post("uploadData.php", { teacher: uploadData[0], date: uploadData[1], class: uploadData[2], roomNum: uploadData[3], students: uploadData[4], recipe: uploadData[5], block: uploadData[6], techReq: uploadData[7], baking: uploadData[8], bread: uploadData[9], chilled: uploadData[10], dairy: uploadData[11], dried: uploadData[12], fresh: uploadData[13], frozen: uploadData[14], other: uploadData[15], raw: uploadData[16], sauces: uploadData[17], tinned: uploadData[18], vegetables: uploadData[19]});
            }

            // redirects after upload
            $(document).ajaxComplete(function()
            {
                Redirect();
            });

        </script>
    </head>
    <body>
        <div class="wrapper">
            <div class="createNewClassOrderDiv">
                <h1>Create New</h1>
                <h3>Class Details</h3>
                <form>
                    <label for="teacherInput">Teacher Code:</label>
                        <input type="text" id="teacherInput">
                    <br>
                    <label for="dateInput">Practical Day:</label>
                        <input type="text" id="dateInput">
                    <br>
                    <label for="classInput">Class:</label>
                        <input type="text" id="classInput">
                    <br>
                    <label for="roomNumInput">Room:</label>
                        <input type="text" id="roomNumInput">
                    <br>
                    <label for="recipeInput">Recipe:</label>
                        <input type="text" id="recipeInput">
                    <br>
                    <label for="studentsInput"># of Students:</label>
                        <input type="text" id="studentsInput">
                    <br>
                    <label for="blockInput">Block(s):</label>
                        <input type="text" id="blockInput">
                    <br>
                    <label for="techreqInput">Technician/Equipment Requests:</label>
                        <input type="text" id="techreqInput">
                    <h3>Ingredient Details</h3>
                    <label for="foodType">Category:</label>
                        <select name="type" id="foodType">
                            <option value="1">Baking Ingredients</option>
                            <option value="2">Bread, Pasta, Rice</option>
                            <option value="3">Chilled Food (Bacon, Salami, etc)</option>
                            <option value="4">Dairy and Eggs</option>
                            <option value="5">Dried Herbs and Spices</option>
                            <option value="6">Fresh Fruit and Herbs</option>
                            <option value="7">Frozen Food</option>
                            <option value="8">Other</option>
                            <option value="9">Raw Meat, Chicken, Fish</option>
                            <option value="10">Sauces, Condiments</option>
                            <option value="11">Tinned Food</option>
                            <option value="12">Vegetables</option>
                        </select>
                    <br>
                    <label for="quantityInput">Quantity/Amount:</label>
                        <input type="text" name="quantity" id="quantityInput">
                    <br>
                    <label for="itemInput">Ingredient Name:</label>
                        <input type="text" name="item" id="itemInput">
                    <br>
                    <button type="button" onclick="SaveItemToFormatter()">Save/Add Another Ingredient</button>
                    <button type="button" onclick="SubmitFormData()">Upload to Database and Exit Page</button>
                </form>

                <form method="post" action="uploadData.php">
                    <input class="invis" type="text" id="Format0" name="teacher">
                    <input class="invis" type="text" id="Format1" name="date">
                    <input class="invis" type="text" id="Format2" name="class">
                    <input class="invis" type="text" id="Format3" name="roomNum">
                    <input class="invis" type="text" id="Format4" name="students">
                    <input class="invis" type="text" id="Format5" name="recipe">
                    <input class="invis" type="text" id="Format6" name="block">
                    <input class="invis" type="text" id="Format7" name="techReq">
                    <input class="invis" type="text" id="Format8" name="baking">
                    <input class="invis" type="text" id="Format9" name="bread">
                    <input class="invis" type="text" id="Format10" name="chilled">
                    <input class="invis" type="text" id="Format11" name="dairy">
                    <input class="invis" type="text" id="Format12" name="dried">
                    <input class="invis" type="text" id="Format13" name="fresh">
                    <input class="invis" type="text" id="Format14" name="frozen">
                    <input class="invis" type="text" id="Format15" name="other">
                    <input class="invis" type="text" id="Format16" name="raw">
                    <input class="invis" type="text" id="Format17" name="sauces">
                    <input class="invis" type="text" id="Format18" name="tinned">
                    <input class="invis" type="text" id="Format19" name="vegetables">
                </form>
            </div>
            <div class="InputDisplayDiv">
                <h3>Ingredients:<h3>
                <p id="inputDisplay"></p>
            </div>
            <div class="ClassDetailsDisplayDiv">
                <h3>Class Details:<h3>
                <p id="classDetailsDisplay"></p>
            </div>
        </div>
    </body>
</html>