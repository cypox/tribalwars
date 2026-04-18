<?php
include("include.inc.php");
include("include/config.php");

$qq1 = $db->query("SELECT * FROM villages WHERE id = '".$_GET['villid']."'");
$f1 = $db->fetch($qq1);

if($f1['bonus'] == 1)
	{ 
	 echo "<img src='graphic/big_buildings/storage.png'>";
	}
	elseif($f1['bonus'] == 2)
	{
	 echo "<img src='graphic/big_buildings/farm.png'>";
	}
	elseif($f1['bonus'] == 3)
	{
	 echo "<img src='graphic/big_buildings/stable.png'>";
	}
	elseif($f1['bonus'] == 4)
	{
	 echo "<img src='graphic/big_buildings/barracks.png'>";
	}
	elseif($f1['bonus'] == 5)
	{
	 echo "<img src='graphic/big_buildings/garage.png'>";
	}
	elseif($f1['bonus'] == 6)
	{
	 echo "<img src='graphic/big_buildings/market.png'>";
	}
?>