<?php
class train{
	var $units;
	var $Units;
	var $cl_units;
	var $db;
	var $recruited = array();

	function __construct(){
		global $cl_units, $db, $arr_farm;

		$this->cl_units = $cl_units;
		$this->db = $db;
		$this->units = $cl_units->get_array("dbname");      
	    $this->Units = $cl_units->get_array("name");
        $this->arr_farm = $arr_farm;
	}
	function do_action($cur_village,$mode="mass"){
        $i = 0;
		foreach($this->Units as $key=>$value){
			++$i;
			$posted = ($mode == "mass") ? $_POST['units'][$cur_village][$key] : $_POST[$key];
			if(!empty($posted)){
                $cur_vil_info = "SELECT * FROM `villages` WHERE `id`='".$cur_village."'";
                $cur_vil_info = $this->db->fetch($this->db->query($cur_vil_info));
                $cur_vil_info['farmLimits'] = $this->arr_farm[$cur_vil_info['farm']]; 
				$this->cl_units->check_needed($key,$cur_vil_info);
                if(in_array("no_investigate",$this->cl_units->get_specials($key)))
					$check = "no_investigate";
				$input = (int)$posted;

				$wood = $this->cl_units->get_woodprice($key)*$input;
				$stone = $this->cl_units->get_stoneprice($key)*$input;
				$iron = $this->cl_units->get_ironprice($key)*$input;
				$bh = $this->cl_units->get_bhprice($key)*$input;
				if($wood > $cur_vil_info['r_wood'] || $stone > $cur_vil_info['r_stone'] || $iron > $cur_vil_info['r_iron']){
					$check = "to_many_units";
				}
				if(($cur_vil_info['farmLimits']-$cur_vil_info['r_bh']-$bh < 0) && empty($check)){
					$check = "to_many_bh";
				}
				if(empty($check) && is_numeric($this->cl_units->last_error) && $input > 0){
					$this->db->query("UPDATE villages SET r_wood=r_wood-'$wood',r_stone=r_stone-'$stone',r_iron=r_iron-'$iron',r_bh=r_bh+'$bh' where id='".$cur_vil_info['id']."'");
					$cur_vil_info['r_wood'] -= $wood;
					$cur_vil_info['r_stone'] -= $stone;
					$cur_vil_info['r_iron'] -= $iron;
					$cur_vil_info['r_bh'] += $bh;

				    $buildname = $this->cl_units->recruit_in[$key];
				    $this->cl_units->recruit_units($key,$input,$buildname,$cur_vil_info[$buildname],$cur_vil_info['id']);

                    $this->recruited[$cur_village][$key] = $input;
				    if($_GET['mode'] != "mass")
						$reload = true;
				}
			}
		}
		if($reload)
			header("LOCATION: game.php?village=".$cur_vil_info['id']."&screen=".$_GET['screen']."");
		if(empty($check))
			$check = $cl_units->last_error;
		switch($check){
			case "not_tec" :	$error = "Desculpe, más está unidade não foi pesquisada!";	break;
			case "not_needed" :	$error = "Desculpe, más não há os requerimentos necessários!";	break;
			case "not_enough_ress" :	$error = "Desculpe, más não há recursos suficientes!";	break;
			case "not_enough_bh" :	$error = "Desculpe, más a fazenda não pode sustentar mais habitantes!";	break;
			case "to_many_units" :	$error = "Desculpe, más não há recursos suficientes!";	break;
			case "to_many_bh" :	$error = "Desculpe, más a fazenda não pode sustentar mais habitantes!";	break;
		}
		if($error) $GLOBALS['tpl']->assign("error",$error);
		return $recruited;
	}
	function get_units_in_village($village){
		$sql = "SELECT ";
		$i = 0;
  		foreach($this->Units as $key=>$value){
			++$i;
			$sql .= (count($this->Units) == $i) ? $key : $key.",";
		}
		$sql .= " from unit_place where villages_from_id='".$village['id']."' AND villages_to_id='".$village['id']."'";
		$result = $this->db->query($sql);
		return $this->db->Fetch($result);
	}
	function get_all_units($village){
		$sql = "SELECT ";
		$i = 0;
    	foreach($this->Units as $key=>$value){
			if(in_array("no_investigate", $this->cl_units->get_specials($key))){
           		unset($this->units[$value]);
           		unset($this->Units[$key]);
           		if(count($this->Units) == $i)
					$sql = substr($sql,0,strlen($sql)-1);
			}else
				$sql .= (count($this->Units) == $i) ? "all_$key,".$key."_tec_level" : "all_$key,".$key."_tec_level,";
			++$i;
		}
		$sql .= " from villages where id='".$village['id']."'";
		$result = $this->db->query($sql);

		return $this->db->Fetch($result);
	}
    function get_recruit($village){
		$recruit_units = array();
		$i = 0;
		$result = $this->db->query("SELECT id,unit,num_unit,num_finished,time_finished,time_start from recruit where villageid='".$village['id']."' order by time_start");
		while($row = $this->db->Fetch($result)){
			++$i;
    	    $recruit_units[$row['id']]['lit'] = ($i == "1") ? true : false;
			$recruit_units[$row['id']]['unit'] = $row['unit'];
			$recruit_units[$row['id']]['num_unit'] = $row['num_unit']-$row['num_finished'];
			$recruit_units[$row['id']]['unit'] = $row['unit'];
			$recruit_units[$row['id']]['time_finished'] = $row['time_finished'];
	        $recruit_units[$row['id']]['countdown']=($i=="1")?($row['time_finished']-time()):($row['time_finished']-$row['time_start']);
		}
		return $recruit_units;
	}
}
?>