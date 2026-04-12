<?php
require_once("./include.inc.php");

$result = $db->query("SELECT `login_locked` FROM `login`");
$row_login = $db->fetch($result);
if($row_login['login_locked'] == "yes"){
    exit("Desculpe, más o acesso está temporariamente bloqueado!");
}
$login = new login();
$userid = parse(@$_GET['id']);
$playerid = $login->login_uv($userid);
if(is_numeric($playerid)){
	$villageid = getfirstvillage($playerid);
    header("LOCATION: game.php?village=".$villageid."&screen=overview&intro");
    exit;
}
echo $playerid;
?>