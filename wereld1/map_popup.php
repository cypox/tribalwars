<?php
	include('include.inc.php');
	$timp = time();

	// Get vars
	$v = $_GET['v'];
	$u = $_GET['u'];
	$ox = $_GET['ox'];
	$oy = $_GET['oy'];

	// Get info about villages
	$query_villages = "SELECT * FROM `villages` WHERE `id` = '$v'";
	$villages = $db->fetch($db->query($query_villages));

	// Get info about users
	$query_users = "SELECT * FROM `users` WHERE `id` = '$villages[userid]'";
	$users = $db->fetch($db->query($query_users));

	// Get info about tribes
	$query_ally = "SELECT * FROM `ally` WHERE `id` = '$users[ally]'";
	$ally = $db->fetch($db->query($query_ally));

	// Get info about troops
	$query_place = "SELECT * FROM `unit_place` WHERE `villages_to_id` = '$v'";
	$place = $db->fetch($db->query($query_place));

	//Get info about user settings
	/*$query_settings = "SELECT * FROM `map_info` WHERE `userid` = '$u'";
	$settings = mysql_fetch_array(mysql_query($query_settings));*/

	//Get info about villages notes
	/*$query_notes = "SELECT * FROM `villages_notes` WHERE `userid` = '$u' AND `village` = '$v'";
	$notes = mysql_fetch_array(mysql_query($query_notes));*/

	// Define variables
	$villages['name'] = urldecode($villages['name']);
	$users['name'] = urldecode($users['name']);
	$ally['name'] = urldecode($ally['short']);
	$villages['points'] = format_number($villages['points']);
	$users['points'] = format_number($users['points']);
	$ally['points'] = format_number($ally['points']);

	// Define output
	$info_title = "$villages[name] ($villages[x]|$villages[y]) K$villages[continent]";
	$info_points = $villages['points'];
	$username = urldecode($users['username']);
	$info_owner = "$username ($users[points] Pts.)";
	$info_tribe = "$ally[name] ($ally[points] Pts.)";
	$info_noob = date("d.m.Y H:i", $users['noob_protection']);

	// Calculate farm info
	$farmt = $arr_farm[$villages['farm']];
	$farm_info = "$villages[r_bh]/$farmt";

	// Calculate dealers info
	$dealerst = $arr_dealers[$villages['market']];
	$dealers = $dealerst - $village['dealers_outside'];
	$dealers = "$dealers/$dealerst";

	// Units Info
	$unit = array("unit_spear","unit_sword","unit_axe","unit_spy","unit_light","unit_heavy","unit_ram","unit_catapult","unit_snob");
	$unit2 = array("all_unit_spear","all_unit_sword","all_unit_axe","all_unit_spy","all_unit_light","all_unit_heavy","all_unit_ram","all_unit_catapult","all_unit_snob");
	$units = array("3000","4000","3000","800","1200","1500","4500","4500","6200");

	function minutes($sec, $padHours = false){
    	$hms = "";
	    $hours = intval(intval($sec) / 3600); 
    	$hms .= ($padHours) 
	          ? str_pad($hours, 2, "0", STR_PAD_LEFT). ':'
    	      : $hours. ':';
	    $minutes = intval(($sec / 60) % 60); 
    	$hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ':';
	    $seconds = intval($sec % 60); 
    	$hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);
	    return $hms;
	}
?>
<table class="vis" style="background-color: #F0E6C8; border:1px solid rgb(128, 64, 0);" width="100%">
	<tr><?php if($villages['bonus'] > 0){ ?>
		<td rowspan="8">
<?php 
	if($villages['bonus'] == 1){
		echo "<img src='".$config['cdn']."/graphic/bonus/storage.png'>";
	}elseif($villages['bonus'] == 2){
		echo "<img src='".$config['cdn']."/graphic/bonus/farm.png'>";
	}elseif($villages['bonus'] == 3){
		echo "<img src='".$config['cdn']."/graphic/bonus/stable.png'>";
	}elseif($villages['bonus'] == 4){
		echo "<img src='".$config['cdn']."/graphic/bonus/barracks.png'>";
	}elseif($villages['bonus'] == 5){
		echo "<img src=".$config['cdn']."/'graphic/bonus/garage.png'>";
	}elseif($villages['bonus'] == 6){
		echo "<img src='".$config['cdn']."/graphic/bonus/all.png'>";
	}
	?></td>
<?php } ?>
    	<th colspan="2"><?php echo $info_title;?></th>
    </tr>
