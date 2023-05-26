<?php
require 'vendor/autoload.php'; // MongoDB PHP driver betöltése

// MongoDB kapcsolat inicializálása
function getMongoDBConnection() {
    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    return $mongoClient->selectDatabase("votes");
}

// UJ KLIENS LETREHOZASA
function postNewClient($username, $email, $password) {
    $mongoDB = getMongoDBConnection();

    $collection = $mongoDB->selectCollection("kliens");

    $document = array(
        "username" => $username,
        "email" => $email,
        "password" => $password,
        "valasz_id" => null
    );

    $result = $collection->insertOne($document);

    if ($result->getInsertedCount() === 1) {
        echo "New client created successfully";
    } else {
        echo "Error creating client";
    }
}

// KLIENS LEKERESE ID ALAPJAN
function getClientById($id) {
    $mongoDB = getMongoDBConnection();

    $collection = $mongoDB->selectCollection("kliens");

    $filter = array("_id" => new MongoDB\BSON\ObjectId($id));

    $result = $collection->findOne($filter);

    if ($result) {
        $ret = "id: " . $result["_id"]. " - username: " . $result["username"]. " - email: " . $result["email"] . " - password: " . $result["password"] . "<br>";
    } else {
        $ret = "Client not found!";
    }

    return $ret;
}

// KLIENS LEKERESE EMAIL ALAPJAN
function getClientByEmail($email) {
    $mongoDB = getMongoDBConnection();

    $collection = $mongoDB->selectCollection("kliens");

    $filter = array("email" => $email);

    $result = $collection->findOne($filter);

    if ($result) {
        $ret = "id: " . $result["_id"]. " - username: " . $result["username"]. " - email: " . $result["email"] . " - password: " . $result["password"] . "<br>";
    } else {
        $ret = "Client not found!";
    }

    return $ret;
}
?>
