<?php 
// Here i will program some quests :)... just some simple quests..!

require_once("./include.inc.php");
$sid = new sid();
$session = $sid->check_sid($_COOKIE['session']);
if(!$session['userid']){
	header ("Location: sid_wrong.php");
	exit;
}


if(isset($_POST['houthakker'])){
	 $houthakker = array();
	 $db->query("UPDATE `quests` SET `hout30`='1' WHERE `userid`='".$session['userid']."'");
	 $db->query("UPDATE `villages` SET `r_wood`=`r_wood`+'20000', `r_stone`=`r_stone`+'20000', `r_iron`=`r_iron`+'20000' WHERE `id`='".$_POST['villid']."'");
	 echo json_encode('houthakker');
}

if(isset($_POST['leemgroeve'])){
	 $leemgroeve = array();
	 $db->query("UPDATE `quests` SET `leem30`='1' WHERE `userid`='".$session['userid']."'");
	 $db->query("UPDATE `villages` SET `r_wood`=`r_wood`+'20000', `r_stone`=`r_stone`+'20000', `r_iron`=`r_iron`+'20000' WHERE `id`='".$_POST['villid']."'");
	 echo json_encode('leemgroeve');
}

if(isset($_POST['ijzermijn'])){
	 $ijzermijn = array();
	 $db->query("UPDATE `quests` SET `ijzer30`='1' WHERE `userid`='".$session['userid']."'");
	 $db->query("UPDATE `villages` SET `r_wood`=`r_wood`+'20000', `r_stone`=`r_stone`+'20000', `r_iron`=`r_iron`+'20000' WHERE `id`='".$_POST['villid']."'");
	 echo json_encode('ijzermijn');
}
?>