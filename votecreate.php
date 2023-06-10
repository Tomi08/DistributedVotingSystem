<!DOCTYPE html>
<html>
<head>

    <title>Szavazás készitése</title>
    <link href="form_style.css" rel="stylesheet" type="text/css">
    <script src="votecreate.js"></script>
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
    <h2>Szavazás készitése</h2>
    <?php
    session_start();
    if(!isset($_SESSION['username']))
    {
        header("Location: registration_form.html");
        exit();
    }

    echo '<div id="formdiv">';
    echo '<form id="eredmeny" action="process.php" method="POST">';
    echo '<label> Adj meg egy kérdést </label><br>';
    echo '<input type="text" name="ezakerdes"';
    
    echo '<br><button id="gomb" type="submit">Küldés</button>';
    echo '<br></form>';
    echo '<br><br>';
    echo '</div>';

    ?>
    </div>

</body>
</html>