<?php if($users['noob_protection'] >= $timp){ ?>
    <tr><td colspan="2"><div class="error">Jogador sob prote&ccedil;&atilde;o de iniciantes! Fim da Prote&ccedil;&atilde;o: <?php echo $info_noob; ?></div></td></tr>
<?php } ?>
<?php if($villages['bonus'] > 0){ ?>
		<tr><td colspan="2" align="center">
<?php 
	if($villages['bonus'] == 1){
		echo "<b>50% mais capacidade de armazenamento e comerciantes</b>";
	}elseif($villages['bonus'] == 2){
		echo "<b>10% mais população</b>";
	}elseif($villages['bonus'] == 3){
		echo "<b>33% produção mais rápida no estábulo</b>";
	}elseif($villages['bonus'] == 4){
		echo "<b>33% produção mais rápida no quartel</b>";
	}elseif($villages['bonus'] == 5){
		echo "<b>50% produção mais rápida na oficina</b>";
	}elseif($villages['bonus'] == 6){
		echo "<b>30% aumento da produção de matérias-primas</b>";
	}
?>
	 </td></tr>
<?php } ?>
    <tr>
        <td width="30%">Pontos:</td><td><?php echo $info_points;?></td>     
    </tr>
    <?php if($villages['userid'] == -1){ ?>
    <tr>
        <td colspan="2" align="center">Aldeia abandonada</td>     
    </tr>
    <?php }else{ ?>
    <tr>
        <td width="30%">Proprietário:</td><td><?php echo $info_owner;?></td>     
    </tr>
    <?php } if($users['ally'] != -1 && $villages['userid'] != -1){ ?>
    <tr>
        <td width="30%">Tribo:</td><td><?php echo $info_tribe;?></td>     
    </tr>
    <?php } if($u == $villages['userid']){ ?>
    <tr>
    	<td colspan="2" align="center">
    		<img src="<?php echo $config['cdn']; ?>/graphic/icons/wood.png"/><?php echo round($villages[r_wood]);?>
    		<img src="<?php echo $config['cdn']; ?>/graphic/icons/stone.png"/><?php echo round($villages[r_stone]);?>
    		<img src="<?php echo $config['cdn']; ?>/graphic/icons/iron.png"/><?php echo round($villages[r_iron]);?>
    		<img src="<?php echo $config['cdn']; ?>/graphic/icons/storage.png"/><?php echo round($villages[storage]);?>

        </td>
    </tr>
    <?php } if($u == $villages['userid'] || $u == $villages['userid']){ ?>
    <tr>
    	<td colspan="2" align="center">
        	<img src="<?php echo $config['cdn']; ?>/graphic/icons/farm.png"/> <?php echo $farm_info;?>
            <img src="<?php echo $config['cdn']; ?>/graphic/buildings/market.png"/> <?php echo $dealers;?>
        </td>
    <tr>
    <?php } ?>
        <td colspan="2" style="background-color: #F7EED3;" align="center">
        	<table class="vis" style="margin:5px; background-color: #F0E6C8;" width="98%">
            	<tr>
                <?php for($i=0;$i<=8;$i++){?>
					<td align="center" <?php if($i%2==0){echo "style='background-color: #ded3b9;'";}?>>
                    	<img src="<?php echo $config['cdn']; ?>/graphic/unit/<?php echo $unit[$i];?>.png"/>
                    </td>
                <?php } ?>
                </tr>
                <?php if($u == $villages['userid']){ ?>
                <tr>
                <?php for($i=0;$i<=8;$i++){?>
                	<td align="center" <?php if($i%2==0){echo "style='background-color: #ded3b9;'";}?>>
                    	<font size="-6"><?php echo $place[$unit[$i]];?></font>
                        <br />
                        <font color="#999999" size="-7">(<?php echo $villages[$unit2[$i]];?>)</font>	
                  	</td>
               	<?php } ?>
               	</tr>
                <?php } if(($ox != $villages[x] || $oy != $villages[y])){ ?>
                <tr>
                <?php for($i=0;$i<=8;$i++){?>
                	<td align="center" <?php if($i%2==0){echo "style=\"background-color: #ded3b9;\"";}?>><font style="font-size:8px;">
                		<?php 
                		
        					


                		// Berekening op af laten vuren lol.. Looptijden kloppen totaal niet :(
                		$troepenlopen = unit_running($ox,$oy,$villages[x],$villages[y],$units[$i]);
                	    print minutes($troepenlopen);
                	    // Berekening op af laten vuren lol.. Looptijden kloppen totaal niet :(
                	    ?>



                	    </font>
                  	</td>
               	<?php } ?>	
                </tr>
                <?php } ?>
            </table>
        </td>
    </tr>
</table>