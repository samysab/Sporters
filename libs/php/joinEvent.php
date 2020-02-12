<?php
include('db/db_connect.php');
include('../functions/functions.php');

if (!isConnected()) {
  header('Location: ../../login.php');
}

if (isset($_GET["enventId"]) && !empty($_GET["enventId"]) && isset($_GET["userId"]) && !empty($_GET["userId"])) {

  // Insertion dans la BDD
  $q = "INSERT INTO events_history(users_userId, users_email, events_enventId) VALUES(:uid, :email, :enventId)";
  $req = $conn->prepare($q);
  $req->execute(array(
    'uid' => $_SESSION["user"]["userId"],
    'email' => $_SESSION["user"]["email"],
    'enventId' => $_GET["enventId"],
  ));

}

?>
