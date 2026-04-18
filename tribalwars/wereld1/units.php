<?php

require("include/configs/units.php");

			$units = $cl_units->get_array("dbname");
			foreach($units as $key=>$value){
				$unit = $db->fetch($db->query("SELECT SUM(`all_".$value."`) AS `".$value."` FROM `zapping_worlds_m1`.`villages`"));
				$unitsAll[$value] = $unit[$value];
				$unitsPerPlayer[$value] = @round($unit[$value]/$players, 2);
				$unitsPerVillage[$value] = @round($unit[$value]/$villages, 2);	
			}

?>