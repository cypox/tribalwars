<?php
$error = "";
if(isset($_GET['action']) && $_GET['action'] == "create"){
	if(empty($error) && (!is_numeric($_POST['num']) || ((int)$_POST['num']) != $_POST['num'])){
		$error = "Het aantal mag geen kommagetal zijn!";
	}
	if(empty($error) && $_POST['num'] < 1){
		$error = "Het aantal moet groter dan 0 zijn";
	}
	if(empty($error) && $_POST['num'] > 500){
		$error = "Het aantal moet kleiner dan 500 zijn";
	}
	if(empty($error)){
		$create_output = "";
		for($n=1;$n<=$_POST['num'];++$n){
			create_village(-1, "", "random");
		}
		$db->query("UPDATE `users` SET `map_reload`=''");
		$tpl->assign("success", true);
	}
}
if(isset($_POST['bonus'])){
	echo "BLALALALALALALALA";
}
$amount = $db->query("SELECT COUNT(`id`) AS `amount` FROM `villages` WHERE `userid`='-1'");
while($row = $db->fetch($amount)){
	$fluela = $row['amount'];
}
$tpl->assign("fluela", $fluela);
$deleteSuccess = "";
if(isset($_GET['action']) && $_GET['action'] == "delete" && isset($_POST['confirm'])){
	$db->query("DELETE FROM `villages` WHERE `userid`='-1'");
	$db->query("UPDATE `users` SET `map_reload`=''");
	$db->query("UPDATE `create_village_barb` SET `nw_c`='1',`no_c`='1',`so_c`='1',`sw_c`='1',`nw`=1,`no`='1',`so`='1',`sw`='1',`no_alpha`='1',`nw_alpha`='1',`so_alpha`='1',`sw_alpha`='1',`next_left`='1'");
	$deleteSuccess = "Die Fl�chtlingslager wurden erfolgreich gel�scht.";
	$tpl->assign("deleteSuccess", $deleteSuccess);
	header("LOCATION: index.php?screen=refugee_camp");
}
$tpl->assign("buildings", $buildings);
$tpl->assign("error", $error);
?>