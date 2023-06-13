<?php
include "connection.php";
function postNewQuestion($question,$key){
    $conn = GetCon($key);
    if ($key === "sql") {

    $sql = "INSERT INTO kerdesek(kerdes) VALUES ('$question')";

    if ($conn->query($sql) === TRUE) {
        echo "New question created successfully". PHP_EOL;
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error . PHP_EOL;
    }
    }
    elseif ($key === "mongodb") {
        $mongoDB = $conn->selectCollection("kerdesek");

        // Ellenőrizzük, hogy a kérdés már szerepel-e az adatbázisban
        $existingQuestion = $mongoDB->findOne(["kerdes" => $question]);

        if ($existingQuestion) {
            echo "A kérdés már szerepel az adatbázisban." . PHP_EOL;
            return;
        }
        
        $sequenceCollection = $conn->selectCollection("sequence");
    if (!$sequenceCollection) {
        $sequenceCollection = $conn->createCollection("sequence");
        $sequenceCollection->insertOne(["_id" => "question_id", "value" => 0]);
    }

    // Lépjünk a következő értékre a szekvencia kollekcióban és vegyük az új ID-t
    $nextId = $sequenceCollection->findOneAndUpdate(
        ["_id" => "question_id"],
        ['$inc' => ["value" => 1]],
        ['returnDocument' => MongoDB\Operation\FindOneAndUpdate::RETURN_DOCUMENT_AFTER]
    );

    // Az új kérdés dokumentum létrehozása
    $document = [
        "_id" => $nextId["value"],
        "kerdes" => $question,
        "letrehozas_datuma" => new MongoDB\BSON\UTCDateTime()
    ];
    
        try {
            $result = $mongoDB->insertOne($document); // Beszúrás a MongoDB-be
    
            if ($result->getInsertedCount() > 0) {
                echo "New question created successfully" . PHP_EOL;
            } else {
                echo "Error inserting question" . PHP_EOL;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . PHP_EOL;
        }
    }
    // CloseCon($conn);
}

function getQuestionById($id,$key){
    
    $conn = GetCon($key);
    if($key === "sql"){

    $sql = "SELECT kerdes_id,kerdes FROM kliens WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ret = "kerdes_id: " . $row["kerdes_id"]. " - kerdes: " . $row["kerdes"]. "<br>";
    } else {
        $ret = "Client not found!";
    }

    // CloseCon($conn);
    return $ret;
}}

?> 