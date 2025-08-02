<?php
    session_start();
    session_destroy();
    header('Location: /3DIG/zaya.cole/webpages/loggedOutRedirect.php');
    exit;
?>