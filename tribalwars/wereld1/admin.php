<?php

##$config->get_cfg('admin_pass')$config->get_cfg('admin_id')##
/*****************************************/
/*=======================================*/
/*     PLIK: admin.php   		 		 */
/*     DATA: 15.12.2011r        		 */
/*     ROLA: administracja plemion		 */
/*     AUTOR: SIR ROLAND                 */
/*=======================================*/
/*****************************************/
$panel_admina = true;
require ('include.ini.php');


function WoW($value) { 
   $caracts = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUWXYZ";
    
for ($car = 0; $car < $value; $car++) {
   $var = $caracts[mt_rand(0,strlen($caracts)-1)];
  
}
return $var;
}



	if ($_GET['action'] == 'zaloguj' and isset($_POST)) {
	$name = $_POST['login'];
	$password = md5($_POST['pass']);

	$login = $db->numrows($db->query("SELECT * FROM gracze WHERE nazwa = '$name' AND haslo = '$password' AND admin = '0'"));
	
	if ($login != '1') { 
		$error = 'Podane has�o lub login jest<br>nieprawid�owe!Mo�liwe r�wnie� �e nie<br>masz uprawnie� do przegl�dania tej<br>strony!Je�li jeste� administratorem i<br>my�lisz, �e powiniene� mie� dost�p<br>skorzystaj z PHPMYADMIN do nadania<br>sobie tej funkcji!'; 
	} else if ($login == '1') { 
		$error = '';
		$session1 = WoW(80);
		$session2 = WoW(80);
		$session = $session1."-".$session2;
		setcookie("sesja_plemiona", $session, time()+31622400);
		$db->query("UPDATE gracze SET session = '$session' WHERE nazwa = '$name'");
setcookie('admin_isset','H2KeYaaDmiinIS');
		$error = '';
		header("Location: admin.php");
  { 

	      }
       }

}



if ($_GET['action'] == 'wyloguj') {
	setcookie('admin_isset','');
	header ('LOCATION: logout_admin.php');
	exit;
	}
	
if ($_COOKIE['admin_isset'] === 'H2KeYaaDmiinIS') {
	$loging = false;
	
	//Milisekundy
	$msec = explode(" ",microtime());
	$msec = floor($msec[0] * 1000);
	
	//Screeny:
	if (!isset($_GET['screen'])) {
		$_GET['screen'] = 'index';
		}
//Strony kt�re maj� by� wy�wietlane w panelu.		
	$all_screens = array('index','create_new_server','edit_serwer','ogloszenia','memo','error','rules','uzytkownicy','news','user','configs');
	//Strona, na kt�ra zostanie przeniesiony b��dny adres
	if (!in_array($_GET['screen'],$all_screens)) {
		$_GET['screen'] = 'error';
		}
		

		
	require ('admin_actions/admin_'.$_GET['screen'].'.php');
	
	$tpl->assign('load_msec',$msec);
	$tpl->assign('linki',$linki);
	if ($conf['admin_key'] == 'actions_massiv_keyaaassd') {
		$tpl->assign('screen',$_GET['screen']);
		$tpl->assign('allow_screens',$all_screens);
		} else {
		$error = 'Nie prawid�owy kod do akcji!';
		}
//Pobra� ilo�� graczy
$players = $db->numrows($db->query("select * from gracze"));

//Pobrać ilość adminów
$admin = $db->query("SELECT * FROM gracze WHERE admin != '1'");
$admins = $db->numrows($admin);

//Pobrać ilość zwyczajnych graczy
$user = $db->query("SELECT * FROM gracze WHERE admin = '1'");
$users = $db->numrows($user);

//Pobrać dane zalogowanego administratora:
$session = $_COOKIE['sesja_plemiona'];
$select = $db->query("SELECT * FROM gracze WHERE session = '$session'");
$user = $db->fetch($select);





		
	} else {
	$loging = true;
	}
if ($lock == 1) {
$conf['strona'] = "http://plemiona-silnik.zz.mu/";
//Zewn�trzen po��czenie w celu sprawdzenia wersji ".$conf['strona']."
$handle=fopen("http://plemiona-silnik.zz.mu/wersja.php", 'r');
$check=fgetcsv($handle,1024);
fclose($handle);
$wersja = $conf['version'];

if($check[0] != $wersja){
$blad = true;
}
}

	
$tpl->assign('admins',$admins);
$tpl->assign('blad',$blad);
$tpl->assign('aktywacja',$configs['aktywacja']);
$tpl->assign('host',$conf['db_host']);
$tpl->assign('user_db',$conf['db_user']);
$tpl->assign('passy',$conf['db_pass']);
$tpl->assign('tabela',$conf['db_name']);
$tpl->assign('edycja_mysql',$conf['db_edit']);
$tpl->assign('id_p_a',$conf['id_pierwszego_admina']);
$tpl->assign('users',$users);
$tpl->assign('user',$user);
$tpl->assign('players',$players);	
$tpl->assign('loging',$loging);
$tpl->assign('date',formatuj_date(date("U")));
$tpl->assign('error',$error);
$tpl->assign('wersja',$wersja);
$tpl->display('admin_page/admin.tpl');

?>

<script>function insertBBcode(textareaID, startTag, endTag) {
	var input = document.getElementById(textareaID);
	input.focus();

	/* f�r Internet Explorer */
	if(typeof document.selection != 'undefined') {
		 /* Einf�gen */
		var range = document.selection.createRange();
		var insText = range.text;
		range.text = startTag + insText + endTag;

		/* Cursorposition anpassen */
		range = document.selection.createRange();
		if (insText.length == 0) {
			range.move('character', -endTag.length);
		} else {
			range.moveStart('character', startTag.length + insText.length + endTag.length);
		}
		range.select();
	}
	/* f�r neuere auf Gecko basierende Browser */
	else if(typeof input.selectionStart != 'undefined') {
		/* Einf�gen */
		var start = input.selectionStart;
		var end = input.selectionEnd;
		var insText = input.value.substring(start, end);
		input.value = input.value.substr(0, start) + startTag + insText + endTag + input.value.substr(end);

		/* Cursorposition anpassen */
		var pos;
		if (insText.length == 0) {
			pos = start + startTag.length;
		} else {
			pos = start + startTag.length + insText.length + endTag.length;
		}
		input.selectionStart = pos;
		input.selectionEnd = pos;
	}
}</script>

