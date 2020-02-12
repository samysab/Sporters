<?php
include('functions.php');
include('../../libs/php/db/db_connect.php');
include('../../libs/functions/functions.php');
hasAccess();

// Vérification des champs
if (!isset($_POST["cgu"]) || empty($_POST["cgu"])) {
  header('Location: ../cgu_manager.php?error=rule_missing');
  exit;
}

$article = check_input($_POST["cgu"]);
$admin_id = $_SESSION["admin"]["idadmin"];

// Insertion dans la BDD
$q = "INSERT INTO cgu(article, admin_id) VALUES(:article, :adminId)";
$req = $conn->prepare($q);
$req->execute(array(
  'article' => $article,
  'adminId' => $admin_id
));

header('Location: ../cgu_manager.php?submit=success');
exit;


// Fonction de vérification et d'assainnissementdes inputs
function check_input($data){
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
