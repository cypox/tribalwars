<?php
class awards {
	var $last_dbname;
	var $id;
	var $name;
	var $dbname;
	var $needed;
	var $description;
	var $maxStage;
	var $nextStage;
	var $thisStage;
	var $type;
	var $in_type;
	var $stage;
	var $desc_stage;

	function add_awards($name,$dbname){
		$this->last_dbname = $dbname;
		$this->id = count($name);
		$this->name[$dbname] = $name;
		$this->dbname[$dbname] = $name;
	}
	function set_need($array){
		$this->needed[$this->last_dbname] = $array;
	}
	function set_maxstage($stage){
		$this->maxStage[$this->last_dbname] = $stage;
	}
	function set_nextStage($nextStage){
		$this->nextStage[$this->last_dbname] = $nextStage;
	}
	function set_thisStage($thisStage){
		$this->thisStage[$this->last_dbname] = $thisStage;
	}
	function set_type($type){
		$this->type[$this->last_dbname] = $type;
	}
	function set_description($description){
		$this->description[$this->last_dbname] = $description;
	}
	function get_name($name){
		return $this->name[$name];
	}
	function get_maxstage($dbname){
		return $this->maxStage[$dbname];
	}
	function get_nStage($dbname){
		return $this->nextStage[$dbname];
	}
	function get_tStage($dbname){
		return $this->thisStage[$dbname];
	}
	function get_type($dbname){
		return $this->type[$dbname];
	}
	function get_needed($dbname,$stage){
		return $this->needed[$dbname][$stage];
	}
	function get_description($dbname){
		return $this->description[$dbname];
	}
	function get_thisStage($dbname,$stage){
		if($this->type[$dbname] == "fix_one"){
			if($stage == 0){
				return $this->get_nextStage($dbname,$stage);
			}else{ 
				return $desc2 = $this->get_tStage($dbname);
			}
		}else{
			if($stage == 0){
				return $this->get_nextStage($dbname,$stage);
			}else{
				$desc1 = explode("%*%",$this->get_tStage($dbname));
				$desc2 =  "";
				$desc2 .= $desc1[0]; 
				$desc2 .= format_number($this->needed[$dbname][$stage]);
				$desc2 .= $desc1[1];
			}
			return $desc2;
		}
	}
	function get_nextStage($dbname,$stage){
		if($this->type[$dbname] == "fix_one"){
			if($stage >= "1"){
				$desc2 .= "Nível máximo atingido";
			}else{
				$desc2 = $this->get_nStage($dbname);
			}
		}else{
			$next = $stage+1;
			$desc1 = explode("%*%",$this->get_nStage($dbname));
			$desc2 = "";
			if($next > "4"){
				$desc2 .= "Nível máximo atingido";
			}else{
				$desc2 .= $desc1[0]; 
				$desc2 .= format_number($this->needed[$dbname][$next]);
				$desc2 .= $desc1[1];
			}
		}
		return $desc2;
	}
	function reload_medal_user($user){
		global $db;

		$array = array();
		foreach($this->dbname as $dbname=>$name){
			$array[] = $dbname;
			$array[] = $dbname."_stage";			
		}

		$result = $db->query("SELECT ".implode(',',$array).",`total_stage` FROM `medal` WHERE `userid`='".$user."'");
		$row = $db->fetch($result);

		$array = array();
		$stage = array();
		foreach($this->dbname as $dbname=>$name){
			$dbnames = $dbname."_stage";
			if($this->type[$dbname] == "fix_one"){
				$im = 1;
			}else{
				$im = 4;
			}

			for($i = 1; $i <= $im; $i++){
				if($this->type[$dbname] == "fix_rank"){
					if($row[$dbname] <=  $this->needed[$dbname][$i] && $row[$dbname] != 0){
						$stage[$dbname] = $i;
					}
				}else{
					if($row[$dbname] >=  $this->needed[$dbname][$i]){
						$stage[$dbname] = $i;
					}
				}
			}
			if($stage[$dbname] > $row[$dbnames]){
				$array[] = $dbnames."='".$stage[$dbname]."'";
				$row['total_stage'] += $stage[$dbname]-$row[$dbnames];
				$this->r_upstage($user,$dbname,$stage[$dbname]);
			}
			if($stage[$dbname] < $row[$dbnames]){
				$array[] = $dbnames."='".$stage[$dbname]."'";
				$row['total_stage'] -= $row[$dbnames]-$stage[$dbname];
			}
		}
		$db->query("UPDATE `medal` SET ".implode(",",$array).",`total_stage`='".$row['total_stage']."' WHERE `userid`='".$user."'");
	}
	function reload_medal(){
		global $db;

		$array = array();
		foreach($this->dbname as $dbname=>$name){
			$array[] = $dbname;
			$array[] = $dbname."_stage";			
		}

		$result = $db->query("SELECT ".implode(',',$array).",`userid`,`total_stage` FROM `medal`");
		while($row = $db->fetch($result)){
			$user = $row['userid'];		
			$array = array();
			$stage = array();
			foreach($this->dbname as $dbname=>$name){
				$dbnames = $dbname."_stage";
				if($this->type[$dbname] == "fix_one"){
					$im = 1;
				}else{
					$im = 4;
				}

				for($i = 1; $i <= $im; $i++){
					if($this->type[$dbname] == "fix_rank"){
						if($row[$dbname] <=  $this->needed[$dbname][$i] && $row[$dbname] != 0){
							$stage[$dbname] = $i;
						}
					}else{
						if($row[$dbname] >=  $this->needed[$dbname][$i]){
							$stage[$dbname] = $i;
						}
					}
				}
				if($stage[$dbname] > $row[$dbnames]){
					$array[] = $dbnames."='".$stage[$dbname]."'";
					$row['total_stage'] += $stage[$dbname]-$row[$dbnames];
					$this->r_upstage($user,$dbname,$stage[$dbname]);
				}
				if($stage[$dbname] < $row[$dbnames]){
					$array[] = $dbnames."='".$stage[$dbname]."'";
					$row['total_stage'] -= $row[$dbnames]-$stage[$dbname];
				}
			}
			$db->query("UPDATE `medal` SET ".implode(",",$array).",`total_stage`='".$row['total_stage']."' WHERE `userid`='".$user."'");
		}
	}
	function reload_rank(){
		global $db;

		$rang = 1;
		$all_rank = $db->query("SELECT `rang`,`userid` FROM `medal` ORDER BY `total_stage` DESC");
		while($rank_exe = $db->fetch($all_rank)){
			if($rank_exe['rang'] != $rang){
				$db->query("UPDATE `medal` SET `rang`='".$rang."' WHERE `userid`='".$rank_exe['userid']."'");
			}
			++$rang;
		}
	}
	function r_upstage($user,$dbname,$stage){
		global $db;

		$title = parse("Medalha ".$this->name[$dbname]." ".$this->desc_stage[$stage]);
		$text = $dbname.";".$stage;
		$db->query("INSERT INTO `reports` (`title`,`time`,`type`,`in_group`,`receiver_userid`,`message`) VALUES ('".$title."','".time()."','medal','other','$user','$text')");
		$db->query("UPDATE `users` SET `new_report`='1' WHERE `id`='".$user."'");
	}
	function getAwards($userid){
		global $db;

		$array = array();
		foreach($this->dbname as $dbname=>$name){
			$array[] = "`".$dbname."`";
			$array[] = "`".$dbname."_stage`";
		}

		$ordermedal = array();
		$result = $db->query("SELECT ".implode(',',$array).",`userid`,`total_stage` FROM `medal` WHERE `userid`='".$userid."'");
		$row = $db->fetch($result);

		foreach($this->dbname as $dbname=>$name){ 
			$stage = $dbname."_stage";
			$ordermedal[$row[$stage]][$dbname]['title'] = $row[$dbname];
			$ordermedal[$row[$stage]][$dbname]['id'] = $row[$stage];
		}

		$medalhas = array();
		krsort($ordermedal);
		foreach($ordermedal as $id=>$key){
			foreach($key as $dbname=>$valor){
				if($id > 0){
					$medalhas[$dbname]['title'] = $valor['title'];
					$medalhas[$dbname]['id'] = $valor['id'];
				}
			}
		}
		return $medalhas;
	}
}
?>