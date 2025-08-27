<html lang>
    <?php include("../PHP_Components/headNav.php"); ?>

    <head>
        <script>
            
            window.onload = onLoadFunctions;
            var inputItem = "";
            var inputQuantity = "";


            var dataJSONArray = ["teacherFormat", "dateFormat", "classFormat", "roomNumFormat", "recipeFormat", "studentsFormat", "blockFormat", "techreqFormat", "bakingFormat", "breadFormat", "chilledFormat", "dairyFormat", "driedFormat", "freshFormat", "frozenFormat", "otherFormat", "rawFormat", "saucesFormat", "tinnedFormat", "vegetablesFormat"];
            var dataInputArray = ["teacherInput", "dateInput", "classInput", "roomNumInput", "recipeInput", "studentsInput", "blockInput", "techreqInput"];
            //https://stackoverflow.com/questions/19322435/loading-javascript-function-on-start-using-javascript
           
            function onLoadFunctions() 
            {
                for(let i = 0; i < 8; i++)
                {
                    document.getElementById(dataJSONArray[i]).value = "none";
                }

                for(let i = 8; i < 20; i++)
                {
                    document.getElementById(dataJSONArray[i]).value = "{";
                }
            }
            
            function SaveItemToFormatter()
            {
                for(let i = 0; i < 8; i++)
                {
                    document.getElementById(dataJSONArray[i]).value = document.getElementById(dataInputArray[i]).value;
                }
                /*$("#teacherFormat").val() = $("#teacherInput").val();
                $("#dateFormat").val()
                $("#classFormat").val()
                $("#roomNumFormat").val()
                $("#studentsFormat").val()
                $("#recipeFormat").val()
                $("#blockFormat").val()
                $("#techreqFormat").val()*/

                inputQuantity = document.getElementById("quantityInput").value;
                inputItem = document.getElementById("itemInput").value;
                let type = document.getElementById("foodType").value;

                for (let i = 1; i < 13; i++)
                {
                    if (i == Number(type))
                    {
                        let k = i+7;
                        
                        if (document.getElementById(dataJSONArray[k]).value == '{')
                        {
                            document.getElementById(dataJSONArray[k]).value += '["'+inputQuantity+'", "'+inputItem+'"]';
                        }
                        else
                        {
                            document.getElementById(dataJSONArray[k]).value += ', ["'+inputQuantity+'", "'+inputItem+'"]';
                        }
                    }
                    
                }
                DisplayInput();
                document.getElementById("quantityInput").value = document.getElementById("itemInput").value = "";
                //document.getElementById("breadFormat").value += "!!"+inputQuantity+"~~"+inputItem;
                inputQuantity = inputItem = "";
            }

            function DisplayInput()
            {
                document.getElementById("inputDisplay").innerHTML += (document.getElementById("quantityInput").value+" "+document.getElementById("itemInput").value+"<br>");

            }
            //https://tecadmin.net/submit-form-without-page-refresh-php-jquery/
            function SubmitFormData() 
            {

                for(let i = 8; i < 20; i++)
                {
                    document.getElementById(dataJSONArray[i]).value += '}';
                }


                var teacher = $("#teacherFormat").val();
                var date = $("#dateFormat").val();
                var Class = $("#classFormat").val(); // capitalized because class is a javascript term which cannot be used as the name of a var
                var roomNum = $("#roomNumFormat").val();
                var students = $("#studentsFormat").val();
                var recipe = $("#recipeFormat").val();
                var block = $("#blockFormat").val();
                var techReq = $("#techreqFormat").val();
                var baking = $("#bakingFormat").val();
                var bread = $("#breadFormat").val();
                var chilled = $("#chilledFormat").val();
                var dairy = $("#dairyFormat").val();
                var dried = $("#driedFormat").val();
                var fresh = $("#freshFormat").val();
                var frozen = $("#frozenFormat").val();
                var other = $("#otherFormat").val();
                var raw = $("#rawFormat").val();
                var sauces = $("#saucesFormat").val();
                var tinned = $("#tinnedFormat").val();
                var vegetables = $("#vegetablesFormat").val();
                $.post("uploadData.php", { teacher: teacher, date: date, class: Class, roomNum: roomNum, students: students, recipe: recipe, block: block, techReq: techReq, baking: baking, bread: bread, chilled: chilled, dairy: dairy, dried: dried, fresh: fresh, frozen: frozen, other: other, raw: raw, sauces: sauces, tinned: tinned, vegetables: vegetables});
                window.location.replace("https://php.papamoacollege.school.nz/3DIG/zaya.cole/index.php");
            }
        </script>
    </head>
    <body>
        <div class="wrapper">
            <!--<h1>Login to Existing Account</h1>
            <div class="signupMessage">
                <p style="text-align: center;">Don't have an account? Sign up for one <a href="signup.php">Here</a></p>
            </div>-->
<!-- login form-->
            <?php

            //$quantity = "null";
            //$foodItem = "";
            /*function updateDisp()
            {
                if("" != $_POST["quantity"] && "" != $_POST["foodItem"])
                {
                    echo "Quantity: ".$_POST["quantity"]."<br>Ingredient: ".$_POST["foodItem"];
                    echo "<br>";
                }
            }*/



            ?>
            <!--https://stackoverflow.com/questions/2075337/uncaught-referenceerror-is-not-defined
            -->


            <div class="LoginDiv">
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
                    <input class="invis" type="text" id="teacherFormat" name="teacher">
                    <input class="invis" type="text" id="dateFormat" name="date">
                    <input class="invis" type="text" id="classFormat" name="class">
                    <input class="invis" type="text" id="roomNumFormat" name="roomNum">
                    <input class="invis" type="text" id="studentsFormat" name="students">
                    <input class="invis" type="text" id="recipeFormat" name="recipe">
                    <input class="invis" type="text" id="blockFormat" name="block">
                    <input class="invis" type="text" id="techreqFormat" name="techReq">
                    <input class="invis" type="text" id="bakingFormat" name="baking">
                    <input class="invis" type="text" id="breadFormat" name="bread">
                    <input class="invis" type="text" id="chilledFormat" name="chilled">
                    <input class="invis" type="text" id="dairyFormat" name="dairy">
                    <input class="invis" type="text" id="driedFormat" name="dried">
                    <input class="invis" type="text" id="freshFormat" name="fresh">
                    <input class="invis" type="text" id="frozenFormat" name="frozen">
                    <input class="invis" type="text" id="otherFormat" name="other">
                    <input class="invis" type="text" id="rawFormat" name="raw">
                    <input class="invis" type="text" id="saucesFormat" name="sauces">
                    <input class="invis" type="text" id="tinnedFormat" name="tinned">
                    <input class="invis" type="text" id="vegetablesFormat" name="vegetables">
                </form>
            </div>

            <div class="InputDisplayDiv">
                <h3>Ingredients:<h3>
                <p id="inputDisplay"></p>

            </div>
        </div>
    </body>
</html>






