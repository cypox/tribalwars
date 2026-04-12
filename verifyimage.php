<?php

$alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$rand = substr(str_shuffle($alphanum), 0, 5);
$image = imagecreatefrompng("global_cdn/captcha.png");
$textColor = imagecolorallocate($image, 0, 0, 0);
imagestring($image, 5, 3, 3, $rand, $textColor);
setcookie("security", md5($rand));
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
?>