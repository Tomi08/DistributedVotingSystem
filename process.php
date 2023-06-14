<?php
include "szavazat.php";
include "kliens.php";
echo "Sikerult";
/*echo '<pre>';
print_r($_POST);
echo '</pre>';
*/

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "<h2>Beérkező adatok:</h2>";

    $fromwhere = $_SERVER["HTTP_REFERER"];

    $adress = explode("/", $fromwhere);
    $lastIndex = count($adress) - 1;

    //echo $adress[$lastIndex];

    if (isset($_POST["Login"])) {
        
        $database = file("login_data.txt", FILE_IGNORE_NEW_LINES);
        $ipAddress = $_SERVER["REMOTE_ADDR"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $emailFound = false;
        $passwordFound = false;
        //echo $email;
        /*foreach ($database as $line) {
            echo $line . "<br>";
            if (!empty(trim($line))) {
                $data = explode(": ", $line);
                //echo $data[1];
                if ($data[0] === "email" && $data[1] === $email) {
                    echo "<br>Email megtalalva";
                    $emailFound = true;
                }
                if(trim($line) === ";;" && $emailFound && !$passwordFound){
                    $foundUser= false;
                    $passwordFound = false;
                    
                }
                if ($data[0] === "password" && $data[1] === $password) {
                    echo "<br>Jelszo megtalalva";
                    $passwordFound = true;
                }
            }
        }
        */
        $result = getClientByEmail($email);
        //echo $email . " " . $password . PHP_EOL;
        //print_r($result);
        if($result == "Client not found!")
        {   
            $emailFound = false;
            $passwordFound = false;
        }
        else{
            $emailFound = true;
            if($result['password'] == $password)
            {
                $passwordFound = true;
               
                
            }
            else
            {
                
                $passwordFound = false;
            }
        }

       if ($emailFound && $passwordFound) {
            session_start();
            file_put_contents("error.txt", "");
            //$_SESSION['user_id'] = $loggedInUserId;
            $_SESSION["username"] = $_POST["email"];
            header("Location: form.php");
            exit();
        } elseif (!$emailFound) {
            $error = "Hibás felhasználónév" . PHP_EOL . ";;" . PHP_EOL;
        } elseif (!$passwordFound) {
            $error = "Hibás jelszó" . PHP_EOL . ";;" . PHP_EOL;
        } else {
            $error = "Hibás felhasználónév vagy jelszó!" . PHP_EOL . ";;" . PHP_EOL;
        }
        
        file_put_contents("error.txt", $error, FILE_APPEND | LOCK_EX);
        header("Location: registration_form.html");
    } elseif (isset($_POST["Register"])) {
        echo "Registration";

        $database = file("login_data.txt", FILE_IGNORE_NEW_LINES);
        $email = $_POST["email"];
        $ipAddress = $_SERVER["REMOTE_ADDR"];
        $password = $_POST["password"];
        $emailFound = false;
        $passwordFound = false;

        /*foreach ($database as $line) {
            //echo $line . "<br>";
            if (!empty(trim($line))) {
                $data = explode(": ", $line);
                //echo $data[1];
                if ($data[0] === "email" && $data[1] === $email) {
                    echo "<br>Email megtalalva";
                    $emailFound = true;
                    break;
                }
               
            }
        }*/

        $result = getClientByEmail($email);

        if($result == "Client not found!")
        {   
            $emailFound = false;
            
        }
        else{
            $emailFound = true; 
        }
        print_r($result);
        echo $emailFound;
        if (!$emailFound) {
            
            $data =
                PHP_EOL .
                ";;" .
                PHP_EOL .
                "IP" .
                ": " .
                $_SERVER["REMOTE_ADDR"] .
                PHP_EOL;
            file_put_contents("login_data.txt", $data, FILE_APPEND | LOCK_EX);

            foreach ($_POST as $key => $value) {
                $data = PHP_EOL . $key . ": " . $value . PHP_EOL;
                file_put_contents(
                    "login_data.txt",
                    $data,
                    FILE_APPEND | LOCK_EX
                );
            }
            $data = PHP_EOL . ";;" . PHP_EOL;
            file_put_contents("login_data.txt", $data, FILE_APPEND | LOCK_EX);
            
            postNewClient($_POST['Nev'], $email, $password);
            $error = "Sikeres Regisztracio". PHP_EOL . ";;" . PHP_EOL;
            file_put_contents("error.txt", $error, FILE_APPEND | LOCK_EX);
            header("Location: registration_form.html");
            exit();
        } else {
            $error = "Sikertelen regisztráció, az adott felhasználó létezik már a rendszerben". PHP_EOL . ";;" . PHP_EOL;
            file_put_contents("error.txt", $error, FILE_APPEND | LOCK_EX);
            header("Location: registration_form.html");
            exit();
        }
    } elseif (isset($_POST["Send"])) {
        session_start();
        $_SESSION['email']=$_POST["email"];

        echo "Forgot Password";
        $to = $_POST["email"];
        $receiver = $_POST["email"];
        $subject = "Jelszó helyreállítása";
        $body = "Az adott email címre jelszó helyreállítási kérelem történt,
         amennyiben ön kérvényezte az alábbi linken lévő utasításokkal tudja megváltoztatni a jelszavát
         http://localhost:80/reset_password_form.html";
        $sender = "osztottprojekt@gmail.com";
        if (mail($receiver, $subject, $body, $sender)) {
            $error = "Az e-mail sikeresen elküldve.". PHP_EOL;
            file_put_contents("error.txt", $error, FILE_APPEND | LOCK_EX);
            echo "Az e-mail sikeresen elküldve.";
        } else {
            $error = "Hiba történt az e-mail küldésekor." . PHP_EOL;
            file_put_contents("error.txt", $error, FILE_APPEND | LOCK_EX);
            echo "Hiba történt az e-mail küldésekor.";
        }

        header("Location: registration_form.html");
        exit();
    } elseif ($adress[$lastIndex] == "reset_password_form.html") {
        session_start();
        if (isset($_SESSION["errors"])) {
        echo $_SESSION['email'];
        updatekliens($_SESSION['email'],$_POST['password']);
        }
        header("Location: registration_form.html");
        exit();
    } elseif ($adress[$lastIndex] == "form.php") {
        session_start();
        echo "Form";

        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        
        //echo $_SESSION['username'];
        
        $result = getClientByEmail($_SESSION['username']);
        
        echo '<pre>';
        print_r($result);
        echo '</pre>';
        
        record_vote($_POST['question_id'],$result['username'],$_POST['answer'],$_POST['question']);

        $data = PHP_EOL . "IP" . ": " . $_SERVER["REMOTE_ADDR"] . PHP_EOL;
        file_put_contents("question_answer.txt", $data, FILE_APPEND | LOCK_EX);

        foreach ($_POST as $key => $value) {
            //echo "<p><strong>{$key}:</strong> {$value}</p>";
            $data = PHP_EOL . $key . ": " . $value . PHP_EOL;
            file_put_contents("question_answer.txt", $data, FILE_APPEND | LOCK_EX);
        }
        $_SESSION['errors'] = "Válasza sikeresen rögzítve lett";
        header("Location: form.php");
        exit();
    }
    elseif ($adress[$lastIndex] == "votecreate.php") {
        session_start();
        echo "Create vote";

        $data = PHP_EOL . "IP" . ": " . $_SERVER["REMOTE_ADDR"] . PHP_EOL;
        file_put_contents("questions.txt", $data, FILE_APPEND | LOCK_EX);

        foreach ($_POST as $key => $value) {
            //echo "<p><strong>{$key}:</strong> {$value}</p>";
            $data = PHP_EOL . $key . ": " . $value . PHP_EOL;
            file_put_contents("questions.txt", $data, FILE_APPEND | LOCK_EX);
            recordQuestion($value);
        }
        $_SESSION['errors'] = "Sikeresen létre hozott egy új kérdést";
        echo $_SESSION['errors'];
        header("Location: form.php");
        exit();
    }
}

/*if (!empty($errors)) {
    // Továbbítás az űrlapra és hibaüzenetek megjelenítése
    session_start();
    $_SESSION["errors"] = $errors;
    //header("Location: form.php");
    //exit();
}*/
?>
