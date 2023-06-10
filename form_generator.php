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
//
// $curl = curl_init();
//
// $url = "http://database/get-questions";
//
// curl_setopt($curl, CURLOPT_URL, $url);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//
// $response = curl_exec($curl);
//
// curl_close($curl);
//
//
// $questions1 = json_decode($response, true);

//echo 'Lekert kerdesek' . $questions1 . '<br><br>';

$questions = array(
  array(
    'question' => 'Add meg a neved',
    'name' => 'name',
    'type' => 'text',
    'required' => true
  ),
  array(
    'question' => 'Mi a kedvenc színed?',
    'name' => 'favorite_color',
    'type' => 'text',
    'required' => false
  ),
  array(
    'question' => 'Hány éves vagy?',
    'name' => 'age',
    'type' => 'number',
    'required' => true
  ),
    array(
    'question' => 'Szereted a banant?',
    'name' => 'banan',
    'type' => 'text',
    'required' => false
  ),
  // További kérdések...
);

  foreach ($questions as $question) {
    echo '<label for="' . $question['name'] . '">' . $question['question'] . '</label><br>';
    echo '<input type="' . $question['type'] . '" id="' . $question['name'] . '" name="' . $question['name'] . '"';
    if ($question['required']) {
      echo ' required';
    }
    echo '><br><br>';
  }






































?>