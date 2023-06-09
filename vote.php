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
    <div>
    <ul>
        <li><a href="form.php">Kezdőlap</a></li>
        <li><a href="vote.php">Szavazás állása</a></li>
        <li><a href="votecreate.php">Szavazás készitése</a></li>
        
        <li class="right"><a href="logout.php">Kijelentkezés</a></li>
        <li class="right"><a href="prfoil.php">Beállítások</a></li>
        <li class="right"><a href="profil.php">Profil</a></li>
    </ul>
    </div>
    <div class="centered">
    <h2>Szavazás állása</h2>
    <?php include "szavazat.php"; ?>
   
    
    <?php
    session_start();
    
    $questionAnswerPercentages = get_question_answer_percentages();

    // Eredmények kiíratása

    foreach ($questionAnswerPercentages as $kerdes => $valaszok) {
    
    echo '<div class="szavazasok">';
    echo '<label>' .  $kerdes . '</label>';

    foreach ($valaszok as $valasz => $szazalek) {
        echo "<br>Válasz: " . $valasz . "<br>";
        echo "Százalékos arány: " . $szazalek . "%<br>";
        echo '<br>';  
    }
    echo '</div>';
    echo '<br><br>';
    } 
    ?>
    </div>


</body>
</html>