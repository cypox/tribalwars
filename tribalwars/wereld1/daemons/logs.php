<?php 


error_reporting(E_ALL);
ini_set('display_errors', 1);
define("PATH", str_replace(PATH_SEPARATOR, "/", dirname(dirname(__FILE__))));
require_once(PATH."/include/config.php");
require_once(PATH."/lib/DB_MySQL.php");
$db = new DB_MySQL();
$db->connect($config['db_host'], $config['db_user'], $config['db_pw'], $config['db_name']);
$test = $db->query("TRUNCATE `logs`");

echo $test;



?>