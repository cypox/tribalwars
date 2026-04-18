<?php
$storage_datas['storage_size'] = $arr_maxstorage[$village['storage']];

if($village['storage'] == $cl_builds->get_maxstage("storage")){
	$storage_datas['storage_size_next'] = false;
}else{
	$storage_datas['storage_size_next'] = $arr_maxstorage[$village['storage']+1];
}

$full = array();

$diff = $storage_datas['storage_size']-$village['r_wood'];
$wood_prod_hour = max(1, round($arr_production[$village['wood']]*$config['speed']/3600));
$full[] = @round($diff/$wood_prod_hour);

$diff = $storage_datas['storage_size']-$village['r_stone'];
$stone_prod_hour = max(1, round($arr_production[$village['stone']]*$config['speed']/3600));
$full[] = @round($diff/$stone_prod_hour);

$diff = $storage_datas['storage_size']-$village['r_iron'];
$iron_prod_hour = max(1, round($arr_production[$village['iron']]*$config['speed']/3600));
$full[] = @round($diff/$iron_prod_hour);

$min = max($full[0], $full[1], $full[2]);
if($viewType == "table"){
	if($min <= 0){
		echo "<b>Warehouse full!</b>";
	}else{
		echo "<b>Warehouse full in <span class=\"timer\">".format_time($min) ."</span></b>";
	}
}else{
	if($min > 0){
		echo "<span class=\"timer\">".format_time($min)."</span>";
	}
}
?>