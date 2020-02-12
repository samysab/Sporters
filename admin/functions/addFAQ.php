<?php
include('functions.php');
include('../../libs/php/db/db_connect.php');
include('../../libs/functions/functions.php');
hasAccess();

// Vérification des champs
if (!isset($_POST["question"]) || empty($_POST["question"])) {
  header('Location: ../faq_manager.php?error=question_missing');
  exit;
}

if (!isset($_POST["answer"]) || empty($_POST["answer"])) {
  header('Location: ../faq_manager.php?error=answer_missing');
  exit;
}

$question = check_input($_POST["question"]);
$answer = check_input($_POST["answer"]);

// Insertion dans la BDD
$q = "INSERT INTO faq(questions, answers, admin_idadmin) VALUES(:question, :answer, :admin_id)";
$req = $conn->prepare($q);
$req->execute(array(
  'question' => $question,
  'answer' => $answer,
  'admin_id' => $_SESSION["admin"]["idadmin"],
));

header('Location: ../faq_manager.php?submit=success');
exit;


// Fonction de vérification et d'assainnissementdes inputs
function check_input($data){
  $data = htmlspecialchars($data);
  return $data;
}
?>
