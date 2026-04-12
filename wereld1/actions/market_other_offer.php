<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit();
}
if(isset($_GET['action']) && $_GET['action'] == "accept_multi"){
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}
	$result = $db->query("SELECT `userid`,`sell`,`buy`,`sell_ress`,`buy_ress`,`from_village`,`ratio_max`,`multi`,`x`,`y` FROM `offers` WHERE `id`='".parse(@$_GET['id'])."'");
	$row = $db->fetch($result);
	$row['id'] = parse(@$_GET['id']);
	if(empty($row['userid']) || $row['userid'] == $user['id']){
		$error = "Desculpe, más está oferta não está disponivel!";
	}
	$count = (int)@$_POST['count'];
	if($count < 1){
		$error = "Desculpe, más você deve especificar a quantidade!";
	}
	if(empty($error)){
		$c = new do_action($user['id']);
        $c->close();

		$return = assume_offer($row,$inside_dealers,$village['r_wood'],$village['r_stone'],$village['r_iron'],$count,true);
		switch($return){
			case "not_enough_multi" :	$error = "Desculpe, más não existe ofertas suficientes!";	break;
			case "not_enough_dealers" :	$error = "Desculpe, más não existe mercadores suficientes!";	break;
			case "not_enough_ress" :	$error = "Desculpe, más não existe recursos suficientes!";	break;
			case 'ok':
				$c->open();
				header("LOCATION: game.php?village=".$village['id']."&screen=market&mode=other_offer");
				exit;
			break;
		}
		$c->open();
	}
}
if(isset($_GET['action']) && $_GET['action'] == "search"){
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}

	$valid_values = array("all","wood","stone","iron");
	if(!in_array(@$_POST['res_sell'], $valid_values)){
		$res_sell = "all";
	}else{
		$res_sell = parse($_POST['res_sell']);
	}
	if(!in_array(@$_POST['res_buy'], $valid_values)){
		$res_buy = "all";
	}else{
		$res_buy = parse($_POST['res_buy']);
	}
	$ratio = (double)@$_POST['ratio_max'];
	$db->query("UPDATE `users` SET `market_sell`='".$res_sell."',`market_buy`='".$res_buy."',`market_ratio_max`='".$ratio."' WHERE `id`='".$user['id']."'");
	header("LOCATION: game.php?village=".$village['id']."&screen=market&mode=other_offer");
}
$result = $db->query("SELECT `market_sell`,`market_buy`,`market_ratio_max` FROM `users` WHERE `id`='".$user['id']."'");
$market = $db->fetch($result);
if(!isset($_GET['site']) || (isset($_GET['site']) && (!is_numeric($_GET['site'])) || $_GET['site'] < 1)){
	$site = 1;
}else{
    $site = (int)parse($_GET['site']);
}

$offers_per_page = 10;
$start = ($site-1)*$offers_per_page;

$offers = array();
$users = array();
$dealer_time = $config['dealer_time']*60;

$num_rows = $db->numrows($db->query("SELECT `id` FROM `offers` WHERE `userid`!='".$user['id']."'"));
$num_pages = (($num_rows%$offers_per_page)==0) ? $num_rows/$offers_per_page : ceil($num_rows/$offers_per_page);
$result = $db->query("SELECT `id`,`userid`,`sell`,`buy`,`sell_ress`,`buy_ress`,`from_village`,`ratio_max`,`multi`,`x`,`y` FROM `offers` WHERE `userid`!='".$user['id']."' ORDER BY `ratio_max` LIMIT ".$start.",".$offers_per_page."");
while($row = $db->fetch($result)){
    $offers[$row['id']]['userid'] = $row['userid'];
    $offers[$row['id']]['sell'] = format_number($row['sell']);
    $offers[$row['id']]['buy'] = format_number($row['buy']);
    $offers[$row['id']]['sell_ress'] = $row['sell_ress'];
    $offers[$row['id']]['buy_ress'] = $row['buy_ress'];
    $offers[$row['id']]['ratio_max'] = $row['ratio_max'];
    $offers[$row['id']]['multi'] = $row['multi'];
    $offers[$row['id']]['userid'] = $row['userid'];
    $offers[$row['id']]['unit_running'] = format_time(unit_running($village['x'],$village['y'],$row['x'],$row['y'],$dealer_time));

	$offers[$row['id']]['ratio_green'] = get_ratio_red($row['ratio_max']);
	$offers[$row['id']]['ratio_red'] = get_ratio_green($row['ratio_max']);

	$offers[$row['id']]['message'] = assume_offer($row,$inside_dealers,$village['r_wood'],$village['r_stone'],$village['r_iron'],1,false);

	if(array_key_exists($row['userid'], $users)){
		$offers[$row['id']]['username'] = $users[$row['userid']];	
	}else{
		$res = $db->query("SELECT `username` FROM `users` WHERE `id`='".$row['userid']."'");
		$username = $db->fetch($res);
		$offers[$row['id']]['username'] = entparse($username['username']);
		$users[$row['id']] = entparse($username['username']);
	}
}
$tpl->assign("market", $market);
$tpl->assign("offers", $offers);
$tpl->assign("num_pages", $num_pages);
$tpl->assign("site", $site);
$tpl->assign("error", $error);
?>