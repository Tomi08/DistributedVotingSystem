<?php
include 'db_connection.php';
// Adatbázis kulcs alapján történő választása
function chooseDatabase($key) {
    if ($key === "sql") {
        // SQL adatbázis kapcsolat inicializálása
        $dbhost = "localhost";
        $dbuser = "aporka";
        $dbpass = "nehezjelszo";
        $db = "ORProjekt_Szavazatok";
        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

        if(!($conn -> error)){
            echo "Succesfuly connected to the database!";
        }
        

        return $conn;
    } elseif ($key === "mongodb") {
        // MongoDB adatbázis kapcsolat beállítása
        $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
        $mongoDB = $mongoClient->selectDatabase("szavazatok");

        // Szavazat rögzítése
        
        $voterName = "John Doe";
        $vote = "Option A";

        recordVote($voterName, $vote);

        return $mongoDB; 
    } else {
        echo "Érvénytelen adatbázis kulcs.";
        return null;
    }
}

// Példa adatbázis használatra kulcs alapján
$databaseKey = "sql"; 

$database = chooseDatabase($databaseKey);

function recordVote($voterName, $vote) {
    global $mongoDB;
    
    $collection = $mongoDB->votes;
    
    $document = array(
        "voterName" => $voterName,
        "vote" => $vote
    );
    
    $collection->insertOne($document);
    
    echo "Szavazat sikeresen rögzítve.";
}


?>
