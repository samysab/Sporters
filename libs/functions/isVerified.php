<?php

function isVerified(){
  include('libs/php/db/db_connect.php');
  // Récupération des infos de l'utilisateur
  $userAccountStatus = "SELECT accountStatus FROM users WHERE userId = ?";
  $sqlQuery = $conn->prepare($userAccountStatus);
  $sqlQuery->execute([$_SESSION["user"]["userId"]]);
  $result = $sqlQuery->fetch();

  if ($result[0] == 0) {
    header('Location: dashboard.php?error=account_status');
    exit;
  }

}
?>
