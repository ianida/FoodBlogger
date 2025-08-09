<?php
session_start();

$str = md5(microtime());
$str = substr($str, 0, 6);

$_SESSION['captcha'] = $str;

$img = imagecreate(70, 30);

// Background color (dark)
imagecolorallocate($img, 26, 26, 26);

// Text color (light)
$textcol = imagecolorallocate($img, 203, 203, 180);

// Font size must be between 1 and 5 (use 5 for biggest built-in font)
imagestring($img, 5, 5, 5, $str, $textcol);

header("Content-Type: image/jpeg");

imagejpeg($img);
imagedestroy($img);
?>
