<?php
class getuserdata{
	var $array;
	var $db;

	function __construct(){
		global $db;
		$this->db = $db;
	}
	function getbyid($id, $array, $count=true){
		global $db;
	
		$sql = "SELECT ";
		$sql .= implode(",",$array);
		$sql .= " FROM `users` WHERE `id`='".$id."'";
		$result = $db->query($sql);
		$row = $db->fetch($result);
		if($count){
			$count = $db->numrows($result);
			$row['exist_user'] = !isset($count) ? 0 : $count;
		}
		return $row;
	}
	function getbyusername($username, $array, $count=true){
		global $db;
	
		$sql = "SELECT ";
		$sql .= implode(",",$array);
		$sql .= " FROM `users` WHERE `username`='".$username."'";
		$result = $db->query($sql);
		$row = $db->fetch($result);
		if($count){
			$count = $db->numrows($result);
			$row['exist_user'] = !isset($count) ? 0 : $count;
		}
		return $row;
	}
}
?>
