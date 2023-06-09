<!DOCTYPE html>
<html>
<head>
    
    <title>Profil oldal</title>
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
        <li class="right"><a href="profil.php">Beállítások</a></li>
        <li class="right"><a href="profil.php">Profil</a></li>
    </ul>
    </div>
    <h2>Profil</h2>
    <?php
    session_start();

    if(!isset($_SESSION['username']))
    {
        header("Location: registration_form.html");
        exit();
    }
    // Fájl beolvasása
    //$file = fopen('login_data.txt','r');
    $database = file('login_data.txt', FILE_IGNORE_NEW_LINES);
    // Felhasználói adatok keresése
    $loggedInUsername = $_SESSION['username']; // Bejelentkezett felhasználó neve
    $userData = array();
    $foundUser = false;

    foreach ($database as $line) {
        //echo $line . '<br>';
        if(!empty(trim($line))){
            $data = explode(': ',$line);    
            //echo $data[1];
            //echo "<p>" . $line . "</p>";
            if($data[0] === 'email' && $data[1] === $loggedInUsername){
                
                //echo "<br>Email megtalalva";
                $foundUser = true;
                
            }
            if(trim($line) === ";;" && $foundUser){
                $foundUser= false;
                
            }
            if($foundUser ){
                
                $userData[$data[0]] = $data[1];
              
            }
           
        
          }
        
   
    }


   


    

    // Felhasználói adatok kiírása
    
    if (!empty($userData)) {
        echo "<p>Név: " . $userData['Nev'] . "</p>";
        echo "<p>Email: " . $userData['email'] . "</p>";
        echo "<p>Jelszó: " . $userData['password'] . "</p>";
        // További adatok kiírása...
    } else {
        echo "<p>A felhasználói adatok nem találhatók.</p>";
    }
    ?>

    <!-- További tartalom a profil oldalon -->
</body>
</html>