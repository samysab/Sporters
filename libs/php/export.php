<?php
include('db/db_connect.php');
header('content-Type: text/csv');
header('accept-charset: utf-8');
header('content-disposition: attachement; filename="export_user.csv"'); //Permet de modifier le type du fichier en *csv

$req = $conn->prepare('SELECT * FROM users ');
$req->execute();
$data=$req->fetchAll();
 ?>"id";"pseudo";"nom de famille";"Prenom";"Adresse";"Date de confirmation"<?php

 foreach ($data as $d) {
   echo "\n".'"'. $d['userId'].'";"'.$d['pseudo'].'";"'.$d['lastname'].'";"'.$d['firstname'].'";"'.$d['userAddress']. $d['postalCode'].'";"'.$d['confirmedAt'] .'"';
   }
?>
