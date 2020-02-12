<?php

// include('../functions/functions.php');
// hasAccess();

include('../../libs/php/db/db_connect.php');

if (isset($_GET['search']) && !empty($_GET['search'])) {
	$value = htmlspecialchars($_GET['search'], ENT_QUOTES);

	// users
	$qsUsers = $conn->prepare("SELECT pseudo, userId FROM users WHERE pseudo LIKE ? LIMIT 3");
	$qsUsers->execute(['%' . $value . '%']);

	// games
	$qsGames = $conn->prepare("SELECT gameName, gameId FROM games WHERE gameName LIKE ? LIMIT 3");
	$qsGames->execute(['%' . $value . '%']);

	// products
	$qsProducts = $conn->prepare("SELECT productName, productID FROM products WHERE productName LIKE ? LIMIT 3");
	$qsProducts->execute(['%' . $value . '%']);

	// terrain
	$qsFields = $conn->prepare("SELECT fieldName, fieldId FROM fields WHERE fieldName LIKE ? LIMIT 3");
	$qsFields->execute(['%' . $value . '%']);

	$rowsUsers = $qsUsers->rowCount();
	$rowsGames = $qsGames->rowCount();
	$rowsProducts = $qsProducts->rowCount();
	$rowsFields = $qsFields->rowCount();

	// echo "rowsUsers : " . $rowsUsers . "\n";
	// echo "rowsGames : " . $rowsGames . "\n";
	// echo "rowsProducts : " . $rowsProducts . "\n";
	// echo "rowsFields : " . $rowsFields . "\n";


	$resUsers = $qsUsers->fetchAll();
	$resGames = $qsGames->fetchAll();
	$resProducts = $qsProducts->fetchAll();
	$resFields = $qsFields->fetchAll();

	// $resTotal = [];
	// $tmp = [];

	// foreach ($resUsers as $userKey => $userName) {
	// 	$tmp[] = $userName;
	// 	$resTotal[] = $tmp;
	// }

	echo json_encode([
		$resUsers,
		$resGames,
		$resProducts,
		$resFields
	]);

} else {
	echo "Une erreur s'est produite";
}

?>