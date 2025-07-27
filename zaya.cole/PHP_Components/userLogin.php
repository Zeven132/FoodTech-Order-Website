<?php

$sql = "SELECT * FROM zayacole_class_order";
$result = $dbconnect->query($sql);

echo '<table class="databaseDispTable"><tr><th>RowID</th><th>Teacher Code</th><th>Practical Day</th><th>Class</th><th>Room</th><th>Recipe</th><th>Students</th><th>Block</th><th>Baking Ingredients</th><th>Bread, Pasta, Rice</th><th>Chilled Food (Bacon, Salami, etc)</th><th>Dairy & Eggs</th><th>Dried Herbs & Spices</th><th>Fresh Fruit & Herbs</th><th>Frozen Food</th><th>Other</th><th>Raw Meat, Chicken, Fish</th><th>Sauces, Condiments</th><th>Tinned Food</th><th>Vegetables</th><th>Technician Requests/equipment</th><tr>';
while ($row = $result->fetch_assoc()) 
{
    echo "<tr><td>".$row['RowID']."</td><td>".$row['TeacherCode']."</td><td>".$row['PracticalDay']."</td><td>".$row['Class']."</td><td>".$row['RoomNum']."</td><td>".$row['Recipe']."</td><td>".$row['NumOfStudents']."</td><td>".$row['Block']."</td><td>".$row['Baking']."</td><td>".$row['Bread']."</td><td>".$row['Chilled']."</td><td>".$row['Dairy']."</td><td>".$row['Dried']."</td><td>".$row['Fresh']."</td><td>".$row['Frozen']."</td><td>".$row['Other']."</td><td>".$row['Raw']."</td><td>".$row['Sauces']."</td><td>".$row['Tinned']."</td><td>".$row['Vegetables']."</td><td>".$row['TechnicianReq']."</td></tr>"/*The recipe for today: " . $row['Recipe']. " with a side of " .$row['Tinned']*/;
}
echo "</table";

//echo "result: $result";


/*
    if((isset($_POST['password'])) && (isset($_POST['email'])))
    {
        $email="SELECT rowID WHERE Email=$_POST['email']";
        $password="SELECT rowID WHERE Password=$_POST['password']";
        if($email == $password)
        {
            // login :3
        }
        else
        {
            echo "Your Password and/or Email is incorrect!";
        }
    }*/
?>