<?php
  include "kliens.php";

  //POST

    //UJ KLIENS LETREHOZASA

  $username = 'BAPOr';
  $email = 'ikhbh@ljb.vd';
  $password = 'asdasd';

  postNewClient($username, $email, $password);

  //GET 

    //KLIENS LEKERESE ID ALAPJAN

  $id = 1;

  echo getClientById($id);

    //KLIENS LEKERESE EMAIL ALAPJAN

  $email = 'ikhbh@ljb.vd';

  echo getClientByEmail($email);
?>