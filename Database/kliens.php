<?php

include 'db_connection.php';

//POST

    //UJ KLIENS LETREHOZASA

function postNewClient($username, $email, $password){
    $conn = OpenCon();

    $sql = "INSERT INTO kliens(username, email, password, valasz_id) VALUES ('$username', '$email', '$password', null)";

    if ($conn->query($sql) === TRUE) {
        echo "New client created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    CloseCon($conn);
}

//GET 

    //KLIENS LEKERESE ID ALAPJAN

function getClientById($id){
    $conn = OpenCon();

    $sql = "SELECT id, username, email, password, valasz_id FROM kliens WHERE id=$id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ret = "id: " . $row["id"]. " - username: " . $row["username"]. " - email: " . $row["email"] . " - password: " . $row["password"] . "<br>";
    } else {
        $ret = "Client not found!";
    }

    CloseCon($conn);
    return $ret;
}

    //KLIENS LEKERESE EMAIL ALAPJAN

function getClientByEmail($email){
    $conn = OpenCon();

    $sql = "SELECT id, username, email, password, valasz_id FROM kliens WHERE email LIKE '$email'";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ret = "id: " . $row["id"]. " - username: " . $row["username"]. " - email: " . $row["email"] . " - password: " . $row["password"] . "<br>";
    } else {
        $ret = "Client not found!";
    }

    CloseCon($conn);
    return $ret;
}

?>