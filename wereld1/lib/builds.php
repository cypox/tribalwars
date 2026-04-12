<?php
class builds{
	var $id;
	var $config;
	var $last_dbname = array();
	var $name = array();
	var $dbname = array();
	var $wood = array();
	var $stone = array();
	var $iron = array();
	var $bh = array();
	var $bh_total = 0;
	var $points = array();
	var $max_stage = array();
	var $needbuilds = array();
	var $needbuilds_by_dbname = array();
	var $description = array();
	var $description_dbname = array();
	var $build_sharpens;
	var $main_factor;
	var $build_error2;
	var $build_error;
	var $specials;
	var $graphicCoords = array();
	var $Classe;

	function __construct(){
		global $config;
		$this->config = $config;
	}
	function add_build($name, $dbname){
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
	function set_points($b,$m){
		$this->points[$this->last_dbname] = "$b,$m";
	}
	function set_time($b,$m){
		$this->time[$this->last_dbname] = "$b,$m";
	}
	function set_mainfactor($b,$m){
		$this->main_factor = "$b,$m";
	}
	function set_maxstage($stage){
		$this->max_stage[$this->last_dbname] = $stage;
	}
	function set_buildsharpens($b,$m){
		$this->build_sharpens = "$b,$m";
	}
	function set_bhprice($b,$m){
		$this->bh[$this->last_dbname] = "$b,$m";
	}
	function set_description($value){
		$this->description[$this->id] = $value;
		$this->description_dbname[$this->last_dbname] = $value;
	}
	function set_needbuilds($array){
		$this->needbuilds[$this->id] = $array;
		$this->needbuilds_by_dbname[$this->last_dbname] = $array;
	}
	function set_specials($array){
		$this->speacials[$this->last_dbname] = $array;
	}
	function set_graphicCoords($coords){
		$this->graphicCoords[$this->last_dbname] = $coords;
	}
	function get_array($array){
		return $this->$array;
	}
	function get_needed($id){
		return $this->needbuilds[$id];
	}
	function get_needed_by_dbname($dbname){
		return $this->needbuilds_by_dbname[$dbname];
	}
	function get_specials($dbname){
		return $this->speacials[$dbname];
	}
	function get_dbname($id){
		return $this->dbname[$id];
	}
	function get_name($name){
		return $this->name[$name];
	}
	function get_description($id){
		return $this->description[$id];
	}
	function get_description_bydbname($dbname){
		return $this->description_dbname[$dbname];
	}
	function get_maxstage($dbname){
		return $this->max_stage[$dbname];
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
	function get_bh($dbname,$stage){
		list($start,$faktor) = explode(",", $this->bh[$dbname]);
		if($stage == "0"){
			return 0;
		}else{
			$bh = round(($start/$faktor)*pow($faktor,$stage) - ($start/$faktor)*pow($faktor,$stage-1));
			$this->bh_total += $bh;
			return $bh;
		}
	}
	function get_bh_total(){
		return $this->bh_total;
	}
	function get_points($dbname, $stage){
		list($start,$faktor) = explode(",", $this->points[$dbname]);
		if($stage == "0"){
			return "0";
		}else{
			return round($start/$faktor*pow($faktor,$stage));
		}
	}
	function get_time($main_stage,$dbname,$stage){
		global $arr_builds_starts_by_one;

		list($start,$faktor) = explode(",", $this->time[$dbname]);
		list($start2,$faktor2) = explode(",", $this->main_factor);
		if(in_array($dbname, $arr_builds_starts_by_one)){
			$stage -= 1;
		}
		$fakt = $start2*pow($faktor2,$main_stage);
		$time = round(($start/$faktor)*pow($faktor,$stage)*$fakt);
		return round($time/$this->config['speed']);
	}
	function get_highest_stage(){
		return max($this->max_stage);
	}
	function get_graphicCoords($dbname){
		return $this->graphicCoords[$dbname];
	}
	function build($village,$building,$build_village,$plus_costs){
		global $arr_production;
		global $arr_maxstorage;
		global $arr_farm;

		$dbname = $this->get_dbname($building);
		if($this->get_maxstage($dbname) <= $build_village[$dbname]){
			$this->build_error2 = "max_stage";
			return "";
		}
		$needed = $this->get_needed($building);
		$needed_done = true;
		foreach($needed as $dbname2 => $needed_stage){
			if($village[$dbname2] < $needed_stage){
				$this->build_error2 = "not_fulfilled";
				return "";
			}
		}
		if($this->get_bh($dbname,$build_village[$dbname]+1) != 0 && $arr_farm[$village['farm']]-$village['r_bh']-$this->get_bh($dbname,$build_village[$dbname]+1) < 0){
			$this->build_error2 = "not_enough_bh";
			return "";
		}
		$wood = round($this->get_wood($dbname,$build_village[$dbname]+1));
		$stone = round($this->get_stone($dbname,$build_village[$dbname]+1));
		$iron = round($this->get_iron($dbname,$build_village[$dbname]+1));
		if($arr_maxstorage[$village['storage']] < max($wood,$stone,$iron)){
			$this->build_error2 = "not_enough_storage";
			return "";
		}
		if($wood > $village['r_wood'] || $stone > $village['r_stone'] || $iron > $village['r_iron']){
			if($wood > $village['r_wood']){
				$missing = ($wood-$village['r_wood_comma'])/$this->config['speed'];
   				$per_second = $arr_production[$village['wood']]/3600;
   				$timeA = $missing/$per_second;
			}else{
			    $timeA = 0;
			}
			if($stone > $village['r_stone']){
   				$missing = ($stone-$village['r_stone_comma'])/$this->config['speed'];
   				$per_second = $arr_production[$village['stone']]/3600;
   				$timeB = $missing/$per_second;
			}else{
			    $timeB = 0;
			}
			if($iron > $village['r_iron']){
   				$missing = ($iron-$village['r_iron_comma'])/$this->config['speed'];
   				$per_second = $arr_production[$village['iron']]/3600;
   				$timeC = $missing/$per_second;
			}else{
			    $timeC = 0;
			}

			$wait_seconds = ceil(max($timeA,$timeB,$timeC));

			$this->build_error = format_time($wait_seconds);
			$this->build_error2 = "not_enough_ress";
			return "";
		}
		$wood = round($wood*$plus_costs);
		$stone = round($stone*$plus_costs);
		$iron = round($iron*$plus_costs);
		if($wood > $village['r_wood'] || $stone > $village['r_stone'] || $iron > $village['r_iron']){
			$this->build_error2 = "not_enough_ress_plus";
			return "";
		}
		$this->build_error = "";
		$this->build_error2 = "no_error";
	}
	function check_needed($buildname,$village){
	    $id_arr = array_flip($this->dbname);
	    $id = $id_arr[$buildname];
	    $needed = true;
	    foreach($this->get_needed($id) as $dbname => $stage){
	        if($village[$dbname] < $stage){
	            $needed = false;
			}
	    }
	    return $needed;
	}
	function get_build_error(){
		return $this->build_error;
	}
	 function get_build_error2(){
		return $this->build_error2;
	}

	function get_porcent($dbname,$stage){
		$max = $this->max_stage[$dbname];
		$porcent = ($stage*100)/$max;
		return floor($porcent);
	}
	function get_buildsharpens_costs($auftrag,$minus_auftrag=true){
		if($minus_auftrag){
			$auftrag -= 2;
		}
		$values = explode(",", $this->build_sharpens);
		if($auftrag < 1){
			return 0;
		}elseif($auftrag < 2){
			return 25;
		}else{
			return round(pow($values['0'],$auftrag)*$values['1'])+$this->get_buildsharpens_costs($auftrag-1,false);
		}
	}
	
	
function getGraphic($building, $stage){
  global $db, $config;

  $hour = date("H");
  $graphic = 'graphic/';
  if($_GET['screen'] != "overview"){
   $noOverview = true;
   $graphic .= "big_buildings/";
  }else{
   if($config['night_start'] > $config['night_end']){
    if($hour >= $config['night_start'] || $hour <= $config['night_end']){
     $graphic .= "visual_night/";
    }else{
     $graphic .= "visual/";
    }
   }else{
    if($hour >= $config['night_start'] && $hour <= $config['night_end']){
     $graphic .= "visual_night/";
    }else{
     $graphic .= "visual/";
    }
   }
  }
  switch($building){
   case "main":
    $get = $db->query("SELECT * FROM `build` WHERE `villageid`='".(int)$_GET['village']."'");
    $gif = $db->fetch($get);
    if($stage < 5){
     $graphic .= "main1";
    }elseif($stage >= 5 && $stage < 15){
     $graphic .= "main2";
    }elseif($stage >= 15){
                      $graphic .= "main3";
    }
    if($db->numRows($get) != 0 && !$noOverview){
     $graphic .= ".gif";
    }else{
     $graphic .= ".png";
    }
   break;
   case "barracks":
    if($stage < 5){
     $graphic .= "barracks1";
    }elseif($stage >= 5 && $stage < 20){
     $graphic .= "barracks2";
    }elseif($stage >= 20){
     $graphic .= "barracks3";
    }
    $graphic .= ".png";
   break;
   case "stable":
    $get = $db->query("SELECT * FROM `recruit` WHERE `villageid`='".(int)$_GET['village']."' AND building='stable'");
    if($stage < 5){
     $graphic .= "stable1";
    }elseif($stage >= 5 && $stage < 20){
     $graphic .= "stable2";
    }elseif($stage >= 20){
     $graphic .= "stable3";
    }
    if($db->numRows($get) != 0 AND !$noOverview) {
     $graphic .= ".gif";
    }else{
     $graphic .= ".png";
    }
   break;
   case "garage":
    $get = $db->query("SELECT * FROM `recruit` WHERE `villageid`='".(int)$_GET['village']."' AND building='garage'");
    if($stage < 5){
     $graphic .= "garage1";
    }elseif($stage >= 5 && $stage < 10){
     $graphic .= "garage2";
    }elseif($stage >= 10){
     $graphic .= "garage3";
    }
    if($db->numRows($get) != 0 && !$noOverview){
     $graphic .= ".gif";
    }else{
     $graphic .= ".png";
    }
   break;
   case "market":
    if($stage < 5){
     $graphic .= "market1";
    }elseif($stage >= 5 && $stage < 20){
     $graphic .= "market2";
    }elseif($stage >= 20){
     $graphic .= "market3";
    }
    $graphic .= ".png";
   break;
   case "smith":
    $get = $db->query("SELECT * FROM `research` WHERE `villageid`='".(int)$_GET['village']."'");
    if($stage < 5) {
     $graphic .= "smith1";
    }elseif($stage >= 5 && $stage < 15){
     $graphic .= "smith2";
    }elseif($stage >= 15){
     $graphic .= "smith3";
    }
    if(($db->numRows($get) > 0) && !$noOverview && $graphics_old){
     $graphic .= ".gif";
    }else{
     $graphic .= ".png";
    }
   break;
   case "storage":
    if($stage < 10) {
     $graphic .= "storage1";
    }elseif($stage >= 10 && $stage < 20){
     $graphic .= "storage2";
    }elseif($stage >= 20){
     $graphic .= "storage3";
    }
    $graphic .= ".png";
   break;
   case "farm":
    if($stage < 10) {
    $graphic .= "farm1";
    }elseif($stage >= 10 && $stage < 20){
     $graphic .= "farm2";
    }elseif($stage >= 20){
     $graphic .= "farm3";
    }
    $graphic .= ".png";
   break;
   case "wood":
    if($stage < 10){
     $graphic .= "wood1";
    }elseif($stage >= 10 && $stage < 20){
     $graphic .= "wood2";
    }elseif($stage >= 20){
     $graphic .= "wood3";
    }
    $graphic .= ".gif";
   break;
   case "stone":
    if($stage < 10){
     $graphic .= "stone1";
    }elseif($stage >= 10 && $stage < 20){
     $graphic .= "stone2";
    }elseif($stage >= 20){
     $graphic .= "stone3";
    }
    $graphic .= ".gif";
   break;
   case "iron":
    if($stage < 10){
     $graphic .= "iron1";
    }elseif($stage >= 10 && $stage < 20) {
     $graphic .= "iron2";
    }elseif($stage >= 20){
     $graphic .= "iron3";
    }
    $graphic .= ".gif";
   break;
   case "wall":
    if($stage < 5){
     $graphic .= "wall1";
    }elseif($stage >= 5 && $stage < 15){
     $graphic .= "wall2";
    }elseif($stage >= 15){
     $graphic .= "wall3";
    }
    $graphic .= ".png";
   break;
   case "snob":
    $get = $db->query("SELECT * FROM `recruit` WHERE `building`='snob' AND `villageid`='".(int)$_GET['village']."'");
    $graphic .= "snob1";
    if($db->numRows($get) != 0 && !$noOverview){
     $graphic .= ".gif";
    }else{
     $graphic .= ".png";
    }
   break;
   case "hide":
    if($stage >= 1){
     $graphic .= "hide1";
    }
    $graphic .= ".png";
   break;
   case "place":
    $get = $db->query("SELECT * FROM `recruit` WHERE `villageid`='".(int)$_GET['village']."' AND building='barracks'");
    if($stage >= 1){
     $graphic .= "place1";
    }else{
     $graphic .= "place1";
    }
    if($db->numRows($get) != 0 && !$noOverview){
     $graphic .= ".gif";
    }else{
     $graphic .= ".png";
    }
   break;
   case "statue":
                        $graphic .= "statue1.png";
   break;
  }
  return $graphic;
 }

 
 
 	function getClass($building, $stage){
		switch($building){
			case "main":
				if($stage < 5){
					$this->Classe = 1;
				}elseif($stage >= 5 && $stage < 10){
					$this->Classe = 2;
				}elseif($stage >= 10 && $stage < 15){
					$this->Classe = 3;
				}elseif($stage >= 15 && $stage < 20){
					$this->Classe = 4;
				}elseif($stage >= 20 && $stage < 20){
					$this->Classe = 5;
				}elseif($stage >= 20){
					$this->Classe = 6;
				}
			break;
			case "barracks":
				if($stage < 5){
					$this->Classe = 1;
				}elseif($stage >= 5 && $stage < 10){
					$this->Classe = 2;
				}elseif($stage >= 10 && $stage < 13){
					$this->Classe = 3;
				}elseif($stage >= 13 && $stage < 15){
					$this->Classe = 4;
				}elseif($stage >= 15 && $stage < 20){
					$this->Classe = 5;
				}elseif($stage >= 20){
					$this->Classe = 6;
				}
			break;
			case "stable":
				if($stage < 3){
					$this->Classe = 1;
				}elseif($stage >= 3 && $stage < 6){
					$this->Classe = 2;
				}elseif($stage >= 6 && $stage < 12){
					$this->Classe = 3;
				}elseif($stage >= 12 && $stage < 15){
					$this->Classe = 4;
				}elseif($stage >= 15 && $stage < 18){
					$this->Classe = 5;
				}elseif($stage >= 18){
					$this->Classe = 5;
				}
			break;
			case "garage":
				if($stage < 3){
					$this->Classe = 1;
				}elseif($stage >= 3 && $stage < 6){
					$this->Classe = 2;
				}elseif($stage >= 6 && $stage < 12){
					$this->Classe = 3;
				}elseif($stage >= 12){
					$this->Classe = 4;
				}
			break;
			case "market":
				if($stage < 5){
					$this->Classe = 1;
				}elseif($stage >= 5 && $stage < 10){
					$this->Classe = 2;
				}elseif($stage >= 10 && $stage < 15){
					$this->Classe = 3;
				}elseif($stage >= 15 && $stage < 20){
					$this->Classe = 4;
				}elseif($stage >= 20){
					$this->Classe = 5;
				}
			break;
			case "smith":
				if($stage < 6){
					$this->Classe = 1;
				}elseif($stage >= 6 && $stage < 12){
					$this->Classe = 2;
				}elseif($stage >= 12){
					$this->Classe = 3;
				}
			break;
			case "storage":
				if($stage < 5){
					$this->Classe = 1;
				}elseif($stage >= 5 && $stage < 10){
					$this->Classe = 2;
				}elseif($stage >= 10 && $stage < 15){
					$this->Classe = 3;
				}elseif($stage >= 15 && $stage < 20){
					$this->Classe = 4;
				}elseif($stage >= 20 && $stage < 25){
					$this->Classe = 5;
				}elseif($stage >= 25){
					$this->Classe = 6;
				}
			break;
			case "farm":
				if($stage < 5){
					$this->Classe = 1;
				}elseif($stage >= 5 && $stage < 10){
					$this->Classe = 2;
				}elseif($stage >= 10 && $stage < 15){
					$this->Classe = 3;
				}elseif($stage >= 15 && $stage < 20){
					$this->Classe = 4;
				}elseif($stage >= 20 && $stage < 25){
					$this->Classe = 5;
				}elseif($stage >= 25){
					$this->Classe = 6;
				}
			break;
			case "wood":
				if($stage < 5){
					$this->Classe = 1;
				}elseif($stage >= 5 && $stage < 10){
					$this->Classe = 2;
				}elseif($stage >= 10 && $stage < 15){
					$this->Classe = 3;
				}elseif($stage >= 15 && $stage < 20){
					$this->Classe = 4;
				}elseif($stage >= 20 && $stage < 25){
					$this->Classe = 5;
				}elseif($stage >= 25){
					$this->Classe = 6;
				}
			break;
			case "stone":
				if($stage < 5){
					$this->Classe = 1;
				}elseif($stage >= 5 && $stage < 10){
					$this->Classe = 2;
				}elseif($stage >= 10 && $stage < 15){
					$this->Classe = 3;
				}elseif($stage >= 15 && $stage < 20){
					$this->Classe = 4;
				}elseif($stage >= 20 && $stage < 25){
					$this->Classe = 5;
				}elseif($stage >= 25){
					$this->Classe = 6;
				}
			break;
			case "iron":
				if($stage < 5){
					$this->Classe = 1;
				}elseif($stage >= 5 && $stage < 10){
					$this->Classe = 2;
				}elseif($stage >= 10 && $stage < 15){
					$this->Classe = 3;
				}elseif($stage >= 15 && $stage < 20){
					$this->Classe = 4;
				}elseif($stage >= 20 && $stage < 25){
					$this->Classe = 5;
				}elseif($stage >= 25){
					$this->Classe = 6;
				}
			break;
			case "wall":
				if($stage < 3){
					$this->Classe = 1;
				}elseif($stage >= 3 && $stage < 6){
					$this->Classe = 2;
				}elseif($stage >= 6 && $stage < 12){
					$this->Classe = 3;
				}elseif($stage >= 12 && $stage < 15){
					$this->Classe = 4;
				}elseif($stage >= 15 && $stage < 18){
					$this->Classe = 5;
				}elseif($stage >= 18){
					$this->Classe = 6;
				}
			break;
			case "snob":
				$this->Classe = 1;
			break;
			case "hide":
				if($stage < 3){
					$this->Classe = 1;
				}elseif($stage >= 3 && $stage < 6){
					$this->Classe = 2;
				}elseif($stage >= 6){
					$this->Classe = 3;
				}
			break;
			case "place":
				$this->Classe = 1;
			break;
		}
		return $this->Classe;
	}
 
 
 
 
}
?>