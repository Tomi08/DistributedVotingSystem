<?php

/*$inipath = php_ini_loaded_file();

if ($inipath) {
    echo 'Loaded php.ini: ' . $inipath;
    echo "<br><br>";
} else {
    echo 'A php.ini file is not loaded';
    echo "<br>";
    
}
*/
//session_start();

$curl = curl_init();
echo $_SESSION['db_key'];
$url = "http://192.168.0.179:5001/db/getQuestion?key=".$_SESSION['db_key'];

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);

curl_close($curl);

//print_r($response);


//$questions1 = json_decode($response, true);

//echo 'Lekert kerdesek' . $questions1 . '<br><br>';
include "kerdes.php";

$questions = getQuestion($_SESSION['db_key']);

// $questions = array(
//   array(
//     'question' => 'Add meg a neved',
//     'name' => 'name',
//     'type' => 'text',
//     'required' => true
//   ),
//   array(
//     'question' => 'Mi a kedvenc színed?',
//     'name' => 'favorite_color',
//     'type' => 'text',
//     'required' => false
//   ),
//   array(
//     'question' => 'Hány éves vagy?',
//     'name' => 'age',
//     'type' => 'number',
//     'required' => true
//   ),
//     array(
//     'question' => 'Szereted a banant?',
//     'name' => 'banan',
//     'type' => 'text',
//     'required' => false
//   ),
//   // További kérdések...
// );

  foreach ($questions as $question) {
    //echo $response;
    echo '<div id="formdiv">';
    echo '<form action="process.php" method="POST">';
    echo '<label for="name">' . $question['kerdes'] . '</label><br><br>';
    echo '<input type="hidden" name="question" value="' . $question['kerdes'] . '">';
    echo '<input type="hidden" name="question_id" value="' . $question['kerdes_id'] . '">';
    echo '<input type="text" name="answer">';
   
    echo '<button type="submit">Küldés</button>';
    echo '<br></form>';
    echo '<br><br>';
    echo '</div>';
  }






































?>