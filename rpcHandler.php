<?php
include "kliens.php";
include "kerdes.php";
include "szavazat.php";

$data = file_get_contents('php://stdin');
$input = explode("\n", $data);
$function = $input[0];
//echo $function;
if($function == "getclientbyemail"){
    $email = isset($input[1]) ? $input[1] : '';
    $key = isset($input[2]) ? $input[2] : '';
    
    $result = getClientByEmail($email,$key);
    //echo "jartam itt";
    echo $result;
}

if($function == "get_vote_by_voter"){
    $voter_name = isset($input[1]) ? $input[1] : '';
    $key = isset($input[2]) ? $input[2] : '';
    
    $result = get_vote_by_voter($voter_name,$key);

    echo $result;
}
if($function == "getQuestion"){
    $key = isset($input[1]) ? $input[1] : '';
    
    $result = getQuestion($key);
    echo "<pre>";
    print_r($result);
    echo "</pre>";
}

if($function == "get_question_answer_percentages"){
    $key = isset($input[1]) ? $input[1] : '';
    
    $result = get_question_answer_percentages($key);

    echo kiiratas_szazalekos_arany($result,$key);
}

if($function == "postNewClient"){
    $username = isset($input[1]) ? $input[1] : '';
    $email = isset($input[2]) ? $input[2] : '';
    $password = isset($input[3]) ? $input[3] : '';
    $key = isset($input[4]) ? $input[4] : '';
    
    $result = postNewClient($username,$email,$password,$key);

    echo $result;
}

if($function == "updatePassword"){
    $email = isset($input[1]) ? $input[1] : '';
    $password = isset($input[2]) ? $input[2] : '';
    $key = isset($input[3]) ? $input[3] : '';
    
    $result = updatePassword($email,$password,$key);

    echo $result;
}

if($function == "record_vote"){
    $kerdes_id = isset($input[1]) ? $input[1] : '';
    $voter_name = isset($input[2]) ? $input[2] : '';
    $vote = isset($input[3]) ? $input[3] : '';
    $kerdes = isset($input[4]) ? $input[4] : '';
    $key = isset($input[5]) ? $input[5] : '';

    $result = record_vote($kerdes_id,$voter_name,$vote,$kerdes,$key);

    echo $result;
}

if($function == "postNewQuestion"){
    $question = isset($input[1]) ? $input[1] : '';
    $key = isset($input[2]) ? $input[2] : '';
    
    $result = postNewQuestion($question,$key);

    echo $result;
}

?>