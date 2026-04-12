<?php
class security{
	function ip2bin($ip_range){
		$ipbin = 0;
		@list($ip, $subnet) = explode('/', $ip_range);
		$subnet = isset($subnet) && $subnet >= 0 && $subnet <= 32 ? (int) $subnet : 32;
		if(strpos($ip, '.') !== false){
			$ip_parts = explode('.', $ip);
			for($i=0;$i<4;$i++){
				$ip_part = (int)$ip_parts[$i];
				if($ip_part < 0 || $ip_part > 255){
					break;
				}
				$ipbin += $ip_part << (24-$i*8);
				if(8*$i >= $subnet){
					break;
				}
			}
		}
		$significant = 0;
		for($i=0;$i<$subnet;$i++){
			$significant += 1 << (31-$i);
		}
		return array($ipbin & $significant, $subnet);
	}
	function checkIPs(){
		if(DEV_TWLan){
			return true;
		}
		$valid_ip_ranges = array();
		$valid_ip_ranges[] = '192.168.0.0/16';
		$valid_ip_ranges[] = '128.0.0.0/8';
		$valid_ip_ranges[] = '10.0.0.0/8';
		$valid_ip_ranges[] = '172.16.0.0/12';
		$valid_ip_ranges[] = '127.0.0.0/8';
		$valid_ip_ranges_bin = array();
		foreach($valid_ip_ranges as $ip_range){
			$valid_ip_ranges_bin[] = $this->ip2bin($ip_range);
		}
		$my_own_ip = $_SERVER['REMOTE_ADDR'];
		if(strpos($my_own_ip, '.') !== false){
			list($my_own_ip_bin, ) = $this->ip2bin($my_own_ip);
			foreach($valid_ip_ranges_bin as $ipdata){
				list($ip, $ip_range) = $ipdata;
				$significant = 0;
				for($i=0;$i<$ip_range;$i++){
					$significant += 1 << (31-$i);
				}
				if(($my_own_ip_bin & $significant) == $ip){
					$valid_found = true;
					break;
				}
			}
		}elseif($my_own_ip == '::1'){
			$valid_found = true;
		}
		return $valid_found;
	}
}
?>