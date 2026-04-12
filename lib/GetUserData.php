<?php
class getuserdata{
	var $array;
	var $db;

	function __construct(){
		global $db;

		$this->db = $db;
	}
	function getbyid($id,$array,$count=true){
		$sql = 'SELECT `' . implode('`, `', $array) . '`';
		$sql .= ' FROM `users` WHERE `id` = ' . intval($id) . ' LIMIT 1';
		$result = $this->db->query($sql);
		$row    = $this->db->fetch($result);
		if($count){
			$row['exist_user'] = ($row === null || $row === false) ? 0 : 1;
		}
		return $row;
	}
	function getbyusername($username,$array){
		$sql = 'SELECT `' . implode('`, `', $array) . '`';
		$sql .= ' FROM `users` WHERE `username` = \'' . $username . '\' LIMIT 1';
		$result = $this->db->query($sql);
		$row = $this->db->fetch($result);

		$row['exist_user'] = ($row === null || $row === false) ? 0 : 1;

		return $row;
	}
}
?>