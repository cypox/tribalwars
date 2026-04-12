<?php
require_once("./include.inc.php");

if($_POST['user']){
	$sid = new sid();
	$session = $sid->check_sid($_COOKIE['session']);
	if(!$session['userid']){
		echo "Ação invalida!";
	}else{
		$valores = array("units","speedunits");
		$cl_map = new map();
		$values = array();
		$uptrue = true;
		foreach($_POST as $key=>$value){
			if($key != "user"){
				if(!in_array($key, $valores)){
					$uptrue = false;
				}
			}
		}
		if($uptrue){
			if($_POST["units"] == 'true'){	$values[] = 1;	}else{	$values[] = 0;	}
			if($_POST["speedunits"] == 'true'){	$values[] = 1;	}else{	$values[] = 0;	}
			$cl_map->up_extrainfos($values, $_POST['user']);
			echo "Seus dados foram salvos com sucesso!";
			$i = 0;

			echo "<script type=\"text/javascript\">";
			foreach($valores as $key){
				echo "var ".$key." = ".$values[$i].";";
				$i++;
			}
			echo "</script>";
		}else{
			echo "Ocorreu um erro inesperado!";
		}
	}
}else{
	$sid = new sid();
	$session = $sid->check_sid($_COOKIE['session']);
	if(!$session['userid']){
		echo "Ação invalida!";
	}else{
		if(isset($_GET['k']) && $_GET['k'] >= 0 && $_GET['k'] <= 99){
			require_once("lib/map_db/".$_GET['k'].".php");
		}
		$x_coords = $JSON->decode($_GET['x']);
		$y_coords = $JSON->decode($_GET['y']);
		$cords = array();

		foreach($y_coords as $y){
			foreach($x_coords as $x){
				if($coordenadas[$y][$x]['image']){
					$cords[$y][$x]['image'] = $coordenadas[$y][$x]['image'];
				}
			}
		}
		echo $JSON->encode($cords);
	}
}
?>