<!DOCTYPE html>
<html>
<head>

    <title>Szavazás állása</title>
    <link href="form_style.css" rel="stylesheet" type="text/css">
    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: left;
        }

        li.right {
            float: right;
        }


        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover {
            background-color: #111;
        }
    </style
</head>
<body>
    
    <ul>
        <li><a href="form.php">Kezdőlap</a></li>
        <li><a href="vote.php">Szavazás állása</a></li>
        <li><a href="votecreate.php">Szavazás készitése</a></li>
        
        <li class="right"><a href="logout.php">Kijelentkezés</a></li>
        <li class="right"><a href="prfoil.php">Beállítások</a></li>
        <li class="right"><a href="profil.php">Profil</a></li>
    </ul>
    <div class="centered">
    <h2>Szavazás állása</h1>
    <?php
    session_start();
    if(!isset($_SESSION['username']))
    {
        header("Location: registration_form.html");
        exit();
    }
    echo "Eddigi szavazatok szama : ";

    $dbhost = "192.168.1.162";
    $dbuser = "aporka";
    $dbpass = "nehezjelszo";
    $db = "aporka";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n". $conn -> error);

    if(!($conn -> error)){
        echo "Succesfuly connected to the database!";
    }

    // $sql = "SELECT count(*) FROM  szavazatok";
    $sql = "SELECT kerdes, szavazoNeve, valasz FROM szavazatok";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // $ret = "id: " . $row["id"]. " - username: " . $row["username"]. " - email: " . $row["email"] . " - password: " . $row["password"] . "<br>";
        // echo $row["count(*)"];
        echo $row["kerdes"], $row["szavazoNeve"], $row["valasz"];
    } else {
        echo "Client not found!";
    }


    ?>
    </div>


</body>
</html>