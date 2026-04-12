<?php
if($viewType == "table"){
	echo "<b>Mercadores: ".(get_dealers($village['market'])-$village['dealers_outside'])."/".get_dealers($village['market'])."</b>";
}else{
	echo (get_dealers($village['market'])-$village['dealers_outside'])."/".get_dealers($village['market']);
}
?>