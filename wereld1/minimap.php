<?php
error_reporting(E_ALL ^ E_NOTICE);

define('PATH', str_replace(PATH_SEPARATOR, '/', dirname(__FILE__)));
spl_autoload_register(function($class_name){
    $root = PATH."/lib/";
    $search_dirs = array(
		'{name}.php',
		'{name}.class.php',
		'class/{name}.php',
		'class/{name}.class.php',
		'smarty/{name}.class.php'
    );
    foreach($search_dirs as $dir){
		$dir = str_replace('{name}', $class_name, $dir);
		if(file_exists($root.$dir)){
		    require_once($root.$dir);
	    	break;
		}
    }
});

require("include/config.php");
require("lib/functions.php");
$db = new DB_MySQL();
$db->connect($config['db_host'], $config['db_user'], $config['db_pw'], $config['db_name']);

function minimap_blank_png(){
	header("Content-type: image/png");
	$img = imagecreatetruecolor(1, 1);
	imagesavealpha($img, true);
	$transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
	imagefill($img, 0, 0, $transparent);
	imagepng($img);
	imagedestroy($img);
	exit;
}

$sid = new sid();
$session_cookie = isset($_COOKIE['session']) ? $_COOKIE['session'] : '';
$session = $session_cookie !== '' ? $sid->check_sid($session_cookie) : array();
$userid = isset($session['userid']) ? (int)$session['userid'] : 0;
$hkey = isset($_GET['hkey']) ? $_GET['hkey'] : '';

