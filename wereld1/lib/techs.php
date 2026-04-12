<?php
class techs {
	var $last_dbname;
	var $id;
	var $name = array();
	var $dbname = array();
	var $wood = array();
	var $stone = array();
	var $iron = array();
	var $time = array();
	var $maxStage = array();
	var $needed = array();
	var $group = array();
	var $description = array();
	var $tech_error;
	var $time_wait;
	var $tech_graphic;
	var $is_researches;
	var $config;
	var $db;
	var $smith_factor;

	function __construct(){
		global $config;
		global $db;

		$this->config = $config;
		$this->db = $db;
	}
	function add_tech($name,$dbname){
		$this->last_dbname = $dbname;
		$this->id = count($this->name);
		$this->name[$dbname] = $name;
		$this->dbname[$this->id] = $dbname;
	}
	function set_woodprice($b,$m){
		$this->wood[$this->last_dbname] = "$b,$m";
	}
	function set_stoneprice($b,$m){
		$this->stone[$this->last_dbname] = "$b,$m";
	}
	function set_ironprice($b,$m){
		$this->iron[$this->last_dbname] = "$b,$m";
	}
	function set_time($b,$m){
		$this->time[$this->last_dbname] = "$b,$m";
	}
	function set_smithfactor($b,$m){
		$this->smith_factor = "$b,$m";
	}
	function set_maxStage($stage){
		$this->maxStage[$this->last_dbname] = $stage;
	}
	function set_needed($array){
		$this->needed[$this->last_dbname] = $array;
	}
	function set_group($group){
		$this->group[$this->last_dbname] = "$group";
	}
	function set_description($description){
		$this->description[$this->last_dbname] = $description;
	}
	function set_attType($t){
		if(in_array('def',$t))	
			$this->atttype['def'][] = $this->last_dbname;
		if(in_array('off',$t))	
			$this->atttype['off'][] = $this->last_dbname;
		if(in_array('spy',$t))	
			$this->atttype['spy'][] = $this->last_dbname;
	}
	function check_tech($dbname,$village){
		global $arr_maxstorage;
		global $config;
		global $arr_production;

        if(!in_array($dbname,$this->dbname)){
  			$this->tech_error = "tech_not_found";
			return "";
        }
		if($this->get_maxstage($dbname) <= $village['unit_'.$dbname.'_tec_level']){
			$this->tech_error = "max_stage";
			$this->tech_graphic = $dbname."_big.png";
			return "";			
		}
		$needed_done = true;
		foreach($this->get_needed($dbname) as $needed_build=>$needed_stage){
			if($village[$needed_build]<$needed_stage){
				$this->tech_error = "not_fulfilled";
				$this->tech_graphic = $dbname."_big_locked.png";
				return "";
			}
		}
		$wood = round($this->get_wood($dbname,$village['unit_'.$dbname.'_tec_level']+1));
		$stone = round($this->get_stone($dbname,$village['unit_'.$dbname.'_tec_level']+1));
		$iron = round($this->get_iron($dbname,$village['unit_'.$dbname.'_tec_level']+1));

  		if($arr_maxstorage[$village['storage']]<max($wood,$stone,$iron)){
  			$this->tech_error = "not_enough_storage";
  			$this->tech_graphic = $dbname."_big_inactive.png";
  			return "";
  		}
		if($wood>$village['r_wood'] || $stone>$village['r_stone'] || $iron>$village['r_iron']){
			if($wood>$village['r_wood']){
   				$missing = ($wood-$village['r_wood_comma'])/$this->config['speed'];
   				$per_second = $arr_production[$village['wood']]/3600;
   				$timeA = $missing/$per_second;
			}else{
			    $timeA = 0;
			}
			if($stone>$village['r_stone']){
   				$missing = ($stone - $village['r_stone_comma'])/$this->config['speed'];
   				$per_second = $arr_production[$village['stone']]/3600;
   				$timeB = $missing/$per_second;
			}else{
			    $timeB = 0;
			}
			if($iron>$village['r_iron']){
   				$missing = ($iron-$village['r_iron_comma'])/$this->config['speed'];
   				$per_second = $arr_production[$village['iron']]/3600;
   				$timeC = $missing/$per_second;
			}else{
			    $timeC = 0;
			}
			$wait_seconds = ceil(max($timeA,$timeB,$timeC));
			$this->time_wait = format_time($wait_seconds);
			$this->tech_error = "not_enough_ress";
			$this->tech_graphic = $dbname."_big_inactive.png";
			return "";
		}
		$this->tech_error = "no_error";
		$this->tech_graphic = $dbname."_big.png";
		return "";
	}
	function research($dbname,$village){
		$wood = round($this->get_wood($dbname,$village['unit_'.$dbname.'_tec_level']+1));
		$stone = round($this->get_stone($dbname,$village['unit_'.$dbname.'_tec_level']+1));
		$iron = round($this->get_iron($dbname,$village['unit_'.$dbname.'_tec_level']+1));
		$time = round($this->get_time($village['smith'],$dbname,$village['unit_'.$dbname.'_tec_level']+1));

		$stamp = time();
		$this->db->query("INSERT into research (research,villageid,end_time) VALUES ('".parse($dbname)."','".$village['id']."','".($time+$stamp)."')");
		$id = $this->db->getLastId();
		$this->db->query("INSERT into events (event_time,event_type,event_id,user_id,villageid) VALUES ('".($time+$stamp)."','research','$id','".$village['userid']."','".$village['id']."')");
		$tec = $dbname.";".($time+$stamp);
		$this->db->query("UPDATE villages SET r_wood=r_wood-'".$wood."',r_stone=r_stone-'".$stone."',r_iron=r_iron-'".$iron."',smith_tec='$tec' where id='".$village['id']."'");
	}
	function get_last_error(){
		return $this->tech_error;
	}
	function get_graphic(){
		return $this->tech_graphic;
	}
	function get_time_wait(){
		return $this->time_wait;
	}
	function get_dbname($id){
		return $this->dbname[$id];
	}
	function get_name($name){
		return $this->name[$name];
	}
	function get_maxStage($dbname){
		return $this->maxStage[$dbname];
	}
	function get_wood($dbname,$stage){
		list($start,$faktor) = explode(",", $this->wood[$dbname]);
		return round(($start/$faktor)*pow($faktor,$stage)); 
	}
	function get_stone($dbname,$stage){
		list($start,$faktor) = explode(",", $this->stone[$dbname]);
		return round(($start/$faktor)*pow($faktor,$stage)); 
	}
	function get_iron($dbname,$stage){
		list($start,$faktor) = explode(",", $this->iron[$dbname]);

		return round(($start/$faktor)*pow($faktor,$stage)); 
	}
	function get_time($smith,$dbname,$stage){
		list($start,$faktor) = explode(",", $this->time[$dbname]);
		list($start2,$faktor2) = explode(",", $this->smith_factor);

		$fakt = round($start2 * pow($faktor2,$smith), 2);
		$time = round( ($start/$faktor)*pow($faktor,$stage) * $fakt);
		return round($time/$this->config['speed']);
	}	
	function get_factor($stage){
		list($start2,$faktor2) = explode(",", $this->smith_factor);

		return $start2 * pow($faktor2,$stage);
	}
	function get_group($dbname){
		return $this->group[$dbname];
	}
	function get_array($array){
		return $this->$array;
	}
	function get_needed($dbname){
		return $this->needed[$dbname];
	}
	function get_tech_from_village($tech,$village){
		return $village['unit_'.$tech.'_tec_level'];
	}
	function get_attType($name){
		return $this->atttype[$name];
	}
}
?>