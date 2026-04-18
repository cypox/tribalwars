<?php
$storage_datas['storage_size'] = $arr_maxstorage[$village['storage']];

if($village['storage'] == $cl_builds->get_maxstage("storage")){
 $storage_datas['storage_size_next'] = false;
}else{
 $storage_datas['storage_size_next'] = $arr_maxstorage[$village['storage']+1];
}

$wood['do'] = $storage_datas['storage_size']-$village['r_wood'];
$wood_per_hour = $arr_production[$village['wood']]*$config['speed'];
$wood['time'] = floor(($wood['do']/$wood_per_hour)*3600);
$wood['end'] = time()+$wood['time'];

$stone['do'] = $storage_datas['storage_size']-$village['r_stone'];
$stone_per_hour = $arr_production[$village['stone']]*$config['speed'];
$stone['time'] = floor(($stone['do']/$stone_per_hour)*3600);
$stone['end'] = time()+$stone['time'];

$iron['do'] = $storage_datas['storage_size']-$village['r_iron'];
$iron_per_hour = $arr_production[$village['iron']]*$config['speed'];
$iron['time'] = floor(($iron['do']/$iron_per_hour)*3600);
$iron['end'] = time()+$iron['time'];

$tpl->assign("wood_sec", $wood['time']);
$tpl->assign("stone_sec", $stone['time']);
$tpl->assign("iron_sec", $iron['time']);

$tpl->assign("wood_sec_date", $wood['end']);
$tpl->assign("stone_sec_date", $stone['end']);
$tpl->assign("iron_sec_date", $iron['end']);

$tpl->assign("store_datas", $storage_datas);
$tpl->assign("description", $cl_builds->get_description_bydbname('storage'));
$tpl->register_modifier("stage", "stage");
?>