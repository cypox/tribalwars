<?php
$storage_datas['storage_size'] = $arr_maxstorage[$village['storage']];

if($village['storage'] == $cl_builds->get_maxstage("storage")){
	$storage_datas['storage_size_next'] = false;
}else{
	$storage_datas['storage_size_next'] = $arr_maxstorage[$village['storage']+1];
}

$full = array();

$diff = $storage_datas['storage_size']-$village['r_wood'];
$full[] = @round($diff/round($arr_production[$village['wood']]*$config['speed']/3600));

$diff = $storage_datas['storage_size']-$village['r_stone'];
$full[] = @round($diff/round($arr_production[$village['stone']]*$config['speed']/3600));

$diff = $storage_datas['storage_size']-$village['r_iron'];
$full[] = @round($diff/round($arr_production[$village['iron']]*$config['speed']/3600));

$min = max($full[0], $full[1], $full[2]);
if($viewType == "table"){
	if($min <= 0){
		echo "<b>Armazém cheio!</b>";
	}else{
		echo "<b>Armazém cheio em <span class=\"timer\">".format_time($min) ."</span></b>";
	}
}else{
	if($min > 0){
		echo "<span class=\"timer\">".format_time($min)."</span>";
	}
}
?>