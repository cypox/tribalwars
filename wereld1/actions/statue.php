<?php
// copied & changed snob.php

// Sicherheits Ausführungscheck:
if ($ACTIONS_MASSIVKEY_HIGHAAASSDD!='sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL') {
	die("Aktions - Ausführung EXEC!");
}

// Believe it or not:
$buildname="statue";

// nothing != null ;)
if(isset($_GET['mode']))
{
	$mode = $_GET['mode'];
}
else
{
	$mode = "main";
}

// Get Pala's name
$result = $db->query("SELECT `knightname` FROM `users` WHERE `id` = '".$user['id']."'");
$row = $db->fetch($result);
$knightname = $row['knightname'];
if(empty($knightname))
{
	$knightname = $lang->grab("configs_units", "knight");
}

// Change Pala's name
if(isset($_GET['action']) && $_GET['action'] == "knights_name" && isset($_POST['knights_name']))
{
	if(strlen($_POST['knights_name']) >= 3 && strlen($_POST['knights_name']) <= 50)
	{
		$knightname = $_POST['knights_name'];
		$knightname = str_replace("<", "&lt;", $knightname);
		$knightname = str_replace(">", "&gt;", $knightname);
		$db->query("UPDATE `users` SET `knightname` = '".$knightname."' WHERE `id` = '".$user['id']."'");
	}
	else
	{
		$error = $lang->grab("statue", "pala_name_error");
	}
}

// Could we already have a pala?
$pala_exists = false;
$pala_moveable = false;
$pala_doing = "";
$result = $db->query("SELECT * FROM `villages` WHERE `userid` = '".$user['id']."'");
while($row = $db->fetch($result))
{
	// Is there a Pala standing in a village?
	$result1 = $db->query("SELECT * FROM `unit_place` WHERE `villages_from_id` = '".$row['id']."'");
	while($row1 = $db->fetch($result1))
	{
		if($row1['unit_knight'] > 0)
		{
			$pala_exists = true;
			if($row['id'] != $village['id'])
			{
				// Only, and only in exactly this case, the player can move his Pala to an other village!
				$pala_moveable = true;
				$pala_vill_id = $row['id'];
				$pala_place_id = $row1['villages_to_id'];
			}
			$pala_doing = ($lang->grab("statue", "pala_idle"));
			if($knightname == $lang->grab("configs_units", "knight"))
			{
				$pala_doing = str_replace("%p", $lang->grab("statue", "your_pala"), $pala_doing);
			}
			else
			{
				$pala_doing = str_replace("%p", $knightname, $pala_doing);
			}
			$result3 = $db->query("SELECT * FROM `villages` WHERE `id` = '".$row1['villages_to_id']."'");
			$row3 = $db->fetch($result3);
			if($pala_moveable)
			{
				$pala_doing = str_replace("%v", '<a href="game.php?village='.$village['id'].'&amp;screen=info_village&amp;id='.$row3['id'].'">'.(entparse($row3['name'])).' ('.$row3['x'].'|'.$row3['y'].')</a>', $pala_doing);
			}
			else
			{
				$pala_doing = str_replace("%v", ($lang->grab("statue", "this_village2")), $pala_doing);
			}
		}
	}

	// Or is the player just recruiting a Pala?
	$result2 = $db->query("SELECT * FROM `recruit` WHERE (`unit` = 'unit_knight' AND `villageid` = '".$row['id']."')");
	if($db->numRows($result2) > 0)
	{
		$pala_exists = true;
	}
}
// Or is there a moving Pala?
if(!$pala_exists)
{
	$result = $db->query("SELECT * FROM `movements` WHERE `from_userid` = '".$user['id']."'");
	while($row = $db->fetch($result))
	{
		$mov_units = explode(";", $row['units']);
		$mov_count = 0;
		foreach($cl_units->dbname as $key=>$value)
		{
			if($value == 'unit_knight' && $mov_units[$mov_count] > 0)
			{
				$pala_exists = true;
				if($row['type'] == "attack")
				{
					$pala_doing = ($lang->grab("statue", "pala_att"));
				}
				elseif($row['type'] == "support")
				{
					$pala_doing = ($lang->grab("statue", "pala_supp"));
				}
				else
				{
					$pala_doing = ($lang->grab("statue", "pala_return"));
					$gramm_mode = true;
				}
				if($knightname == $lang->grab("configs_units", "knight"))
				{
					$pala_doing = str_replace("%p", $lang->grab("statue", "your_pala"), $pala_doing);
				}
				else
				{
					$pala_doing = str_replace("%p", $knightname, $pala_doing);
				}
				$result1 = $db->query("SELECT * FROM `villages` WHERE `id` = '".$row['send_to_village']."'");
				$row1 = $db->fetch($result1);
				if($row1['id'] == $village['id'] && isset($gramm_mode))
				{
					$pala_doing = str_replace("%v", $lang->grab("statue", "this_village2"));
				}
				elseif($row1['id'] == $village['id'])
				{
					$pala_doing = str_replace("%v", $lang->grab("statue", "this_village1"));
				}
				else
				{
					$pala_doing = str_replace("%v", '<a href="game.php?village='.$village['id'].'&amp;screen=info_village&amp;id='.$row1['id'].'">'.(entparse($row1['name'])).' ('.$row1['x'].'|'.$row1['y'].')</a>', $pala_doing);
				}
			}
			$mov_count++;
		}
	}
}

