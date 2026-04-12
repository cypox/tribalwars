<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

$result = $db->query("SELECT `id` FROM `build` WHERE `villageid`='".$village['id']."'");
$auftrage = $db->numrows($result);

$mode = 'build';
if(isset($_GET['mode']) && is_string($_GET['mode']) && $_GET['mode'] == 'destroy'){
	$mode = 'destroy';
}

$total_build = 0;
$total_stage = 0;
foreach($cl_builds->get_array("dbname") as $key=>$value){
	$total_build += $village[$value];
	$total_stage += $cl_builds->get_maxstage($value);
}
$total_const = ceil((($total_build*100)/$total_stage));

$plus_costs = $cl_builds->get_buildsharpens_costs($auftrage)/100+1;

$builds = $cl_builds->get_array("dbname");
foreach($builds as $key => $value){
	$build_village[$value] = $village[$value];
}

$destroy_village = $build_village;

$do_build = array();
$i = 0;
$result = $db->unb_query("SELECT `id`,`building`,`end_time`,`build_time`,`mode` FROM `build` WHERE `villageid`='".$village['id']."' ORDER BY `id`");
while($row = $db->fetch($result)){
	$do_build[$i]['build'] = $row['building'];
	$do_build[$i]['r_id'] = $row['id'];
	if($row['mode'] == 'build'){
		$do_build[$i]['stage'] = ++$build_village[$row['building']];
	}elseif($row['mode'] == 'destroy'){
		$do_build[$i]['stage'] = --$destroy_village[$row['building']];
	}
	$do_build[$i]['dauer'] = $i == 0 ? $row['end_time']-time() : $row['build_time'];
	$do_build[$i]['finished'] = $row['end_time'];
	$do_build[$i]['mode'] = $row['mode'];
	++$i;
}
if(isset($_GET['action']) && $_GET['action'] == "change_name"){
	if(isset($_GET['h']) && is_string($_GET['h']) && $session['hkey'] == $_GET['h']){
		if(strlen($_POST['name']) < 3){
			$error = "Desculpe, más o nome da aldeia deve conter entre 3 e 25 caracteres!";
        }elseif(strlen($_POST['name']) > 25){
			$error = "Desculpe, más o nome da aldeia deve conter entre 3 e 25 caracteres!";
		}
		if(empty($error)){
			$p_name = parse($_POST['name']);
			$db->unb_query("UPDATE `villages` SET `name`='".$p_name."' WHERE `id`='".$village['id']."'");
			$d->open();
			header("LOCATION: game.php?screen=main&village=".$village['id']);
			exit;
		}
	}else{
		$error = "Desculpe, más o código de segurança está invalido!";
	}
}
if(isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == "build"){
	$dbname_array = $cl_builds->get_array('dbname');
	$id_array = array_flip($cl_builds->get_array('dbname'));
	if(!is_string($_GET['id']) || !in_array($_GET['id'], $dbname_array)){
		$error = "Desculpe, más este edifício não existe!";
	}else{
		$cl_builds->build($village, $id_array[$_GET['id']], $build_village, $plus_costs);
		switch($cl_builds->get_build_error2()){
			case "not_enough_ress":	$error = "Desculpe, más não há recursos suficientes!";	break;
			case "not_enough_ress_plus":	$error = "Desculpe, más não existe recursos suficientes para adicionar uma nova ordem de construção!";	break;
			case "max_stage":	$error = "Desculpe, más o edifício já está totalmente construído!";	break;
			case "not_enough_bh":	$error = "Desculpe, más a fazenda não pode sustentar mais habitantes!";	break;
			case "not_enough_storage":	$error = "Desculpe, más o armazém é muito pequeno!";	break;
			case "not_fulfilled":	$error = "Desculpe, más não há os requerimentos necessários!";	break;
		}
	}
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}
	if(empty($error)){
		$wood = $cl_builds->get_wood($_GET['id'],$build_village[$_GET['id']]+1);
		$stone = $cl_builds->get_stone($_GET['id'],$build_village[$_GET['id']]+1);
		$iron = $cl_builds->get_iron($_GET['id'],$build_village[$_GET['id']]+1);
		$bh = $cl_builds->get_bh($_GET['id'],$build_village[$_GET['id']]+1);
		$time = $cl_builds->get_time($village['main'],$_GET['id'],$build_village[$_GET['id']]+1);
		$onlytime = $cl_builds->get_time($village['main'],$_GET['id'],$build_village[$_GET['id']]+1);

		$result = $db->query("SELECT `end_time` FROM `build` WHERE `villageid`='".$village['id']."' ORDER BY `id` DESC LIMIT 1");
        $row = $db->fetch($result);
		if($db->affectedrows() == "0"){
  			$time += time();
  			$add_village_sql = ",main_build='".$_GET['id'].",$time' ";
		}else{
			$time += $row['end_time'];
		}
		$db->query("UPDATE `villages` SET `r_wood`=`r_wood`-'".round($wood*$plus_costs)."',`r_stone`=`r_stone`-'".round($stone*$plus_costs)."',`r_iron`=`r_iron`-'".round($iron*$plus_costs)."',`r_bh`=`r_bh`+'".$bh."' ".$add_village_sql." WHERE `id`='".$village['id']."'");
		$db->query("INSERT INTO `build` (`building`,`villageid`,`end_time`,`build_time`,`mode`) VALUES ('".parse($_GET['id'])."','".$village['id']."','".$time."','".$onlytime."','build')");
		$buildid = $db->getlastid();
		$db->query("INSERT INTO `events` (`event_time`,`event_type`,`event_id`,`user_id`,`villageid`) VALUES ('".$time."','build','".$buildid."','".$user['id']."','".$village['id']."')");
		$d->open();
		header("LOCATION: game.php?screen=main&village=".$village['id']);
		exit;
	}
}
if(isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == "cancel"){
	$g_id = parse($_GET['id']);
	$result = $db->query("SELECT `building`,`villageid`,`mode` FROM `build` WHERE `id`='".$g_id."'");
	$broke_build = $db->fetch($result);
	if(empty($broke_build['building'])){
		$error = "Desculpe, más não encontrams está construção!";
	}
	if($village['id'] != $broke_build['villageid']){
		$error = "Desculpe, más a ordem ja foi cumprida!";
	}
	if(empty($error)){
		$result = $db->query("DELETE FROM `build` WHERE `id`='".$g_id."'" );
		if($db->affectedRows() != "0"){
			$broke_build['stage'] = $build_village[$broke_build['building']];
			$wood = $cl_builds->get_wood($broke_build['building'],$broke_build['stage']);	
			$stone = $cl_builds->get_stone($broke_build['building'],$broke_build['stage']);
			$iron = $cl_builds->get_iron($broke_build['building'],$broke_build['stage']);
			$bh = $cl_builds->get_bh($broke_build['building'],$broke_build['stage']);
			if($broke_build['mode'] == 'build'){
				$db->query("UPDATE `villages` SET `r_wood`=`r_wood`+'".$wood."',`r_stone`=`r_stone`+'".$stone."',`r_iron`=`r_iron`+'".$iron."',`r_bh`=`r_bh`-'".$bh."' WHERE `id`='".$village['id']."'");
			}
			$db->query("DELETE FROM `events` WHERE `event_id`='".$g_id."' AND `event_type`='build'");
			$old_time = time();
			$village2 = $village;
			$is_first = true;
			$result = $db->query("SELECT `id`,`build_time`,`end_time`,`building` FROM `build` WHERE `villageid`='".$village['id']."' ORDER BY `id`");
			while($row = $db->fetch($result)){
				$stage = ++$village2[$row['building']];
				$n_build_time = $cl_builds->get_time($village['main'],$row['building'],$stage);
				if($row['end_time']-$row['build_time'] < time() && $is_first){
					$old_time = $row['end_time'];
				}else{
					$old_time = $old_time+$n_build_time;
					$db->query("UPDATE `build` SET `end_time`='".$old_time."',`build_time`='".$n_build_time."' WHERE `id`='".$row['id']."'");
					$db->query("UPDATE `events` SET `event_time`='".$old_time."' WHERE `event_id`='".$row['id']."' AND `event_type`='build'");
				}
				if($is_first){
					$first_build = $row['building'].",".$old_time;
				}
				$is_first = false;
            }
            if($is_first == true){
				$db->query("UPDATE `villages` SET `main_build`='' WHERE `id`='".$village['id']."'");
			}else{
				$db->query("UPDATE `villages` SET `main_build`='".$first_build."' WHERE `id`='".$village['id']."'");
			}
            $d->open();
			header("LOCATION: game.php?village=".$village['id']."&screen=main&mode=".$_GET['mode']);
			exit;
		}
	}
}
$built_builds = array();
foreach($builds as $id=>$dbname){
	$needed = $cl_builds->get_needed($id);
	$needed_done = true;
	foreach($needed as $dbname2=>$needed_stage){
		if($village[$dbname2] < $needed_stage){
			$needed_done = false;
		}
	}
	if($village[$dbname] > 0 || $needed_done){
		$fulfilled_builds[$id] = $dbname;
		$nivel = $village[$dbname];
		$n_max = $cl_builds->get_maxstage($dbname);
		$c1[$dbname] = ceil(($nivel*100)/$n_max);
	}
}

