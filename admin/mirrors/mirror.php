<?php
include('../functions/functions.php');
hasAccess();

include('../../libs/php/db/db_connect.php');

if (isset($_GET['productName'])) {

	$name = htmlentities($_GET['productName']);

	$queryProduct = $conn->prepare('SELECT * FROM products WHERE productName = ?');
	$queryProduct->execute([$name]);

	$rows = $queryProduct->rowCount();

	if ($rows) {
		$res = $queryProduct->fetch();
		$array = [];

		for ($i = 0; $i < 11; $i++) {
			$array[] = $res[$i];
		}

		echo json_encode($array);
	}
}

if (isset($_GET['productRemoveId']) && !empty($_GET['productRemoveId'])) {

	$idr = htmlentities($_GET['productRemoveId']);

	$removeProduct = $conn->prepare('DELETE FROM products WHERE productID = ?');
	$removeProduct->execute([$idr]);

	$rows = $removeProduct->rowCount();

	if ($rows) {
		echo 1;		
	}

}


?>