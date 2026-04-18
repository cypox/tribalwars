<?php
include("include.inc.php");
include("include/config.php");

$qq1 = $db->query("SELECT * FROM villages WHERE id = '".$_GET['villid']."'");
$f1 = $db->fetch($qq1);

if($f1['bonus'] == 1)
	{ 
	 echo "<b>50% more storage capacity and merchants</b>";
	}
	elseif($f1['bonus'] == 2)
	{
	 echo "<b>10% more population</b>";
	}
	elseif($f1['bonus'] == 3)
	{
	 echo "<b>33% faster production in the Stable</b>";
	}
	elseif($f1['bonus'] == 4)
	{
	 echo "<b>33% faster production in the Barracks</b>";
	}
	elseif($f1['bonus'] == 5)
	{
	 echo "<b>50% faster production in the Workshop</b>";
	}
	elseif($f1['bonus'] == 6)
	{
	 echo "<b>30% increased raw material production</b>";
	}
?>