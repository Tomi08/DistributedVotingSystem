<?php
include "connection.php";
function postNewQuestion($question){
    $conn = GetCon();

    $sql = "INSERT INTO kerdesek(kerdes) VALUES ('$question')";

    if ($conn->query($sql) === TRUE) {
        echo "New question created successfully". PHP_EOL;
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error . PHP_EOL;
    }

    // CloseCon($conn);
}

function getQuestionById($id){
    $conn = GetCon();

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
}
?> 