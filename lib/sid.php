<?php
class sid{
	var $db;

	function __construct(){
		global $db;

		$this->db = $db;
	}
	function create_sid($userid){
		$this->db->query("DELETE FROM `sessions` WHERE `userid`='".$userid."'");
		do{
			$sid_letters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$sid = "";
			for($n=1;$n<=32;$n++){
				$sid .= $sid_letters[rand(0, 61)];
			}
			$result = $this->db->query("SELECT COUNT(sid) FROM `sessions` WHERE `sid`='".$sid."'");
		}while($this->db->numrows($result)==0);
		$hkey = "";
		for($n=1;$n<=4;++$n){
			$hkey .= $sid_letters[rand(0, 61)];
		}
		$this->db->query("INSERT INTO `sessions` (`userid`,`hkey`,`sid`) VALUES ('".$userid."','".$hkey."','".$sid."')");
		setcookie("session", $sid);
	}
	function logout($userid){
		$this->db->query("DELETE FROM `sessions` WHERE `userid`='".$userid."'");
    }
	function check_sid($sid){
		$sid = parse($sid);
		$result = $this->db->query("SELECT `userid`,`hkey`,`sid` FROM `sessions` WHERE `sid`='".$sid."'");
		$row = $this->db->fetch($result);
		if($result === false)
			return false;
		return $row;
	}
}
?>