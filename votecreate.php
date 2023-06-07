<!DOCTYPE html>
<html>
<head>

    <title>Szavazás készitése</title>
    <link href="registration_form_style.css" rel="stylesheet" type="text/css">
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
    <h2>Szavazás állása</h1>
    <?php
    session_start();
    if(!isset($_SESSION['username']))
    {
        header("Location: registration_form.html");
        exit();
    }
    echo "Eddigi szavazatok szama : "

    ?>

</body>
</html>