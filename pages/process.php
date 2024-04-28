<?php
include "szavazat.php";
include "kliens.php";
echo "Sikerult";
/*echo '<pre>';
print_r($_POST);
echo '</pre>';
*/
session_start();

//kulcs logika
$databases = array('sql', 'mongodb');
$databaseCount = count($databases);


$lastDatabaseIndex = $_SESSION['last_database_index'] ?? -1;


$nextDatabaseIndex = ($lastDatabaseIndex + 1) % $databaseCount;

$databaseType = $databases[$nextDatabaseIndex];
$_SESSION['last_database_index'] = $nextDatabaseIndex;

if ($databaseType === 'sql') {
    $key = 'sql';
} elseif ($databaseType === 'mongodb') {
    $key = 'mongodb';
}
$key = 'sql';
$_SESSION['db_key']=$key;

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
        //$result = getClientByEmail($email,'sql');
        //echo $result;
        //$result='Client not found!';
        //echo $result;
        $curl = curl_init();
        $url = "http://192.168.0.179:5001/db/getclientbyemail?email=".$email."&key=".$key;

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);

        $tmp = trim($response);
        echo $tmp;
        if($tmp != "Client not found!"){

            $tmp = explode(' - ',$response);
            $result = [];

            foreach ($tmp as $line) {
            $parts = explode(':', $line);
            $key_ = trim($parts[0]);
            $value = trim($parts[1]);
            $result[$key_] = $value;
        }
        }
        else{
            $result =  "Client not found!";
        }
        echo "<pre>";
        print_r($result);
        echo "</pre>";
        if($result == "Client not found!")
        {
            $emailFound = false;
            $passwordFound = false;
        }
        else{
            $emailFound = true;
            echo "<pre>".$result['password'] . "</pre>";
            echo "<pre>".$password . "</pre>";
            if(trim(strip_tags($result['password'])) == trim(strip_tags($password)))
            {
                $passwordFound = true;
            }
            else
            {
                echo "akkor erre";
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
        session_start();
        $_SESSION['error'] = $error;
        file_put_contents("error.txt", $error, FILE_APPEND | LOCK_EX);
        header("Location: pages/registration_form.html");
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
        $curl = curl_init();
        $url = "http://192.168.0.179:5001/db/getclientbyemail?email=".$email."&key=".$key;

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);

        $tmp = trim($response);
        echo $tmp;
        if($tmp != "Client not found!"){

            $tmp = explode(' - ',$response);
            $result = [];

            foreach ($tmp as $line) {
            $parts = explode(':', $line);
            $key_ = trim($parts[0]);
            $value = trim($parts[1]);
            $result[$key_] = $value;
        }
        }
        else{
            $result =  "Client not found!";
        }

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

            foreach ($_POST as $key_ => $value) {
                $data = PHP_EOL . $key_ . ": " . $value . PHP_EOL;
                file_put_contents(
                    "login_data.txt",
                    $data,
                    FILE_APPEND | LOCK_EX
                );
            }
            $data = PHP_EOL . ";;" . PHP_EOL;
            file_put_contents("login_data.txt", $data, FILE_APPEND | LOCK_EX);
            $curl = curl_init();
            $name =urlencode($_POST['Nev']);
            $url = "http://192.168.0.179:5001/db/postNewClient?username=".$name."&email=".$email."&password=".$password."&key=".$key;

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($curl);
            curl_close($curl);

            $error = "Sikeres Regisztracio". PHP_EOL . ";;" . PHP_EOL;
            session_start();
            $_SESSION['error'] = $error;
            file_put_contents("error.txt", $error, FILE_APPEND | LOCK_EX);
            header("Location: pages/registration_form.html");
            exit();
        } else {
            $error = "Sikertelen regisztráció, az adott felhasználó létezik már a rendszerben". PHP_EOL . ";;" . PHP_EOL;
            session_start();
            $_SESSION['error'] = $error;
            file_put_contents("error.txt", $error, FILE_APPEND | LOCK_EX);
            header("Location: pages/registration_form.html");
            exit();
        }
    } elseif (isset($_POST["Send"])) {
        echo "Forgot Password";
        $to = $_POST["email"];
        $receiver = $_POST["email"];
        $subject = "Jelszó helyreállítása";
        $body = "Az adott email címre jelszó helyreállítási kérelem történt,
        amennyiben ön kérvényezte az alábbi linken lévő utasításokkal tudja megváltoztatni a jelszavát
        http://5.15.42.150:5000/reset_password_form.html";
        $sender = "osztottprojekt@gmail.com";
        if (mail($receiver, $subject, $body, $sender)) {
            $error = "Az e-mail sikeresen elküldve.". PHP_EOL;
            session_start();
            $_SESSION['error'] = $error;
            $_SESSION['email'] = $_POST["email"];
            file_put_contents("error.txt", $error, FILE_APPEND | LOCK_EX);
            echo "Az e-mail sikeresen elküldve.";
        } else {
            $error = "Hiba történt az e-mail küldésekor." . PHP_EOL;
            session_start();
            $_SESSION['error'] = $error;
            file_put_contents("error.txt", $error, FILE_APPEND | LOCK_EX);
            echo "Hiba történt az e-mail küldésekor.";
        }

        header("Location: pages/registration_form.html");
        exit();
    } elseif ($adress[$lastIndex] == "pages/reset_password_form.html") {
        session_start();

        if (isset($_SESSION["email"])) {
        echo $_SESSION['email'] . " " . $_POST['password'];
        $curl = curl_init();
        $url = "http://192.168.0.179:5001/db/updatePassword?email=".$_SESSION['email']."&password=".$_POST['password']."&key=".$key;

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);



        $error = "Jelszó sikeresen helyreállítva";
        $_SESSION['error'] = $error;
        echo $_SESSION['error'];
        }
        header("Location: registration_form.html");
        exit();
    } elseif ($adress[$lastIndex] == "pages/form.php") {
        session_start();
        echo "Form";

        echo '<pre>';
        print_r($_POST);
        echo '</pre>';

        $response = getClientByEmail($_SESSION['username'],$key);
        $tmp = explode(' - ',$response);
            $result = [];

            foreach ($tmp as $line) {
            $parts = explode(':', $line);
            $key_ = trim($parts[0]);
            $value = trim($parts[1]);
            $result[$key_] = $value;
            }
        echo '<pre>';
        print_r($result);
        echo '</pre>';

        echo record_vote($_POST['question_id'],$result['username'],$_POST['answer'],$_POST['question'],$key);
        $curl = curl_init();
        $user = urlencode($result['username']);
        $answer = urlencode($_POST['answer']);
        $question = urlencode($_POST['question']);
        $url = "http://127.0.0.1:5000/kijelzo/update?nev=".$user."&szavazat=".$answer."&kerdes=".$question;

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);


        $data = PHP_EOL . "IP" . ": " . $_SERVER["REMOTE_ADDR"] . PHP_EOL;
        file_put_contents("question_answer.txt", $data, FILE_APPEND | LOCK_EX);

        foreach ($_POST as $key_ => $value) {
            //echo "<p><strong>{$key}:</strong> {$value}</p>";
            $data = PHP_EOL . $key_ . ": " . $value . PHP_EOL;
            file_put_contents("question_answer.txt", $data, FILE_APPEND | LOCK_EX);
        }
        $_SESSION['errors'] = "Válasza sikeresen rögzítve lett";
        header("Location: pages/form.php");
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
            include "pages/szavazat.php";
            include "pages/kerdes.php";
            postNewQuestion($value,$_SESSION['db_key']);
        }
        $_SESSION['errors'] = "Sikeresen létre hozott egy új kérdést";
        echo $_SESSION['errors'];
        header("Location: pages/form.php");
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
