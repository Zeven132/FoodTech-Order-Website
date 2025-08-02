<?php
    //https://codeshack.io/secure-login-system-php-mysql/
    session_start();
    include("../PHP_Components/config.php");

    $dbconnect=mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if (mysqli_connect_errno())
    {
        echo "Connection Failed: ".mysqli_connect_error();
        exit;
    }

    if(!isset($_POST['username'], $_POST['password']))
    {
        echo "You Are Dumb!";
        exit;
    }
    
    if ($stmt = $dbconnect->prepare('SELECT RowID, password FROM zayacole_accounts WHERE username = ?'))
    {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0)
        {
            $stmt->bind_result($RowID, $password);
            $stmt->fetch();
            
            if (($_POST['password'] === $password))
            {
                echo "Yay!! you are logged in!";
                session_regenerate_id();
                $_SESSION['account_loggedin'] = TRUE;
                $_SESSION['account_name'] = $_POST['username'];
                $_SESSION['account_id'] = $RowID;

                header('Location: /3DIG/zaya.cole/index.php'); //redirect to index once logged in

                exit;
            }
            else
            {
                echo "Wrong Info.. ";
                echo $_POST['username'];
            }
        }
        else
        {
            echo "SUPER Wrong Info.. Loser";
        }
        $stmt->close();
    }

?>
