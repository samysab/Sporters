<?php
include('../functions/functions.php');
include('db/db_connect.php');

// Vérification des inputs
  // Si aucun input n'est rempli -> redirection erreur
// if (isset($_POST['banFormSubmit'])) {
//   if (isset($_POST['bandate']) && !empty($_POST['bandate']) && isset($_POST['banDefinitif']) && !empty($_POST['banDefinitif'])) {

//   }
// }


if ($_POST['bandate'] != '' && isset($_POST['banDefinitif'])) {
  header('Location: ../../admin/viewUsers.php?error=make_a_choice');
  exit;
}


if (isset($_POST['bandate']) && !empty($_POST['bandate'])) {
  // $queryBan = $conn->prepare('UPDATE users SET banTim')
  // Vérification du format de la date
  $dateInput = $_POST["bandate"];
  $bandate = explode("-", $dateInput);
  $year = $bandate[0];
  $month = $bandate[1];
  $day = $bandate[2];

  if (!checkdate($month, $day, $year)) {
    header('Location: ../../admin/viewUsers.php?error=bandate_invalid');
    exit;
  }

  if (date($day."-".$month."-".$year) <= date("d/m/Y")) {
    header('Location: ../../admin/viewUsers.php?error=bandate_past');
    exit;
  }
}

if (isset($_POST['banDefinitif'])) {
  $queryBanDef = $conn->prepare('UPDATE users SET accountStatus = ? WHERE userId = ?');
  $queryBanDef->execute([5, $_POST['userId']]);
  if ($queryBanDef->rowCount()) {
    header('Location: ../../admin/viewUsers.php?ban=success');
    exit;
  }
}

if (isset($_POST['bandate'])){
//   $queryBanTemp = $conn->prepare('UPDATE users SET accountStatus = ?, banTime = ? WHERE userId = ?');
//   $queryBanTemp->execute([4, $_POST['bandate'], $_POST['userId']]);
//   if ($queryBanTemp->rowCount()) {
    header('Location: ../../admin/viewUsers.php?ban=nope');
//     exit;
//   } 
}


?>
