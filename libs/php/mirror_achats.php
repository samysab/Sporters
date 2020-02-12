<?php

if (isset($_GET['data'])) {
	include('db/db_connect.php');

	$commandes = json_decode($_GET['data']);
	$userId = htmlspecialchars($_GET['userid']);
	$userEmail = htmlspecialchars($_GET['email']);
	

	$alphabet = "AZERTYUIOPQSDFGHJKLMWXCVBN1234567890";
	$random = substr(str_shuffle($alphabet), 0, 5);

	foreach ($commandes as $commande) {
		$insertSales = $conn->prepare('INSERT INTO orders VALUES (?, ?, ?, ?, ?, ?)');
		$statut = $insertSales->execute([NULL, $userEmail, $userId, $commande->id, date("Y-m-d H:i:s"), $random]);

		if($statut) {
			echo "commande passée";
		} else {
			echo 0;
		}
	}
}

if (isset($_GET['buy_premium']) && $_GET['buy_premium'] == 1) {
	include('db/db_connect.php');

	$updateStatus = $conn->prepare('UPDATE users SET membershipStatus = 2 WHERE userId = ?');
	$row = $updateStatus->execute([$_GET['id']]);
	if ($row) {
		echo "updated";
	}
}

?>