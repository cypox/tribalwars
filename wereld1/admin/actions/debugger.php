<?php
if(isset($_GET['action']) && $_GET['action'] == 'attacks'){
	$db->query("UPDATE `login` SET `login_locked`='yes'");
	$db->query("TRUNCATE TABLE `sessions`");

	$result = $db->query("SELECT `id`,`attacks` FROM `villages`");
	while($row = $db->Fetch($result)){
		$res = $db->query("SELECT COUNT(`send_to_village`) AS `count` FROM `movements` WHERE `send_to_village`='".$row['id']."' AND `type`='attack' LIMIT 1");
		$r = $db->fetch($res);
		if($row['attacks'] != $r['count'] && is_numeric($r['count'])){
			$db->query("UPDATE `villages` SET `attacks`='".$r['count']."' WHERE `id`='".$row['id']."'");
		}
	}

	$result = $db->query("SELECT `id`,`attacks` FROM `users`");
	while($row = $db->Fetch($result)){
		$res = $db->query("SELECT SUM(`attacks`) AS `count` FROM `villages` WHERE `userid`='".$row['id']."'");
		$r = $db->fetch($res);

		if($row['attacks'] != $r['count'] && is_numeric($r['count'])){
			$db->query("UPDATE `users` SET `attacks`='".$r['count']."' WHERE `id`='".$row['id']."'");
		}
	}
	header("LOCATION: index.php?screen=debugger&done=attacks");

	$db->query("UPDATE `login` SET `login_locked`='no'");
}

$tpl->assign("done",@$_GET['done']);
?>