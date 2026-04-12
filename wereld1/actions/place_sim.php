<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

foreach($cl_units->get_array("dbname") as $name => $dbname){
	if(isset($_POST['att_'.$dbname]) && is_numeric($_POST['att_'.$dbname])){
		$values['att'][$dbname] = (int)$_POST['att_'.$dbname];
	}else{
		$values['att'][$dbname] = "";
	}
	if(isset($_POST['att_tech_'.$dbname]) && is_numeric($_POST['att_tech_'.$dbname])){
		$values['att_tech'][$dbname] = (int) $_POST['att_tech_'.$dbname];
	}else{
		$values['att_tech'][$dbname] = "";
	}
	if(isset($_POST['def_'.$dbname]) && is_numeric($_POST['def_'.$dbname])){
		$values['def'][$dbname] = (int)$_POST['def_'.$dbname];
	}else{
		$values['def'][$dbname] = "";
	}
	if(isset($_POST['def_tech_'.$dbname]) && is_numeric($_POST['def_tech_'.$dbname])){
		$values['def_tech'][$dbname] = (int)$_POST['def_tech_'.$dbname];
	}else{
		$values['def_tech'][$dbname] = "";
	}
}

if(isset($_POST['def_wall']) && is_numeric($_POST['def_wall'])){
	$values['def_wall'] = $_POST['def_wall'];
}elseif(isset($_POST['def_wall']) && $_POST['def_wall'] < 0){
	$values['def_wall'] = "";
}else{
	$values['def_wall'] = "";
}

if(isset($_POST['def_building']) && is_numeric($_POST['def_building']) && $_POST['def_building'] > 0){
	$values['def_building'] = $_POST['def_building'];
}else{
	$values['def_building'] = "";
}
if(isset($_POST['def_build_wall']) && $_POST['def_build_wall'] == true){
	$values['def_build_wall'] = true;
}else{
	$values['def_build_wall'] = false;
}

if(isset($_POST['luck']) && (!is_numeric($_POST['luck']))){
	$values['luck'] = 0;
}elseif(isset($_POST['luck']) && ($_POST['luck'] > '25' || $_POST['luck'] < '-25')){
    $values['luck'] = 0;
}elseif(isset($_POST['luck'])){
    $values['luck'] = $_POST['luck'];
}else{
	$values['luck'] = 0;
}

if(isset($_POST['moral']) && (!is_numeric($_POST['moral']))){
	$values['moral'] = 100;
}elseif(isset($_POST['moral']) && $_POST['moral'] > 100){
	$values['moral'] = 100;
}elseif(isset($_POST['moral']) && $_POST['moral'] < 25){
	$values['moral'] = 30;
}elseif(isset($_POST['moral'])){
	$values['moral'] = (int)$_POST['moral'];
}else{
	$values['moral'] = 100;
}

if(isset($_POST['simulate'])){
	$att = array();
	$att_tech = array();
	$def = array();
	$def_tech = array();

	foreach($cl_units->get_array("dbname") as $name => $dbname){
		if(isset($_POST['att_'.$dbname]) && (is_numeric($_POST['att_'.$dbname]) && $_POST['att_'.$dbname] > 0)){
			$att[$dbname] = (int)$_POST['att_'.$dbname];
		}else{
			$att[$dbname] = 0;
		}
		if(isset($_POST['att_tech_'.$dbname]) && (is_numeric($_POST['att_tech_'.$dbname]) && $_POST['att_tech_'.$dbname] > 0)){
			$att_tech[$dbname] = (int)$_POST['att_tech_'.$dbname];
		}else{
			$att_tech[$dbname] = 1;
		}
		if(isset($_POST['def_'.$dbname]) && (is_numeric($_POST['def_'.$dbname]) && $_POST['def_'.$dbname] > 0)){
			$def[$dbname] = (int)$_POST['def_'.$dbname];
		}else{
			$def[$dbname] = 0;
		}
		if(isset($_POST['def_tech_'.$dbname]) && (is_numeric($_POST['def_tech_'.$dbname]) && $_POST['def_tech_'.$dbname] > 0)){
			$def_tech[$dbname] = (int)$_POST['def_tech_'.$dbname];
		}else{
			$def_tech[$dbname] = 1;
		}		
	}
    $others = array();
	if($values['def_wall'] > 0){
		$others['def_wall'] = (int)$values['def_wall'];
	}else{
		$others['def_wall'] = 0;
	}
	if(isset($_POST['def_building']) && (is_numeric($_POST['def_building']) && $_POST['def_building'] > 0)){
		$others['def_building'] = (int)$_POST['def_building'];
	}else{
		$others['def_building'] = 0;
	}
	if(isset($_POST['luck']) && is_numeric($_POST['luck'])){
		$others['luck'] = (int)$_POST['luck'];
	}else{
		$others['luck'] = 0;
	}

	$others['moral'] = $values['moral'];
	if($values['def_build_wall']){
		$others['cata_building'] = "wall";
	}else{
		$others['cata_building'] = "wood";
	}
	$simulate_values = simulate($att,$att_tech,$def,$def_tech,$others);

	$tpl->assign("simulate_values", $simulate_values);
	$tpl->assign("simulate", true);
}
$tpl->assign("values", $values);
$tpl->assign("moral_activ", $config['moral_activ']);
?>