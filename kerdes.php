<?php
include "connection.php";
/*$data = file_get_contents('php://stdin');
$input = explode("\n", $data);

$email = isset($input[0]) ? $input[0] : '';
$key = isset($input[1]) ? $input[1] : '';
*/

function postNewQuestion($question,$key){
    $conn = GetCon($key);
    if ($key === "sql") {
        $question = mysqli_real_escape_string($conn, $question); // Sanitize the input to prevent SQL injection
    
        $sql = "INSERT INTO kerdesek (kerdes)
                SELECT * FROM (SELECT '$question') AS tmp
                WHERE NOT EXISTS (
                    SELECT kerdes FROM kerdesek WHERE kerdes = '$question'
                ) LIMIT 1";
    
        if ($conn->query($sql) === TRUE) {
            if ($conn->affected_rows > 0) {
                echo "New question created successfully". PHP_EOL;
            } else {
                echo "Question already exists". PHP_EOL;
            }
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
        
     

    // Az új kérdés dokumentum létrehozása
    $document = [
        "kerdes" => $question,
        "kerdes_id" =>"4",
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
function getQuestion($key){
    $conn = GetCon($key);
    if($key === "sql"){
    $sql = "SELECT kerdes, kerdes_id FROM kerdesek";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        //$ret = "kerdes_id: " . $row["kerdes_id"]. " - kerdes: " . $row["kerdes"]. "<br>";
		$ret = $result;
    } else {
        $ret = "Client not found!";
    }

    // CloseCon($conn);
    return $ret;
}
elseif ($key === "mongodb") {
    $collection = $conn->selectCollection("kerdesek");
    
    $cursor = $collection->find();
    
    $questions = iterator_to_array($cursor);
    
    if (!empty($questions)) {
        return $questions;
    } else {
        return "No questions found!";
    }
}
}
?> 