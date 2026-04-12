<?php
include("./include.inc.php");

reload_all_village_points();
reload_all_player_points();
reload_all_ally_points();
reload_ally_rangs();
reload_player_rangs();
reload_kill_player();
reload_kill_ally();
$cl_awards->reload_rank();
?>