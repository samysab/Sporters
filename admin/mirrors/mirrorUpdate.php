<?php
include("../functions/functions.php");
hasAccess();

include("../../libs/php/db/db_connect.php");

$id = htmlentities($_GET['id'], ENT_QUOTES);

$product = explode(',', $_GET['product']);

$nom = htmlentities($product[0], ENT_QUOTES);
$marque = htmlentities($product[1], ENT_QUOTES);
$type = htmlentities($product[2], ENT_QUOTES);
$genre = htmlentities($product[3], ENT_QUOTES);
$stock = htmlentities($product[4], ENT_QUOTES);
$prix = htmlentities($product[5], ENT_QUOTES);
$score = htmlentities($product[6], ENT_QUOTES);
$sport = htmlentities($product[7], ENT_QUOTES);
$description = htmlentities($product[8], ENT_QUOTES);
$img = htmlspecialchars($product[9], ENT_QUOTES);

$c = 0;
for ($i = 0; $i < strlen($img); $i++) {
	if ($img[$i] == '\\' OR $img[$i] == '/')
		$c++;
	if ($c == 2) {
		$img = substr($img, $i+1);
	}
}


$queryUpdate = $conn->prepare('SELECT * FROM products WHERE productID = ?');
$queryUpdate->execute([$id]);

$rows = $queryUpdate->rowCount();

if ($rows) {
	$res = $queryUpdate->fetch(PDO::FETCH_ASSOC);

	function compareData($new, $col, $res, $id) {
		include('../../libs/php/db/db_connect.php');

		if ($res[$col] != $new) {
			$queryChange = $conn->prepare('UPDATE products SET '.$col.' = ? WHERE productID = ?');
			$queryChange->execute([$new, $id]);
		}

		if ($col == 'productImg') {
			$status = move_uploaded_file($img[0], '../ressources/images/products/' + $img[0]);
			if ($status) {
				echo 1;
			} else {
				echo "no";
			}
		}

	}

	compareData($nom, 'productName', $res, $id);
	compareData($marque, 'productBrand', $res, $id);
	compareData($type, 'productType', $res, $id);
	compareData($genre, 'productGender', $res, $id);
	compareData($stock, 'productStock', $res, $id);
	compareData($prix, 'productPrice', $res, $id);
	// compareData($sport, 'productSport');
	compareData($score, 'productScore', $res, $id);
	compareData($description, 'productDescription', $res, $id);
	compareData($img, 'productImg', $res, $id);


}

?>