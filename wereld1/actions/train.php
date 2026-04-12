<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

$train = new train();
if($village['barracks'] > 0){
	$units_in_village = $train->get_units_in_village($village);
	$units_all = $train->get_all_units($village,$Units);
	$village += $units_all;
	
	foreach($train->Units as $key=>$value){
		$units_all[$key] = $units_all["all_".$key];
	}
	
	$tpl->assign("units",$train->units);
	$tpl->assign("village",$village);
	$tpl->assign("cl_units",$cl_units);
	$tpl->assign("units_in_village",$units_in_village);
	$tpl->assign("units_all",$units_all);
	$tpl->assign("arr_farm",$arr_farm);

	if($_GET['screen'] == "train" && !isset($_GET['mode'])){
		$recruit_units = $train->get_recruit($village);
		$tpl->assign("recruit_units",$recruit_units);
	}
	if($_GET['action'] == "train"){
		if($session['hkey'] != $_GET['h']){
			$error = "HKEY!";
		}
		$recruited = $train->do_action($village['id'],"single");
	}
	if($_GET['mode'] == "mass"){
		$villages = array();
		$query = $db->query("SELECT * FROM `villages` WHERE `userid`='".$village['userid']."' AND `barracks`>0");
		$current_amount = 1;
		$i = 0;
		$persite = $_GET['persite'] > 0 ? (int)$_GET['persite'] : 50;
		$_GET['site'] = $_GET['site'] > 0 ? (int)$_GET['site'] : 1; 
		while($row = $db->fetch($query)){
			if($i >= (($persite*$_GET['site'])-50)){
				if($current_amount <= $persite)
					$villages[] = (int)$row['id'];
				reload_resource_villages($user['id'], $row['id']);
				++$current_amount;
			}
			++$i;
		}
		$farmLimits = $arr_farm;
		$in_prod = array();
		foreach($villages as $for_village){
			$query = $db->query("SELECT * FROM `recruit` WHERE `villageid`='".$for_village."'");
			while($row = $db->fetch($query)){
				$in_prod[$for_village][$row['unit']] = true;
			}
		}
		$tpl->assign("get", $_GET);
		$tpl->assign("sites", ceil($i/$persite));
		$tpl->assign("persite", $persite); 
		$tpl->assign("in_prod", $in_prod);
		$tpl->assign("villages", $villages);
		$tpl->assign("farmLimits", $farmLimits);
	
		if($_GET['mode'] == "mass" && $_GET['action'] == "train_mass" && $_POST){
			$c = new do_action($user['id']);
			$c->close();
	
			$check = ""; 
			foreach($villages as $cur_village){
				$train->do_action($cur_village);
			}
			$c->open();
		}
	}
	if(isset($_GET['action']) && $_GET['action'] == "cancel" && isset($_GET['id'])){
		if($session['hkey'] != $_GET['h']){
			$error = "HKEY inv&aacute;lida!";
		}
		$g_id = parse($_GET['id']);
		$result = $db->query("SELECT unit,villageid,num_finished,num_unit from recruit where id='$g_id'");
		$row = $db->fetch($result);
	
		if($row['villageid'] != $village['id']){
			$error = "Auftrag bereits fertig gestellt.";
		}
		if(empty($error)){
			while(true){
				$result = $db->query("SELECT Count(id) AS count from events where event_type='recruit' AND event_id='$g_id'");
				$row = $db->Fetch($result);
				if($row['count'] != 1){
					$error = "Auftrag bereits fertig gestellt.";
					break;
				}
				$result = $db->query("UPDATE events SET cid='1' where event_type='recruit' AND event_id='$g_id' AND cid=0");
				if($db->affectedrows() == 1){
					$result = $db->query("SELECT unit,villageid,num_finished,num_unit from recruit where id='$g_id'");
					$row = $db->fetch($result);
					break;
				}
			}
			if (empty($error)) {
				$db->query("DELETE from events where event_type='recruit' AND event_id='$g_id'");
				$db->query("DELETE from recruit where id='$g_id'");
	
				$wood = round(($cl_units->get_woodprice($row['unit'])*($row['num_unit']-$row['num_finished']))*0.90);
				$stone = round(($cl_units->get_stoneprice($row['unit'])*($row['num_unit']-$row['num_finished']))*0.90);
				$iron = round(($cl_units->get_ironprice($row['unit'])*($row['num_unit']-$row['num_finished']))*0.90);
				$bh = $cl_units->get_bhprice($row['unit'])*($row['num_unit']-$row['num_finished']);
	
				$old_time = time();
				$result = $db->query("SELECT id,time_start,time_finished,building from recruit where villageid='".$village['id']."' AND building='$buildname'");
				while($row = $db->fetch($result)){
					if($row['time_start'] < time()){
						$old_time = $row['time_finished'];
					}else{
						$start_time = $old_time;
						$old_time = $old_time+($row['time_finished']-$row['time_start']);
						$db->query("UPDATE recruit SET time_finished='$old_time',time_start='$start_time' where id='".$row['id']."'");  //Recruit Update
						$db->query("UPDATE events SET event_time='$start_time' where event_id='".$row['id']."' AND event_type='recruit'"); 	// Event Updates
					}
				}
				$db->query("UPDATE villages SET r_wood=r_wood+'$wood',r_stone=r_stone+'$stone',r_iron=r_iron+'$iron',r_bh=r_bh-'$bh' where id='".$village['id']."'");
				$d->open();
				header("LOCATION: game.php?village=".$village['id']."&screen=".$_GET['screen']);
			}
		}
	}
}
$tpl->assign("get",$_GET);
$tpl->assign("recruited",$train->recruited);
$tpl->assign("hkey",$session['hkey']);
$tpl->assign("mode",$_GET['mode']);
?>