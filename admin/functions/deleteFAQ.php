<?php
include('db/db_connect.php');
include('../../admin/functions/functions.php');
hasAccess();

// Suppression des enregistrements de la table FAQ
$q = "DELETE FROM faq";
$req = $conn->prepare($q);
$req->execute();

header('Location: ../../admin/faq_manager.php?q=success');
exit;

?>
