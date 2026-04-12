<?php
$cl_techs = new techs();
$cl_techs->set_smithfactor("0.997","0.9096");

$cl_techs->add_tech("Lança","spear");
$cl_techs->set_group("Infantaria");
$cl_techs->set_woodprice("256","1.6");
$cl_techs->set_stoneprice("244","1.6");
$cl_techs->set_ironprice("296","1.6");
$cl_techs->set_time("2900","1.75");
$cl_techs->set_maxStage("1");
$cl_techs->set_needed(array());
$cl_techs->set_attType(array('def','off','spy'));
$cl_techs->set_description("");

$cl_techs->add_tech("Espada","sword");
$cl_techs->set_group("Infantaria");
$cl_techs->set_woodprice("360","1.6");
$cl_techs->set_stoneprice("320","1.6");
$cl_techs->set_ironprice("312","1.6");
$cl_techs->set_time("3085","1.75");
$cl_techs->set_maxStage("1");
$cl_techs->set_needed(array("smith"=>"1"));
$cl_techs->set_attType(array('def','off','spy'));
$cl_techs->set_description("");

$cl_techs->add_tech("Machado","axe");
$cl_techs->set_group("Infantaria");
$cl_techs->set_woodprice("280","1.6");
$cl_techs->set_stoneprice("336","1.6");
$cl_techs->set_ironprice("228","1.6");
$cl_techs->set_time("3085","1.75");
$cl_techs->set_maxStage("1");
$cl_techs->set_needed(array("smith"=>"2"));
$cl_techs->set_attType(array('off'));
$cl_techs->set_description("");

if($config['archers']){
	$cl_techs->add_tech("Arco","archer");
	$cl_techs->set_group("Infantaria");
	$cl_techs->set_woodprice("640","1.6");
	$cl_techs->set_stoneprice("560","1.6");
	$cl_techs->set_ironprice("740","1.6");
	$cl_techs->set_time("1760","1.75");
	$cl_techs->set_maxStage("1");
	$cl_techs->set_needed(array("barracks"=>"5","smith"=>"5"));
	$cl_techs->set_attType(array('def'));
	$cl_techs->set_description("");
}

$cl_techs->add_tech("Explorador","spy");
$cl_techs->set_group("Cavalaria");
$cl_techs->set_woodprice("500","1.6");
$cl_techs->set_stoneprice("400","1.6");
$cl_techs->set_ironprice("400","1.6");
$cl_techs->set_time("2520","1.75");
$cl_techs->set_maxStage("1");
$cl_techs->set_needed(array("stable"=>"1"));
$cl_techs->set_attType(array('spy'));
$cl_techs->set_description("");

$cl_techs->add_tech("Cavalaria leve","light");
$cl_techs->set_group("Cavalaria");
$cl_techs->set_woodprice("440","1.6");
$cl_techs->set_stoneprice("496","1.6");
$cl_techs->set_ironprice("416","1.6");
$cl_techs->set_time("5040","1.75");
$cl_techs->set_maxStage("1");
$cl_techs->set_needed(array("stable"=>"3"));
$cl_techs->set_attType(array('off'));
$cl_techs->set_description("");

if($config['archers']){
	$cl_techs->add_tech("Arqueiro a cavalo","marcher");
	$cl_techs->set_group("Cavalaria");
	$cl_techs->set_woodprice("3000","1.6");
	$cl_techs->set_stoneprice("2400","1.6");
	$cl_techs->set_ironprice("2000","1.6");
	$cl_techs->set_time("3085","1.75");
	$cl_techs->set_maxStage("3");
	$cl_techs->set_needed(array("stable"=>"5" ));
	$cl_techs->set_description("");
}

$cl_techs->add_tech("Cavalaria Pesada","heavy");
$cl_techs->set_group("Cavalaria");
$cl_techs->set_woodprice("600","1.6");
$cl_techs->set_stoneprice("496","1.6");
$cl_techs->set_ironprice("416","1.6");
$cl_techs->set_time("5040","1.75");
$cl_techs->set_maxStage("1");
$cl_techs->set_needed(array("stable"=>"10","smith"=>"15"));
$cl_techs->set_attType(array('def','off','spy'));
$cl_techs->set_description("");

$cl_techs->add_tech("Ariete","ram");
$cl_techs->set_group("Máquinas de guerra");
$cl_techs->set_woodprice("560","1.6");
$cl_techs->set_stoneprice("800","1.6");
$cl_techs->set_ironprice("192","1.6");
$cl_techs->set_time("4480","1.75");
$cl_techs->set_maxStage("1");
$cl_techs->set_needed(array("garage"=>"1"));
$cl_techs->set_attType(array('off'));
$cl_techs->set_description("");

$cl_techs->add_tech("Catapulta","catapult");
$cl_techs->set_group("Máquinas de guerra");
$cl_techs->set_woodprice("640","1.6");
$cl_techs->set_stoneprice("960","1.6");
$cl_techs->set_ironprice("560","1.6");
$cl_techs->set_time("5600","1.75");
$cl_techs->set_maxStage("1");
$cl_techs->set_needed(array("garage"=>"2","smith"=>"12"));
$cl_techs->set_attType(array('def','off'));
$cl_techs->set_description("");
?>