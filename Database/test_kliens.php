<?php
  include "kliens.php";
  include "szavazat.php";
  include "kerdes.php";
  

  //POST

    //UJ KLIENS LETREHOZASA

  $username = 'Rozsi';
  $email = 'rozsi@ljb.vd';
  $password = 'feltorhetetlen';
  $key = 'mongodb';
  // postNewClient($username, $email, $password,$key);
  
  $kerdes_id = 1;
  $voter_name = 'barni';
  $vote = 'piros';
  $kerdes = 'Mi a kedvenc hobbid?';


  // record_vote($kerdes_id,$voter_name, $vote, $kerdes,$key);

  // echo get_vote_by_voter($voter_name,$key);
  $question = 'Mit ettel ma?';
  updatePassword("jancsi@ljb.vd","feltorheto","sql");

  //echo getClientByEmail($email,$key) ;

  // postNewQuestion($question,$key);



  // $eredmeny = getQuestionById($kerdes_id,$key);

  // echo $eredmeny;
  // echo getClientByEmail($email);

  // echo get_vote_by_voter($voter_name);

  // Példa használat
// $result = get_question_answer_percentages($key);
// kiiratas_szazalekos_arany($result,$key);

?>