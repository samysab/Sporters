<?php
if (isset($_POST['formconnexion'])) {
	include('db/db_connect.php');

  $mail = htmlspecialchars($_POST['mail']);
  $mdp = htmlspecialchars($_POST['mdp']);

  if (!empty($_POST['mail']) AND !empty($_POST['mail']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp'])) {

	include('db/db_connect.php');

	$mdp = hash('sha256', $mdp);

	$loginQuery = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");

	$res = $loginQuery->execute([$mail, $mdp]);

	$rows = $loginQuery->rowCount();

	if ($rows) {
		$user = $loginQuery->fetch();
		if ($user['accountStatus'] == 5) {
			header('Location: ../../login.php?error=banned');
			exit;
		}
		session_start();
		$_SESSION['user'] = $user;
		header('Location: ../../dashboard.php');
		exit;

	} else {
		$loginQuery = $conn->prepare("SELECT * FROM admin WHERE adminPseudo = ? AND adminPassword = ?");
		$res = $loginQuery->execute([$mail, $mdp]);
		$rows = $loginQuery->rowCount();

		if ($rows) {
			$user = $loginQuery->fetch();
			session_start();
			$_SESSION['admin'] = $user;
			header('Location: ../../admin/index.php');
			exit;
      
		} else {
			header('Location: ../../login.php?login=loginerror');
      exit;
		}
	}

}else {
  header('Location: ../../login.php?login=field_blank');
  exit;
  }
}
?>
