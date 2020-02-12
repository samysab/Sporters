<?php
session_start();

$_SESSION['captcha'] = mt_rand(1000,9999);
$img = imagecreate(100,65);
$font = '../../ressources/fonts/destroyfont.ttf';

imagecolorallocate($img,255,255,255);
$textcolor = imagecolorallocate($img, 0, 0, 0);

imagettftext ($img, 35, 0, 3, 40, $textcolor, $font, $_SESSION['captcha']);

header('Content-type:image/jpeg');
imagejpeg($img);
imagedestroy($img);

?>
