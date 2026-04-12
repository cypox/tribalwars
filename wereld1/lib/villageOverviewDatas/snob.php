<?php
$units = array();
$time_finished = 0;
$res = $db->query("SELECT `unit`,`num_unit`,`num_finished`,`time_finished` FROM `recruit` WHERE `villageid`='".$village['id']."' AND `building`='snob' ORDER BY `time_finished`");
while($r = $db->fetch($res)){
	$time_finished = $r['time_finished'];
	$num = $r['num_unit']-$r['num_finished'];
	$units[$i]['num'] = $num;
	$units[$i]['name'] = $r['unit'];
	$i++;
}
if($viewType == "table"){
	if($time_finished != 0){
		echo "<b>".format_date($time_finished)."</b> ";
		foreach($units as $arr){
			echo "<img src=\"graphic/unit/{$arr['name']}.png\" alt=\"{$arr['num']}\" />";
		}
	}
}else{
	if($time_finished != 0){
		echo "<span class=\"timer\">".format_time($time_finished-time())."</span>";
	}
}
?>