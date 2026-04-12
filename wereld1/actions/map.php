<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

if($_GET['page'] == 'mark'){
	if(isset($_GET['action']) && $_GET['action'] == 'mark'){
		$player = parse($_POST['player']);
		$color = parse($_POST['color']);

		if(empty($error) && (empty($_POST['player']) || empty($_POST['color']))){
			$error = 'Desculpe, más você deve nos fornecer os dados necessarios!';
		}
		$sql = $db->query("SELECT * FROM `users` WHERE `username`='".$player."' LIMIT 1");
		$row = $db->fetch($sql);
		$check = $db->numrows($sql);
		if(empty($error) && $check != 1){
			$error = 'Desculpe, más não encontramos este jogador!';
		}
		$check = $db->numrows($db->query("SELECT * FROM `marked` WHERE `marker_id`='".$user['id']."' AND `marked_id`='".$row['id']."'"));
		if(empty($error) && $check != 0){
			$error = 'Desculpe, más não encontramos este jogador!';
		}
		if(empty($error) && $user['username'] == parse($_POST['player'])){
			$error = 'Desculpe, más você não pode marcar suas aldeias no mapa!';
		}
		if(empty($error)){
			$db->query("INSERT INTO `marked` (`marker_id`,`marked_id`,`color`) VALUES ('".$user['id']."','".$row['id']."','".$color."')");
			header("LOCATION: game.php?village=".$village['id']."&screen=map&page=mark");
			exit;
		}
	}
	if(isset($_GET['action']) && $_GET['action'] == 'delete'){
		$id = parse($_GET['id']);
		$db->query("DELETE FROM `marked` WHERE `marker_id`='".$user['id']."' AND `marked_id`='".$id."'");
		header("LOCATION: game.php?village=".$village['id']."&screen=map&page=mark");
		exit;
	}
	$tpl->assign("error", $error);
}else{
	if(isset($_POST['x'])){
		$_GET['x'] = parse($_POST['x']);
	}
	if(isset($_POST['y'])){
		$_GET['y'] = parse($_POST['y']);
	}
	if(isset($_GET['x']) && is_numeric($_GET['x']) && !($_GET['x'] > "999" && $_GET['x'] < "-999")){
		$map['x']  = parse($_GET['x']);
	}else{
		$map['x'] = $village['x'];
	}
	if(isset($_GET['y']) && is_numeric($_GET['y']) && !($_GET['y'] > "999" && $_GET['y'] < "-999")){
		$map['y']  = parse($_GET['y']);
	}else{
		$map['y'] = $village['y'];
	}
	
	if($map['x'] > 999){
		$map['x'] = 999;
	}
	if($map['y'] > 999){
		$map['y'] = 999;
	}
	if($map['x'] < 0){
		$map['x'] = 0;
	}
	if($map['y'] < 0){
		$map['y'] = 0;
	}
	
	$map['size'] = $user['map_size'];
	$one_right_coords = ($map['size']-1)/2;
	$x_begin = $map['x']-$one_right_coords;
	$x_end = $map['x'] +$one_right_coords;
	$y_begin = $map['y']-$one_right_coords;
	$y_end = $map['y']+$one_right_coords;

	for($n = $x_begin; $n <= $x_end; ++$n){
		$x_coords[] = ceil($n);
	}
	for($n=$y_end; $y_begin<=$n; --$n){
		$y_coords[] = ceil($n);
	}

	$arr = convert_to_continents($map['x'], $map['y']);
	$con = $arr['con'];
	
	$cl_map = new map();
	$cl_map->search_villages($x_begin, $x_end, $y_begin, $y_end);
	
	/* MINIMAP */
	$pixeli_minimap = 267;
	$cat = round($pixeli_minimap/5/1.2);
	$minimap_pixel = $pixeli_minimap;
	$image_diameter = $minimap_pixel/5;
	$image_radius = floor($image_diameter/2);
	
	$url = $_SERVER["REQUEST_URI"];
	$ex = explode("?x=",$url);
	$url = $ex[0];
	$ex = explode("&x=",$url);
	$url = $ex[0];
	if(strpos($url, "?") === FALSE) $url.="?"; else $url.="&";
	if(!isset($_POST['x'])){
		$x = 0;
		$y = 0;
		if(isset($_GET['x']) && isset($_GET['y'])){
			$x = parse($_GET['x']);
			$y = parse($_GET['y']);
		}else{
			$x = $village['x'];
			$y = $village['y'];
			$map['x'] = $x;
			$map['y'] = $y;
			$_GET['x'] = $x;
			$_GET['y'] = $y;
		}
	}elseif(isset($_POST['x']) && isset($_POST['go'])){
		$x = $_POST['x'];
		$y = $_POST['y'];
	}elseif(isset($_POST['curx']) && isset($_POST['cury'])){
		$curx = $_POST['curx'];
		$cury = $_POST['cury'];
	
		$x = $_POST['x'];
		$y = $_POST['y'];
		$y = $minimap_pixel-$y;
		$x = floor($x/5);
		$y = floor($y/5);
		$x = ($curx-$image_radius)+$x;
		$y = ($cury-$image_radius)+$y;
		header("Location: ".$url."x=".$x."&y=".$y);
	}

	$map_radius = floor($user['map_size']/2);
	$start_left_x = $x-$map_radius;
	$start_left_y = $y-$map_radius;
	$end_right_x = $x+$map_radius;
	$end_right_y = $y+$map_radius;

	$sql = $db->query("SELECT `image`,`x`,`y` FROM `map` WHERE `x` BETWEEN $start_left_x AND $end_right_x AND `y` BETWEEN $start_left_y AND $end_right_y");
	while($row = mysqli_fetch_array($sql)){
		$image_objects[$row['x']][$row['y']] = $row['image'];
	}

	$hour = date("H");
	if($config['night_start'] > $config['night_end']){
		if($hour >= $config['night_start'] || $hour <= $config['night_end']){
			$map_base = "map_dark";
		}else{
			$map_base = "map";
		}
	}else{
		if($hour >= $config['night_start'] && $hour <= $config['night_end']){
			$map_base = "map_dark";
		}else{
			$map_base = "map";
		}
	}
	
	$tpl->assign("map", $map);
	$tpl->assign("image_objects", $image_objects);
	$tpl->assign("mapdesign", $config['map_design']);
	$tpl->assign("x_coords", $x_coords);
	$tpl->assign("y_coords", $y_coords);
	$tpl->assign("cl_map", $cl_map);
	$tpl->assign("bigMapRectTop", $bigMapRectTop);
	$tpl->assign("bigMapRectLeft", $bigMapRectLeft);
	$tpl->assign("mapSize", $map['size']);
	$tpl->assign("continent", $con);
	$tpl->assign("one_right_coords", $one_right_coords);
	$tpl->assign("map_base", $map_base);
}
$marked = array();
$result = $db->query("SELECT * FROM `marked` WHERE `marker_id`='".$user['id']."'");
$i = 0;
while($row = $db->fetch($result)){
	$row['color'] = color($row['color']);
	$row['color'] = $row['color'][0].','.$row['color'][1].','.$row['color'][2];
	$select = $db->fetch($db->query("SELECT * FROM `users` WHERE `id`='".$row['marked_id']."'"));
	$row['name'] = entparse($select['username']);
	$row['i'] = $i;
	$marked[] = $row;
	$i++;
}
$tpl->assign("marked", $marked);
$tpl->assign("page", $_GET['page']);
?>