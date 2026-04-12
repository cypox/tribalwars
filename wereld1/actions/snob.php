<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

$buildname = "snob";
if($cl_builds->check_needed($buildname,$village) && $village[$buildname] > 0){
	$show_build = true;
}else{
	$show_build = false;
}

if($show_build){
	$units = $cl_units->get_recruit_in_units($buildname);
    $sql = "SELECT ";
    $i = 0;
	foreach($units as $key=>$value){
		$i++;
		if(count($units) == $i){
			$sql .= $key;
		}else{
			$sql .= $key.",";
		}
	}
	$sql .= " FROM `unit_place` WHERE `villages_from_id`='".$village['id']."' AND `villages_to_id`='".$village['id']."'";
	$result = $db->query($sql);
	$units_in_village = $db->fetch($result);

	$sql = "SELECT ";
	$i = 0;
	foreach ($units as $key=>$value){
		$i++;
		if(in_array("no_investigate", $cl_units->get_specials($key))){
 			if(count($units) == $i){
				$sql .= "all_".$key;
			}else{
				$sql .= "all_".$key;
			} 	
		}else{
			if(count($units) == $i){
				$sql .= "all_".$key.",".$key."_tec_level";
			}else{
				$sql .= "all_".$key.",".$key."_tec_level,";
			}
		}
	}
	$sql .= " FROM `villages` WHERE `id`='".$village['id']."'";
	$result = $db->query($sql);
	$units_all = $db->fetch($result);

	$village = $village + $units_all;

	foreach($units as $key=>$value){
		$units_all[$key] = $units_all["all_".$key];
	}

    if($config['ag_style'] == 1){
        $result = $db->query("SELECT SUM(`snob`) AS `stages`,SUM(`all_unit_snob`) AS `snob_sum`,SUM(`recruited_snobs`) AS `rec_snobs` FROM `villages` WHERE `userid`=".$user['id']."");
		$row = $db->fetch($result);
        $village['snob_info']['stage_snobs'] = $row['stages'];
        $village['snob_info']['all_snobs'] = $row['snob_sum'];
        $village['snob_info']['ags_in_prod'] = $row['rec_snobs']-$row['snob_sum'];
        $village['snob_info']['control_villages'] = $user['villages']-1;
        $village['snob_info']['recruited_snobs'] = $row['rec_snobs'];
        $village['snob_info']['can_prod'] = $row['stages']-$row['rec_snobs']-$village['snob_info']['control_villages'];
    }elseif($config['ag_style'] == 2){
		$price = $config['gold_coin_price'];
		if($price['wood'] > $village['r_wood'] || $price['stone'] > $village['r_stone'] || $price['iron'] > $village['r_iron']){
			if($price['wood'] > $village['r_wood']){
				$missing = ($price['wood']-$village['r_wood_comma'])/$config['speed'];
				$per_second = $arr_production[$village['wood']]/3600;
				$timeA = $missing/$per_second;
			}else{
				$timeA = 0;
			}
			if($price['stone'] > $village['r_stone']){
				$missing = ($price['stone']-$village['r_stone_comma'])/$config['speed'];
				$per_second = $arr_production[$village['stone']]/3600;
				$timeB = $missing/$per_second;
			}else{
				$timeB = 0;
			}
			if($price['iron'] > $village['r_iron']){
				$missing = ($iron-$village['r_iron_comma'])/$config['speed'];
				$per_second = $arr_production[$village['iron']]/3600;
				$timeC = $missing/$per_second;
			}else{
				$timeC = 0;
			}
		
			$wait_seconds = ceil(max($timeA, $timeB, $timeC));
			$build_error = format_time($wait_seconds);
			$makeCoin = false;
		}else{
			$makeCoin = true;
		}

		$getCoins = $db->query("SELECT coins FROM users WHERE id = ".$user['id']."");
		while($rowCoin = $db->fetch($getCoins)){
			$coinsAll = $rowCoin['coins'];
		}
		$getAllSnobs = $db->query("SELECT snobs FROM users WHERE id = ".$user['id']."");
		while($rowGetAllSnobs = $db->fetch($getAllSnobs)){
			$allRecruitedSnobs = $rowGetAllSnobs['snobs'];
		}
		$getTotal = $db->query("SELECT snobs FROM users WHERE id = ".$user['id']."");
		while($row = $db->fetch($getTotal)){
			$totalSnobs = $row['snobs'];
		}
		$getNow = $db->query("SELECT SUM(all_unit_snob) AS allSnobs FROM villages WHERE userid = ".$user['id']."");
		while($rowN = $db->fetch($getNow)){
			$snobsNow = $rowN['allSnobs'];
		}
		if($snobsNow < $totalSnobs){
			$new = $totalSnobs-$snobsNow;
			$db->query("UPDATE users SET snobs = $new WHERE id = ".$user['id']."");
		}
		$getAllVillages = $db->query("SELECT * FROM villages WHERe userid = ".$user['id']."");
		while($rowVilles = $db->fetch($getAllVillages)){
			$villages[] = $rowVilles;
		}
		$inRecruit = 0;
		for($i=0;$i<count($villages);$i++){
			$recruit = $db->query("SELECT SUM(num_unit) AS unit FROM recruit WHERE unit = 'unit_snob' AND villageid = ".$villages[$i]['id']."");
			while($rowR = $db->fetch($recruit)){
				$inRecruit += $rowR['unit'];
			}
		}
		$amountSnobsCanBeRecruited = snobs_per_coins_recruited($snobsNow, $coinsAll);
		if($amountSnobsCanBeRecruited != 0){
			$amountSnobsCanBeRecruited -= $inRecruit;
			$getVillages = $db->query("SELECT * FROM villages WHERE userid = ".$user['id']."");
			if($config['ag_style'] == 2){
				$enobled = ($db->numrows($getVillages)-$config['min_villages']);
			}else{
				$enobled = ($db->numrows($getVillages)-1);
			}
			$amountSnobsCanBeRecruited -= $enobled;
		}
		$snobLimit = $snobsNow+$inRecruit+$enobled+$amountSnobsCanBeRecruited;
		$getCoinsNext = $db->query("SELECT coinsNext FROM users WHERE id = ".$user['id']."");
		while($rowCN = $db->fetch($getCoinsNext)){
			$coinsNext = $rowCN['coinsNext'];
		}
		if(isset($_GET['action']) && $_GET['action'] == 'coin'){
			if(!$makeCoin){
				header("LOCATION: game.php?village=".$village['id']."&screen=snob");
				exit;
			}else{
				$uid = $user['id'];
				$db->query("UPDATE users SET coins = coins + 1 WHERE id = $uid");
				if($coinsNext == 1){
					$newNext = $snobLimit+2;
					$db->query("UPDATE users SET coinsNext = $newNext WHERE id = ".$user['id']."");
				}else{
					$db->query("UPDATE users SET coinsNext = coinsNext - 1 WHERE id = ".$user['id']."");
				}
				$db->query("UPDATE villages SET r_wood=r_wood-'".$price['wood']."',r_stone=r_stone-'".$price['stone']."',r_iron=r_iron-'".$price['iron']."' WHERE `id`='".$village['id']."'");
				$db->query("UPDATE `medal` SET `gold`=`gold`+'1' WHERE `userid`='".$user['id']."'");
				header("LOCATION: game.php?village=" . $village['id'] . "&screen=snob");
				exit;
			}
		}
	}
    $error = "";
    if(isset($_GET['action']) && $_GET['action'] == "train_snob"){
        $c = new do_action($user['id']);
		$c->close();
        if($session['hkey'] != $_GET['h']){
            $error = "Desculpe, más o código de segurança está invalido!";
        }

        $check = "";
        $reload = false;
        foreach($units as $key=>$value){
            $cl_units->check_needed($key,$village);

			$input = 1;

			$wood = $cl_units->get_woodprice($key)*$input;
			$stone = $cl_units->get_stoneprice($key)*$input;
			$iron = $cl_units->get_ironprice($key)*$input;
			$bh = $cl_units->get_bhprice($key)*$input;

			if($wood > $village['r_wood'] || $stone > $village['r_stone'] || $iron > $village['r_iron']){
			    $check = "to_many_units";
			}
            if(($arr_farm[$village['farm']]-$village['r_bh']-$bh < 0) && empty($check)){
                $check = "to_many_bh";
            }
            if(empty($check) && is_numeric($cl_units->last_error) && $input > 0){
                $db->query("UPDATE `villages` SET `r_wood`=`r_wood`-'".$wood."',`r_stone`=`r_stone`-'".$stone."',`r_iron`=`r_iron`-'".$iron."',`r_bh`=`r_bh`+'".$bh."',`recruited_snobs`=`recruited_snobs`+'1' WHERE `id`='".$village['id']."'" );
				if($config['ag_style'] == 2){
					$db->query("UPDATE `users` SET `snobs`=`snobs`+'1' WHERE `id`='".$user['id']."'");
				}
                $village['r_wood'] -= $wood;
                $village['r_stone'] -= $stone;
                $village['r_iron'] -= $iron;
                $village['r_bh'] += $bh;
                $cl_units->recruit_units($key,$input,$buildname,$village[$buildname],$village['id']);
                $reload = true;
            }
        }
        $c->open();
        if($reload){
            header("LOCATION: game.php?village=".$village['id']."&screen=".$_GET['screen']."");
			exit;
        }
        if(empty($check)){
            $check = $cl_units->last_error;
        }
		switch($check){
			case "not_tec" :	$error = "Desculpe, más está unidade não foi pesquisada!";	break;
			case "build_ah" :	$error = "Desculpe, más não é possível produzir mais nobres!.";	break;
			case "not_needed" :	$error = "Desculpe, más não há os requerimentos necessários!";	break;
			case "not_enough_ress" :	$error = "Desculpe, más não há recursos suficientes!";	break;
			case "not_enough_bh" :	$error = "Desculpe, más a fazenda não pode sustentar mais habitantes!";	break;
			case "to_many_units" :	$error = "Desculpe, más não há recursos suficientes!";	break;
			case "to_many_bh" :	$error = "Desculpe, más a fazenda não pode sustentar mais habitantes!";	break;
		}
	}
	if(isset($_GET['action']) && $_GET['action'] == "cancel" && isset($_GET['id'])){
		if($session['hkey'] != $_GET['h']){
			$error = "Desculpe, más o código de segurança está invalido!";
		}

		$g_id = parse($_GET['id']);
		$result = $db->query("SELECT `unit`,`villageid`,`num_finished`,`num_unit` FROM `recruit` WHERE `id`='".$g_id."'");
		$row = $db->fetch($result);
        if($row['villageid'] != $village['id']){
            $error = "Desculpe, más houve um erro ao executar a ação!";
        }
		if (!in_array($row['unit'], array_flip($units))){
            $error = "Desculpe, más o rerutamento não pode ser cancelado!";
        }
		if(empty($error)){
			while(true){
				$result = $db->query("SELECT COUNT(`id`) AS `count` FROM `events` WHERE `event_type`='recruit' AND `event_id`='".$g_id."'");
				$row = $db->fetch($result);
				if($row['count'] != 1){
					$error = "Desculpe, más o recrutamento já foi concluido!";
					break;
				}
				$result = $db->query("UPDATE `events` SET `cid`='1' WHERE `event_type`='recruit' AND `event_id`='".$g_id."' AND `cid`='0'");
				if($db->affectedrows() == 1){
					$result = $db->query("SELECT `unit`,`villageid`,`num_finished`,`num_unit` FROM `recruit` WHERE `id`='".$g_id."'");
					$row = $db->fetch($result);
					break;
				}
			}
			if(empty($error)){
				$db->query("DELETE FROM `events` WHERE `event_type`='recruit' AND `event_id`='".$g_id."'");
				$db->query("DELETE FROM `recruit` WHERE `id`='".$g_id."'");
				$wood = round(($cl_units->get_woodprice($row['unit'])*($row['num_unit']-$row['num_finished']))*0.90);
				$stone = round(($cl_units->get_stoneprice($row['unit'])*($row['num_unit']-$row['num_finished']))*0.90);
				$iron = round(($cl_units->get_ironprice($row['unit'])*($row['num_unit']-$row['num_finished']))*0.90);
				$bh = $cl_units->get_bhprice($row['unit'])*($row['num_unit']-$row['num_finished']);
				$old_time = time();
				$result = $db->query("SELECT `id`,`time_start`,`time_finished`,`building` FROM `recruit` WHERE `villageid`='".$village['id']."' AND `building`='".$buildname."'");
				while($row = $db->fetch($result)){
					if($row['time_start'] < time()){
						$old_time = $row['time_finished'];
		    		}else{
		    			$start_time = $old_time;
		    			$old_time = $old_time+($row['time_finished']-$row['time_start']);
		    			$db->query("UPDATE `recruit` SET `time_finished`='".$old_time."',`time_start`='".$start_time."' WHERE `id`='".$row['id']."'");
		   				$db->query("UPDATE `events` SET `event_time`='".$old_time."' WHERE `event_id`='".$row['id']."' AND `event_type`='recruit'");
		   			}
				}
				$db->query("UPDATE `villages` SET `r_wood`=`r_wood`+'".$wood."',`r_stone`=`r_stone`+'".$stone."',`r_iron`=`r_iron`+'".$iron."',`r_bh`=`r_bh`-'".$bh."',`recruited_snobs`=`recruited_snobs`-'1' WHERE `id`='".$village['id']."'");
				header("LOCATION: game.php?village=".$village['id']."&screen=".$_GET['screen']."");
				exit;
			}
		}
	}

	$recruit_units = array();
	$i = 0;
	$result = $db->query("SELECT `id`,`unit`,`num_unit`,`num_finished`,`time_finished`,`time_start` FROM `recruit` WHERE `villageid`='".$village['id']."' AND `building`='".$buildname."' ORDER BY `time_start`");
	while($row = $db->fetch($result)){
		$i++;
	    if($i == "1"){
	        $recruit_units[$row['id']]['lit'] = true;
		}else{
		    $recruit_units[$row['id']]['lit'] = false;
		}
		$recruit_units[$row['id']]['unit'] = $row['unit'];
		$recruit_units[$row['id']]['num_unit'] = $row['num_unit']-$row['num_finished'];
		$recruit_units[$row['id']]['unit'] = $row['unit'];
		$recruit_units[$row['id']]['time_finished'] = $row['time_finished'];
	    if($i == "1"){
			$recruit_units[$row['id']]['countdown'] = $row['time_finished']-time();
		}else{
		    $recruit_units[$row['id']]['countdown'] = $row['time_finished']-$row['time_start'];
		}
	}

	$snobed_villages = array();
	$result = $db->query("SELECT `name`,`id`,`x`,`y`,`continent` FROM `villages` WHERE `snobed_by`='".$village['id']."'");
	while($row = $db->fetch($result)){
		$snobed_villages[$row['id']] = entparse($row['name'])." (".$row['x']."|".$row['y'].") K".$row['continent'];
	}
	$tpl->assign("units", $units);
	$tpl->assign("snobed_villages", $snobed_villages);
	$tpl->assign("error", $error);
	$tpl->assign("units_in_village", $units_in_village);
	$tpl->assign("units_all", $units_all);
	$tpl->assign("recruit_units", $recruit_units);
}

$tpl->assign("description", $cl_builds->get_description_bydbname($buildname));
$tpl->assign("cl_units", $cl_units);
$tpl->assign("buildname", $cl_builds->get_name($buildname));
$tpl->assign("dbname", $buildname);
if($config['ag_style'] == 2){
	$tpl->assign("amountSnobsCanBeRecruited", $amountSnobsCanBeRecruited);
	$tpl->assign("coinError", $build_error);
	$tpl->assign("makeCoin", $makeCoin);
	$tpl->assign("coinsAll", $coinsAll);
	$tpl->assign("coinPrice", array(
		"wood" => $price['wood'],
		"stone" => $price['stone'],
		"iron" => $price['iron']
	));
	$tpl->assign("snobLimit", $snobLimit);
	$tpl->assign("snobsNow", $snobsNow);
	$tpl->assign("inRecruit", $inRecruit);
	$tpl->assign("enobled", $enobled);
	$tpl->assign("coinsNext", $coinsNext);
}
$tpl->assign("ag_style", $config['ag_style']);
$tpl->assign("show_build", $show_build);
?>