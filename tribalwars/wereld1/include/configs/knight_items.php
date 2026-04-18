<?php
$knight_items = new knight_items();

if($config['statue_style'] == 2)
{
	$knight_items->addItem("spear", "Halberd of Guan Yu", "unit_spear", 1.3, 1.2, 1);
	$knight_items->addItem("sword", "Paracelsus' Longsword", "unit_sword", 1.3, 1.2, 1);
	$knight_items->addItem("axe", "Thorgard's battle axe", "unit_axe", 1.3, 1.2, 1);
	if($config['archers']) {
	    $knight_items->addItem("archer", "Nimrod's long-bow", "unit_archer", 1.3, 1.2, 1);
	}
	$knight_items->addItem("spy", "Kalid's telescope", "unit_spy", 1, 1, 1);
	$knight_items->addItem("light", "Mieszkos lance", "unit_light", 1.3, 1.2, 1);
	$knight_items->addItem("heavy", "Baptiste's Banner", "unit_heavy", 1.3, 1.2, 1);
	if($config['archers']){
		$knight_items->addItem("marcher", "Nimrod's composite bow", "unit_marcher", 1.3, 1.2, 1);
	}
	$knight_items->addItem("ram", "Carol's morning star", "unit_ram", 1, 1, 2);
	$knight_items->addItem("catapult", "Aletheia's Bonfire", "unit_catapult", 1, 1, 2);
	$knight_items->addItem("snob", "Vasco's Scepter", "unit_snob", 1, 1, 30);
}

if($config['statue_style'] == 3)
{
	$knight_items->addItem("spear", "Halberd of Guan Yu", "unit_spear", 1.3, 1.2, 1);
	$knight_items->addItem("sword", "Paracelsus' Longsword", "unit_sword", 1.4, 1.3, 1);
	$knight_items->addItem("axe", "Thorgard's battle axe", "unit_axe", 1.4, 1.3, 1);
	if($config['archers']){
		$knight_items->addItem("archer", "Nimrod's long-bow", "unit_archer", 1.3, 1.2, 1);
	}
	$knight_items->addItem("spy", "Kalid's telescope", "unit_spy", 1, 1, 1);
	$knight_items->addItem("light", "Mieszko's lance", "unit_light", 1.3, 1.2, 1);
	$knight_items->addItem("heavy", "Baptiste's Banner", "unit_heavy", 1.3, 1.2, 1);
	if($config['archers']){
		$knight_items->addItem("marcher", "Nimrod's composite bow", "unit_marcher", 1.3, 1.2, 1);
		}
	$knight_items->addItem("ram", "Carol's morning star", "unit_ram", 2, 1, 2);
	$knight_items->addItem("catapult", "Paracelsus' Longsword", "unit_catapult", 1, 10, 2);
	$knight_items->addItem("snob", "Thorgard's battle axe", "unit_snob", 1, 1, 30);
}

$knight_items->setPoly("spear", "125,47,104,114,114,409,127,409,129,217,159,77");
$knight_items->setPoly("sword", "370,204,384,223,486,230,485,238,386,236,366,251,333,228");
$knight_items->setPoly("axe", "132,256,190,258,191,316,170,316,169,409,154,408,154,314,132,314");
if($config['archers']){
	$knight_items->setPoly("archer", "195,160,221,189,239,251,238,321,226,371,196,402");
}
$knight_items->setPoly("spy", "335,268,409,262,408,270,345,290");
$knight_items->setPoly("light", "252,48,244,191,254,316,264,313,265,105");
$knight_items->setPoly("heavy", "101,18,78,79,76,352,89,419,101,355");
if($config['archers']){
	$knight_items->setPoly("marcher", "533,222,514,383,487,351,485,336,498,303,492,265,501,247");
}
$knight_items->setPoly("ram", "362,153,449,156,452,224,429,224,432,172,360,169");
$knight_items->setPoly("catapult", "55,0,23,106,41,167,80,42");
$knight_items->setPoly("snob", "441,273,396,281,403,291,484,304,484,290");
?>