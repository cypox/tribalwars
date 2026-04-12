
<?php
if ($conf['admin_key'] == 'actions_massiv_keyaaassd') {
$id = $_GET['graczID'];

$gracz = $db->query("SELECT * FROM gracze WHERE id = $id");
$gracz = $db->fetch($gracz);

	if ($_GET['akcja'] == 'notka' and isset($_POST)) {
    $notka = $_POST['notka'];
	$db->query("UPDATE `gracze` SET `notka` = '".$notka."' WHERE `id` = '".$gracz['id']."'");
	}

$tpl->assign('gracz',$gracz);
}
?>


