<?php

  // Récupération des infos de l'utilisateur
  $userAccountStatus = "SELECT * FROM users WHERE userId = ?";
  $sqlQuery = $conn->prepare($userAccountStatus);
  $sqlQuery->execute([$_SESSION["user"]["userId"]]);
  $result = $sqlQuery->fetch();

?>
