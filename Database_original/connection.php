<?php
if (!function_exists('GetCon')) {
function GetCon() {
    static $conn;

    // Check if the connection is already established
    if (!$conn) {
        $dbhost = "localhost";
        $dbuser = "osztott";
        $dbpass = "nehezjelszo";
        $db = "osztott";
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);
    
        // Check connection
        if ($conn->connect_error) {
            die("Failed to connect to the database: " . $conn->connect_error);
        }
        //echo "Sikeresen csatlakozott az adatbázishoz!";
    }

    // Return the connection
    return $conn;
}
}
// if (!function_exists('CloseCon')) {
// function CloseCon($conn){
//     echo 'VEGE';
//     $conn -> close();
// }
// }

?>
