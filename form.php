<!DOCTYPE html>
<html>
<head>
    <title>Kérdőív</title>
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
        
        
        <li class="right"><a href="registration_form.html">Kijelentkezés</a></li>
        <li class="right"><a href="settings.php">Beállítások</a></li>
        <li class="right"><a href="profil.php">Profil</a></li>
    </ul>
    <h2>Kérdőív</h2>
    <?php
    session_start();
    echo $_SESSION['username'];
    if (isset($_SESSION["errors"])) {
        foreach ($_SESSION["errors"] as $error) {
            echo "<p>$error</p>";
        }
        unset($_SESSION["errors"]);
    }
    ?>
    <form action="process.php" method="POST">
        <?php include "form_generator.php"; ?>
        <button type="submit">Küldés</button>
    </form>
</body>
</html>
