<?php
class map{
	var $villages;
	var $players;
	var $ally;
	var $db;
	var $user;
	var $village;
	var $config;

	function __construct(){
		global $db, $user, $village, $config;

		$this->db = $db;
		$this->user = $user;
		$this->village = $village;
		$this->config = $config;
	}
    function search_villages($x_begin,$x_end,$y_begin,$y_end){
		$result = $this->db->query("SELECT `id`,`userid`,`x`,`y`,`points`,`name`,`continent` FROM `villages` WHERE (`x`>='".$x_begin."' AND `x`<='".$x_end."') AND (`y`>='".$y_begin."' AND `y`<='".$y_end."')");
		while($row_vill = $this->db->fetch($result)){
			foreach($row_vill as $key=>$value){
				$this->villages[$row_vill['x']][$row_vill['y']][$key] = $value;
			}
			if($row_vill['userid'] != "-1"){
				if(!isset($this->players[$row_vill['userid']])){
					$result2 = $this->db->query("SELECT `ally`,`username`,`points` FROM `users` WHERE `id`='".$row_vill['userid']."'");
					$row_user = $this->db->fetch($result2);
					if(is_array($row_user)){
						foreach($row_user as $key=>$value){
							$this->players[$row_vill['userid']][$key] = $value;
						}
					}
					if(!isset($this->ally[$row_user['ally']]) && $row_user['ally'] != "-1"){
						$result3 = $this->db->query("SELECT `id`,`points`,`short`,`name` FROM `ally` WHERE `id`='".$row_user['ally']."'");
						$row_ally = $this->db->Fetch($result3);
						if(is_array($row_ally)){
							foreach($row_ally as $key=>$value){
								$this->ally[$row_user['ally']][$key] = $value;
							}
						}
					}
				}
			}
		}
	}
	function getvillage($x,$y,$type='id'){
		if(isset($this->villages["$x"]["$y"]["$type"])){
			return str_replace("'", "\'", entparse($this->villages["$x"]["$y"]["$type"]));
		}else{
			return false;
		}
	}
	function getuser($id,$type){
		if(isset($this->players["$id"]["$type"])){
			return str_replace("'", "\'", entparse($this->players["$id"]["$type"]));
		}else{
			return false;
		}
	}
	function getcolor($x,$y){
		$getAllyTypePartner = $this->db->query("SELECT `to_ally`,`type` FROM `ally_contracts` WHERE `from_ally`='".$this->user['ally']."' AND `type`='partner'");
		$toAllyPartner = array();
		while($typePartnerRow = $this->db->fetch($getAllyTypePartner)){
			$typePartnerRow[$toAllyPartner] = $typePartnerRow['to_ally'];
		}
		$getAllyTypeNap = $this->db->query("SELECT `to_ally`,`type` FROM `ally_contracts` WHERE `from_ally`='".$this->user['ally']."' AND `type`='nap'");
		$toAllyNap = array();
		while($typeNapRow = $this->db->fetch($getAllyTypeNap)){
			$typeNapRow[$toAllyNap] = $typeNapRow['to_ally'];
		}
		$getAllyTypeEnemy = $this->db->query("SELECT `to_ally`,`type` FROM `ally_contracts` WHERE `from_ally`='".$this->user['ally']."' AND `type`='enemy'");
		$toAllyEnemy = array();
		while($typeEnemyRow = $this->db->fetch($getAllyTypeEnemy)){
			$typeEnemyRow[$toAllyEnemy] = $typeEnemyRow['to_ally'];
		}
		$esql = $this->db->query("SELECT `color` FROM `marked` WHERE `marker_id`='".$this->user['id']."' AND `marked_id`='".$this->villages[$x][$y]["userid"]."' LIMIT 1");
		if($this->village['x'] == $x && $this->village['y'] == $y){
			$rgb = "255,255,255";
		}elseif($this->db->numrows($esql) > 0){
			$select = $this->db->fetch($esql);
			$hex = color($select['color']);
			$rgb = $hex['0'].",".$hex['1'].",".$hex['2'];
		}elseif($this->villages[$x][$y]['userid'] == $this->user['id']){
			$rgb = "240,200,0";
		}elseif($this->players[$this->getvillage($x,$y,userid)]['ally'] == $this->user['ally'] && $this->user['ally'] != "-1"){
			$rgb = "0,0,224";
		}elseif($this->villages[$x][$y]['userid'] == $this->user['id']){
			$rgb = "240,200,0";
		}elseif(in_array($this->players[$this->getvillage($x,$y,userid)]['ally'], $toAllyPartner)){
			$rgb = "0,160,244";
		}elseif(in_array($this->players[$this->getvillage($x,$y,userid)]['ally'], $toAllyNap)){
			$rgb = "128,0,128";
		}elseif(in_array($this->players[$this->getvillage($x,$y,userid)]['ally'], $toAllyEnemy)){
			$rgb = "244,0,0";
		}else{
			$rgb = "130,60,10";
		}
		return $rgb;
    }
	function graphic($x, $y){
		$graphic = "";
		if($this->villages[$x][$y]["bonus"] != 0){
			$graphic .= "b";
		}else{
			$graphic .= "v";
		}
		$v = true;
		$points = $this->villages[$x][$y]["points"];
		if($points < 300 && $v){
			$graphic .= "1";
		}elseif($points < 1000 && $v){
			$graphic .= "2";
		}elseif($points < 3000 && $v){
			$graphic .= "3";
		}elseif($points < 9000 && $v){
			$graphic .= "4";
		}elseif($points < 11000 && $v){
			$graphic .= "5";
		}elseif($v){
			$graphic .= "6";
		}
		if(empty($this->villages[$x][$y]['userid'])){
			$graphic = "gras".rand(1,4);
		}elseif($this->villages[$x][$y]['userid'] == "-1"){
			$graphic .= "_left";
		}else{
			$graphic .= "";
		}
		$graphic .= ".png";
		return $graphic;
	}
	function getclass($x,$y){
		global $config;

		$hour = date("H");
		if($config['night_start'] > $config['night_end']){
			if($hour >= $config['night_start'] || $hour <= $config['night_end']){
				$night = "-night";
			}else{
				$night = "";
			}
		}else{
			if($hour >= $config['night_start'] && $hour <= $config['night_end']){
				$night = "-night";
			}else{
				$night = "";
			}
		}
		$return = '';
		if($x%100 == 0){
			$return .= 'border-left ';
		}elseif($x%5 == 0){
			$return .= 'space-left'.$night.' ';
		}else{
			$return .= '';
		}
		if(($y)%100 == 0){
			$return .= 'border-bottom ';
		}elseif(($y)%5 == 0){
			$return .= 'space-bottom'.$night.' ';
		}else{
			$return .= '';
		}
		return $return;
    }
	function getcon($x,$y){
		return $this->villages[$x][$y]['continent'];
	}
	function getvillageid($x,$y){
		return $this->villages[$x][$y]['id'];
	}
	function getally($x,$y){
		if(!isset($this->ally[$this->players[$this->villages[$x][$y]['userid']]['ally']]['short'])){
			return "null";
		}else{
			$allyname = str_replace("'", "\'", entparse($this->ally[$this->players[$this->villages[$x][$y]['userid']]['ally']]['short']));
			$points = str_replace("'", "\'", entparse($this->ally[$this->players[$this->villages[$x][$y]['userid']]['ally']]['points']));
			return "'".entparse($allyname)." (".numberFormat($points)." Pontos)'";
		}
	}
	function playerinfo($x,$y){
		$playerid = $this->villages[$x][$y]["userid"];
		if($playerid == "-1"){
			return "null";
		}else{
			$username = str_replace("'", "\'", entparse($this->players[$playerid]['username']));
			$playerpoints = str_replace("'", "\'", entparse($this->players[$playerid]['points']));
			return "'".$username." (".format_number($playerpoints)." Pontos)'";
		}
	}
}
?>