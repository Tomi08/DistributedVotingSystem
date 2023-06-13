<?php
include "connection.php";

//POST
//UJ KLIENS LETREHOZASA


function postNewClient($username, $email, $password,$key){
    $conn = GetCon($key);
    if ($key === "sql") {
    $sql = "INSERT INTO kliens(username, email, password, valasz_id) VALUES ('$username', '$email', '$password', null)";

    if ($conn->query($sql) === TRUE) {
        echo "New client created successfully". PHP_EOL;
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error . PHP_EOL;
    }
}elseif ($key === "mongodb") {
    $mongoDB = $conn->selectCollection("kliens");

    // Ellenőrizzük, hogy a felhasználónév vagy az email már szerepel-e az adatbázisban
    $existingClient = $mongoDB->findOne([
        '$or' => [
            ["username" => $username],
            ["email" => $email]
        ]
    ]);

    if ($existingClient) {
        echo "A felhasználónév vagy az email már szerepel az adatbázisban." . PHP_EOL;
        return;
    }

    $document = [
        "username" => $username,
        "email" => $email,
        "password" => $password,
        "valasz_id" => null
    ];

    try {
        $result = $mongoDB->insertOne($document);

        if ($result->getInsertedCount() > 0) {
            echo "New client created successfully" . PHP_EOL;
        } else {
            echo "Error inserting client" . PHP_EOL;
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . PHP_EOL;
    }
}
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

function getClientByEmail($email,$key){
    $conn = GetCon($key);
    if ($key === "sql") {
    $sql = "SELECT id, username, email, password, valasz_id FROM kliens WHERE email LIKE '$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ret = "id: " . $row["id"]. " - username: " . $row["username"]. " - email: " . $row["email"] . " - password: " . $row["password"] . "<br>";
    } else {
        $ret = "Client not found!";
    }

    // CloseCon($conn);
    return $ret;
} elseif ($key === "mongodb") {
    $mongoDB = $conn->selectCollection("kliens");

    $query = array("email" => $email);
    $result = $mongoDB->findOne($query);

    if ($result) {
        $ret = "id: " . $result["_id"] . " - username: " . $result["username"] . " - email: " . $result["email"] . " - password: " . $result["password"] . "<br>";
    } else {
        $ret = "Client not found!";
    }

    return $ret;
}
}

function updatePassword($email,$password,$key){
    $conn = GetCon($key);
    if ($key === "sql") {
        $sql = "UPDATE kliens SET password = '$password' WHERE email = '$email'";
        
        if ($conn->query($sql) === TRUE) {
            echo "Password updated successfully" . PHP_EOL;
        } else {
            echo "Error updating password: " . $conn->error . PHP_EOL;
        }
    }
    elseif ($key === "mongodb") {
        $mongoDB = $conn->selectCollection("kliens");
        
        // Ellenőrizzük, hogy a megadott email szerepel-e az adatbázisban
        $existingClient = $mongoDB->findOne(["email" => $email]);
        
        if (!$existingClient) {
            echo "Client not found!" . PHP_EOL;
            return;
        }
        
        $updateResult = $mongoDB->updateOne(
            ["email" => $email],
            ['$set' => ["password" => $password]]
        );
        
        if ($updateResult->getModifiedCount() > 0) {
            echo "Password updated successfully" . PHP_EOL;
        } else {
            echo "Error updating password" . PHP_EOL;
        }
    }
    else{
        echo "Error modifying the password!";
    }
}


?>