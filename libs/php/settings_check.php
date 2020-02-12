<?php
include('../functions/functions.php');
include('db/db_connect.php');

if (!isConnected()) {
  header('Location: ../../login.php');
}

// Fonction d'assainissement des inputs
function check_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Récupération des inputs de l'user
$lname = check_input($_POST["lname"]);
$fname = check_input($_POST["fname"]);
$pseudo = check_input($_POST["pseudo"]);
$address = check_input($_POST["address"]);
$cp = check_input($_POST["cp"]);
$city = check_input($_POST["city"]);
$phone = check_input($_POST["phone"]);

// Vérification des champs
if (empty($lname) || empty($fname) || empty($pseudo) || empty($address)
|| empty($cp) || empty($city) || empty($phone)) {
  header('Location: ../../settings.php?error=empty_fields');
  exit;
}


// Vérification du format et taille de l'adresse


if (strlen($_POST["address"]) > 50) {
  header('Location: ../../settings.php?error=adress_length');
  exit;
}

// Vérification de la taille et format du code postal
$pattern_cp = "#[0-9]{5}#";
if (!preg_match($pattern_cp, $_POST["cp"])) {
  header("Location: ../../settings.php?error=invalid_cp_format");
  exit;
}

if (strlen($_POST["cp"]) != 5) {
  header("Location: ../../settings.php?error=invalid_cp_length");
  exit;
}

// Vérification de la taille et format de données saisies champs ville
$pattern_city = "#[^0-9]#";
if (!preg_match($pattern_city, $_POST["city"])) {
  header('Location: ../../settings.php?error=city_format');
  exit;
}

if (strlen($_POST["city"]) > 50) {
  header("Location: ../../settings.php?error=invalid_city_length");
  exit;
}

// Vérification de la taille et format du numéro de téléphone
$pattern_phone = "#[0-9]{9,10}#";
if (!preg_match($pattern_phone, $_POST["phone"])) {
  header("Location: ../../settings.php?error=invalid_phone_format");
  exit;
}

if (strlen($_POST["phone"]) > 10 ||  strlen($_POST["phone"]) < 9) {
  header("Location: ../../settings.php?error=invalid_phone_length");
  exit;
}



// Mise à jour de la BDD
$userid = $_SESSION["user"]["userId"];
$q = "UPDATE users SET pseudo = :pseudo, lastname = :lname, firstname = :fname,
userAddress = :address, postalCode = :cpostal, phoneNumber = :phone, city = :city WHERE userId = :uid";
$req = $conn->prepare($q);
$req->execute(array(
  'pseudo' => $pseudo,
  'lname' => $lname,
  'fname' => $fname,
  'address' => $address,
  'cpostal' => $cp,
  'phone' => $phone,
  'city' => $city,
  'uid' => $userid,
));

header('Location: ../../settings.php?submit=check');
exit;
?>
