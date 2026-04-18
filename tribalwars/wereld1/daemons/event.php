<?php
function msec(){
	list($msec, $sec) = explode(' ', microtime());
	return ($sec%3600)*1000+$msec*1000;
}
function gets_ms($a){
	global $load_msec;
	echo "$a: ".(msec()-$load_msec)."<br />";
}


$start = microtime(true);
set_time_limit(60);
for ($i = 0; $i < 59; ++$i) {	
	error_reporting(E_ALL ^ E_NOTICE);
	$time = time();
	$load_msec = msec();
	define("PATH", str_replace(PATH_SEPARATOR, "/", dirname(dirname(__FILE__))));
	require_once(PATH."/include/config.php");
	require_once(PATH."/lib/functions.php");
	require_once(PATH."/lib/DB_MySQL.php");
	$db = new DB_MySQL();
	$db->connect($config['db_host'], $config['db_user'], $config['db_pw'], $config['db_name']);
	if($time+5 < time()){
		exit("Sem resposta do MySQL! Verifique a conexao!");
	}
	require_once(PATH."/lib/GetVillageData.php");
	require_once(PATH."/lib/GetUserData.php");
	require_once(PATH."/lib/login.php");
	require_once(PATH."/lib/sid.php");
	require_once(PATH."/lib/map.php");
	require_once(PATH."/lib/builds.php");
	require_once(PATH."/lib/units.php");
	require_once(PATH."/lib/techs.php");
	require_once(PATH."/lib/add_report.php");
	require_once(PATH."/lib/do_action.php");
	require_once(PATH."/lib/awards.php");
	require_once(PATH."/lib/train.php");
	require_once(PATH."/lib/events.php");
	require_once(PATH."/lib/knight_items.php");
	require_once(PATH."/include/configs/buildings.php");
	require_once(PATH."/include/configs/raw_material_production.php");
	require_once(PATH."/include/configs/farm_limits.php");
	require_once(PATH."/include/configs/max_storage.php");
	require_once(PATH."/include/configs/max_hide.php");
	require_once(PATH."/include/configs/units.php");
	require_once(PATH."/include/configs/techs.php");
	require_once(PATH."/include/configs/max_wall_bonus.php");
	require_once(PATH."/include/configs/dealers.php");
	require_once(PATH."/include/configs/awards.php");
	require_once(PATH."/include/configs/knight_items.php");

	$run_key = generate_key();
	$cl_reports = new add_report();
	print("Os eventos estao funcionando... Nao feche esta janela pois aqui a magica de servidor acontece =D");
	// for($i = 0; $i < (2 << 15); ++$i){
	// 	$last = time();
		check_events();
		check();
	// 	if($last == time()){
	// 		sleep(1);
	// 	}
	// }
	time_sleep_until($start + $i + 1);
}
?>