<?php
function userdata_encode($key, $text){
    $l_k = strlen($key);
    $l_t = strlen($text);
    if($l_k == 0)
		return $text;

    $encoded = "";
    $k = 0;
    for($i=0; $i<$l_t; $i++){
        if($k > $l_k)
			$k = 0;
        $encoded .= chr(ord($text[$i]) ^ ord($key[$k]));
        $k++;
    }
    return $encoded;
}
function userdata_decode($key, $chiffre){
    $l_k = strlen($key);
    $l_t = strlen($chiffre);

    if($l_k == 0)
		return $text;

    $decoded = "";
    $k = 0;
    for($i=0; $i<$l_t; $i++){
        if($k > $l_k)
			$k = 0;
        $decoded .= chr(ord($chiffre[$i]) ^ ord($key[$k]));
        $k++;
    }
    return $decoded;
}
function checkMail($email){
	if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)){
		return false;
	}else{
		return true;
	}
}
function logging($event,$str){
	if($type != 'recruit'){
		global $db;

		$str = parse($str);
		$type = parse($type);

		global $user;
		$user = $user['username'];

		global $run_key;
		$db->query("INSERT INTO `logs` (`event_id`,`user`,`village`,`time`,`log`) VALUES ('".$event."','".$user."','".$run_key."','".time()."','".$str."')");
	}
}
function parse($str){
	if($str === null){
		$str = '';
	}
	$str = (string)$str;
	$str = urlencode($str);
	$str = trim($str);
    return $str;
}
function entparse($str){
	$str = urldecode($str);
	$str = stripslashes($str);
	$str = htmlspecialchars($str);
    return $str;
}
function get_ms($t){
	global $load_msec;
    echo $t." :".round(msec()-$load_msec)."ms<br />";
}
function numberFormat($num){
     return preg_replace("/(?<=\d)(?=(\d{3})+(?!\d))/",".",$num);
} 
function format_number($number){
	return str_replace(".","<span class=\"grey\">.</span>",numberFormat($number));
}
function getfirstvillage($userid){
	global $db;

    $result = $db->query("SELECT `id` FROM `villages` WHERE `userid` = '".$userid."' ORDER BY `name`,`id` LIMIT 1" );
	$row = $db->fetch($result);
    return $row['id'];
}
function create_village($userid,$username='',$direction){
	global $config;
	global $cl_units;
	global $db;

	if($userid == '-1'){
		$result = $db->query("SELECT * FROM `create_village_barb`");
	}else{
		$result = $db->query("SELECT * FROM `create_village`");
	}
	$row = $db->fetch($result);

	if($direction == "random"){
		$min = min($row['no'],$row['nw'],$row['sw'],$row['so']);
   		switch($min){
 			 case $row['no']:	$direction = "no";	break;
 			 case $row['nw']:	$direction = "nw";	break;
 			 case $row['so']:	$direction = "so";	break;
 			 case $row['sw']:	$direction = "sw";	break;
   		}
	}elseif($direction = "random_left"){
		$dir = array(
			"1" => "no",
			"2" => "sw",
			"3" => "so",
			"4" => "nw"
		);
		$rand = rand(1,4);
		$direction = $dir[$rand];
	}else{
		$direction = parse($direction);
	}
	$alpha = $row[$direction.'_alpha'];
	do{
		$db->query("UNLOCK TABLES");
		
		$longest_c = max($row['no_c'], $row['nw_c'], $row['sw_c'],$row['so_c']);
                $long2 = @round(($longest_c-$row[$direction.'_c'])/2);
                $min = $row[$direction.'_c'];
                $max = $longest_c-$long2;
                $size_c = @rand($min, $max);
                #$size_c = mt_rand($min, $max);

                $zufall = @rand(130,250)/100;
                $alpha += (90/$row[$direction.'_c'])*$zufall;
				
		if($alpha >= 90){
			$row[$direction.'_alpha'] = rand(1,25);
			$do_alpha_to_null = true;
			$row[$direction.'_c'] += mt_rand(1,3);
			$alpha = $row[$direction.'_alpha'];
		}else{
			$do_alpha_to_null = false;
		}
		$bogen = ($alpha*2*pi())/360;
		$x = round(sin($bogen)*$size_c);
		$y = round(cos($bogen)*$size_c);

		if($direction == "nw"){
			$x = 500-$x;
			$y = 500+$y;
		}
		if($direction == "no"){
			$x = 500+$x;
			$y = 500+$y;
		}
		if($direction == "so"){
 			$x = 500+$x;
			$y = 500-$y;
 		}
		if($direction == "sw"){
			$x = 500-$x;
			$y = 500-$y;
		}
		$db->query("LOCK TABLES `villages` READ");
		$result = $db->query("SELECT COUNT(`id`) AS `count_village` FROM `villages` WHERE `x` = '".$x."' AND `y` = '".$y."'");
		$row2 = $db->fetch($result);
		if(!$row2['count_village']){
			$db->query("UNLOCK TABLES");
		}
		if($row2['count_village'] <= 0){
			$db->query("LOCK TABLES `map` READ");
			$result = $db->query("SELECT COUNT(`id`) AS `count_village` FROM `map` WHERE `x`='".$x."' AND `y`='".$y."'");
			$row2 = $db->fetch($result);
			if(!$row2['count_village']){
				$db->query("UNLOCK TABLES");
			}
		}
	}while($row2['count_village'] == "1");

	if($userid != "-1"){
 		$villagename = parse("Aldeia de ".entparse($username));
 	}else{
 		$villagename = parse(entparse($config['left_name']));
 	}	
 	$arr = convert_to_continents($x,$y);
 	require("map_db/".$arr['con'].".php");
 	$unit = $cl_units->get_array("name");
	$db->query("INSERT INTO `villages` (`x`,`y`,`bonus`,`name`,`userid`,`points`,`continent`,`last_prod_aktu`,`main_build`,`agreement_aktu`,`create_time`,`smith_tec`,`conmap_con`,`group`,`l_grow`) VALUES ('".$x."','".$y."','0','".$villagename."','".$userid."','0','".$arr['con']."','".time()."','','".time()."','".time()."','','','','0')");
	$villageid = $db->getlastid();
	$db->query("INSERT INTO `unit_place` (`villages_from_id`,`villages_to_id`) VALUES ('".$villageid."','".$villageid."')");
	reload_village_points($villageid);
	load_bh($villageid);
	if($userid != "-1"){
		$db->query("UPDATE `users` SET `villages` = `villages`+'1' WHERE `id` = '".$userid."'");	
		reload_player_points($userid);
		reload_player_rangs();
	}
	$row[$direction.'_alpha'] = $alpha;
	if($do_alpha_to_null)
		$row[$direction.'_alpha'] = 0;
	$add_sql = "";
	$create_lager = false;
	if($config['count_create_left'] > 0 && $userid != "-1"){
		if($row['next_left'] <= 1){
			$create_lager = true;
			$add_sql = ",`next_left` = '".$config['count_create_left']."'";
		}else{
			$add_sql = ",`next_left`=`next_left`-'1'";
		}
 	}
	if($userid == '-1'){
		$db->query("UPDATE `create_village_barb` SET `nw_c`='".$row['nw_c']."',`no_c`='".$row['no_c']."',`so_c`='".$row['so_c']."',`sw_c`='".$row['sw_c']."',`$direction`=`$direction`+'1',`nw_alpha`='".$row['nw_alpha']."',`no_alpha`='".$row['no_alpha']."',`so_alpha`='".$row['so_alpha']."',`sw_alpha`='".$row['sw_alpha']."'$add_sql");
	}else{
		$db->query("UPDATE `create_village` SET `nw_c`='".$row['nw_c']."',`no_c`='".$row['no_c']."',`so_c`='".$row['so_c']."',`sw_c`='".$row['sw_c']."',`$direction`=`$direction`+'1',`nw_alpha`='".$row['nw_alpha']."',`no_alpha`='".$row['no_alpha']."',`so_alpha`='".$row['so_alpha']."',`sw_alpha`='".$row['sw_alpha']."'$add_sql");
	}
	if($create_lager) create_village("-1","","random_left");
	if($userid != "-1"){
 		return $villageid;
 	}
}
function convert_to_continents($x, $y){
	if(999 < abs($x) || 999 < abs($y)){
		return false;
	}else{
		$x *= 2;
		$y *= 2;
		$con = floor(($y)/200)*10+floor($x/200);
		$sec = floor($y/10)%10*10+floor($x/10)%10;
		$sub = $y%10*2.5+$x%10/2;
		return array(
			"con" => $con,
			"sec" => $sec,
			"sub" => $sub
		);
    }
}
function stage($stage){
	if($stage > 0){
		return "Level ".$stage;
	}
	return "Level 0";
}
function tech($stage){
	if($stage > 0){
		return "Level ".$stage;
	}
	return "Não pesquisado";
}
function format_time($sek){
	$sek = (int)$sek;
	if($sek < 0){
		$sek = 0;
	}
    $std = 3600;
    $min = 60;
    $anzahl_std = 0;
    while($std <= $sek){
		$sek -= $std;
		++$anzahl_std;
	}
	$anzahl_min = 0;
	while($min <= $sek){
		$sek -= $min;
		++$anzahl_min;
	}
	return sprintf("%01s", $anzahl_std).":".sprintf("%02s", $anzahl_min).":".sprintf("%02s", $sek);
}
function format_date($stamp, $show_sek="false"){
	$today_day = date("d", $time = time());
	$tomorrow_day = date("d", $time + 86400);
	$return = "";
	if($today_day == date("d", $stamp)){
		$return = "Hoje ";
	}elseif($tomorrow_day == date("d", $stamp)){
		$return = "Amanhã";
	}else{
		$return = "Op ".date("d.m", $stamp);
	}
	if($show_sek){
		$return .= " às ".date("G:i:s", $stamp)." hrs";
	}else{
		$return .= " às ".date("G:i", $stamp)." hrs";
	}
	return $return;
}
function ressis($village, $time=""){
	global $arr_production;
	global $arr_maxstorage;
	global $config;
	global $db;

	$time = (empty($time))?time():$time; 
	$differenz = $time - $village['last_prod_aktu'];

	$wood = $village['r_stone']+$arr_production[$village['wood']]/3600*$config['speed']*$differenz;
    $stone = $village['r_stone']+$arr_production[$village['stone']]/3600*$config['speed']*$differenz;
    $iron = $village['r_iron']+$arr_production[$village['iron']]/3600*$config['speed']*$differenz;

	$wood = $arr_maxstorage[$village['storage']] < $wood ? $arr_maxstorage[$village['storage']] : $wood;
	$stone = $arr_maxstorage[$village['storage']] < $stone ? $arr_maxstorage[$village['storage']] : $stone;
	$iron = $arr_maxstorage[$village['storage']] < $iron ? $arr_maxstorage[$village['storage']] : $iron;
	$db->query("UPDATE `villages` SET `r_wood`='".$wood."',`r_stone`='".$stone."',`r_iron`='".$iron."',`last_prod_aktu`='".$time."' WHERE `id`='".$village['id']."'");
	return array(
		"r_wood" => floor($wood),
		"r_stone" => floor($stone),
		"r_iron" => floor($iron),
		"r_wood_comma" => $wood,
		"r_stone_comma" => $stone,
		"r_iron_comma" => $iron
	);
}
function generate_key(){
	return md5(microtime().serialize($_SERVER));
}
function send_mail($from_id,$from_name,$to_id,$to_name,$subject,$message,$output){
	global $db;
    if($output){
		$db->query("INSERT INTO `mail_out` (`from_id`,`from_username`,`to_id`,`to_username`,`subject`,`text`,`time`) VALUES ('".$from_id."','".$from_name."','".$to_id."','".$to_name."','".$subject."','".$message."','".time()."')");
        $outid = $db->GetLastID();
	}else{
		$outid = -1;
	}
	$db->query("INSERT INTO `mail_in` (`from_id`,`from_username`,`to_id`,`to_username`,`subject`,`text`,`output_id`,`time`) VALUES ('".$from_id."','".$from_name."','".$to_id."','".$to_name."','".$subject."','".$message."','".$outid."','".time()."')");
    $db->query("UPDATE `users` SET `new_mail` = '1' WHERE `id` = '".$to_id."'");
}
function reload_village_points($villageid){
	global $cl_builds;
	global $db;

	$builds = $cl_builds->get_array("dbname");
	$villagedata = new GetVillageData();
	$row = $villagedata->getByID($villageid, $builds, false);
	$points = 0;
	foreach($row as $building => $stage){
		$points += $cl_builds->get_points($building, $stage);
	}

	$db->query("UPDATE `villages` SET `points`='".$points."' WHERE `id`='".$villageid."'");
}
function reload_all_village_points(){
	global $cl_builds;
	global $db;

	$builds = $cl_builds->get_array("dbname");
	$result = $db->query("SELECT `id`,`points`,".implode(",", $builds)." FROM `villages`");
    while($rowall = $db->fetch($result)){
		$points = 0;
		foreach($builds as $building){
			$points += $cl_builds->get_points($building, $rowall[$building]);
		}
		if($points != $row['points']){
			$db->query("UPDATE `villages` SET `points`='".$points."' WHERE `id`='".$rowall['id']."'");
		}
	}
}
function reload_player_points($playerid){
	global $db;

	$result = $db->query("SELECT SUM(points) AS `points` FROM `villages` WHERE `userid`='".$playerid."'");
	$row = $db->fetch($result);
	$db->query("UPDATE `users` SET `points`='".$row['points']."' WHERE `id`='".$playerid."'");
	$db->query("UPDATE `medal` SET `points`='".$row['points']."' WHERE `userid`='".$playerid."'");
}
function reload_all_player_points(){
	global $db;

	$result = $db->query("SELECT `id`,`points` FROM `users`");
    while($row = $db->fetch($result)){
		$result2 = $db->query("SELECT SUM(`points`) AS `points` FROM `villages` WHERE `userid`='".$row['id']."'");
		$row2 = $db->fetch($result2);
		if($row['points'] != $row2['points']){
			$db->query("UPDATE `users` SET `points`='".$row2['points']."' WHERE `id`='".$row['id']."'");
			$db->query("UPDATE `medal` SET `points`='".$row2['points']."' WHERE `userid`='".$row['id']."'");
		}
	}
}
function reload_ally_points($allyid){
	global $db;

	$count = 1;
	$points = 0;
	$best_points = 0;
	$members = 0;
	$villages = 0;
	$result = $db->query("SELECT `points`,`villages` FROM `users` WHERE `ally`='".$allyid."' ORDER BY `points` DESC");
	while($row = $db->fetch($result)){
		if($count< 41){
			$best_points += $row['points'];
		}
		$points += $row['points'];
		$villages += $row['villages'];
		$members += 1;
		++$count;
	}
	$db->query("UPDATE `ally` SET `points`='".$points."',`best_points`='".$best_points."',`villages`='".$villages."',`members`='".$members."' WHERE `id`='".$allyid."'");
}
function reload_all_ally_points(){
	global $db;

	$res = $db->query("SELECT id FROM ally");
	while($rowally = $db->fetch($res)){
		$count = 1;
		$points = 0;
		$best_points = 0;
		$result = $db->query("SELECT points,villages FROM users WHERE ally=".$rowally['id']." ORDER BY points DESC");
		while($row = $db->fetch($result)){
			if($count < 41){
				$best_points += $row['points'];
			}
			$points += $row['points'];
			++$count;
		}
		$db->query("UPDATE ally SET points=".$points.",best_points=$best_points WHERE id=".$rowally['id']."");
	}
}
function load_bh($villageid){
	global $cl_builds,$db;

    $builds = $cl_builds->get_array("dbname");
    $villagedata = new GetVillageData();

    $row = $villagedata->getByID($villageid, $builds, false);
    $bh = 0;
    foreach($row as $building => $stage){
        for($i=1; $i <= $stage; ++$i){
			$bh += $cl_builds->get_bh($building, $i);
		}
	}
	$db->query("UPDATE `villages` SET `r_bh`='".$bh."' WHERE `id`='".$villageid."'");
}
function reload_ally_rangs(){
	global $db;

	$rang = 1;
	$result = $db->query("SELECT `id`,`rank` FROM `ally` ORDER BY `best_points` DESC");
	while($row = $db->fetch($result)){
		if($row['rank'] != $rang){
			$db->query("UPDATE `ally` SET `rank`='".$rang."' WHERE `id`='".$row['id']."'");
		}
		++$rang;
	}
}
function reload_player_rangs(){
	global $db;

	$rang = 1;
	$result = $db->query("SELECT id,rang FROM users ORDER BY points DESC");
	while($row = $db->fetch($result)){
		if($row['rang'] != $rang){
			$db->query("UPDATE `users` SET `rang`='".$rang."' WHERE `id`='".$row['id']."'");
			$db->query("UPDATE `medal` SET `rank`='".$rang."' WHERE `userid`='".$row['id']."'");
		}
		++$rang;
	}
}
function reload_kill_player(){
	global $db;

	$rang = 1;
    $result = $db->query("SELECT id,killed_units_att_rank from users order by killed_units_att desc");
    while($row = $db->fetch($result)){
        if($row['killed_units_att_rank'] != $rang){
            $db->query("UPDATE users SET killed_units_att_rank='".$rang."' where id='".$row['id']."'");
        }
        ++$rang;
    }
    $rang = 1;
    $result = $db->query("SELECT id,killed_units_def_rank from users order by killed_units_def desc");
    while($row = $db->fetch($result)){
        if($row['killed_units_def_rank'] != $rang){
            $db->query("UPDATE users SET killed_units_def_rank='".$rang."' where id='".$row['id']."'");
        }
        ++$rang;
    }
    $rang = 1;
    $result = $db->query("SELECT id,killed_units_altogether_rank from users order by killed_units_altogether desc");
    while($row = $db->fetch($result)){
        if($row['killed_units_altogether_rank'] != $rang){
            $db->query("UPDATE users SET killed_units_altogether_rank='".$rang."' where id='".$row['id']."'");
        }
        ++$rang;
    }
}
function reload_kill_ally(){
	global $db;

	$rang = 1;
    $result = $db->query("SELECT id,killed_units_att_rank from users order by killed_units_att desc");
    while($row = $db->fetch($result)){
        if($row['killed_units_att_rank'] != $rang){
            $db->query("UPDATE ally SET killed_units_att_rank='".$rang."' where id='".$row['id']."'");
        }
        ++$rang;
    }
    $rang = 1;
    $result = $db->query("SELECT id,killed_units_def_rank from users order by killed_units_def desc");
    while($row = $db->fetch($result)){
        if($row['killed_units_def_rank'] != $rang){
            $db->query("UPDATE ally SET killed_units_def_rank='".$rang."' where id='".$row['id']."'");
        }
        ++$rang;
    }
    $rang = 1;
    $result = $db->query("SELECT id,killed_units_altogether_rank from users order by killed_units_altogether desc");
    while($row = $db->fetch($result)){
        if($row['killed_units_altogether_rank'] != $rang){
            $db->query("UPDATE ally SET killed_units_altogether_rank='".$rang."' where id='".$row['id']."'");
        }
        ++$rang;
    }
}
function grow_vill(){
	global $db, $config, $cl_builds;

	$auto_build = $config['auto_build'];
	$sql = $db->query("SELECT `main`,`barracks`,`stable`,`garage`,`smith`,`place`,`market`,`wood`,`stone`,`iron`,`farm`,`storage`,`hide`,`wall`,`id`,`points` FROM `villages` WHERE `userid` = '-1' AND `points` <= '".$auto_build['max_points']."'");
	while($vill = $db->fetch($sql)){
		$grow = $vill['l_grow']+($auto_build['grow_time']*60);
		if($grow <= time()){
			$builds = array('main','barracks','stable','garage','smith','place','market','wood','stone','iron','farm','storage','hide','wall');
			$stages = array('30','25','20','15','20','1','25','30','30','30','30','30','10','20');
			$rand = rand(0, 13);
			$build = $builds[$rand];
			$max_stage = $stages[$rand];
			$bh = $cl_builds->get_bh($build, $vill[$build]+1);
			if($vill[$build] < $max_stage){
				$db->query("UPDATE `villages` SET `".$build."`=".$vill[$build]."+1,`l_grow`='".time()."',`r_bh`='' WHERE `id`='".$vill['id']."'");
			}
			load_bh($vill['id']);
		}
	}
	reload_all_village_points();
}
function unit_running($x,$y,$cordx,$cordy,$pro_feld){
	global $config;

	if($x > $cordx){ $xfelder = $x-$cordx; }else{ $xfelder = $cordx-$x; }
	if($y > $cordy){ $yfelder = $y-$cordy; }else{ $yfelder = $cordy-$y; }
	if($xfelder > $yfelder){ $schief = $yfelder; }else{ $schief = $xfelder; }
	if($xfelder > $yfelder){ $gerade = $xfelder - $yfelder; }else{ $gerade = $yfelder - $xfelder; }
	$time1 = $gerade*$pro_feld;
	$time2 = $schief*(1.4142*$pro_feld);
	$komplett = $time1+$time2;
	$komplett = ($komplett/$config['speed'])/$config['movement_speed'];
	return round($komplett);
}
function simulate($att,$att_tech,$def,$def_tech,$others){
	global $cl_units;
	global $config;
	global $knight_items;
	global $arr_basic_defense;
	global $arr_wall_bonus;

	if(!isset($others['att_knight_items']) || !is_array($others['att_knight_items'])){
		$others['att_knight_items'] = array();
	}
	if(!isset($others['def_knight_items']) || !is_array($others['def_knight_items'])){
		$others['def_knight_items'] = array();
	}

	$others['believe_att_factor'] = 1;
	$others['believe_def_factor'] = 1;
	if($config['church']){
		$others['believe_att_factor'] = 0.5;
		if($others['believe_att']){
			$others['believe_att_factor'] = 1;
		}
		$others['believe_def_factor'] = 0.5;
		if($others['believe_def']){
			$others['believe_def_factor'] = 1;
		}
	}

	if($att['unit_ram'] > 0){
		
		
		$ram_pala = 1;
		if(in_array("ram", $others['att_knight_items']) && $config['statue_style'] > 1)
		{
			$ram_pala = $knight_items->getItem("ram");
			$ram_pala = $ram_pala['special'];
		}
		
		
		$ramHarm = $config['ram']['wall'];
		$others['wall_fight'] = $others['def_wall']-round(($att['unit_ram']*$others['believe_att_factor'])/($ramHarm['base']*pow($ramHarm['factor'], $others['def_wall'])));
		if($config['statue_style'] == 3 && in_array("ram", $others['att_knight_items']))
		{
			$min_wall = round($others['def_wall'] / 4);
		}
		else
		{
			$min_wall = round($others['def_wall'] / 2);
		}
		if($others['wall_fight'] < $min_wall){
			$others['wall_fight'] = $min_wall;
		}
	}else{
		$others['wall_fight'] = $others['def_wall'];
	}


	
	// Für jeden Gegenstand ein Paladin...
	if($config['statue_style'] > 1 && count($others['att_knight_items']) > $att['unit_knight'])
	{
		$att['unit_knight'] = count($others['att_knight_items']);
	}
	if($config['statue_style'] > 1 && count($others['def_knight_items']) > $def['unit_knight'])
	{
		$def['unit_knight'] = count($others['def_knight_items']);
	}
	
	
	
	$attPoints_Foot = 0;
	$attPoints_Cav = 0;
	$attPoints_Bow = 0;
	$attTotal = 0;
	$defPoints_Foot = 0;
	$defPoints_Cav = 0;
	$defPoints_Bow = 0;
	$defTotal = 0;
	foreach($cl_units->get_array("dbname") as $name=>$dbname){
		
		
		$knight_item_dbname = $knight_items->getByUnit($dbname);
		$knight_att_factor = 1;
		if(in_array($knight_item_dbname, $others['att_knight_items']) && $config['statue_style'] > 1)
		{
			$knight_att_factor = ($knight_items->getItem($knight_item_dbname));
			$knight_att_factor = $knight_att_factor['att'];
		}
		$knight_def_factor = 1;
		if(in_array($knight_item_dbname, $others['def_knight_items']) && $config['statue_style'] > 1)
		{
			$knight_def_factor = ($knight_items->getItem($knight_item_dbname));
			$knight_def_factor = $knight_def_factor['deff'];
		}
		
		
		
		
		if($cl_units->get_group($dbname) == "cav"){
			$attPoints_Cav += $cl_units->get_att($dbname,$att_tech[$dbname]) * $att[$dbname] * $knight_att_factor;
		}elseif($cl_units->get_group($dbname) == "archer"){
			$attPoints_Bow += $cl_units->get_att($dbname,$att_tech[$dbname]) * $att[$dbname] * $knight_att_factor;
		}else{
			$attPoints_Foot += $cl_units->get_att($dbname,$att_tech[$dbname]) * $att[$dbname] * $knight_att_factor;
		}
		$attTotal += $att[$dbname];
		$defTotal += $def[$dbname];
		$defPoints_Foot += $cl_units->get_def($dbname,$def_tech[$dbname]) * $def[$dbname] * $knight_def_factor;
		$defPoints_Cav += $cl_units->get_defCav($dbname,$def_tech[$dbname]) * $def[$dbname] * $knight_def_factor;
		$defPoints_Bow += $cl_units->get_defCav($dbname,$def_tech[$dbname]) * $def[$dbname] * $knight_def_factor;
	}
	$attPoints_Total = $attPoints_Foot+$attPoints_Cav+$attPoints_Bow;
		
	if($attPoints_Total <= 0){
		$attFoot_factor = 0;
		$attCav_factor = 0;
		$attBow_factor = 0;
	}else{
		$attFoot_factor = $attPoints_Foot/$attPoints_Total;
		$attCav_factor = $attPoints_Cav/$attPoints_Total;
		$attBow_factor = $attPoints_Bow/$attPoints_Total;
	}

	$attPoints_real = $attPoints_Total;
	$attPoints_real *= (100+$others['luck'])/100;
	if($config['moral_activ']){
		$attPoints_real *= $others['moral']/100;
	}
	$attPoints_real *= $others['believe_att_factor'];

	$attFoot = $attPoints_real*$attFoot_factor;
	$attCav = $attPoints_real*$attCav_factor;
	$attBow = $attPoints_real*$attBow_factor;

	$defPoints_Foot *= $attFoot_factor;
	$defPoints_Cav *= $attCav_factor;
	$defPoints_Bow *= $attBow_factor;
	$defPoints_Total = $defPoints_Foot+$defPoints_Cav+$defPoints_Bow;

	if($defPoints_Total <= 0){
		$defFoot_factor = 0;
		$defCav_factor = 0;
		$defBow_factor = 0;
	}else{
		$defFoot_factor = $defPoints_Foot/$defPoints_Total;
		$defCav_factor = $defPoints_Cav/$defPoints_Total;
		$defBow_factor = $defPoints_Bow/$defPoints_Total;
	}

	$defPoints_real = $defPoints_Total;
	$defPoints_real += $config['reason_defense'];
	$defPoints_real *= $arr_wall_bonus[$others['wall_fight']]+1;
	$defPoints_real *= $others['believe_def_factor'];

	$defFoot = $defPoints_real*$defFoot_factor;
	$defCav = $defPoints_real*$defCav_factor;
	$defBow = $defPoints_real*$defBow_factor;

	$others['see_def_units'] = false;
	if($attPoints_real > $defPoints_real){
		$others['wins'] = 'att';
		$others['see_def_units'] = true;
		$others['def_color'] = "red";
		$def_lose = $def;
		$def_lost_total = $defTotal;
		$att_lost_total = 0;
		$att_lose = array();
		if($defFoot <= 0){
			$att_lose_foot = 0;
		}else{
			$att_lose_foot = (($defFoot*pow($defFoot, 1/2))/($attFoot*pow($attFoot, 1/2)));
		}
		if($defCav <= 0){
			$att_lose_cav = 0;
		}else{
			$att_lose_cav = (($defCav*pow($defCav, 1/2))/($attCav*pow($attCav, 1/2)));
		}
		if($defBow <= 0){
			$att_lose_bow = 0;
		}else{
			$att_lose_bow = (($defBow*pow($defBow, 1/2))/($attBow*pow($attBow, 1/2)));
		}
		foreach($cl_units->get_array("dbname") as $name=>$dbname){
			if($cl_units->get_group($dbname) == "cav"){
				$att_lose[$dbname] = round($att[$dbname]*$att_lose_cav);
			}elseif($cl_units->get_group($dbname) == "archer"){
				$att_lose[$dbname] = round($att[$dbname]*$att_lose_bow);
			}else{
				$att_lose[$dbname] = round($att[$dbname]*$att_lose_foot);
			}
			$att_lost_total += $att_lose[$dbname];
		}
		if($att_lost_total <= 0){
			$others['att_color'] = "green";
		}else{
			$others['att_color'] = "yellow";
		}

		if($att['unit_ram'] > 0){
			
			$ram_pala = 1;
			if(in_array("ram", $others['att_knight_items']) && $config['statue_style'] > 1)
			{
				$ram_pala = $knight_items->getItem("ram");
				$ram_pala = $ram_pala['special'];
			}
			
			
			$ramHarm = $config['ram']['wall'];
			$max_wall_dmg = (($att['unit_ram']*$cl_units->get_att("unit_ram",$att_tech["unit_ram"])*$others['believe_att_factor'])/($ramHarm['base']*pow($ramHarm['factor'], $others['def_wall'])));
			if($attTotal <= 0){
				$ram_factor = 1;
			}else{
				$ram_factor = $att_lost_total/$attTotal;
			}
			$others['new_wall'] = $others['def_wall']-round($max_wall_dmg-((1/2)*$max_wall_dmg*$ram_factor));
		}else{
			$others['new_wall'] = $others['def_wall'];
		}
		if($others['new_wall'] < 0)
			$others['new_wall'] = 0;

		if($att['unit_catapult'] > 0){
			if($others['cata_building'] == "wall"){
				$others['def_building'] = $others['new_wall'];
			}
			
			
			$cata_pala = 1;
			if(in_array("catapult", $others['att_knight_items']) && $config['statue_style'] > 1)
			{
				$cata_pala = $knight_items->getItem("catapult");
				$cata_pala = $cata_pala['special'];
			}
			
			

			$catapultHarm = $config['catapult']['wall'];
			$max_build_dmg = (($att['unit_catapult']*$cl_units->get_att("unit_catapult",$att_tech["unit_catapult"]*$others['believe_att_factor']))/($catapultHarm['base']*pow($catapultHarm['factor'], $others['def_building']))) * $cata_pala;
			if($attTotal <= 0){
				$cata_factor = 1;
			}else{
				$cata_factor = $att_lost_total/$attTotal;
			}
			$others['new_building'] = $others['def_building']-round($max_build_dmg-((1/2)*$max_build_dmg*$cata_factor));
		}else{
			$others['new_building'] = $others['def_building'];
		}
	}elseif($defPoints_real > $attPoints_real){
		$others['wins'] = 'def';
		$others['att_color'] = "red";
		$att_lose = $att;
		$att_lost_total = $attTotal;
		$def_lost_total = 0;
		$def_lose = array();
		$def_lose_factor = (($attPoints_real*pow($attPoints_real, 1/2))/($defPoints_real*pow($defPoints_real,1/2)));
		foreach($cl_units->get_array("dbname") as $name=>$dbname){
			$def_lose[$dbname] = round($def[$dbname] * $def_lose_factor);
			$def_lost_total += $def_lose[$dbname];
		}
		if($def_lost_total <= 0){
			$others['def_color'] = "green";
		}else{
			$others['def_color'] = "yellow";
		}
		if($att['unit_ram'] > 0){
			
			$ram_pala = 1;
			if(in_array("ram", $others['att_knight_items']) && $config['statue_style'] > 1)
			{
				$ram_pala = $knight_items->getItem("ram");
				$ram_pala = $ram_pala['special'];
			}
			
			
			if($defTotal <= 0){
				$ram_factor = 1;
			}else{
				$ram_factor = $def_lost_total/$defTotal;
			}
			$ramHarm = $config['ram']['wall'];
			$others['new_wall'] = $others['def_wall'] - round(($att['unit_ram']*$cl_units->get_att("unit_ram",$att_tech["unit_ram"])*$ram_factor*$others['believe_att_factor'])/(2*$ramHarm['base']*pow($ramHarm['factor'], $others['def_wall'])));
		}else{
			$others['new_wall'] = $others['def_wall'];
		}
		if($others['new_wall'] < 0)
			$others['new_wall'] = 0;

		if($att['unit_catapult'] > 0){
			if($others['cata_building'] == "wall"){
				$others['def_building'] = $others['new_wall'];
			}
			
			$cata_pala = 1;
			if(in_array("catapult", $others['att_knight_items']) && $config['statue_style'] > 1)
			{
				$cata_pala = $knight_items->getItem("catapult");
				$cata_pala = $cata_pala['special'];
			}
			
			

			if($defTotal <= '0'){
				$cata_factor = 1;
			}else{
				$cata_factor = $def_lost_total/$defTotal;
			}
			$catapultHarm = $config['catapult']['wall'];
			$others['new_building'] = $others['def_building']-round(($att['unit_catapult']*$cl_units->get_att("unit_catapult",$att_tech["unit_catapult"])*$others['believe_att_factor']* $cata_pala * $cata_factor)/(2*$catapultHarm['base']*pow($catapultHarm['factor'], $others['def_building'])));
		}else{
			$others['new_building'] = $others['def_building'];
		}

		if($defTotal == 0){
			$others['see_def_units'] = true;
		}elseif(($def_lost_total/$defTotal) >= 2/3){
			$others['see_def_units'] = true;
		}
	}

	if($att['unit_spy'] == $attTotal){
		$def_lose['unit_spy'] = 0;
		$others['att_color'] = "blue";
		$others['def_color'] = "blue";
	}
	if((($attTotal-$att_lost_total) == ($att['unit_spy']-$att_lose['unit_spy'])) && $att['unit_spy'] > 0 && ($att['unit_spy']-$att_lose['unit_spy']) > 0){
		$others['att_color'] = "blue";
		$others['see_def_units'] = true;
		$others['wins'] = "att";
	}
	if($def['unit_spy'] <= 0){
		$att_lose['unit_spy'] = 0;
		if($att['unit_spy'] > 0){
			if(($config['spy_style'] >= 1) && (($att_lose['unit_spy'] * 2 >= $att['unit_spy']) || (($att_lose['unit_spy'] < $att['unit_spy']) && (in_array("spy", $others['att_knight_items'])))))
			{
				$others['see_def_ress'] = true;
			}
		}
	}else{
		$factor_spy = pow($def['unit_spy']/($att['unit_spy']*$config['factor_spy']), 3/2);
		$att_lose['unit_spy'] = round($factor_spy*$att['unit_spy']);
		if($att_lose['unit_spy'] <= 0 && $att['unit_spy'] > 0){
			$others['wins'] = 'att';
			$others['att_color'] = "blue";
			$others['see_def_units'] = true;
		}elseif($att_lose['unit_spy'] > 0 && $att_lose['unit_spy'] < $att['unit_spy'] && $att['unit_spy'] > 0){
			$others['wins'] = 'att';
			$others['att_color'] = "yellow";
			$others['see_def_units'] = true;
		}elseif($att['unit_spy'] <= $att_lose['unit_spy'] && $att['unit_spy'] > 0){
			$others['att_color'] = "red";
		}
	}

	$others['see_def_ress'] = false;
	$others['see_def_builds'] = false;
	$others['see_def_away'] = false;

	if($att['unit_spy'] > 0){
		if(($config['spy_style'] >= 1) && (($att_lose['unit_spy']*$att['unit_spy']) <= 2 || ($att_lose['unit_spy'] < $att['unit_spy']))){
			$others['see_def_ress'] = true;
			$others['see_def_builds'] = true;
			$others['see_def_away'] = true;
		}
	}

	foreach($att_lose as $key=>$value){
		if($value > $att[$key]){
			$att_lose[$key] = $att[$key];
		}
	}
	foreach($def_lose as $key=>$value){
		if($value > $def[$key]){
			$def_lose[$key] = $def[$key];
		}
	}
	if($others['new_building'] < 0){
		$others['new_building'] = 0;
	}
	if($others['new_building'] < 1 && in_array($others['cata_building'], $config['buildings_starting_by_one'])){
		$others['new_building'] = 1;
	}

    return array(
		"att" => $att,
		"att_lose" => $att_lose,
		"def" => $def,
		"def_lose" => $def_lose,
		"others" => $others
	);
}
function add_movement($from_userid,$from_id,$to_userid,$to_id,$units,$type,$start_time,$end_time,$from_hidden,$building="",$turn=false){
	global $db;

	if($from_hidden){
		$from_hidden = 1;
	}else{
		$from_hidden = 0;
	}
	if($turn){
		$sfrom_userid = $to_userid;
		$sfrom_id = $to_id;
		$sto_userid = $from_userid;
		$sto_id = $from_id;
	}else{
		$sfrom_userid = $from_userid;
		$sfrom_id = $from_id;
		$sto_userid = $to_userid;
		$sto_id = $to_id;
	}
	$db->query("INSERT INTO `movements` (`from_village`,`to_village`,`from_userid`,`to_userid`,`units`,`type`,`start_time`,`end_time`,`to_hidden`,`building`,`send_from_user`,`send_from_village`,`send_to_user`,`send_to_village`) VALUES ('".$from_id."','".$to_id."','".$from_userid."','".$to_userid."','".$units."','".$type."','".$start_time."','".$end_time."','".$from_hidden."','".$building."','".$sfrom_userid."','".$sfrom_id."','".$sto_userid."','".$sto_id."')");
	$id = $db->getlastid();
	if($type == "attack"){
		$db->query("UPDATE `users` SET `attacks`=`attacks`+'1' WHERE `id`='".$to_userid."'");
		$db->query("UPDATE `villages` SET `attacks`=`attacks`+'1' WHERE `id`='".$to_id."'");
	}
	$db->query("INSERT INTO `events` (`event_time`,`event_type`,`event_id`,`user_id`,`villageid`) VALUES ('".$end_time."','movement','".$id."','".$from_userid."','".$from_id."')");
	$event_idA = $db->getlastid();
}
function get_movement_message($type,$villagename,$from){
	if($from == "own"){
		switch($type){
			case "attack" :
				return "Aanval op ".$villagename;
			case "support" :
				return "Ondersteuning aan ".$villagename;
			case "back" :
				return "Terugkeer van ".$villagename;
			case "return" :
				return "Terugkeer van ".$villagename;
			case "cancel" :
				return "Terugkeer van ".$villagename;
		}
	}else{
		switch($type){
			case "attack" :
				return "Aanval op ".$villagename;
			case "support" :
				return "Ondersteuning aan ".$villagename;
		}
	}
	return false;
}
function get_movement_message_only_type($type){
	switch($type){
		case "attack" :
			return "Aanval";
		case "support" :
			return "Ondersteuning";
		case "back" :
			return "Terugkeer";
		case "return" :
			return "Terugkeer";
		case "cancel" :
			return "Terugkeer";
	}
	return false;
}
function calc_moral($def, $att){
	global $config;

	$moral = (3*$def/$att+0.3);
	if($att == 0 || $def == 0){
		$moral = 100;
	}elseif(100 < ($moral*100)){
		$moral = 100;
	}
	if($moral < $config['min_moral']){
		$moral = $config['min_moral'];
	}
	return $moral;
}
function calc_agreement($village,$time=""){
	global $config;
	global $db;

	if($village['agreement'] != 100){
		$agreement_per_second = 1/(3600/$config['agreement_per_hour'])*$config['speed'];
		$time = isset($time) ? time() : $time;
		$village['agreement'] += ($time-$village['agreement_aktu'])*$agreement_per_second;
        if($village['agreement'] > 100){
			$village['agreement'] = 100;
		}
		$db->query("UPDATE `villages` SET `agreement`='".$village['agreement']."',`agreement_aktu`='".$time."' WHERE `id`='".$village['id']."'");
		return floor($village['agreement']);
	}
	return 100;
}
function get_dealers($stage){
	global $arr_dealers;
    return $arr_dealers[$stage];
}
function get_ratio_red($ratio){
	$start = 255;
	$faktor = 0.5;
	$var = floor($start/$faktor*pow($faktor,$ratio));
	if($var > 255){
		$var = 255;
	}
	if($var < 0){
		$var = 0;
	}
	return $var;
}
function get_ratio_green($ratio){
	$start = 255;
	$faktor = 1.5;
	$var = floor($start/$faktor*pow($faktor, $ratio));
	if($var > 255){
		$var = 255;
	}
	if($var < 0){
		$var = 0;
	}
	return $var;
}
function assume_offer($row,$dealers,$wood,$stone,$iron,$num_assume=1,$do){
	global $db;
	global $village;
	global $user;
	global $cl_reports;
	
	if($num_assume > $row['multi']){
		return "not_enough_multi";
	}
	if($dealers < (ceil($row['buy']/1000)*$num_assume)){
 		return "not_enough_dealers";
 	}
 	if($$row['buy_ress'] < ($row['buy']*$num_assume)){
 		return "not_enough_ress";
 	}
	if(!$do){
		$numA = floor($dealers/(ceil($row['buy']/1000)*$num_assume));
		$numB = floor($$row['buy_ress']/($row['buy']*$num_assume));
		return min($numA,$numB,$row['multi']);
	}else{
		$db->query("DELETE FROM `offers_multi` WHERE `id`='".$row['id']."' LIMIT ".$num_assume."");
		$num_assume = $db->affectedrows();

		if($row['buy_ress']=='wood'){ $wood = $row['buy']*$num_assume; }else{ $wood = 0; }
		if($row['buy_ress']=='stone'){ $stone = $row['buy']*$num_assume; }else{ $stone = 0; }
		if($row['buy_ress']=='iron'){ $iron = $row['buy']*$num_assume; }else{ $iron = 0; }
		send_dealers($village['id'],$village['userid'],$row['from_village'],$row['userid'],$village['x'],$village['y'],$row['x'],$row['y'],$wood,$stone,$iron,true);

		if($row['sell_ress']=='wood'){ $wood = $row['sell']*$num_assume; }else{ $wood = 0; }
		if($row['sell_ress']=='stone'){ $stone = $row['sell']*$num_assume; }else{ $stone = 0; }
		if($row['sell_ress']=='iron'){ $iron = $row['sell']*$num_assume; }else{ $iron = 0; }
		send_dealers($row['from_village'],$row['userid'],$village['id'],$village['userid'],$village['x'],$village['y'],$row['x'],$row['y'],$wood,$stone,$iron,true,true);

		$db->query("UPDATE `offers` SET `multi`=`multi`-".$num_assume." WHERE `id`='".$row['id']."'");
		$db->query("DELETE FROM `offers` WHERE `id`='".$row['id']."' AND `multi`=0 AND `do_action`!='update'");

		$result = $db->query("SELECT `username` FROM `users` WHERE `id`='".$row['userid']."'");
		$from = $db->fetch($result);

		$cl_reports->assume_offer($row['userid'],entparse($from['username']),$row['from_village'],$village['userid'],entparse($user['username']),$village['id'],$row['buy'],$row['sell'],$row['buy_ress'],$row['sell_ress']);
	}
 }
