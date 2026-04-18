<?php
if($viewType == "table"){
	if($village['main_build'] != ''){
		list($building,$time) = explode(",", $village['main_build']);
		echo "<b>".format_date($time)."</b><br />(".$cl_builds->get_name($building).")";
	}
}else{
	$sql = $db->query("SELECT `end_time` FROM `build` WHERE `villageid`='".$village['id']."' ORDER BY `id` DESC");
	$row = $db->fetch($sql);
	$timer_data = (is_array($row) && isset($row['end_time'])) ? ($row['end_time']-time()) : 0;
	if($timer_data > 0){
		echo "<span class=\"timer\">".format_time($timer_data)."</span>";
	}
}
?>