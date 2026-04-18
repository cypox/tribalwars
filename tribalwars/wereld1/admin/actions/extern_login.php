<?php
$res = $db->query("SELECT `extern_auth` FROM `login`");
$row = $db->fetch($res);

if($_GET['action'] == 'close'){
	$db->query("UPDATE `login` SET `extern_auth`=''");
	header("LOCATION: index.php?screen=extern_login");
}elseif($_GET['action'] == 'open'){
	$db->query("UPDATE `login` SET `extern_auth`='".generate_key()."'");
	header("LOCATION: index.php?screen=extern_login");
}
$tpl->assign("hash",$row['extern_auth']);
?>