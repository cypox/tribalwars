<?php
if(isset($_GET['action']) && $_GET['action'] == "edit"){
	if(isset($_POST['standard'])){
		foreach($cl_builds->get_array('name') as $dbname=>$name){
			if(in_array($dbname, $config['buildings_starting_by_one'])){
				$db->query("ALTER TABLE `villages` CHANGE `$dbname` `$dbname` INT(5) NULL DEFAULT '".((int)1)."'");
			}else{
				$db->query("ALTER TABLE `villages` CHANGE `$dbname` `$dbname` INT(5) NULL DEFAULT '".((int)0)."'");
			}
		}
	}else{
		foreach($cl_builds->get_array('name') as $dbname=>$name){
			if($_POST[$Var_4] < 0){
				$error = "Geb�ude ".$name.": unter Stufe 0 nicht erlaubt!!!";
			}
			if(in_array($dbname, $config['buildings_starting_by_one']) && $_POST[$dbname] < 1){
				$error = "Building ".$name.": must be at least level 1!";
			}
			if($_POST[$dbname] > $cl_builds->get_maxStage($dbname)){
				$error = "Geb�ude ".$name.": Geb�ude h�her als maximale Ausbaustufe!!!";
			}
		}
		if(empty($error)){
			foreach($cl_builds->get_array('name') as $dbname=>$name){
				$db->query("ALTER TABLE `villages` CHANGE `$dbname` `$dbname` INT(5) NULL DEFAULT '".((int)$_POST[$dbname])."'");
			}
		}
	}
	if(empty($error)){
		header("LOCATION: index.php?screen=start_buildings");
	}
}
$standards = array();
$result = $db->query("SHOW COLUMNS FROM `villages`");
while($row = $db->fetch($result)){
	$standards[$row['Field']] = $row['Default'];
}

$buildings = array();
foreach($cl_builds->get_array('name') as $dbname=>$name){
	$buildings[$dbname]['name'] = $name;
	$buildings[$dbname]['stage'] = $standards[$dbname];
}
$tpl->assign('buildings',$buildings);
$tpl->assign('error',$error);
?>