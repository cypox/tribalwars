<?php
class villageoverviewdatas{
	function __construct($viewType){
		$this->viewType = $viewType;
	}
	function get($building){
		global $db,$cl_units,$cl_builds,$cl_techs,$village,$arr_maxstorage,$arr_production,$config,$arr_farm,$maxmag,$maxfarm,$bonus;
		$path = PATH."/lib/villageOverviewDatas/".$building.".php";
		$viewType = $this->viewType;
		if(is_file($path)){
			require_once($path);
		}
	}
}
?>