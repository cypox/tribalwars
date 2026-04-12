<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

if(isset($_GET['action']) && $_GET['action'] == "new_offer"){
	$error = "";
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}
    $sell = (int)@$_POST['sell'];
	if(empty($error) && $sell < 10){
		$error = "Desculpe, más você deve oferecer ao menos 10 unidades de recursos!";
	}
	$multi = (int)@$_POST['multi'];
    if(empty($error) && $multi < 1){
		$error = "Desculpe, más o número de ofertas não pode ser inferior a 1!";
	}
	$dealers = ceil($sell/1000)*$multi;
	if(empty($error) && $inside_dealers < $dealers){
		$error = "Desculpe, más você não tem mercadores suficientes para fazer está oferta!";
	}
	$valid_res = array("wood","stone","iron");
	if(empty($error) && !isset($_POST['res_sell']) || !in_array($_POST['res_sell'], $valid_res)){
		$error = "Desculpe, más você deve selecionar o recurso que irá oferecer!";
	}
	if(empty($error) && ($sell*$multi) > $village['r_'.$_POST['res_sell']]){
		$error = "Desculpe, más você não pode suprir está oferta!";
	}
	$buy = (int)@$_POST['buy'];
	if(@($sell/$buy) < 0.5 || @($buy/$sell) < 0.5){
		$error = "Desculpe, más aproporção da oferta e busca deve ser no minimo de 0.5!";
	}
	if(empty($error) && !isset($_POST['res_buy']) || !in_array($_POST['res_buy'], $valid_res)){
		$error = "Desculpe, más você deve selecionar o recurso que irá buscar!";
	}
	if(empty($error) && $_POST['res_buy'] == $_POST['res_sell']){
		$error = "Desculpe, más você não pode oferecer e buscar pelo mesmo recurso!";
	}
	if(empty($error)){
		$c = new do_action($user['id']);
        $c->close();
		$ratio_max = round($buy/$sell, 2);
		$db->query("INSERT INTO `offers` (`sell`,`buy`,`sell_ress`,`buy_ress`,`multi`,`from_village`,`time`,`ratio_max`,`userid`,`x`,`y`) VALUES ('".parse($sell)."','".parse($buy)."','".parse($_POST['res_sell'])."','".parse($_POST['res_buy'])."','".parse($multi)."','".$village['id']."','".time()."','".$ratio_max."','".$user['id']."','".$village['x']."','".$village['y']."')");
		$id = $db->getlastid();
		for($i=1; $i<=$multi; ++$i){
			$db->query("INSERT INTO `offers_multi` (`id`) VALUES ('".$id."')");
		}
		$db->query("UPDATE `villages` SET `dealers_outside`=`dealers_outside`+'".$dealers."',`r_".$_POST['res_sell']."`=`r_".$_POST['res_sell']."`-'".$sell."' WHERE `id`='".$village['id']."'");
		$c->open();
		header( "Location: game.php?village=".$village['id']."&screen=market&mode=own_offer" );
	}
}
if (isset($_GET['action']) && $_GET['action'] == "modify_offers"){
	$error = "";

	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}
	if(empty($error)){
		if(isset($_POST['delete'])){
			foreach($_POST as $id => $value){
				if(substr($id, 0, 3)=="id_"){
					$id = parse(array_pop(explode("id_", $id)));
					$result = $db->query("SELECT `sell`,`buy`,`sell_ress`,`buy_ress`,`multi`,`from_village` FROM `offers` WHERE `id`='".$id."'");
					$row = $db->fetch($result);
					if($row['from_village'] != $village['id']){
     					$error = "Desculpe, más houve um erro ao apagar a oferta!";
					}else{
						$db->query("UPDATE `offers` SET `do_action`='del' WHERE `id`='".$id."' AND `do_action`=''");
						if($db->affectedrows() == 1){
							$db->query("DELETE FROM `offers_multi` WHERE `id`='".$id."'");
							$offers_back = $db->affectedrows();
							$db->query("DELETE FROM `offers` WHERE `id`='".$id."'");
							$dealers = ceil($row['sell']/1000)*$offers_back;
							$ress_back = $row['sell']*$offers_back;
							$db->query("UPDATE `villages` SET `dealers_outside`=`dealers_outside`-'".$dealers."',`r_".$row['sell_ress']."`=`r_".$row['sell_ress']."`+'".$ress_back."' WHERE `id`='".$village['id']."'");
							if(empty($error)){
								header("Location: game.php?village=".$village['id']."&screen=market&mode=own_offer");
							}
						}
					}
				}
			}	
		}
		if(isset($_POST['increase'])) {
			$c = new do_action($user['id']);
			$c->close();
			$mod_count = (int)@$_POST['mod_count'];
			$err = false;
			if($mod_count < 1){
				$err = true;
			}
			if(!$err){
				foreach($_POST as $id => $value){
					if(substr($id, 0, 3) == "id_"){
						$id = parse(array_pop(explode("id_", $id)));
						$result = $db->query("SELECT `sell`,`buy`,`sell_ress`,`buy_ress`,`multi`,`from_village` FROM `offers` WHERE `id`='".$id."'");
						$row = $db->fetch($result);
						if($row['from_village'] != $village['id']){
	     					$error = "Desculpe, más houve um erro ao incrementar a oferta!";
						}else{
							$dealers = ceil($row['sell']/1000)*$mod_count;
							if($dealers > $inside_dealers){
								$error = "Desculpe, más você não tem mercadores suficientes para fazer está oferta!";
							}
							$ress = $row['sell']*$mod_count;
							if($village['r_'.$row['sell_ress']] < $ress){
								$error = "Desculpe, más você não pode suprir está oferta!";
							}
							if(empty($error)){
								$db->query("UPDATE `offers` SET `multi`=`multi`+'".$mod_count."',`do_action`='update' WHERE `id`='".$id."' AND `do_action`=''");
								if($db->affectedRows() == 1){
									for($i=1;$i<=$mod_count;$i++){
										$db->query("INSERT INTO `offers_multi` (`id`) VALUES ('".$id."')");	
									}
									$db->query("UPDATE `villages` SET `dealers_outside`=`dealers_outside`+'".$dealers."',`r_".$row['sell_ress']."`=`r_".$row['sell_ress']."`-'".$ress."' WHERE `id`='".$village['id']."'");
									$db->query("UPDATE `offers` SET `do_action`='' WHERE `id`='".$id."'");
								}
							}
							if(empty($error)){
								$c->open();
								header("Location: game.php?village=".$village['id']."&screen=market&mode=own_offer");
							}
						}
					}
				}
			}
			$c->open();
		}
		if(isset($_POST['decrease'])){
			$mod_count = (int)@$_POST['mod_count'];
			$err = false;
			if($mod_count < 1){
				$err = true;
			}
			if(!$err){
				foreach($_POST as $id => $value){
					if(substr($id, 0, 3) == "id_"){
						$id = parse(array_pop(explode("id_", $id)));
						$result = $db->query("SELECT `sell`,`buy`,`sell_ress`,`buy_ress`,`multi`,`from_village` FROM `offers` WHERE `id`='".$id."'");
						$row = $db->fetch($result);
						if($row['from_village'] != $village['id']){
	     					$error = "Desculpe, más houve um erro ao redurzir a oferta!";
						}else{
							if(empty($error)){
								$db->query("DELETE FROM `offers_multi` WHERE `id`='".$id."' LIMIT ".$mod_count."");
								$offers_delete = $db->affectedrows();
								$dealers = ceil($row['sell']/1000)*$offers_delete;
								$ress = $row['sell']*$dealers;
								$db->query("UPDATE `offers` SET `multi`=`multi`-'".$offers_delete."',`do_action`='update' WHERE `id`='".$id."' AND `do_action`=''");
								if($db->affectedrows() == 1){
									$db->query("UPDATE `villages` SET `dealers_outside`=`dealers_outside`-'".$dealers."',`r_".$row['sell_ress']."`=`r_".$row['sell_ress']."`+'".$ress."' WHERE `id`='".$village['id']."'");
									if($db->numrows($db->query("SELECT `id` FROM `offers_multi` WHERE `id`='".$id."'")) == 0){
										$db->query("DELETE FROM `offers` WHERE `id`='".$id."'");
									}else{
										$db->query("UPDATE `offers` SET `do_action`='' WHERE `id`='".$id."'");
									}
								}
							}
							if(empty($error)){
								header("Location: game.php?village=".$village['id']."&screen=market&mode=own_offer");
							}
						}
					}
				}
			}		
		}
	}
}
$offers = array();
$result = $db->query("SELECT `id`,`sell`,`buy`,`sell_ress`,`buy_ress`,`multi`,`time` FROM `offers` WHERE `from_village`='".$village['id']."'");
while($row = $db->fetch($result)){
	$offers[$row['id']]['sell'] = $row['sell'];
	$offers[$row['id']]['buy'] = $row['buy'];
	$offers[$row['id']]['sell_ress'] = $row['sell_ress'];
	$offers[$row['id']]['buy_ress'] = $row['buy_ress'];
	$offers[$row['id']]['multi'] = $row['multi'];
	$offers[$row['id']]['time'] = format_date($row['time']);
}

$tpl->assign("offers", $offers);
$tpl->assign("error", @$error);
?>