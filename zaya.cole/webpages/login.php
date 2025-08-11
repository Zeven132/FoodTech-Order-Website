<html lang>
    <?php include("../PHP_Components/headNav.php"); ?>

    <head>
        <script>
            
            window.onload = onLoadFunctions;
            var inputItem = "";
            var inputQuantity = "";

            //https://stackoverflow.com/questions/19322435/loading-javascript-function-on-start-using-javascript
            function onLoadFunctions() 
            {
                for(let i = 1; i < 13; i++)
                {
                    switch(i)
                    {
                        case 1:
                        {
                            document.getElementById("bakingFormat").value = "none";
                            break;
                        }
                        case 2:
                        {
                            document.getElementById("breadFormat").value = "none";
                            break;
                        }
                        case 3:
                        {
                            document.getElementById("chilledFormat").value = "none";
                            break;
                        }
                        case 4:
                        {
                            document.getElementById("dairyFormat").value = "none";
                            break;
                        }
                        case 5:
                        {
                            document.getElementById("driedFormat").value = "none";
                            break;
                        }
                        case 6:
                        {
                            document.getElementById("freshFormat").value = "none";
                            break;
                        }
                        case 7:
                        {
                            document.getElementById("frozenFormat").value = "none";
                            break;
                        }
                        case 8:
                        {
                            document.getElementById("otherFormat").value = "none";
                            break;
                        }
                        case 9:
                        {
                            document.getElementById("rawFormat").value = "none";
                            break;
                        }
                        case 10:
                        {
                            document.getElementById("saucesFormat").value = "none";
                            break;
                        }
                        case 11:
                        {
                            document.getElementById("tinnedFormat").value = "none";
                            break;
                        }
                        case 12:
                        {
                            document.getElementById("vegetablesFormat").value = "none";
                            break;
                        }
                    }
                }
            }
            

            function SaveItemToFormatter()
            {
                document.getElementById("teacherFormat").value = document.getElementById("teacherInput").value;
                document.getElementById("dateFormat").value = document.getElementById("dateInput").value;
                document.getElementById("classFormat").value = document.getElementById("classInput").value;
                document.getElementById("roomNumFormat").value = document.getElementById("roomNumInput").value;
                document.getElementById("recipeFormat").value = document.getElementById("recipeInput").value;
                document.getElementById("studentsFormat").value = document.getElementById("studentsInput").value;
                document.getElementById("blockFormat").value = document.getElementById("blockInput").value;
                document.getElementById("techreqFormat").value = document.getElementById("techreqInput").value;
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
                console.log(document.getElementById("foodType").value);
                let type = document.getElementById("foodType").value;
                switch(Number(type))
                {
                    case 1:
                    {
                        if (document.getElementById("bakingFormat").value == "none")
                        {
                            document.getElementById("bakingFormat").value = "";
                        }
                        document.getElementById("bakingFormat").value += "!!"+inputQuantity+"~~"+inputItem;
                        break;
                    }
                    case 2:
                    {
                        if (document.getElementById("breadFormat").value == "none")
                        {
                            document.getElementById("breadFormat").value = "";
                        }
                        document.getElementById("breadFormat").value += "!!"+inputQuantity+"~~"+inputItem;
                        console.log(document.getElementById("breadFormat").value);
                        console.log("yay");
                        break;
                    }
                    case 3:
                    {
                        if (document.getElementById("chilledFormat").value == "none")
                        {
                            document.getElementById("chilledFormat").value = "";
                        }
                        document.getElementById("chilledFormat").value += "!!"+inputQuantity+"~~"+inputItem;
                        break;
                    }
                    case 4:
                    {
                        if (document.getElementById("dairyFormat").value == "none")
                        {
                            document.getElementById("dairyFormat").value = "";
                        }
                        document.getElementById("dairyFormat").value += "!!"+inputQuantity+"~~"+inputItem;
                        break;
                    }
                    case 5:
                    {
                        if (document.getElementById("driedFormat").value == "none")
                        {
                            document.getElementById("driedFormat").value = "";
                        }
                        document.getElementById("driedFormat").value += "!!"+inputQuantity+"~~"+inputItem;
                        break;
                    }
                    case 6:
                    {
                        if (document.getElementById("freshFormat").value == "none")
                        {
                            document.getElementById("freshFormat").value = "";
                        }
                        document.getElementById("freshFormat").value += "!!"+inputQuantity+"~~"+inputItem;
                        break;
                    }
                    case 7:
                    {
                        if (document.getElementById("frozenFormat").value == "none")
                        {
                            document.getElementById("frozenFormat").value = "";
                        }
                        document.getElementById("frozenFormat").value += "!!"+inputQuantity+"~~"+inputItem;
                        break;
                    }
                    case 8:
                    {
                        if (document.getElementById("otherFormat").value == "none")
                        {
                            document.getElementById("otherFormat").value = "";
                        }
                        document.getElementById("otherFormat").value += "!!"+inputQuantity+"~~"+inputItem;
                        break;
                    }
                    case 9:
                    {
                        if (document.getElementById("rawFormat").value == "none")
                        {
                            document.getElementById("rawFormat").value = "";
                        }
                        document.getElementById("rawFormat").value += "!!"+inputQuantity+"~~"+inputItem;
                        break;
                    }
                    case 10:
                    {
                        if (document.getElementById("saucesFormat").value == "none")
                        {
                            document.getElementById("saucesFormat").value = "";
                        }
                        document.getElementById("saucesFormat").value += "!!"+inputQuantity+"~~"+inputItem;
                        break;
                    }
                    case 11:
                    {
                        if (document.getElementById("tinnedFormat").value == "none")
                        {
                            document.getElementById("tinnedFormat").value = "";
                        }
                        document.getElementById("tinnedFormat").value += "!!"+inputQuantity+"~~"+inputItem;
                        break;
                    }
                    case 12:
                    {
                        if (document.getElementById("vegetablesFormat").value == "none")
                        {
                            document.getElementById("vegetablesFormat").value = "";
                        }
                        document.getElementById("vegetablesFormat").value += "!!"+inputQuantity+"~~"+inputItem;
                        break;
                    }
                }
                document.getElementById("quantityInput").value = document.getElementById("itemInput").value = "";
                //document.getElementById("breadFormat").value += "!!"+inputQuantity+"~~"+inputItem;
                inputQuantity = inputItem = "";
            }
            //https://tecadmin.net/submit-form-without-page-refresh-php-jquery/
            function SubmitFormData() 
            {
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
                    <label for="dateInput">Practical Day:</label>
                        <input type="text" id="dateInput">
                    <br>
                    <label for="classInput">Class:</label>
                        <input type="text" id="classInput">
                    <label for="roomNumInput">Room:</label>
                        <input type="text" id="roomNumInput">
                    <br>
                    <label for="recipeInput">Recipe:</label>
                        <input type="text" id="recipeInput">
                    <label for="studentsInput"># of Students:</label>
                        <input type="text" id="studentsInput">
                    <br>
                    <label for="blockInput">Block(s):</label>
                        <input type="text" id="blockInput">
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
                </form>

                <form method="post" action="uploadData.php"> <!-- comment out action when testing new way -->
                    <button type="button" onclick="SubmitFormData()">Upload to Database and Exit Page (under construction)</button>
                    <input type="submit" name="submit" value="Upload to Database and Exit Page">
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


                <!--Welcome <?php //echo $_POST["quantity"]; ?><br>
                Your email address is: <?php //echo $_POST["foodItem"]; ?>
                <!--<form id="loginForm" style="text-align: left;">
                    <label for="Username">Username:</label>
                    <input type="text" name="name" value="<?php// echo $email;?>">
                    <br>
                    <br>
                    <label for="Password">Password:</label>
                    <input type="password" id="Password" name="password">
                    <br>
                    <br>
                    <button>Login</button>
                </form>
            </div>-->
        </div>
        <div>
            <?php 
                //updateDisp();
            ?>
        </div>
    </body>
</html>