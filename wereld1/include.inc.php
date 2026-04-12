<?php

error_reporting(E_ALL ^ E_NOTICE);

define('PATH', str_replace(PATH_SEPARATOR, '/', dirname(__FILE__)));
function LoadFuncVV1($class_name){
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
}
spl_autoload_register("LoadFuncVV1");

require_once(PATH."/include/config.php");
if($config['agreement_per_hour'] == 0)
    exit('Configuração invalida: $config[\'agreement_per_hour\'] não pode ter o valor menor ou igual a 0!');
if($config['ip_control'] && !(in_array($_SERVER['REMOTE_ADDR'], $allow_ips)))
	exit("Seu IP não está na lista de IP's permitidos!");

require_once(PATH."/lib/functions.php");
$time = time();
$db = new DB_MySQL();
$db->connect($config['db_host'], $config['db_user'], $config['db_pw'], $config['db_name'], "MySql");
if($time+5 < time()){
	exit("Sem resposta do MySQL! Verifique a conexão!");
}

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

$arr_builds_starts_by_one = $config['buildings_starting_by_one'];


// Inventário estátua
$lang = new aLang("index", "PT");
Registry::set("lang", $lang);

include('include/configs/bbcodes.php');




$villageId = isset($_GET['village']) ? intval($_GET['village']) : 0;
$vill = array('bonus' => '0');
if($villageId > 0){
  $sql_bonus_villages = $db->query("SELECT * FROM villages WHERE id = '".$villageId."'");
  $vill_row = $db->fetch($sql_bonus_villages);
  if(is_array($vill_row)){
    $vill = $vill_row;
  }
}
if ($vill["bonus"] == "1")
{
  include("include/configs/max_storage_bonus.php");
  include("include/configs/dealers_bonus.php");
}
elseif($vill["bonus"] == "2")
{
  include("include/configs/farm_limits_bonus.php");
}
elseif($vill["bonus"] == "3")
{
  include("include/configs/units_bonus_stable.php");
}
elseif($vill["bonus"] == "4")
{
  include("include/configs/units_bonus_barracks.php");
}
elseif($vill["bonus"] == "5")
{
  include("include/configs/units_bonus_garage.php");
}
elseif($vill["bonus"] == "6")
{
  include("include/configs/raw_material_production_bonus.php");
}


function get_bonus($x,$y)
{
  global $db;
  $sql = $db->query("SELECT * FROM villages WHERE x = '$x' AND y = '$y'");
  $vill = $db->fetch($sql);
  if ($vill["bonus"] > "0")
  {
    $out = true;
  }
  else
  {
    $out = false;
  }
  return $out;
}

?>