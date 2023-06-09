/* 
// if(!isset($_SESSION['username']))
// {
    // header("Location: registration_form.html");
    // exit();
// }
// echo "Eddigi szavazatok szama : "; */

/* // $dbhost = "192.168.1.162";
// $dbuser = "aporka";
// $dbpass = "nehezjelszo";
// $db = "aporka";
// $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n". $conn -> error);

// if(!($conn -> error)){
//     echo "Succesfuly connected to the database!";
// } */


/* // $sql = "SELECT count(*) FROM  szavazatok";
    // $sql = "SELECT kerdes, szavazoNeve, valasz FROM szavazatok";

    // $result = $conn->query($sql);

    // if ($result->num_rows > 0) {
    //     $row = $result->fetch_assoc();
    //     // $ret = "id: " . $row["id"]. " - username: " . $row["username"]. " - email: " . $row["email"] . " - password: " . $row["password"] . "<br>";
    //     // echo $row["count(*)"];
    //     echo $row["kerdes"], $row["szavazoNeve"], $row["valasz"];
    // } else {
    //     echo "Client not found!";
    // } */



    foreach ($questionAnswerPercentages as $kerdes => $valaszok) {
    echo '<div class = "szavazasok">';
    
    // echo '<div class="kerdes">';
    
    
    // echo "Kérdés: " . $kerdes . "<br>";
    
    echo '<label>' .  $kerdes . '</label><br><br>';

    foreach ($valaszok as $valasz => $szazalek) {
        echo "Válasz: " . $valasz . "<br>";
        echo "Százalékos arány: " . $szazalek . "%<br>";
        echo '<br>';  
    }
    echo '</div>';
    echo '<br><br>';
    }
     ?>