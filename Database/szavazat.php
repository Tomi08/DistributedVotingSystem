
<?php


include "connection.php";
//POST
//UJ SZAVAZAT LETREHOZASA
function record_vote($kerdes_id,$voter_name, $vote, $kerdes,$key){
    $conn = GetCon($key);
    if ($key === "sql") {
    $sql = "INSERT INTO szavazatok (kerdes_id,szavazoNeve, valasz,kerdes ) VALUES ('$kerdes_id', '$voter_name', '$vote','$kerdes')";

    if ($conn->query($sql) === TRUE) {
        echo "Vote created successfully". PHP_EOL;
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error . PHP_EOL;
    }

    // Close_con($conn);
}
elseif ($key === "mongodb") {
    $mongoDB = $conn->selectCollection("szavazatok");

    $document = array(
        "kerdes_id" => $kerdes_id,
        "szavazoNeve" => $voter_name,
        "valasz" => $vote,
        "kerdes" => $kerdes
    );

    try {
        $result = $mongoDB->insertOne($document); // Insert into MongoDB

        if ($result->getInsertedCount() > 0) {
            echo "Vote created successfully" . PHP_EOL;
        } else {
            echo "Error creating vote" . PHP_EOL;
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . PHP_EOL;
    }
}
}

//GET
//SZAVAZAT LEKERESE SZAVAZO NEVE ALAPJAN
function get_vote_by_voter($voter_name,$key){
    $conn = GetCon($key);
    if ($key === "sql") {
    $sql = "SELECT szavazoNeve, szavazat FROM szavazatok WHERE szavazoNeve = $voter_name";
    $result = $conn->query($sql);

    if ($result) {
        return "Szavazo: " . $result[0] . ", Szavazat: " . $result[1];
    } else {
        return "No vote found for the specified voter.";
    }

    // Close_con($conn);
}
elseif ($key === "mongodb") {
    $mongoDB = $conn->selectCollection("szavazatok");

    $query = array("szavazoNeve" => $voter_name);
    $result = $mongoDB->findOne($query);

    if ($result) {
        return "Szavazo: " . $result["szavazoNeve"] . ", Szavazat: " . $result["valasz"];
    } else {
        return "No vote found for the specified voter.";
    }
}
}



/// Kérdések válaszainak százalékos eloszlásának lekérése
function get_question_answer_percentages($key) {
    $conn = GetCon($key);
    if ($key === "sql") {
    $sql = "SELECT kerdes, valasz, (COUNT(*) / (SELECT COUNT(*) FROM szavazatok WHERE kerdes = s.kerdes)) * 100 AS szazalek
            FROM szavazatok s
            GROUP BY kerdes, valasz";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $questionAnswerPercentages = array();

        while ($row = $result->fetch_assoc()) {
            $kerdes = $row['kerdes'];
            $valasz = $row['valasz'];
            $szazalek = $row['szazalek'];

            if (!isset($questionAnswerPercentages[$kerdes])) {
                $questionAnswerPercentages[$kerdes] = array();
            }

            $questionAnswerPercentages[$kerdes][$valasz] = $szazalek;
        }

        return $questionAnswerPercentages;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

}
elseif ($key === "mongodb") {
    $mongoDB = $conn->selectCollection("szavazatok");

    $pipeline = array(
        array(
            '$group' => array(
                '_id' => array('kerdes' => '$kerdes', 'valasz' => '$valasz'),
                'count' => array('$sum' => 1)
            )
        ),
        array(
            '$group' => array(
                '_id' => '$_id.kerdes',
                'valaszok' => array(
                    '$push' => array(
                        'valasz' => '$_id.valasz',
                        'count' => '$count'
                    )
                ),
                'total' => array('$sum' => '$count')
            )
        ),
        array(
            '$project' => array(
                '_id' => 0,
                'kerdes' => '$_id',
                'valaszok' => 1,
                'total' => 1
            )
        )
    );

   return $result = $mongoDB->aggregate($pipeline);

    
}
}

function kiiratas_szazalekos_arany($result,$key){
    if ($key === "sql") {
    foreach ($result as $kerdes => $valaszok) {
    echo "Kérdés: " . $kerdes . "<br>";

    foreach ($valaszok as $valasz => $szazalek) {
        echo "Válasz: " . $valasz . "<br>";
        echo "Százalékos arány: " . $szazalek . "%<br>";
        echo "<br>";
    }
}
}elseif ($key === "mongodb") {
    // Eredmények kiíratása
    foreach ($result as $doc) {
    $kerdes = $doc['kerdes'];
    $valaszok = $doc['valaszok'];
    $total = $doc['total'];
    echo "<pre>";
    echo "Kérdés: $kerdes" . PHP_EOL;
  
    foreach ($valaszok as $valasz) {
        $valaszText = $valasz['valasz'];
        $count = $valasz['count'];
        $szazalek = round(($count / $total) * 100,2);
  
        echo "Válasz: $valaszText - Százalék: $szazalek%" . PHP_EOL;
    }
  
    echo PHP_EOL;
    echo "</pre>";
  }
}
}


?>