<?php

echo "NA";

function OpenCon(){
    $dbhost = "localhost";
    $dbuser = "aporka";
    $dbpass = "nehezjelszo";
    $db = "ORProjekt_Szavazatok";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

    if(!($conn -> error)){
        echo "Succesfuly connected to the database!";
    }

    return $conn;
}
 
function CloseCon($conn){
    $conn -> close();
}
?>