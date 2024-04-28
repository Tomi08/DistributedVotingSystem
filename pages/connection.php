<?php
require 'vendor/autoload.php';

if (!function_exists('getMongoDBConnection')) {
    function getMongoDBConnection() {
        $mongoClient = new MongoDB\Client("*your_mongodb_auth*");
        return $mongoClient->selectDatabase("osztott");
    }
    }

if (!function_exists('GetCon')) {
function GetCon($key) {
    if ($key === "sql") {
    static $conn;

    // Check if the connection is already established
    if (!$conn) {
        $dbhost = "";
        $dbuser = "";
        $dbpass = "";
        $db = "";
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

        // Check connection
        if ($conn->connect_error) {
            die("Failed to connect to the database: " . $conn->connect_error);
        }
        //echo "Sikeresen csatlakozott az adatbázishoz!";
    }

    // Return the connection
    return $conn;
}elseif ($key === "mongodb") {
 $mongoClient = getMongoDBConnection();
 //echo "kapcsolodva.";
 return $mongoClient;
}
else {
        echo "Érvénytelen adatbázis kulcs." . PHP_EOL;
        echo $key;
        return null;
}
}
}
// if (!function_exists('CloseCon')) {
// function CloseCon($conn){
//     echo 'VEGE';
//     $conn -> close();
// }
// }

?>
