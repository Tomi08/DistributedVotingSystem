<?php
//file_put_contents("error.txt", "");
session_start();

$statusMessage = "";

if(isset($_SESSION['error'])){

    $statusMessage = $_SESSION['error'];
    unset($_SESSION["error"]);
}

// Return the status message as JSON
echo json_encode($statusMessage);
?>