<?php
include('../functions/functions.php');
include('db/db_connect.php');
header('content-Type: text/csv');
header('accept-charset: utf-8');
header('content-disposition: attachement; filename="export_' . $_SESSION["user"]["pseudo"] . '.csv"'); //Permet de modifier le type du fichier en *csv

// Récupération des infos user
$req = $conn->prepare('SELECT * FROM users WHERE userId = ?');
$req->execute([$_SESSION["user"]["userId"]]);
$data = $req->fetchAll();


?>
"ID";"Pseudo";"Nom";"Prenom";"Adresse";"Code Postal";"Date de confirmation"
<?php
 foreach ($data as $d) {
   echo $d["userId"] . ';' . $d["pseudo"] . ';' . $d["lastname"] . ';' . $d["firstname"] . ';' . $d["userAddress"] . ';' . $d["postalCode"] .
   ';' . $d["confirmedAt"];
   }
 ?>
