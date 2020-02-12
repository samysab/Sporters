<?php
include('../functions/functions.php');
include('db/db_connect.php');


// Vérification des inputs
  // Si aucun input n'est rempli -> redirection erreur
if (!isset($_POST["gamename"]) || empty($_POST["gamename"]) && !isset($_POST["gamedate"]) || empty($_POST["gamedate"])
&& !isset($_POST["gamesport"]) || empty($_POST["gamesport"])
&& !isset($_POST["gamefield"]) || empty($_POST["gamefield"]) && !isset($_POST["gameslots"]) || empty($_POST["gameslots"])) {

  header('Location: ../../dashgames.php?error=emptyfields');
  exit;
}

  // Vérification de l'input "Nom de la partie"
if (!isset($_POST["gamename"]) || empty($_POST["gamename"])) {
  header('Location: ../../dashgames.php?error=empty_gamename');
  exit;
}

if (strlen($_POST["gamename"]) > 30) {
  header('Location: ../../dashgames.php?error=gamename_length');
  exit;
}


  // Vérification de l'input "Date de la partie"
if (!isset($_POST["gamedate"]) || empty($_POST["gamedate"])) {
header('Location: ../../dashgames.php?error=empty_gamedate');
exit;
}
  // Vérification du format de la date
$dateInput = $_POST["gamedate"];
$gamedate = explode("-", $dateInput);
$year = $gamedate[0];
$month = $gamedate[1];
$day = $gamedate[2];

if (!checkdate($month, $day, $year)) {
  header('Location: ../../dashgames.php?error=gamedate_invalid');
  exit;
}

  // Vérification de l'input "Sport de la partie"
if (!isset($_POST["gamesport"]) || empty($_POST["gamesport"])) {
header('Location: ../../dashgames.php?error=empty_gamesport');
exit;
}

  // Vérification de l'input "Terrain de la partie"
if (!isset($_POST["gamefield"]) || empty($_POST["gamefield"])) {
header('Location: ../../dashgames.php?error=empty_gamefield');
exit;
}

  // Vérification de l'input "Nombre de places de la partie"
if (!isset($_POST["gameslots"]) || empty($_POST["gameslots"])) {
header('Location: ../../dashgames.php?error=empty_gameslots');
exit;
}


// Préparation et insertion des données dans la BDD
  // Récupération de l'ID du terrain choisi
  $q = "SELECT fieldId FROM fields WHERE fieldAddress = ?";
  $req = $conn->prepare($q);
  $req->execute([$_POST["gamefield"]]);
  $res = $req->fetch();



$sql = "INSERT INTO games(gameName, gameDate, gameSport, slotAvailable, fields_fieldId, fields_fieldAddress, users_userId, users_email) VALUES(?,?,?,?,?,?,?,?)";
$request = $conn->prepare($sql);
$request->execute(array(
  $_POST["gamename"],
  $_POST["gamedate"],
  $_POST["gamesport"],
  $_POST["gameslots"],
  $res['fieldId'],
  $_POST["gamefield"],
  $_SESSION["user"]["userId"],
  $_SESSION["user"]["email"]
));

function check_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
}

header('Location: ../../dashgames.php?game=success');
exit;
?>
