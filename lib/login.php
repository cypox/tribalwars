<?php
require_once("GetUserData.php");
class login{
	var $sid;

	function login_js($username, $password){
		global $db;		

		$datas_cl = new getuserdata();
		$needed_datas = array("id","username","password","banned");
		$datas = $datas_cl->getbyusername(parse($username), $needed_datas);
		if($datas['exist_user'] == "0"){
		    return '{"message":"Desculpe, más não encontramos está conta!","type":"error","sms":"username"}';
		}elseif($datas['password'] != md5(crc32(md5(sha1(md5($password)))))){
		    return '{"message":"Desculpe, más a senha está invalida!","type":"error","sms":"password"}';
		}elseif($datas['banned'] == "Y"){
		    return '{"message":"Desculpe, más está conta está banida!","type":"error","sms":"username"}';
		}
		$sid = new sid();
        $sid = $sid->create_sid($datas['id']);
        $db->query("INSERT INTO `logins` (`username`,`time`,`ip`,`userid`) VALUES ('".$datas['username']."','".time()."','".$_SERVER['REMOTE_ADDR']."','".$datas['id']."')");
		return $datas['id'];
	}
	function login_do($username,$password){
		global $db;

		$datas_cl = new getuserdata();
		$needed_datas = array("id","username","password","banned");
		$datas = $datas_cl->getbyusername(parse($username), $needed_datas);
		if($datas['exist_user'] == "0"){
			return "Desculpe, más não encontramos está conta!";
		}elseif($datas['password'] != md5($password)){
			return "Desculpe, más a senha está invalida!";
		}elseif($datas['banned'] == "Y"){
			return "Desculpe, más está conta está banida!";
		}
		$sid = new sid();
        $sid = $sid->create_sid($datas['id']);
        $db->query("INSERT INTO `logins` (`username`,`time`,`ip`,`userid`) VALUES ('".$datas['username']."','".time()."','".$_SERVER['REMOTE_ADDR']."','".$datas['id']."')");
		return $datas['id'];
	}
	function login_uv($id){
		global $db;

		$datas_cl = new getuserdata();
		$needed_datas = array("id","username","banned","vacation_id","vacation_name","vacation_accept");
		$datas = $datas_cl->getbyid($id, $needed_datas);
		$sid = parse($_COOKIE['session']);
		$res = $db->query("SELECT `userid` FROM `sessions` WHERE `sid`='".$sid."'");
		$row = $db->fetch($res);
		if($row['userid'] != $datas['vacation_id'] || $datas['vacation_accept'] == 0){
			return "UV wurde bereits beendet!";
		}elseif($datas['exist_user'] == "0"){
			return "Desculpe, más não encontramos está conta!";
		}elseif($datas['banned'] == "Y"){
			return "Desculpe, más está conta está banida!";
		}else{
			$sid = new sid();
			$sid = $sid->create_sid($datas['id'], true);
			$db->query("INSERT INTO `logins` (`username`,`time`,`ip`,`userid`,`uv`) VALUES ('".$datas['username']."','".time( )."','".$_SERVER['REMOTE_ADDR']."','".$datas['id']."','".$datas['vacation_name']."')");
			return $datas['id'];
		}
	}
}

?>