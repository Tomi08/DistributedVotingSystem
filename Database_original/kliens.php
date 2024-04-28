<?php
include "connection.php";

//POST
//UJ KLIENS LETREHOZASA


function postNewClient($username, $email, $password){
    echo "bent vagyok";
    $conn = GetCon();

    $sql = "INSERT INTO kliens(username, email, password, valasz_id) VALUES ('$username', '$email', '$password', null)";

    if ($conn->query($sql) === TRUE) {
        echo "New client created successfully". PHP_EOL;
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error . PHP_EOL;
    }

    // CloseCon($conn);
}

//GET 
//KLIENS LEKERESE ID ALAPJAN

function getClientById($id){
    $conn = GetCon();

    $sql = "SELECT id, username, email, password, valasz_id FROM kliens WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ret = "id: " . $row["id"]. " - username: " . $row["username"]. " - email: " . $row["email"] . " - password: " . $row["password"] . "<br>";
    } else {
        $ret = "Client not found!";
    }

    // CloseCon($conn);
    return $ret;
}

    //KLIENS LEKERESE EMAIL ALAPJAN

function getClientByEmail($email){
    $conn = GetCon();

    $sql = "SELECT id, username, email, password, valasz_id FROM kliens WHERE email LIKE '$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ret = $row;
        //$ret = "id: " . $row["id"]. " - username: " . $row["username"]. " - email: " . $row["email"] . " - password: " . $row["password"] . "<br>";
    } else {
        $ret = "Client not found!";
    }

    // CloseCon($conn);
    return $ret;
}



?>