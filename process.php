<?php
echo 'Sikerult';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "<h2>Beérkező adatok:</h2>";

    $fromwhere = $_SERVER['HTTP_REFERER'];

    $adress = explode('/', $fromwhere);
    $lastIndex = count($adress) - 1;
    
    //echo $adress[$lastIndex];

    if($_POST['Login'] == "Login"){
        session_start();
        $database = file('login_data.txt', FILE_IGNORE_NEW_LINES);
        $email = $_POST['email'];
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $password = $_POST['password'];
        $emailFound = false;
        $passwordFound = false;
        echo $email ;
        foreach ($database as $line) {
            echo $line . '<br>';
            if(!empty(trim($line))){
                $data = explode(': ',$line);    
                echo $data[1];
                if($data[0] === 'email' && $data[1] === $email){
                    echo "<br>Email megtalalva";
                    $emailFound = true;
                }
                if($data[0] === 'password' && $data[1] === $password){
                    echo "<br>Jelszo megtalalva";
                    $passwordFound = true;
                }
                
              }
            
       
        }
    
        
        if ($emailFound && $passwordFound) {
            file_put_contents('error.txt','');
            //$_SESSION['user_id'] = $loggedInUserId;
            $_SESSION['username'] = $_POST['email'];;
            header("Location: form.php");
            exit();
          
        } elseif (!$emailFound) {
            $error = "Hibás felhasználónév";
        }
        elseif(!$passwordFound){
            $error = "Hibás jelszó";
        }
        else{
            $error = "Hibás felhasználónév vagy jelszó!";
        }
        
        file_put_contents('error.txt', $error, FILE_APPEND | LOCK_EX);
        header("Location: login_form.html");
    }


    elseif($_POST['Register'] == "Register"){
        echo "Registration";
        
        
        $database = file('login_data.txt', FILE_IGNORE_NEW_LINES);
        $email = $_POST['email'];
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $password = $_POST['password'];
        $emailFound = false;
        $passwordFound = false;

        
        foreach ($database as $line) {
            echo $line . '<br>';
            if(!empty(trim($line))){
                $data = explode(': ',$line);    
                echo $data[1];
                if($data[0] === 'email' && $data[1] === $email){
                    echo "<br>Email megtalalva";
                    $emailFound = true;
                }
                if($data[0] === 'password' && $data[1] === $password){
                    echo "<br>Jelszo megtalalva";
                    $passwordFound = true;
                }
                
              }
            
       
        }
        if(!$passwordFound && !$emailFound){
        $data = PHP_EOL . ";;" .PHP_EOL .  'IP' . ': ' . $_SERVER['REMOTE_ADDR'] . PHP_EOL;
        file_put_contents('data.txt', $data, FILE_APPEND | LOCK_EX);

        foreach ($_POST as $key => $value) {
            $data = PHP_EOL .  $key . ': ' . $value  . PHP_EOL;
            file_put_contents('login_data.txt', $data, FILE_APPEND | LOCK_EX);
        }
        $data = PHP_EOL . ";;" .PHP_EOL ;
        file_put_contents('data.txt', $data, FILE_APPEND | LOCK_EX);

           header("Location: registration_form.html");
           exit();
        }
        
        else{
            header("Location: registration_form.html");
            exit();
        }
    }


    elseif($_POST['Send'] == "Send"){
        echo "Forgot Password";
        $to = $_POST['email'];
        $receiver = $_POST['email'];
        $subject = "Jelszó helyreállítása";
        $body = "Az adott email címre jelszó helyreállítási kérelem történt,
         amennyiben ön kérvényezte az alábbi linken lévő utasításokkal tudja megváltoztatni a jelszavát
         http://localhost:80/reset_password_form.html";
        $sender = "osztottprojekt@gmail.com";
        if(mail($receiver, $subject, $body, $sender)){
            echo 'Az e-mail sikeresen elküldve.';
        }else{
            echo 'Hiba történt az e-mail küldésekor.';
        }
      
        header("Location: registration_form.html");
        exit();
    }
    elseif($adress[$lastIndex] == "reset_password_form.html"){
        header("Location: login_form.html");
        exit();
    }

    
    elseif($adress[$lastIndex] == "form.php"){
        echo "Form";

        $data = PHP_EOL .  'IP' . ': ' . $_SERVER['REMOTE_ADDR'] . PHP_EOL;
        file_put_contents('data.txt', $data, FILE_APPEND | LOCK_EX);
        
        foreach ($_POST as $key => $value) {
            //echo "<p><strong>{$key}:</strong> {$value}</p>";
            $data = PHP_EOL .  $key . ': ' . $value  . PHP_EOL;
            file_put_contents('data.txt', $data, FILE_APPEND | LOCK_EX);
           }
        
        header("Location: form.php");
        exit();
    }
   




}

if (!empty($errors)) {
    // Továbbítás az űrlapra és hibaüzenetek megjelenítése
    session_start();
    $_SESSION["errors"] = $errors;
    header("Location: form.php");
    exit;
}
?>