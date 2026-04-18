<?php
$units = array();
$time_finished = 0;
$i = 0;
$now = time();
$overdue = $db->query("SELECT `id` FROM `recruit` WHERE `villageid`='".$village['id']."' AND `building`='snob' AND `time_finished`<='".$now."'");
while($overdue_row = $db->fetch($overdue)){
	$recruit_update = check_recruit($overdue_row['id'], $now);
	if(!is_numeric($recruit_update)){
		$db->query("DELETE FROM `events` WHERE `event_type`='recruit' AND `event_id`='".$overdue_row['id']."'");
	}else{
		$db->query("UPDATE `events` SET `event_time`='".$recruit_update."',`cid`='0' WHERE `event_type`='recruit' AND `event_id`='".$overdue_row['id']."'");
	}
}
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