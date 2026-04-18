<?php
class Country{
	var $ip_num = 0;
	var $ip = '';
	var $country_code = '';
	var $country_name = '';

	function __construct(){
		$this->set_ip();
	}
	function get_ip_num(){
		return $this->ip_num;
	}
	function set_ip($newip=''){
		if($newip == '')
			$newip = $this->get_client_ip();
		$this->ip = $newip;
		$this->calculate_ip_num();
		$this->country_code = '';
		$this->country_name = '';
	}
	function calculate_ip_num(){
		if($this->ip == '')
			$this->ip = $this->get_client_ip();
		$this->ip_num = sprintf("%u", ip2long($this->ip));
	}
	function get_country_code($ip_addr=''){
		global $db;

		if($ip_addr != '' && $ip_addr != $this->ip)
			$this->set_ip($ip_addr);
		if($ip_addr == ''){
			if($this->ip != $this->get_client_ip())
				$this->set_ip();
		}
		if($this->country_code != '')
			return $this->country_code;
		$r = $db->query("SELECT `country_code`,`country_name` FROM `country` WHERE ".$this->ip_num." BETWEEN `begin_ip_num` AND `end_ip_num`");
		if(!$r)
			return '';
		$row = $db->fetch($r);
		$this->country_name = $row['country_name'];
		$this->country_code = $row['country_code'];
		return $row['country_code'];
	}
	function get_country_name($ip_addr=''){
		$this->get_country_code($ip_addr);
		return $this->country_name;
	}
	function get_client_ip(){
		$v = '';
		$v = (!empty($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : ((!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : @getenv('REMOTE_ADDR'));
		if(isset($_SERVER['HTTP_CLIENT_IP']))
			$v = $_SERVER['HTTP_CLIENT_IP'];
		return htmlspecialchars($v,ENT_QUOTES);
	}
}
?>