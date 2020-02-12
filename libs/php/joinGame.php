<?php
include('db/db_connect.php');
include('../functions/functions.php');

if (!isConnected()) {
  header('Location: ../../login.php');
}

if (isset($_GET["gameId"]) && !empty($_GET["gameId"]) && isset($_GET["userId"]) && !empty($_GET["userId"])) {

  // Insertion dans la BDD
  $q = "INSERT INTO games_history VALUES(:uid, :email, :gameid)";
  $req = $conn->prepare($q);
  $req->execute(array(
    'uid' => $_SESSION["user"]["userId"],
    'email' => $_SESSION["user"]["email"],
    'gameid' => $_GET["gameId"],
  ));

header('Location: ../../dashgames.php?join=success');
exit;
}

?>
