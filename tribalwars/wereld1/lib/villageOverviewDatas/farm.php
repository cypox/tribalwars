<?php
$storage_datas['storage_size'] = $arr_maxstorage[$village['storage']];

if($viewType == "table"){
	if($village['r_bh'] >= $arr_farm[$village['farm']]){
		echo "<b>Fazenda lotada!</b>";
	}else{
		echo '<b>'.$village['r_bh'].'/'.$arr_farm[$village['farm']].'</b>';
	}
}else{
	if($village['r_bh'] >= $arr_farm[$village['farm']]){
		echo "Cheia!";
	}else{
		echo $village['r_bh'].'/'.$arr_farm[$village['farm']];
	}
}
?>