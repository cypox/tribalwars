<?php
if($viewType == "table"){
	if(!empty($village['smith_tec'])){
		list($first_tec,$first_time) = explode(";", $village['smith_tec']);

		$tec = $cl_techs->get_name($first_tec);
		$time = format_date($first_time);
		echo "<b>{$time}</b> ({$tec})";
	}
}else{
	if(!empty($village['smith_tec'])){
		list($first_tec,$first_time) = explode(";", $village['smith_tec']);
		echo "<span class=\"timer\">".format_time($first_time-time())."</span>";
	}
}
?>