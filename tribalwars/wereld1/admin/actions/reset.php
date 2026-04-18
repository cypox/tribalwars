<?php
if(isset($_GET['action']) && $_GET['action'] == "reset"){
	$db->query("TRUNCATE TABLE `villages`");
    if(isset($_GET['do']) && $_GET['do'] == "soft"){
		$db->query("UPDATE `users` SET `map_reload`='',`villages`='0',`ally`='-1',`points`='0',`attacks`='0',`ennobled_by`='',`rang`='0',`new_report`='0',`new_mail`='0',`vacation_id`='-1',`vacation_name`='',`birthday`='',`killed_units_altogether`='0',`killed_units_def`='0',`killed_units_att`='0',`do_action`='',`image`=''");
	}else{
		$db->query("TRUNCATE TABLE `users`");
	}
	if(abs($config['map_incircle']) > 1){
		$circle = $config['map_incircle'];
	}else{
		$circle = 1;
	}
	$db->query("UPDATE `create_village` SET `nw_c`='".$circle."',`so_c`='".$circle."',`sw_c`='".$circle."',`no_c`='".$circle."',`no_alpha`='0',`nw_alpha`='0',`sw_alpha`='0',`so_alpha`='0',`no`='0',`sw`='0',`so`='0',`nw`='0',`next_left`='".abs($config['count_create_left'])."'");
	$db->query("UPDATE `create_village_barb` SET `nw_c`='".$circle."',`so_c`='".$circle."',`sw_c`='".$circle."',`no_c`='".$circle."',`no_alpha`='0',`nw_alpha`='0',`sw_alpha`='0',`so_alpha`='0',`no`='0',`sw`='0',`so`='0',`nw`='0',`next_left`='".abs($config['count_create_left'])."'");
	$db->query("TRUNCATE TABLE `offers`");
	$db->query("TRUNCATE TABLE `offers_multi`");
	$db->query("TRUNCATE TABLE `ally`");
	$db->query("TRUNCATE TABLE `events`");
	$db->query("TRUNCATE TABLE `build`");
	$db->query("TRUNCATE TABLE `recruit`");
	$db->query("TRUNCATE TABLE `sessions");
	$db->query("TRUNCATE TABLE `unit_place`");
	$db->query("TRUNCATE TABLE `movements`");
	$db->query("TRUNCATE TABLE `reports`");
	$db->query("TRUNCATE TABLE `research`");
	$db->query("TRUNCATE TABLE `dealers`");
	$db->query("TRUNCATE TABLE `logs`");
	$db->query("TRUNCATE TABLE `mail_in`");
	$db->query("TRUNCATE TABLE `mail_out`");
	$db->query("TRUNCATE TABLE `mail_archiv`");
	$db->query("TRUNCATE TABLE `mail_block`");
	$db->query("TRUNCATE TABLE `ally_contracts`");
	$db->query("TRUNCATE TABLE `ally_invites`");
	$db->query("TRUNCATE TABLE `ally_events`");
	$db->query("TRUNCATE TABLE `run_events`");
	$db->query("UPDATE `login` SET `start`='".date("d.m.Y H:i")."'");
	$db->query("TRUNCATE TABLE `logins`");
	$_GET['screen'] = "reset_done";
}
?>