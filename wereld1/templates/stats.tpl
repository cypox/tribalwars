<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Statistik - Die St&auml;mme</title>
<link rel="stylesheet" type="text/css" href="stamm.css" />
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
</head>

<body id="ds_body" >
<table class="main" width="100%" align="center"><tr><td>
<table ><tr><td valign="top">



</td><td>

<h2>Statistik Welt 1</h2>

<h3><a href="guest.php" target="_top">&raquo; Gastzugang</a></h3><br />

<table class="vis" width="100%">
<tr><th>Spieleranzahl:</th><th>{$players}</th></tr>
<tr><td>Dörfer insgesamt:</td><td>{$villages} ({$vpp} pro Spieler)</td></tr>

</table><br />

<table class="vis" width="100%">
<tr><th>Folgende Werte wurden berechnet</th><th>heute um {$time} Uhr</th></tr>
<tr><td>Nachrichten verschickt:</td><td>{$mail} ({$mpp} pro Spieler)</td></tr>

<tr><td>Punkte insgesamt:</td><td>{$points} ({$ppp} pro Spieler, {$ppv} pro Dorf)</td></tr>

<tr><td>Rohstoffe insgesamt:</td><td><img src="/graphic/holz.png" title="Holz" alt="" />{$wood} <img src="/graphic/lehm.png" title="Lehm" alt="" />{$stone} <img src="/graphic/eisen.png" title="Eisen" alt="" />{$iron} </td></tr>

<tr><td>Bevölkerung insgesamt:</td><td><img src="/graphic/face.png" title="Arbeiter" alt="" /> {$bh}</td></tr>

<tr><td>Truppen insgesamt:</td><td>
<table><tr>
<th width="45"><img src="/graphic/unit/unit_spear.png" title="Speerträger" alt="" /></th><th width="45"><img src="/graphic/unit/unit_sword.png" title="Schwertkämpfer" alt="" /></th><th width="45"><img src="/graphic/unit/unit_axe.png" title="Axtkämpfer" alt="" /></th><th width="45"><img src="/graphic/unit/unit_spy.png" title="Späher" alt="" /></th><th width="45"><img src="/graphic/unit/unit_light.png" title="Leichte Kavallerie" alt="" /></th><th width="45"><img src="/graphic/unit/unit_heavy.png" title="Schwere Kavallerie" alt="" /></th><th width="45"><img src="/graphic/unit/unit_ram.png" title="Rammbock" alt="" /></th><th width="45"><img src="/graphic/unit/unit_catapult.png" title="Katapult"> </th><th width="45"><img src="/graphic/unit/unit_snob.png" title="Adelsgeschlecht" alt="" /></th>
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

<tr><td>Truppenschnitt pro Spieler:</td><td>
<table><tr>
<th width="45"><img src="/graphic/unit/unit_spear.png" title="Speerträger" alt="" /></th><th width="45"><img src="/graphic/unit/unit_sword.png" title="Schwertkämpfer" alt="" /></th><th width="45"><img src="/graphic/unit/unit_axe.png" title="Axtkämpfer" alt="" /></th><th width="45"><img src="/graphic/unit/unit_spy.png" title="Späher" alt="" /></th><th width="45"><img src="/graphic/unit/unit_light.png" title="Leichte Kavallerie" alt="" /></th><th width="45"><img src="/graphic/unit/unit_heavy.png" title="Schwere Kavallerie" alt="" /></th><th width="45"><img src="/graphic/unit/unit_ram.png" title="Rammbock" alt="" /></th><th width="45"><img src="/graphic/unit/unit_catapult.png" title="Katapult" alt="" /></th></th><th width="45"><img src="/graphic/unit/unit_snob.png" title="Adelsgeschlecht" alt="" /></th>
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

<tr><td>Truppenschnitt pro Dorf:</td><td>
<table><tr>
<th width="45"><img src="/graphic/unit/unit_spear.png" title="Speerträger" alt="" /></th><th width="45"><img src="/graphic/unit/unit_sword.png" title="Schwertkämpfer" alt="" /></th><th width="45"><img src="/graphic/unit/unit_axe.png" title="Axtkämpfer" alt="" /></th><th width="45"><img src="/graphic/unit/unit_spy.png" title="Späher" alt="" /></th><th width="45"><img src="/graphic/unit/unit_light.png" title="Leichte Kavallerie" alt="" /></th><th width="45"><img src="/graphic/unit/unit_heavy.png" title="Schwere Kavallerie" alt="" /></th><th width="45"><img src="/graphic/unit/unit_ram.png" title="Rammbock" alt="" /></th><th width="45"><img src="/graphic/unit/unit_catapult.png" title="Katapult" alt="" /></th><th width="45"><img src="/graphic/unit/unit_snob.png" title="Adelsgeschlecht" alt="" /></th>
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