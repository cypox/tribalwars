<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD!='sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL'){
	exit;
}

if(isset($_GET['h'])) $g_h = parse($_GET['h']);

if($session['hkey'] == $g_h){
	$sid->logout($user['id']);
	setcookie("session", "", time()-1);
	header("LOCATION: index.php");
}else{
	exit("Sorry er is een fout opgetreden");
}
?>