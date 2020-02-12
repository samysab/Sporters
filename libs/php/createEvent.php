<?php
include('../functions/functions.php');
include('db/db_connect.php');


// Vérification des inputs
  // Si aucun input n'est rempli -> redirection erreur
if (!isset($_POST["eventname"]) || empty($_POST["eventname"]) && !isset($_POST["eventdate"]) || empty($_POST["eventdate"])
&& !isset($_POST["eventsport"]) || empty($_POST["eventsport"])
&& !isset($_POST["eventfield"]) || empty($_POST["eventfield"]) && !isset($_POST["eventslots"]) || empty($_POST["eventslots"])
&& !isset($_POST["eventprice"]) || empty($_POST["eventprice"])) {

  header('Location: ../../dashevents.php?error=emptyfields');
  exit;
}

  // Vérification de l'input "Nom de la partie"
if (!isset($_POST["eventname"]) || empty($_POST["eventname"])) {
  header('Location: ../../dashevents.php?error=empty_eventname');
  exit;
}

if (strlen($_POST["eventname"]) < 5 || strlen($_POST["eventname"]) > 30) {
  header('Location: ../../dashevents.php?error=eventname_length');
  exit;
}


  // Vérification de l'input "Date de la partie"
if (!isset($_POST["eventdate"]) || empty($_POST["eventdate"])) {
header('Location: ../../dashevents.php?error=empty_eventdate');
exit;
}
  // Vérification du format de la date
$dateInput = $_POST["eventdate"];
$eventdate = explode("-", $dateInput);
$year = $eventdate[0];
$month = $eventdate[1];
$day = $eventdate[2];

if (!checkdate($month, $day, $year)) {
  header('Location: ../../dashevents.php?error=eventdate_invalid');
  exit;
}

  // Vérification de l'input "Sport de la partie"
if (!isset($_POST["eventsport"]) || empty($_POST["eventsport"])) {
header('Location: ../../dashevents.php?error=empty_eventsport');
exit;
}

  // Vérification de l'input "Terrain de la partie"
if (!isset($_POST["eventfield"]) || empty($_POST["eventfield"])) {
header('Location: ../../dashevents.php?error=empty_eventfield');
exit;
}

  // Vérification de l'input "Nombre de places de la partie"
if (!isset($_POST["eventslots"]) || empty($_POST["eventslots"])) {
header('Location: ../../dashevents.php?error=empty_eventslots');
exit;
}


// Préparation et insertion des données dans la BDD
  // Récupération de l'ID du terrain choisi
  $q = "SELECT fieldId FROM fields WHERE fieldAddress = ?";
  $req = $conn->prepare($q);
  $req->execute([$_POST["eventfield"]]);
  $res = $req->fetch();

include('../functions/check_input.php');

$sql = "INSERT INTO events(eventName, eventDate, eventSport, eventSlot, eventPrice, fields_fieldId, fields_fieldAddress, users_userId, users_email)
VALUES(:name, :eventdate, :sport, :slots, :price, :fieldId, :fieldaddr, :creator, :creatorEmail)";
$request = $conn->prepare($sql);
$request->execute(array(
  'name' => check_input($_POST["eventname"]),
  'eventdate' => check_input($_POST["eventdate"]),
  'sport' => check_input($_POST["eventsport"]),
  'slots' => check_input($_POST["eventslots"]),
  'price' => check_input($_POST["eventprice"]),
  'fieldId' => $res['fieldId'],
  'fieldaddr' => $_POST["eventfield"],
  'creator' => $_SESSION["user"]["userId"],
  'creatorEmail' => $_SESSION["user"]["email"]
));

header('Location: ../../dashevents.php?event=success');
exit;
?>