// Maybe the Pala disappeared?
if(!$pala_exists)
{
	$result = $db->query("SELECT * FROM `events` WHERE (`event_type` = 'deploy_pala' AND `user_id` = '".$user['id']."')");
	if($db->numRows($result) > 0)
	{
		$row = $db->fetch($result);
		$pala_exists = true;
		$pala_doing = $lang->grab("statue", "pala_moving");
		if($knightname == $lang->grab("configs_units", "knight"))
		{
			$pala_doing = str_replace("%p", $lang->grab("statue", "your_pala"), $pala_doing);
		}
		else
		{
			$pala_doing = str_replace("%p", $knightname, $pala_doing);
		}
		if($row['villageid'] == $village['id'])
		{
			$pala_doing = str_replace("%v", $lang->grab("statue", "this_village1"), $pala_doing);
		}
		else
		{
			$result1 = $db->query("SELECT * FROM `villages` WHERE `id` = '".$row['villageid']."'");
			$row1 = $db->fetch($result1);
			$pala_doing = str_replace("%v", '<a href="game.php?village='.$village['id'].'&amp;screen=info_village&amp;id='.$row1['id'].'">'.(entparse($row1['name'])).' ('.$row1['x'].'|'.$row1['y'].')</a>', $pala_doing);
		}
		$pala_doing = str_replace("%t", date("d.m.Y H:i:s", $row['event_time']), $pala_doing);
	}
}

// It requires more to move the pala ;)
if($pala_moveable)
{
	if(($village['farmLimits'] - $village['r_bh']) < $cl_units->get_bhprice("unit_knight"))
	{
		$pala_moveable = false;
	}
}

