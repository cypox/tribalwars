<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('precision','20');

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

if(defined('DEV_TWLan'))
	exit('Você não vai conseguir crackear o servidor!');
define('DEV_TWLan', true);
$security = new Security();
$valid_found = $security->checkIPs();
if(!$valid_found)
	exit("Desculpe, más o TWLan apenas pode ser jogado em rede local!");

$cwd = getcwd();

// Cú
//$admin_string = substr($cwd, strlen($cwd) - 6, 6);
/*if($admin_string != "\admin" && (!file_exists("admin/index.php") || !file_exists("admin/actions/reset.php")))
	exit("Não remova/altere os conteúdos padrões da pasta admin!");
*/

$DWSWxABRcFGKnrkrvhgIWKimsfhQBAEZVrRTD = "FSrBaQAIzLsYrdAUEMrhUefQjAxQqOPCI";
$ejzrpJHCoQCHTDzDjoReBpmMHuDQmXyM = "GLuGYJhHTjcYjQZoMiAgUthZbSihvDrsB";
$afhRcSSvCkOfJckpCsYKaQhrdFFxMZkhAzU = "ioaosetXVzjnxGDZNLQchbzkCbljTpygs";
$OYTtShpnZUfRKQMMHKsAylLibPKAEigpZ = "uJczAAJPAMYURnzNuSYyJoFuwUsYlRLyjEh";
$pQIQxhJmlHDkcKUuELOQPUQtVBQLStvaB = "hMzdGaucjWJZFckNKoXhQduaJIdaBEA";
$UAQixDGrDpKFAjqSIJWQfvgRSUPJHPZiD = "GyhkrYKMvDDEbjvJbrzKEGVVyPURdQ";
$lsLrRczVefePQWsEYpvrKEMpKmDMVihBZEv = "FlUiZRjJqGjPReTGNTgASaEuXOsJPGMgz";
$nKvvmHnMHTkCRgdBqzmavDhFjmrHoAcRde = "egKXfdPPVnCeyNbIUPXYcHNZdtgtDaUwHag";
$ofaZsvdVoIzygdckmSXKbSAsBsAfZNZ = "pcuuhGCjHpNbRkZrdhXLhGdDGYofQCQTW";
$dqKusarYFDnqPuEmjngxFbzDSyrkMwZdT = "bQztplgLtRtvHtPyYGwzNzOnLolnkthASNzctz";

require_once(PATH."/include/config.php");
require_once(PATH."/lib/functions.php");
$time = time();
$db = new DB_MySQL();
$db->connect($config['db_host'], $config['db_user'], $config['db_pw'], $config['prefix'].$config['db_name'], "MySql");
if($time+5 < time())
	exit("Sem resposta do MySQL! Verifique a conexão!");

$run_key = generate_key();
$country = new Country();
include('bbcodes.php');

?>