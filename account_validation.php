<?php
// Script PHP qui traite la demande de validation du compte de l'utilisateur

include('libs/functions/functions.php');
include('libs/php/db/db_connect.php');

if (!isConnected()) {
  header('Location: login.php');
}

// Fonction de vérification des inputs
function check_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Vérification des champs
if (!isset($_POST["address"]) || empty($_POST["address"]) || !isset($_POST["cp"])
|| empty($_POST["cp"]) || !isset($_POST["city"]) || empty($_POST["city"])
|| !isset($_POST["phone"]) || empty($_POST["phone"])) {
  header('Location: account.php?error=empty_fields');
  exit;
}

if (!isset($_POST["address"]) || empty($_POST["address"])) {
  header('Location: account.php?error=address_missing');
  exit;
}

if (!isset($_POST["cp"]) || empty($_POST["cp"])) {
  header('Location: account.php?error=cp_missing');
  exit;
}

if (!isset($_POST["city"]) || empty($_POST["city"])) {
  header('Location: account.php?error=city_missing');
  exit;
}

if (!isset($_POST["phone"]) || empty($_POST["phone"])) {
  header('Location: account.php?error=phone_missing');
  exit;
}

if (!isset($_FILES["profilepic"]) || empty($_FILES["profilepic"])) {
  header('Location: account.php?error=photo_missing');
  exit;
}


// Vérification du format et taille de l'adresse


if (strlen($_POST["address"]) > 50) {
  header('Location: account.php?error=adress_length');
  exit;
}

// Vérification de la taille et format de données saisies champs ville
$pattern_city = "#[^0-9]#";
if (!preg_match($pattern_city, $_POST["city"])) {
  header('Location: account.php?error=city_format');
  exit;
}

if (strlen($_POST["city"]) > 30) {
  header("Location: account.php?error=invalid_city_length");
  exit;
}

// Vérification de la taille et format du code postal
$pattern_cp = "#[0-9]{5}#";
if (!preg_match($pattern_cp, $_POST["cp"])) {
  header("Location: account.php?error=invalid_cp_format");
  exit;
}

if (strlen($_POST["cp"]) != 5) {
  header("Location: account.php?error=invalid_cp_length");
  exit;
}


// Vérification de la taille et format du numéro de téléphone
$pattern_phone = "#[0-9]{9,10}#";
if (!preg_match($pattern_phone, $_POST["phone"])) {
  header("Location: account.php?error=invalid_phone_format");
  exit;
}

if (strlen($_POST["phone"]) > 10 ||  strlen($_POST["phone"]) < 9) {
  header("Location: account.php?error=invalid_phone_length");
  exit;
}


// Upload photo de profil
$image_name = 'profil-' . $_SESSION["user"]["userId"] . '-' . date('Y-m-d-H-i-s');
$filename = $_FILES["profilepic"]["name"];
$temp_array = explode(".", $filename);
$imageFileType = strtolower(end($temp_array));
$target_file = 'uploads/profile_pic/' . $image_name . "." . $imageFileType;


// Vérifier si le fichier existe déjà
if (file_exists($target_file)) {
  header('Location: account.php?error=file_exists');
  exit;
}

// Vérification du type de fichier
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    header('Location: account.php?error=file_format');
    exit;
}

// Vérification de la taille du fichier
$maxsize = 256000; // 256 KB
if (($_FILES['profilepic']['size'] > $maxsize)) {
  header('Location: account.php?=error=image_size');
  exit;
}

// Vérification de l'état de l'upload et envoi
move_uploaded_file($_FILES["profilepic"]["tmp_name"], $target_file);

$userId = $_SESSION["user"]["userId"];

$q = "UPDATE users SET userAddress = :address, postalCode = :cp, phoneNumber = :phone,
city = :city, userProfilePic = :photo, accountStatus = :account WHERE userId = $userId";
$req = $conn->prepare($q);
$req->execute(array(
  'address' => check_input($_POST["address"]),
  'cp' => check_input($_POST["cp"]),
  'phone' => check_input($_POST["phone"]),
  'city' => check_input($_POST["city"]),
  'photo' => $target_file,
  'account' => 1
));

$_SESSION["user"]["accountStatus"] == 1;
header('Location: account.php?submit=check');

?>