// Vorraussetzungen checken:
$show_build = ($cl_builds->check_needed($buildname,$village) && $village[$buildname]>0)?true:false;
if ($show_build) {

	// Alle Einheiten die im gebäude gebaut werden können ermitteln:
	$units = $cl_units->get_recruit_in_units($buildname);

	// Sql vorbereiten für Einheiten im Dorf
	$sql = "SELECT ";
	$i=0;
	foreach ($units as $key=>$value) {
		$i++;
		if (count($units)==$i) {
			$sql .= "$key";
		}
		else
		{
			$sql .= "$key,";
		}
	}
	$sql .= " from unit_place where villages_from_id='".$village['id']."' AND villages_to_id='".$village['id']."'";
	$result = $db->query("$sql");
	$units_in_village = $db->Fetch($result);

	// Sql vorbereiten alle einheiten
	$sql = "SELECT ";
	$i=0;
	foreach ($units as $key=>$value) {
		$i++;
		// Schauen ob Tech bei der Einheit aktiviert ist:
		if (in_array("no_investigate", $cl_units->get_specials($key))) {
 			if (count($units)==$i) {
				$sql .= "all_$key";
			}
			else
			{
				$sql .= "all_$key";
			} 	
		}
		else
		{
			if (count($units)==$i) {
				$sql .= "all_$key,".$key."_tec_level";
			}
			else
			{
				$sql .= "all_$key,".$key."_tec_level,";
			}
		}
	}
	$sql .= " from villages where id='".$village['id']."'";
	$result = $db->query("$sql");
	$units_all = $db->Fetch($result);

	$village = $village + $units_all;

	foreach ($units as $key=>$value) {
		$units_all[$key] = $units_all["all_".$key];
	}
	
	######################## Einheiten rekrutieren:
	if (isset($_GET['action']) && $_GET['action']=="train") {
	    // HKEY checken
	    $c = new do_action($user['id']);
		$c->close();
		if ($session['hkey']!=$_GET['h'])
			$error = "Wrong HKEY!";

		// Rohstoffe überprüfen
		$check="";
		$reload=false;
		foreach($units AS $key=>$value) {
				$cl_units->check_needed($key,$village);

				$input = 1;
				// Weitere Überprüfungen
				$wood = $cl_units->get_woodprice($key)*$input;
				$stone = $cl_units->get_stoneprice($key)*$input;
				$iron = $cl_units->get_ironprice($key)*$input;
				$bh = $cl_units->get_bhprice($key)*$input;

				if ($wood>$village['r_wood'] OR $stone>$village['r_stone'] OR $iron>$village['r_iron']) {
				    $check = "to_many_units";
				}

				if(($arr_farm[$village['farm']]-$village['r_bh']-$bh) < 0 && empty($check)) {
				    $check = "to_many_bh";
				}
				if($pala_exists)
				{
					$check = "pala_exists";
				}
				if (empty($check) && is_numeric($cl_units->last_error) && $input>0) {

					// Ress abziehen und ag im bau dazuzählen:
					$db->query("UPDATE villages SET r_wood=r_wood-'$wood',r_stone=r_stone-'$stone',r_iron=r_iron-'$iron',r_bh=r_bh+'$bh' where id='".$village['id']."'");
					$village['r_wood'] -= $wood;
					$village['r_stone'] -= $stone;
					$village['r_iron'] -= $iron;
					$village['r_bh'] += $bh;

				    // Nun kann die Einheit rekrutiert werden:
				    $cl_units->recruit_units($key,$input,$buildname,$village[$buildname],$village['id']);
				    $reload = true;
				}
		}
		$c->open();
		if($reload)
		    HEADER("LOCATION: game.php?village=".$village['id']."&screen=".$_GET['screen']."");


	    if (empty($check))
			$check = $cl_units->last_error;

		switch($check) {
		    case "not_tec":
		    $error = $lang->grab("error", "not_tec");
		    break;
		    
			case "build_ah":
		    $error = $lang->grab("error", "build_ah");
		    break;
		    
		    case "build_ah":
		    $error = $lang->grab("error", "build_ah");
		    break;

		    case "not_needed":
		    $error = $lang->grab("error", "not_fulfilled");
		    break;

		    case "not_enough_ress":
		    $error = $lang->grab("error", "not_enough_ress");
		    break;

		    case "not_enough_bh":
		    $error = $lang->grab("error", "not_enough_bh");
			break;

			case "to_many_units":
			$error = $lang->grab("error", "to_many_units");
			break;

	 		case "to_many_bh":
			$error = $lang->grab("error", "to_many_bh");
			break;

			case "pala_exists":
			$error = $lang->grab("error", "pala_exists");
			break;
		}
	}

	############################ Rekrutierung abbrechen

	if (isset($_GET['action']) && $_GET['action']=="cancel" && isset($_GET['id'])) {

	    // HKEY checken
		if ($session['hkey']!=$_GET['h'])
			$error = "Wrong HKEY!";

		$g_id = parse( $_GET['id'] );

		$result = $db->query("SELECT unit,villageid,num_finished,num_unit from recruit where id='$g_id'");
		$row=$db->Fetch($result);

		// Schauen ob Auftrag dem aktuellen Dorf gehört:
		if ($row['villageid']!=$village['id']) {
			$error="Auftrag bereits fertig gestellt.";
		}

		// Schauen ob Einheit auch in diesem Gebäude abgebrochen werden kann:
		if (!in_array($row['unit'], array_flip($units)))
		    $error="Einheit kann hier nicht abgebrochen werden!";

		// Wenn kein Fehler ist, dann Auftrag löschen:
		if (empty($error)) {
			// Warten bis auf das event nicht mehr Zugegriffen wird und dann holen, damit keine
			// Einheiten mehr produziert werden:
			while(true) {
				// Schauen, ob auftrag noch exisitert:
				$result = $db->query("SELECT Count(id) AS count from events where event_type='recruit' AND event_id='$g_id'");
				$row = $db->Fetch($result);
				if ($row['count']!=1) {
					// Auftrag exisitert nicht mehr!
					$error = "Auftrag bereits fertig gestellt.";
					break;
				}
				$result = $db->query("UPDATE events SET cid='1' where event_type='recruit' AND event_id='$g_id' AND cid=0");
				if ($db->affectedRows()==1) {
					// Neu auslesen, vll haben sich Einheiten geändert
					$result = $db->query("SELECT unit,villageid,num_finished,num_unit from recruit where id='$g_id'");
					$row=$db->Fetch($result);
					break;
				}
			}
			if (empty($error)) {
				// Event löschen:
				$db->query("DELETE from events where event_type='recruit' AND event_id='$g_id'");
				// Aus recruit löschen:
				$db->query("DELETE from recruit where id='$g_id'");
				// 90% der Ress wieder gut schreiben
				$wood = round(($cl_units->get_woodprice($row['unit'])*($row['num_unit']-$row['num_finished']))*0.90);
				$stone = round(($cl_units->get_stoneprice($row['unit'])*($row['num_unit']-$row['num_finished']))*0.90);
				$iron = round(($cl_units->get_ironprice($row['unit'])*($row['num_unit']-$row['num_finished']))*0.90);
				$bh = $cl_units->get_bhprice($row['unit'])*($row['num_unit']-$row['num_finished']);
	
				// Bauzeiten in rekruit neu laden:
				$old_time=time();
				$result = $db->query("SELECT id,time_start,time_finished,building from recruit where villageid='".$village['id']."' AND building='$buildname'");
				while($row=$db->Fetch($result)) {
					// Neue Bauzeit berechnen:
					if ($row['time_start']<time()) {
						// Der Auftrag ist bereits in Bau
						$old_time=$row['time_finished'];
		    		}
		    		else
		    		{
		    			// Der Auftrag muss einen neuen Startzeitpunkt bekommen
		    			$start_time = $old_time;
		    			$old_time = $old_time+($row['time_finished']-$row['time_start']);
		    			// DB Update
		    			$db->query("UPDATE recruit SET time_finished='$old_time',time_start='$start_time' where id='".$row['id']."'");
		    			// Event Updates
		   				$db->query("UPDATE events SET event_time='$old_time' where event_id='".$row['id']."' AND event_type='recruit'");
		   			}
				}
	
				$db->query("UPDATE villages SET r_wood=r_wood+'$wood',r_stone=r_stone+'$stone',r_iron=r_iron+'$iron',r_bh=r_bh-'$bh' where id='".$village['id']."'");
	
				HEADER("LOCATION: game.php?village=".$village['id']."&screen=".$_GET['screen']."");
			}
		}
	}

	####################################################

	// Move Pala
	if(isset($_GET['action']) && $_GET['action'] == "deploy" && $pala_moveable)
	{
		$db->query("UPDATE `villages` SET `all_unit_knight` = '0', `r_bh` = `r_bh` - '".($cl_units->get_bhprice("unit_knight"))."' WHERE `id` = '".$pala_vill_id."'");
		$db->query("UPDATE `unit_place` SET `unit_knight` = '0' WHERE (`villages_from_id` = '".$pala_vill_id."' AND `villages_to_id` = '".$pala_place_id."')");
		$db->query("UPDATE `villages` SET `all_unit_knight` = '1', `r_bh` = `r_bh` + '".($cl_units->get_bhprice("unit_knight"))."' WHERE `id` = '".$village['id']."'");
		$pala_time = time() + (($cl_units->get_time(1, 'unit_knight') / 2) / $config->get('speed'));
		$db->query("INSERT INTO `events` (`event_time`, `event_type`, `event_id`, `user_id`, `villageid`) VALUES ('".$pala_time."', 'deploy_pala', '".($db->getLastId())."', '".$user['id']."', '".$village['id']."')");
		HEADER("LOCATION: game.php?village=".$village['id']."&screen=".$_GET['screen']."");
	}

	$recruit_units=array();
	// Alle Einheiten auslesen & für Template vorbereiten:
	$i=0;
	$result = $db->query("SELECT id,unit,num_unit,num_finished,time_finished,time_start from recruit where villageid='".$village['id']."' AND building='$buildname' order by time_start");
	while($row=$db->Fetch($result)) {
		$i++;
	    if ($i=="1") {
	        $recruit_units[$row['id']]['lit'] = true;
		}
		else
		{
		    $recruit_units[$row['id']]['lit'] = false;
		}

		$recruit_units[$row['id']]['unit'] = $row['unit'];
		$recruit_units[$row['id']]['num_unit'] = $row['num_unit'] - $row['num_finished'];
		$recruit_units[$row['id']]['unit'] = $row['unit'];
		$recruit_units[$row['id']]['time_finished'] = $row['time_finished'];

	    if ($i=="1") {
			$recruit_units[$row['id']]['countdown'] = $row['time_finished'] - time();
		}
		else
		{
		    $recruit_units[$row['id']]['countdown'] = $row['time_finished'] - $row['time_start'];
		}
	}

	// Get Pala-Image
	$result = $db->query("SELECT `chosen` FROM `knight_items` WHERE `uid` = '".$user['id']."'");
	$row = $db->fetch($result);
	if(isset($knight_items->name[$row['chosen']]))
	{
		$pala_image = true;
		$pala_item = $row['chosen'];
		if($config['statue_style'] == 3 && ($pala_item == "ram" || $pala_item == "catapult"))
		{
			$pala_item_des = $lang->grab("knight_items_des", $pala_item."1");
		}
		else
		{
			$pala_item_des = $lang->grab("knight_items_des", $pala_item);
		}
		if($pala_item == "ram" || $pala_item == "catapult")
		{
			$pala_item_des = str_replace("%atk", (($knight_items->special[$pala_item] - 1) * 100)."%", $pala_item_des);
		}
		else
		{
			$pala_item_des = str_replace("%atk", (($knight_items->att[$pala_item] - 1) * 100)."%", $pala_item_des);
		}
		$pala_item_des = str_replace("%def", (($knight_items->deff[$pala_item] - 1) * 100)."%", $pala_item_des);
		$pala_item_des = str_replace("%special", $knight_items->special[$pala_item], $pala_item_des);
	}
	else
	{
		$pala_image = false;
		$pala_item = false;
		$pala_item_des = false;
	}

	// Inventory
	if($mode == "inventory" && $config['statue_style'] > 1)
	{
		$result = $db->query("SELECT * FROM `knight_items` WHERE `uid` = '".$user['id']."'");
		$row = $db->fetch($result);
		$items_found = 0;
		foreach(($knight_items->name) as $key=>$value)
		{
			if($row[$key] == "false")
			{
				$row[$key] = false;
			}
			else
			{
				$row[$key] = true;
				$items_found++;
			}
		}
		if(isset($_GET['action']) && $_GET['action'] == "equip" && isset($_GET['item']))
		{
			if ($session['hkey']!=$_GET['h'])
			die("Wrong HKEY!");
			if(isset($knight_items->name[$_GET['item']]) && $row[$_GET['item']])
			{
				$db->query("UPDATE `knight_items` SET `chosen` = '".$_GET['item']."' WHERE `uid` = '".$user['id']."'");
				HEADER("LOCATION: game.php?village=".$village['id']."&screen=".$_GET['screen']."");
			}
		}
		if(empty($row['progress']))
		{
			$row['progress'] = 0;
		}
		$items_des = array();
		foreach(($knight_items->name) as $key=>$value)
		{
			if($config['statue_style'] == 3 && ($key == "ram" || $key == "catapult"))
			{
				$pala_item_des2 = $lang->grab("knight_items_des", $key."1");
			}
			else
			{
				$pala_item_des2 = $lang->grab("knight_items_des", $key);
			}
			if($key == "ram" || $key == "catapult")
			{
				$pala_item_des2 = str_replace("%atk", (($knight_items->special[$key] - 1) * 100)."%", $pala_item_des2);
			}
			else
			{
				$pala_item_des2 = str_replace("%atk", (($knight_items->att[$key] - 1) * 100)."%", $pala_item_des2);
			}
			$pala_item_des2 = str_replace("%def", (($knight_items->deff[$key] - 1) * 100)."%", $pala_item_des2);
			$pala_item_des2 = str_replace("%special", $knight_items->special[$key], $pala_item_des2);
			$items_des[$key] = $pala_item_des2;
		}
		$tpl->assign("items_des", $items_des);
		$tpl->assign("knight_items", $knight_items);
		$tpl->assign("items_data", $row);
		$tpl->assign("items_found", $items_found);
		$tpl->assign("find_progress", 390*($row['progress']/100));
		$tpl->assign("f_progress", $row['progress']);
	}
	
	$tpl->assign("pala_image", $pala_image);
	$tpl->assign("pala_item", $pala_item);
	$tpl->assign("pala_item_des", $pala_item_des);
	$tpl->assign("units",$units);
	$tpl->assign("error",$error);
	$tpl->assign("units_in_village",$units_in_village);
	$tpl->assign("units_all",$units_all);
	$tpl->assign("recruit_units",$recruit_units);
}

$teste = $db->query("SELECT * FROM villages WHERE userid = '".$user['id']."'");
while($a == $db->fetch($teste)){
	if($a['all_unit_knight'] >= '1'){
		$pala_exists = true;	
	}
}

$tpl->assign("description", $cl_builds->get_description_bydbname($buildname));
$tpl->assign("cl_units",$cl_units);
$tpl->assign("buildname",$cl_builds->get_name($buildname));
$tpl->assign("dbname",$buildname);
$tpl->assign("show_build",$show_build);
$tpl->assign("statue_style",$config['statue_style']);
$tpl->assign("mode", $mode);
$tpl->assign("pala_exists", $pala_exists);
$tpl->assign("pala_moveable", $pala_moveable);
$tpl->assign("pala_doing", $pala_doing);
$tpl->assign("knightname", $knightname);
?>