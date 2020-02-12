<?php

$user_id = $_GET['id'];
$token = $_GET['token'];
require 'libs/php/db/db_connect.php';

$query = $conn->prepare('SELECT * FROM users WHERE userId = ?');
$query->execute([$user_id]);
$user = $query->fetch();

if ($user && $user['confirmationToken'] == $token) {
	$queryAccoutStatus = $conn->prepare('SELECT * FROM users WHERE userId = ?');
	$queryAccoutStatus->execute($user_id);
	$as = $queryAccoutStatus->fetch()['accountStatus'];
	switch ($as) {
		case 0:
			$as = 1;
			break;
		case 2:
			$as = 3;
		default:
			$as = 0;
			break;
	}

	$query = $conn->prepare('UPDATE users SET confirmationToken = NULL, confirmedAt = NOW(), accountStatus = ? WHERE userId = ?');
	$query->execute([$as, $user_id]);

	session_start();
	$_SESSION['auth'] = $user;
	

	$_SESSION['msgs']['success'] = 'Votre compte a bien été confirmé';
	header('Location: login.php?account=confirmed');
} else {
	$_SESSION['msgs']['success'] = 'Token non valide';
	header('Location: index.php');
}

?>