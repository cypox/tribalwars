<?php
class getvillagedata{
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
		$sql .= " FROM `villages` WHERE `id`='".$id."'";
		$result = $db->query($sql);
		$row = $db->fetch($result);
		if($count){
			$count = $db->numrows($result);
			$row['exist_village'] = !isset($count) ? 0 : $count;
		}
		return $row;
	}
	function getbyvillagename($name, $array, $count=true){
		global $db;
	
		$sql = "SELECT ";
		$sql .= implode(",",$array);
		$sql .= " FROM `villages` WHERE `name`='".$name."'";
		$result = $db->query($sql);
		$row = $db->fetch($result);
		if($count){
			$count = $db->numrows($result);
			$row['exist_village'] = !isset($count) ? 0 : $count;
		}
		return $row;
	}
}
?>
