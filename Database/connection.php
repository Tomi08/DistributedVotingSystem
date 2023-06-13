<?php
require 'vendor/autoload.php';

if (!function_exists('getMongoDBConnection')) {
    function getMongoDBConnection() {
        $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
        return $mongoClient->selectDatabase("szavazo_rendszer");
    }
    }

if (!function_exists('GetCon')) {
function GetCon($key) {
    if ($key === "sql") {
    static $conn;

    // Check if the connection is already established
    if (!$conn) {
        $dbhost = "localhost";
        $dbuser = "aporka";
        $dbpass = "nehezjelszo";
        $db = "aporka";
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);
    
        // Check connection
        if ($conn->connect_error) {
            die("Failed to connect to the database: " . $conn->connect_error);
        }
        echo "Sikeresen csatlakozott az adatbázishoz!";
    }

    // Return the connection
    return $conn;
}elseif ($key === "mongodb") {
 $mongoClient = getMongoDBConnection();
 echo "kapcsolodva.";
 return $mongoClient; 
}
else {
        echo "Érvénytelen adatbázis kulcs." . PHP_EOL;
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
