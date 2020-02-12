<?php
include('libs/php/db/db_connect.php');
include('libs/functions/functions.php');


if (!isConnected()) {
  header('Location: login.php');
}

/* Si l'user a joint un fichier à l'input alors effectuer vérifications
et upload */
if (!isset($_FILES["profilepic"]) && empty($_FILES["profilepic"])) {
  header('Location: settings.php?error=empty_photo');
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
  header('Location: settings.php?error=file_exists');
  exit;
}

// Vérification du type de fichier
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    header('Location: settings.php?error=file_format');
    exit;
}

// Vérification de la taille du fichier
$maxsize = 256000; // 256 KB
if (($_FILES['profilepic']['size'] > $maxsize)) {
  header('Location: settings.php?=error=image_size');
  exit;
}

// Vérification de l'état de l'upload et envoi
move_uploaded_file($_FILES["profilepic"]["tmp_name"], $target_file);

// Mise à jour dans la BDD
$q = "UPDATE users SET userProfilePic = :photo WHERE userId = :uid";
$req = $conn->prepare($q);
$req->execute(array(
  'photo' => $target_file,
  'uid' => $_SESSION["user"]["userId"],
));

header('Location: settings.php?submit=check');
exit;
?>