function send_dealers($from_village,$from_userid,$to_village,$to_userid,$x,$y,$x2,$y2,$wood,$stone,$iron,$is_offer,$offer_owner=false){
	global $db;
	global $config;

	$wood = (int)$wood;
	$stone = (int)$stone;
	$iron = (int)$iron;

	$dealers = ceil(($wood+$stone+$iron)/1000);

	if(!$offer_owner){
		$db->query("UPDATE `villages` SET `r_wood`=`r_wood`-'".$wood."',`r_stone`=`r_stone`-'".$stone."',`r_iron`=`r_iron`-'".$iron."',`dealers_outside`=`dealers_outside`+'".$dealers."' WHERE `id`='".$from_village."'");
	}

	$start_time = time();
	$end_time = $start_time + unit_running($x,$y,$x2,$y2,($config['dealer_time']*60));

	$db->query("INSERT INTO `dealers` (`from_village`,`from_userid`,`to_village`,`to_userid`,`wood`,`stone`,`iron`,`start_time`,`end_time`,`is_offer`,`dealers`,`type`) VALUES ('".$from_village."','".$from_userid."','".$to_village."','".$to_userid."','".$wood."','".$stone."','".$iron."','".$start_time."','".$end_time."','".$is_offer."','".$dealers."','to')");
	$id = $db->getlastid();
	$db->query("INSERT INTO `events` (`event_type`,`event_id`,`event_time`,`user_id`,`villageid`,`can_knot`) VALUES ('dealers','".$id."','".$end_time."','".$from_userid."','".$from_village."','1')");

	$knot = $db->getlastid();
	$db->query("INSERT INTO `events` (`event_type`,`event_id`,`event_time`,`user_id`,`villageid`,`knot_event`) VALUES  ('dealers','".$id."','".$end_time."','".$to_userid."','".$to_village."','".$knot."')");
}
function add_allyevent($ally,$message){
	global $db;
	$message = parse($message);
    $db->query("INSERT INTO `ally_events` (`ally`,`message`,`time`) VALUES ('".$ally."','".$message."','".time()."')");
}
function snobs_per_coins($coins){
	$start = 1;
	$snobs = 1;

	if($coins < 1){
		return 0;
	}elseif($coins == 1){
		return 1;
	}
	while($coins > $start){
		$snobs += 1;
		$start += $snobs;
		if($start > $coins){
			$snobs -= 1;
		}
	}
	return $snobs;
}
function snobs_per_coins_recruited($recruitedSnobs,$coins){
	$maxSnobs = snobs_per_coins($coins);
	return $maxSnobs-$recruitedSnobs;
}
function coins_to_next_snob($coinsAll,$limit){
	return snobs_per_coins($coinsAll)-$limit;
}
function getUserInfoByVillage($vid){
	global $db;
	$getUid = $db->query("SELECT `userid` FROM `villages` WHERE `id`='".$vid."'");
	$get = $db->fetch($getUid);
	$uid = $get['userid'];
	$getInfo = $db->query("SELECT * FROM `users` WHERE `id`='".$uid."'");
	$user = array();
	while($row = $db->fetch($getInfo)){
		$user = $row;
	}
	return $user;
}
function color($hex){
	return array(
		base_convert(substr($hex, 0, 2), 16, 10),
		base_convert(substr($hex, 2, 2), 16, 10),
		base_convert(substr($hex, 4, 2), 16, 10),
	);
}
function reload_resource_villages($userid, $vid){
	global $db;
	global $config;
	global $arr_production;
	global $arr_maxstorage;

	if($vid != $_GET['village']){
		$a = $db->fetch($db->query("SELECT `wood`,`stone`,`iron`,`r_wood`,`r_stone`,`r_iron`,`storage`,`last_prod_aktu` FROM `villages` WHERE `userid`='".$userid."' AND `id`='".$vid."'"));

		$wood_sec = $config['speed']*$arr_production[$a['wood']]/60/60;
		$stone_sec = $config['speed']*$arr_production[$a['stone']]/60/60;
		$iron_sec = $config['speed']*$arr_production[$a['iron']]/60/60;

		$last_prod = time()-$a['last_prod_aktu'];

		$wood_sec = $last_prod*$wood_sec;
		$stone_sec = $last_prod*$stone_sec;
		$iron_sec = $last_prod*$iron_sec;
		$max_storage = $arr_maxstorage[$a['storage']];

		$wood_full = $a['r_wood']+$wood_sec;
		$stone_full = $a['r_stone']+$stone_sec;
		$iron_full = $a['r_iron']+$iron_sec;

		if($a['r_wood'] > $max_storage || $wood_full > $max_storage){
			$db->query("UPDATE `villages` SET `r_wood`='".$max_storage."' WHERE `userid`='".$userid."' AND `id`='".$vid."'");
		}else{
			$db->query("UPDATE `villages` SET `r_wood`=`r_wood`+'".$wood_sec."' WHERE `userid`='".$userid."' AND `id`='".$vid."'");
		}
		if($a['r_stone'] > $max_storage || $stone_full > $max_storage){
			$db->query("UPDATE `villages` SET `r_stone`='".$max_storage."' WHERE `userid`='".$userid."' AND `id`='".$vid."'");
		}else{
			$db->query("UPDATE `villages` SET `r_stone`=`r_stone`+'".$stone_sec."' WHERE `userid`='".$userid."' AND `id`='".$vid."'");
		}
		if($a['r_iron'] > $max_storage || $iron_full > $max_storage){
			$db->query("UPDATE `villages` SET `r_iron`='".$max_storage."' WHERE `userid`='".$userid."' AND `id`='".$vid."'");
		}else{
			$db->query("UPDATE `villages` SET `r_iron`=`r_iron`+'".$iron_sec."' WHERE `userid`='".$userid."' AND `id`='".$vid."'");
		}
		$db->query("UPDATE `villages` SET `last_prod_aktu`='".time()."' WHERE `userid`='".$userid."' AND `id`='".$vid."'");
	}
	return true;
}
function del_emptys($arr){
	foreach($arr as $val){
		if(!empty($val)){
			$new_arr[] = $val;
		}
	}
	return $new_arr;
}

function premium_load_bh($villageid){
	global $cl_builds;

	$builds = $cl_builds->get_array("dbname");
	$villagedata = new GetVillageData();

	$row = $villagedata->getByID($villageid, $builds, false);
	$bh = 0;
	foreach($row as $building => $stage){
		for($i=1; $i <= $stage; ++$i){
			$bh += $cl_builds->get_bh($building, $i);
		}
	}
	return $bh;
}

function farm_fill_zeroes($vill){
	global $db;
	$sql = "DELETE FROM `unit_place` WHERE `villages_from_id`='".$vill."' AND `villages_to_id` != '".$vill."'";
	return $db->unb_query($sql);

}
?>