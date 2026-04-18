<?php
function msec(){
    list($msec, $sec) = explode(' ', microtime());
    return ($sec%3600)*1000+$msec*1000;
}

$load_msec = msec();
require_once("../include.inc.php");
if($_GET['action'] == "logout"){
	setcookie("admin_pw", "");
	header("LOCATION: index.php");
}
if($_COOKIE['admin_pw'] != md5($config['master_pw'])){
	if($_GET['action'] == "login" ){
		setcookie("admin_pw", md5($_POST['pw']));
		header("LOCATION: index.php");
		exit;
	}
	$tpl = new Smarty();
	$tpl->assign("config", $config);
	$tpl->display("index_login.tpl");
	exit;
}

$tpl = new Smarty();

if(!isset($_GET['screen'])) $_GET['screen'] = "startpage";

$allow_screens = array("startpage","debugger","extern_login","logs","mail","reset","refugee_camp","reset_done","start_buildings","save_round");
if(in_array(@$_GET['screen'], $allow_screens)){
	require("actions/".$_GET['screen'].".php");
}

$extern_menue = array();
$ordner = "./extern_modules";
$handle = opendir($ordner);
while($file = readdir($handle)){
	$toolname = "";
	$screenname = "";
	if($file == "." || $file == "..")
		continue;
	require_once("extern_modules/".$file);
	if(empty($toolname)){
		echo "<b>Fehler:</b> Tool ".$file." hat einen leeren Wert bei \$toolname!<br />";
		continue;
	}elseif(empty($screenname)){
		echo "<b>Fehler:</b> Tool ".$file." hat einen leeren Wert bei \$screenname!<br />";
		continue;
	}
	$extern_menue[$toolname] = $screenname;
	if($_GET['screen'] == $screenname){
		if(is_file("actions/".$screenname.".php")){
			require_once("actions/".$screenname.".php");
		}else{
			echo "<b>Fehler:</b> Aktionsdatei wurde nicht gefunden. Eventuell ist dieses Tool defekt!<br />";
		}
	}
	$allow_screens[] = $screenname;
}
closedir($handle);

$tpl->assign("servertime", date("G:i:s"));
$tpl->assign("load_msec", round(msec()-$load_msec));
$tpl->assign("screen", @$_GET['screen']);
$tpl->assign("allow_screens", $allow_screens);
$tpl->assign("extern_menue", $extern_menue);
$tpl->display("index.tpl");
?>