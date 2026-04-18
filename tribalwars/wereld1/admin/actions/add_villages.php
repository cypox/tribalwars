<?php
$lipe1 = 'Bonusdorp';
$lipe2 = urlencode($lipe1);
$lipe3 = 'Barbarendorp';
$lipe4 = urlencode($lipe3);
if($_GET['action'] == "add_bonus")
	{
	 $anzahl = intval(mysqli_real_escape_string($db->get_connection(), $_POST['anzahl']));
	 $bonus = $_POST['bonus'];
	 
	 if($anzahl <= 1000 && $anzahl > 1)
		{
		for($i = 1; $i <= $anzahl; $i++)
			{
			$q1 = create_village(-1, ".$lipe2.", "random");
			}
		$all = $db->query("SELECT * FROM villages");
		$all_e = $db->numrows($all);
		
		$lim1 = $all_e - $anzahl;
		
		$qu1 = $db->query("SELECT * FROM villages ORDER BY id LIMIT $lim1, $all_e");
		
		while($er1 = $db->fetch($qu1))
			{
			 if($bonus == 0)
				{
				 $rand = rand(1, 6);
				$u1 = $db->query("UPDATE villages SET bonus = '".$rand."' WHERE id = '".$er1['id']."'");
				$u2 = $db->query("UPDATE villages SET name = '".$lipe2."' WHERE id = '".$er1['id']."'");
				}
				else
				{
				 $u1 = $db->query("UPDATE villages SET bonus = '".$bonus."' WHERE id = '".$er1['id']."'");
				 $u2 = $db->query("UPDATE villages SET name = '".$lipe2."' WHERE id = '".$er1['id']."'");
				}
			}
		 if($u1 && $u2)
			{
			 $error = "<td colspan='3'><font color='green'><b>Bonusdorpen werden met succes toegevoegd!</b></font></td>";
			}
		}
		else
		{
		 $error = "<td colspan='3'><font color='red'><b>Je kan maximaal 1000 dorpen in 1 keer toevoegen!</b></font></td>";
		}
	}
	$sate1 = $db->numrows($db->query("SELECT * FROM villages WHERE bonus = '1'"));
$sate2 = $db->numrows($db->query("SELECT * FROM villages WHERE bonus = '2'"));
$sate3 = $db->numrows($db->query("SELECT * FROM villages WHERE bonus = '3'"));
$sate4 = $db->numrows($db->query("SELECT * FROM villages WHERE bonus = '4'"));
$sate5 = $db->numrows($db->query("SELECT * FROM villages WHERE bonus = '5'"));
$sate6 = $db->numrows($db->query("SELECT * FROM villages WHERE bonus = '6'"));
$total = $sate1+$sate2+$sate3+$sate4+$sate5+$sate6;

$tpl->assign("villages", $villages);
$tpl->assign("error", $error);
$tpl->assign("sate1", $sate1);
$tpl->assign("sate2", $sate2);
$tpl->assign("sate3", $sate3);
$tpl->assign("sate4", $sate4);
$tpl->assign("sate5", $sate5);
$tpl->assign("sate6", $sate6);
$tpl->assign("total", $total);
?>
<?php

if($_GET['action'] == "add_villages")
	{
	 $numar = intval(mysqli_real_escape_string($db->get_connection(), $_POST['numar']));
	 $buton = $_POST['buton'];
	 if($buton){
	 if($numar <= 1000 && $numar > 1)
		{
		for($i = 1; $i <= $numar; $i++)
			{
			$q1 = create_village(-1, ".$lipe4.", "0");
			}
			 $err = "<td colspan='3'><font color='green'><b>Bonusdorpen werden met succes toegevoegd!/b></font></td>";
			
		}
		else
		{
		 $err = "<td colspan='3'><font color='red'><b>Je kan maximaal 1000 dorpen in 1 keer toevoegen!</b></font></td>";
		}
	}
	}
	$sate = $db->numrows($db->query("SELECT * FROM villages WHERE userid = '-1'"));
$tpl->assign("err", $err);
$tpl->assign("sate", $sate);
?>