if(!$userid){
	minimap_blank_png();
}
if(!isset($session['hkey']) || $session['hkey'] != $hkey){
	minimap_blank_png();
}else{
	ob_start();

	$iduser = $db->fetch($db->query('SELECT userid FROM villages WHERE id = '.parse($_GET['id'])));
	$iduser = $iduser['userid'];
	$sqluser = mysqli_fetch_array($db->query("SELECT `ally`,`map_size`,`minimap_size` FROM `users` WHERE `id` = '$iduser'"));
	$tribuser = $sqluser[0];
	$mapsize_user = $sqluser[1];
	$pixeli_minimap = 267;

	$image_size = $pixeli_minimap;
	$image_diameter = $image_size/5;
	$image_radius = floor($image_diameter/2);

	if($_GET['no'] <> 1){
		header("Content-type: image/png");
	}
	$img = imagecreate($image_size,$image_size);

	if(!isset($_GET['x']))
		$_GET['x'] = 0;
	if(!isset($_GET['y']))
		$_GET['y'] = 0;
	$x = parse($_GET['x']);
	$y = parse($_GET['y']);
	settype($x, "integer");
	settype($y, "integer");
	settype($image_objects, "array");

	$start_left_x = $x-$image_radius;
	$start_left_y = $y-$image_radius;
	$end_right_x = $x+$image_radius;
	$end_right_y = $y+$image_radius;

	$sql3 = $db->query("SELECT `image`,`x`,`y` FROM `map` WHERE `x` BETWEEN $start_left_x AND $end_right_x AND `y` BETWEEN $start_left_y AND $end_right_y");
	$numar = $db->numrows($sql3);
	while($array2 = mysqli_fetch_array($sql3)){
		 $image_objects[$array2[1]][$array2[2]] = $array2[0];
	}

	$hour = date("H");
	if($config['night_start'] > $config['night_end']){
		if($hour >= $config['night_start'] || $hour <= $config['night_end']){
			$fond = imagecolorallocate($img,61,73,81);
			$liniimari = imagecolorallocate($img,32,41,50);
			$liniimici = imagecolorallocate($img,48,57,66);
			$liniicontinent = imagecolorallocate($img,0,0,0);
			$activ = imagecolorallocate($img,61,73,81);
			$sate = imagecolorallocate($img,130,60,10);
			$parasit = imagecolorallocate($img,150,150,150);
			$propriu = imagecolorallocate($img,240,200,0);
			$aliat = imagecolorallocate($img,0,160,244);
			$dusman = imagecolorallocate($img,244,0,0);
			$pna = imagecolorallocate($img,128,0,128);
			$trib = imagecolorallocate($img,0,0,244);
			$elem = imagecolorallocate($img,50,60,70);
			$active = imagecolorallocate($img,255,255,255);
			$col = imagecolorallocate($img,255,255,255);
		}else{
			$fond = imagecolorallocate($img,97,145,60);
			$liniimari = imagecolorallocate($img,47,72,13);
			$liniimici = imagecolorallocate($img,66,97,18);
			$liniicontinent = imagecolorallocate($img,0,0,0);
			$activ = imagecolorallocate($img,87,117,26);
			$sate = imagecolorallocate($img,127,63,0);
			$parasit = imagecolorallocate($img,143,143,143);
			$propriu = imagecolorallocate($img,240,200,0);
			$aliat = imagecolorallocate($img,0,160,244);
			$dusman = imagecolorallocate($img,244,0,0);
			$pna = imagecolorallocate($img,128,0,128);
			$trib = imagecolorallocate($img,0,0,244);
			$elem = imagecolorallocate($img,83,125,61);
			$active = imagecolorallocate($img,255,255,255);
			$col = imagecolorallocate($img,255,255,255);
		}
	}else{
		if($hour >= $config['night_start'] && $hour <= $config['night_end']){
			$fond = imagecolorallocate($img,61,73,81);
			$liniimari = imagecolorallocate($img,32,41,50);
			$liniimici = imagecolorallocate($img,48,57,66);
			$liniicontinent = imagecolorallocate($img,0,0,0);
			$activ = imagecolorallocate($img,61,73,81);
			$sate = imagecolorallocate($img,130,60,10);
			$parasit = imagecolorallocate($img,150,150,150);
			$propriu = imagecolorallocate($img,240,200,0);
			$aliat = imagecolorallocate($img,0,160,244);
			$dusman = imagecolorallocate($img,244,0,0);
			$pna = imagecolorallocate($img,128,0,128);
			$trib = imagecolorallocate($img,0,0,244);
			$elem = imagecolorallocate($img,50,60,70);
			$active = imagecolorallocate($img,255,255,255);
			$col = imagecolorallocate($img,255,255,255);
		}else{
			$fond = imagecolorallocate($img,97,145,60);
			$liniimari = imagecolorallocate($img,47,72,13);
			$liniimici = imagecolorallocate($img,66,97,18);
			$liniicontinent = imagecolorallocate($img,0,0,0);
			$activ = imagecolorallocate($img,87,117,26);
			$sate = imagecolorallocate($img,127,63,0);
			$parasit = imagecolorallocate($img,143,143,143);
			$propriu = imagecolorallocate($img,240,200,0);
			$aliat = imagecolorallocate($img,0,160,244);
			$dusman = imagecolorallocate($img,244,0,0);
			$pna = imagecolorallocate($img,128,0,128);
			$trib = imagecolorallocate($img,0,0,244);
			$elem = imagecolorallocate($img,83,125,61);
			$active = imagecolorallocate($img,255,255,255);
			$col = imagecolorallocate($img,255,255,255);
		}
	}

	for($i = 1; $i <= $image_diameter; $i++){
		$curox = $start_left_x+$i;
		$curoy = $end_right_y-$i+1;
		$lx = $i*5;
		$ly = $i*5;
		settype($lines_arrx, "array");
		settype($lines_arry, "array");

		if($curox%5 == 0){
			$lines_arrx['mari'][$lx]=$liniimari;
		}else{
			$lines_arrx['mici'][$lx]=$liniimici;
		}

		if($curoy%5 == 0){
			$lines_arry['mari'][$ly] = $liniimari;
		}else{
			$lines_arry['mici'][$ly] = $liniimici;
		}

		if($curox%100 == 0){
			$lines_arrx['cont'][$lx] = $liniicontinent;
		}
		if($curoy%100 == 0){
			$lines_arry['cont'][$ly] = $liniicontinent;
		}
	}
	foreach($lines_arrx['mici'] as $key => $value){
		imageline($img,$key,0,$key,$image_size,$value);
	}
	foreach($lines_arry['mici'] as $key => $value){
		imageline($img,0,$key,$image_size,$key,$value);
	}

	if(is_array($lines_arrx['mari']) && is_array($lines_arry['mari'])){
		foreach($lines_arrx['mari'] as $key => $value){
			imageline($img,$key,0,$key,$image_size,$value);
		}
		foreach($lines_arry['mari'] as $key => $value){
			imageline($img,0,$key,$image_size,$key,$value);
		}
	}

	if(is_array($lines_arrx['cont'])){
		foreach($lines_arrx['cont'] as $key => $value){
			imageline($img,$key,0,$key,$image_size,$value);
		}
	}
	if(is_array($lines_arry['cont'])){
		foreach($lines_arry['cont'] as $key => $value){
			imageline($img,0,$key,$image_size,$key,$value);
		}
	}

	$polygon_var = (floor($mapsize_user/2))*5;
	$a1 = $image_radius*5-$polygon_var;
	$b1 = $image_radius*5+$polygon_var+5;
	imagepolygon($img,array($a1,$a1,$b1,$a1,$b1,$b1,$a1,$b1),4,$col);

	foreach($image_objects as $key1=>$value1){
		foreach($image_objects[$key1] as $key2=>$value2){
			$rx = $key1;
			$ry = $key2;

			$rx = (($rx%$image_size-1)*5)+$image_radius*5-($x%$image_size-1)*5;
			$ry = ($y%$image_size-1)*5+$image_radius*5-(($ry%$image_size-1)*5);

			$rx = $rx%$image_size;
			$ry = $ry%$image_size;	

			if($rx < 0){
				$rx = $image_size+$rx;
			}
			if($ry < 0){
				$ry = $image_size+$ry;
			}

			$actual = $elem;
			imagefilledrectangle($img, $rx+1, $ry+1, $rx+4, $ry+4, $actual);
			
		}	
	}

	$q = $db->query("SELECT `id`,`x`,`y`,`userid` FROM `villages` WHERE `x` BETWEEN $start_left_x AND $end_right_x AND `y` BETWEEN $start_left_y AND $end_right_y");
	while($r = mysqli_fetch_array($q)){
		$actual = $sate;
		$rx = $r['x'];
		$ry = $r['y'];
		$userid = $r['userid'];
		$tribsat = $db->query("SELECT `ally` FROM `users` WHERE `id` = '$userid'");
		$tribsat = mysqli_fetch_array($tribsat);
		$tribsat = $tribsat[0];
		$type = $db->query("SELECT `type` FROM `ally_contracts` WHERE `from_ally` = '$tribuser' AND `to_ally` = '$tribsat'");
		$type = mysqli_fetch_array($type);
		$type = $type[0];
	
	if($userid == "-1")
		$actual = $parasit;
	if($tribsat == $tribuser && $tribsat <> '-1' && !empty($tribsat))
		$actual = $trib;
	if($type == "enemy")
		$actual = $dusman;
	if($type == "partner")
		$actual = $aliat;
	if($type == "nap")
		$actual = $pna;
	if($userid == $iduser)
		$actual = $propriu;
	if($r['id'] == parse($_GET['id']))
		$actual = $active;

		$esql = $db->query("SELECT `color` FROM `marked` WHERE `marker_id`='".$iduser."' AND `marked_id`='".$userid."'");
		$mark = $db->numrows($esql);
		if($mark != "0"){
			$select = mysqli_fetch_array($esql);
			$hex = color($select['color']);
			$actual = imagecolorallocate($img,$hex[0],$hex[1],$hex[2]);
		}

		$rx = (($rx%$image_size-1)*5)+$image_radius*5-($x%$image_size-1)*5;
		$ry = ($y%$image_size-1)*5+$image_radius*5-(($ry%$image_size-1)*5);

		$rx = $rx%$image_size;
		$ry = $ry%$image_size;	
	
		if($rx < 0)
			$rx = $image_size+$rx;
		if($ry < 0)
			$ry = $image_size+$ry;
	
		imagefilledrectangle($img, $rx+1, $ry+1, $rx+4, $ry+4, $actual);
	}
	imagepng($img, null, 9);
	imagedestroy($img);
}
?>