$result = $db->query("SELECT * FROM `build` WHERE `mode`='build' AND `villageid`='".$village['id']."'");
$num_do_build = $db->numrows($result);

$num_build_all = count($do_build);

if(!isset($error)) $error = "";

if($_GET['mode'] == 'destroy' && $village['main'] >= 15 && $config['build_destroy']){
	require_once("main_destroy.php");
}

$cladiri = array("barracks","stable","garage","snob","smith","market","wall");
$i = 1;
foreach($cladiri as $build){
	$sql = $db->fetch($db->query("SELECT `$build` FROM `villages` WHERE `id`='".$village['id']."'"));
	if($sql[$build] == 0){
		$build_no[$i] = $build;
		$i++;
	}
}

$tpl->assign("neconstruit", $build_no);
$tpl->assign("mode", $mode);
$tpl->assign("cl_builds", $cl_builds);
$tpl->assign("builds", $builds);
$tpl->assign("do_build", $do_build);
$tpl->assign("build_village", $build_village);
$tpl->assign("destroy_village", $destroy_village);
$tpl->assign("error", $error);
$tpl->assign("c1", $c1);
$tpl->assign("time", time());
$tpl->assign("fulfilled_builds", $fulfilled_builds);
$tpl->assign("num_do_build", $num_do_build);
$tpl->assign("num_build_all", $num_build_all);
$tpl->assign("description", $cl_builds->get_description_bydbname('main'));
$tpl->assign("plus_costs", $plus_costs);
$tpl->assign("builds_start_by_one", $config['buildings_starting_by_one']);
$tpl->assign("porcent", $total_const);
$tpl->register_modifier("stage", "stage");
$tpl->register_modifier("format_date", "format_date");
$tpl->register_modifier("format_time", "format_time");
$tpl->assign("config", $config);
?>