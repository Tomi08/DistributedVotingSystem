<!DOCTYPE html>
<html>
<head>
    <title>Kérdőív</title>
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
        p { 
            
            color: green;
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
        <li class="right"><a href="profil.php">Beállítások</a></li>
        <li class="right"><a href="profil.php">Profil</a></li>
    </ul>
    <div>
    <div class="centered">
    <h2>Kérdőív</h2>
    <?php
    session_start();
    // echo $_SESSION['username'];
    
    if(!isset($_SESSION['username']))
    {
        header("Location: registration_form.html");
        exit();
    }
   
    if (isset($_SESSION["errors"])) {
        
            echo '<p>' . $_SESSION["errors"] . '</p>';
        
        unset($_SESSION["errors"]);
    }
    ?>
    <?php include "szavazat.php"; ?>
    <?php include "form_generator.php"; ?>
    </div>  
</body>
</html>
