<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Statistics - Tribal Wars</title>
<link rel="stylesheet" type="text/css" href="stamm.css" />
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
</head>

<body id="ds_body" >
<table class="main" width="100%" align="center"><tr><td>
<table ><tr><td valign="top">



</td><td>

<h2>World 1 Statistics</h2>

<h3><a href="guest.php" target="_top">&raquo; Guest access</a></h3><br />

<table class="vis" width="100%">
<tr><th>Number of players:</th><th>{$players}</th></tr>
<tr><td>Total villages:</td><td>{$villages} ({$vpp} per player)</td></tr>

</table><br />

<table class="vis" width="100%">
<tr><th>The following values were calculated</th><th>today at {$time}</th></tr>
<tr><td>Messages sent:</td><td>{$mail} ({$mpp} per player)</td></tr>

<tr><td>Total points:</td><td>{$points} ({$ppp} per player, {$ppv} per village)</td></tr>

<tr><td>Total resources:</td><td><img src="/graphic/holz.png" title="Wood" alt="" />{$wood} <img src="/graphic/lehm.png" title="Clay" alt="" />{$stone} <img src="/graphic/eisen.png" title="Iron" alt="" />{$iron} </td></tr>

<tr><td>Total population:</td><td><img src="/graphic/face.png" title="Farm space" alt="" /> {$bh}</td></tr>

<tr><td>Total troops:</td><td>
<table><tr>
<th width="45"><img src="/graphic/unit/unit_spear.png" title="Spearman" alt="" /></th><th width="45"><img src="/graphic/unit/unit_sword.png" title="Swordsman" alt="" /></th><th width="45"><img src="/graphic/unit/unit_axe.png" title="Axeman" alt="" /></th><th width="45"><img src="/graphic/unit/unit_spy.png" title="Scout" alt="" /></th><th width="45"><img src="/graphic/unit/unit_light.png" title="Light Cavalry" alt="" /></th><th width="45"><img src="/graphic/unit/unit_heavy.png" title="Heavy Cavalry" alt="" /></th><th width="45"><img src="/graphic/unit/unit_ram.png" title="Ram" alt="" /></th><th width="45"><img src="/graphic/unit/unit_catapult.png" title="Catapult"> </th><th width="45"><img src="/graphic/unit/unit_snob.png" title="Nobleman" alt="" /></th>
</tr><tr>

{foreach from=$unitsAll item=unitsAll}
{if $unitsAll == 0}
<td class="hidden">{$unitsAll}</td>
{else}
<td>{$unitsAll}</td>
{/if}
{/foreach}
</tr></table>
</td></tr>

<tr><td>Average troops per player:</td><td>
<table><tr>
<th width="45"><img src="/graphic/unit/unit_spear.png" title="Spearman" alt="" /></th><th width="45"><img src="/graphic/unit/unit_sword.png" title="Swordsman" alt="" /></th><th width="45"><img src="/graphic/unit/unit_axe.png" title="Axeman" alt="" /></th><th width="45"><img src="/graphic/unit/unit_spy.png" title="Scout" alt="" /></th><th width="45"><img src="/graphic/unit/unit_light.png" title="Light Cavalry" alt="" /></th><th width="45"><img src="/graphic/unit/unit_heavy.png" title="Heavy Cavalry" alt="" /></th><th width="45"><img src="/graphic/unit/unit_ram.png" title="Ram" alt="" /></th><th width="45"><img src="/graphic/unit/unit_catapult.png" title="Catapult" alt="" /></th></th><th width="45"><img src="/graphic/unit/unit_snob.png" title="Nobleman" alt="" /></th>
</tr><tr>
{foreach from=$unitsPlayer item=unitsPlayer}
{if $unitsPlayer == 0}
<td class="hidden">{$unitsPlayer}</td>
{else}
<td>{$unitsPlayer}</td>
{/if}
{/foreach}

</tr></table>
</td></tr>

<tr><td>Average troops per village:</td><td>
<table><tr>
<th width="45"><img src="/graphic/unit/unit_spear.png" title="Spearman" alt="" /></th><th width="45"><img src="/graphic/unit/unit_sword.png" title="Swordsman" alt="" /></th><th width="45"><img src="/graphic/unit/unit_axe.png" title="Axeman" alt="" /></th><th width="45"><img src="/graphic/unit/unit_spy.png" title="Scout" alt="" /></th><th width="45"><img src="/graphic/unit/unit_light.png" title="Light Cavalry" alt="" /></th><th width="45"><img src="/graphic/unit/unit_heavy.png" title="Heavy Cavalry" alt="" /></th><th width="45"><img src="/graphic/unit/unit_ram.png" title="Ram" alt="" /></th><th width="45"><img src="/graphic/unit/unit_catapult.png" title="Catapult" alt="" /></th><th width="45"><img src="/graphic/unit/unit_snob.png" title="Nobleman" alt="" /></th>
</tr><tr>
{foreach from=$unitsVillage item=unitsVillage}
{if $unitsVillage == 0}
<td class="hidden">{$unitsVillage}</td>
{else}
<td>{$unitsVillage}</td>
{/if}
{/foreach}
</tr></table>
</td></tr>

</table>

</td></tr></table>

</td></tr></table>
</body>
</html>