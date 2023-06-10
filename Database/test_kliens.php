<?php
  include "kliens.php";
  include "szavazat.php";
  include "kerdes.php";

  //POST

    //UJ KLIENS LETREHOZASA

  $username = 'Rozsi';
  $email = 'rozsi@ljb.vd';
  $password = 'feltorhetetlen';

  // postNewClient($username, $email, $password);
  
  $kerdes_id = 3;
  $voter_name = 'Janos';
  $vote = 'zold';
  $kerdes = 'Mi a kedvenc eteled?';

  // record_vote($kerdes_id,$voter_name, $vote, $kerdes);

  $question = 'Mit ittal ma?';

  // postNewQuestion($question);
  
  // echo getClientByEmail($email);

  // echo get_vote_by_voter($voter_name);

  // Példa használat
$questionAnswerPercentages = get_question_answer_percentages();

// Eredmények kiíratása
foreach ($questionAnswerPercentages as $kerdes => $valaszok) {
  echo "Kérdés: " . $kerdes . "<br>";

  foreach ($valaszok as $valasz => $szazalek) {
      echo "Válasz: " . $valasz . "<br>";
      echo "Százalékos arány: " . $szazalek . "%<br>";
      echo "<br>";
  }
}
?>