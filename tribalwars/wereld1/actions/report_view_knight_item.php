<?php 
$exp = explode(";",$report['message']);
$itemname = $exp[0];
$tpl->assign("knight_items", $knight_items);
$tpl->assign("itemname", $itemname);
?>
