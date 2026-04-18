<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{$village.name} ({$village.x}|{$village.y}) - Die Tribes</title>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<link rel="stylesheet" type="text/css" href="stamm.css" />
<script src="script.js?1159978916" type="text/javascript"></script>
<script src="menu.js?1148466057" type="text/javascript"></script>
</head>
<body style="margin-top:6px;">

{if $intro}
      <script src="http://add.gfx-dose.de/layer.js/dslan-intern" type="text/javascript"></script>
{/if}

{if $user.dyn_menu==1}
	<table class="menu nowrap" align="center" width="{$user.window_width}">
	<tr id="menu_row">
	<td><a href="game.php?village={$village.id}&amp;screen=&amp;action=logout&amp;h={$hkey}" target="_top">Logout</a></td>
	<td><a href="http://dslan.gfx-dose.de" target="_blank">DSLAN Forum</a></td>
	<td><a href="help.php" target="_blank">Help</a></td>
	<td><a href="game.php?village={$village.id}&amp;screen=settings">Settings</a><br /><table cellspacing="0" width="120"><tr><td><a href="game.php?village={$village.id}&amp;screen=settings&amp;mode=profile">Profile</a></td></tr><tr><td><a href="game.php?village={$village.id}&amp;screen=settings&amp;mode=settings">Settings</a></td></tr><tr><td><a href="game.php?village={$village.id}&amp;screen=settings&amp;mode=move">Start over</a></td></tr><tr><td><a href="game.php?village={$village.id}&screen=settings&mode=quickbar">Edit quickbar</a></td></tr><tr><td><a href="game.php?village={$village.id}&amp;screen=settings&amp;mode=vacation">Vacation mode</a></td></tr><tr><td><a href="game.php?village={$village.id}&amp;screen=settings&amp;mode=logins">Logins</a></td></tr><tr><td><a href="game.php?village={$village.id}&amp;screen=settings&amp;mode=change_passwd">Change password</a></td></tr></table></td>
	<td><a href="game.php?village={$village.id}&amp;screen=ranking">Ranking</a> ({$user.rang}.|{$user.points|format_number} P) <br /><table cellspacing="0" width="120"><tr><td><a href="game.php?village={$village.id}&amp;screen=ranking&amp;mode=ally">Tribes</a></td></tr><tr><td><a href="game.php?village={$village.id}&amp;screen=ranking&amp;mode=player">Players</a></td></tr><tr><td><a href="game.php?village={$village.id}&amp;screen=ranking&amp;mode=kill_player">Defeated opponents</a></td></tr></table>
	<td> <a href="game.php?village={$village.id}&amp;screen=ally">Tribe</a>{if $user.ally!=-1}<br /><table cellspacing="0" width="120"><tr><td><a href="game.php?village={$village.id}&amp;screen=ally&amp;mode=overview">Overview</a></td></tr><tr><td><a href="game.php?village={$village.id}&amp;screen=ally&amp;mode=profile">Profile</a></td></tr><tr><td><a href="game.php?village={$village.id}&amp;screen=ally&amp;mode=members">Members</a></td></tr>{if $user.ally_invite==1}<tr><td><a href="game.php?village={$village.id}&amp;screen=ally&amp;mode=invites">Invitations</a></td></tr>{/if}{if $user.ally_diplomacy==1}<tr><td><a href="game.php?village={$village.id}&amp;screen=ally&amp;mode=properties">Properties</a></td></tr>{/if}</table>{/if}</td>
	<td><a href="game.php?village={$village.id}&amp;screen=report">{if $user.new_report==1}<img src="graphic/new_report.png" title="New report" alt="" />{/if} Reports</a><br /><table cellspacing="0" width="120"><tr><td><a href="game.php?village={$village.id}&amp;screen=report&amp;mode=all">All reports</a></td></tr><tr><td><a href="game.php?village={$village.id}&amp;screen=report&amp;mode=attack">Attacks</a></td></tr><tr><td><a href="game.php?village={$village.id}&amp;screen=report&amp;mode=defense">Defenses</a></td></tr><tr><td><a href="game.php?village={$village.id}&amp;screen=report&amp;mode=support">Support</a></td></tr><tr><td><a href="game.php?village={$village.id}&amp;screen=report&amp;mode=trade">Trade</a></td></tr><tr><td><a href="game.php?village={$village.id}&amp;screen=report&amp;mode=other">Other</a></td></tr></table></td>
	<td><a href="game.php?village={$village.id}&amp;screen=mail">{if $user.new_mail==1}<img src="graphic/new_mail.png" title="New message" alt="" /> {/if} Messages</a><br /><table cellspacing="0" width="120"><tr><td><a href="game.php?village={$village.id}&amp;screen=mail&amp;mode=in">Inbox</a></td></tr><tr><td><a href="game.php?village={$village.id}&amp;screen=mail&amp;mode=out">Outbox</a></td></tr><tr><td><a href="game.php?village={$village.id}&amp;screen=mail&amp;mode=arch">Archive</a></td></tr><tr><td><a href="game.php?village={$village.id}&amp;screen=mail&amp;mode=new">Write message</a></td></tr><tr><td><a href="game.php?village={$village.id}&amp;screen=mail&amp;mode=block">Block sender</a></td></tr></table></td>
	<td><a href="game.php?village={$village.id}&amp;screen=memo">Notes</a></td></tr>
	</table>
	
	
	
	
	{if $user.show_toolbar==1}
	
	{php}require_once("quickbar.php");{/php}
		
	{/if}
	
	
	<hr width="{$user.window_width}" size="2" />
	
	<table align="center" width="{$user.window_width}" cellspacing="0" style="padding:0px;margin-bottom:4px">
	<tr>
	<td>
	
	
		<table class="menu nowrap" align="left">
		<tr id="menu_row2">
		<td><a href="game.php?village={$village.id}&amp;screen=overview_villages" accesskey="s">Overviews</a><br /><table cellspacing="0" width="120"><tr><td><a href="game.php?village={$village.id}&amp;screen=overview_villages&amp;mode=combined">Combined</a></td></tr><tr><td><a href="game.php?village={$village.id}&amp;screen=overview_villages&amp;mode=prod">Production</a></td></tr><tr><td><a href="game.php?village={$village.id}&amp;screen=overview_villages&amp;mode=units">Troops</a></td></tr><td><a href="game.php?village={$village.id}&amp;screen=overview_villages&amp;mode=commands">Commands</a></td></tr><td><a href="game.php?village={$village.id}&amp;screen=overview_villages&amp;mode=incomings">Incomings</a></td></tr></td></table>
		<td><a href="game.php?village={$village.id}&amp;screen=map">Map</a></td>
		<td class="no_hover">
		{if $user.villages>1}
			{if !empty($village_array.last)}
				<a href="{$village_array.last_link}" accesskey="a"><img src="graphic/links.png" alt="" /></a> 
			{else}
				<img src="graphic/links2.png" alt="" />
			{/if}
			{if !empty($village_array.next)}
				<a href="{$village_array.next_link}" accesskey="d"><img src="graphic/rechts.png" alt="" /></a> 
			{else}
				<img src="graphic/rechts2.png" alt="" />
			{/if}
		{/if}	
		</td>
		<td><a href="game.php?village={$village.id}&amp;screen=overview">{$village.name}</a> <b>({$village.x}|{$village.y}) K{$village.continent}</b></td>
			</tr>
		</table>
		
	</td>
	
	<td align="right"><table cellspacing="0"><tr>
	<td><table class="box" cellspacing="0"><tr>
	<td><a href="game.php?village={$village.id}&amp;screen=wood"><img src="graphic/holz.png" title="Wood" alt="" /></a></td>
	<td><span id="wood" title="{$wood_per_hour}" {if $village.r_wood==$max_storage}class="warn"{/if}>{$village.r_wood}</span>&nbsp;</td>
	<td><a href="game.php?village={$village.id}&amp;screen=stone"><img src="graphic/lehm.png" title="Clay" alt="" /></a></td>
	<td><span id="stone" title="{$stone_per_hour}" {if $village.r_stone==$max_storage}class="warn"{/if}>{$village.r_stone}</span>&nbsp;</td>
	<td><a href="game.php?village={$village.id}&amp;screen=iron"><img src="graphic/eisen.png" title="Iron" alt="" /></a></td>
	<td><span id="iron" title="{$iron_per_hour}" {if $village.r_iron==$max_storage}class="warn"{/if}>{$village.r_iron}</span></td>
	<td style="border-left: dotted 1px;">
	&nbsp;<a href="game.php?village={$village.id}&amp;screen=storage"><img src="graphic/res.png" title="Warehouse capacity" alt="" /></a>
	</td><td id="storage">{$max_storage} </td>
	</tr></table></td>
	
	<td><table class="box" cellspacing="0"><tr>
	<td width="18" height="20" align="center"><a href="game.php?village={$village.id}&amp;screen=farm"><img src="graphic/face.png" title="Farm space" alt="" /></a></td>
	<td align="center">{$village.r_bh}/{$max_bh}</td>
	</tr></table></td>

	{if $user.attacks!=0}
		<td><table class="box" cellspacing="0"><tr>
		<td width="60" height="20" align="center"><img src="graphic/unit/att.png" alt="" /> ({$user.attacks})</td>
		</tr></table></td>
	{/if}
	
	</tr></table></td>
	
	</tr></table>
	
	<!--[if IE ]>
	<script type="text/javascript">initMenuList("menu_row");</script>
	<script type="text/javascript">initMenuList("menu_row2");</script>
	<![endif]-->

{else}
	<table align="center">
	<tr><td>
	<a href="game.php?village={$village.id}&amp;screen=&amp;action=logout&amp;h={$hkey}" target="_top">Logout</a>
	- <a href="http://dslan.gfx-dose.de" target="_blank">DSLAN Forum</a>
	- <a href="help.php" target="_blank">Help</a>
	- <a href="game.php?village={$village.id}&amp;screen=settings">Settings</a>
	- <a href="game.php?village={$village.id}&amp;screen=ranking">Ranking</a> ({$user.rang}.|{$user.points|format_number} P) 
	-  <a href="game.php?village={$village.id}&amp;screen=ally">Tribe</a> 
	- <a href="game.php?village={$village.id}&amp;screen=report">{if $user.new_report==1}<img src="graphic/new_report.png" title="New report" alt="" />{/if} Reports</a>
	- <a id="menu_mail" href="game.php?village={$village.id}&amp;screen=mail">{if $user.new_mail==1}<img src="graphic/new_mail.png" title="New message" alt="" /> {/if} Messages</a>
	- <a href="game.php?village={$village.id}&amp;screen=memo">Notes</a>
	</td></tr></table>
	
	
	
	
	{if $user.show_toolbar==1}
		<br />
		<table id="quickbar" class="menu nowrap" align="center">
		<tr>
			<td><a href="game.php?village={$village.id}&amp;screen=main" ><img src="graphic/buildings/main.png" alt="" />Headquarters</a></td>
			<td><a href="game.php?village={$village.id}&amp;screen=barracks" ><img src="graphic/buildings/barracks.png" alt="" />Barracks</a></td>
			<td><a href="game.php?village={$village.id}&amp;screen=stable" ><img src="graphic/buildings/stable.png" alt="" />Stable</a></td>
			<td><a href="game.php?village={$village.id}&amp;screen=garage" ><img src="graphic/buildings/garage.png" alt="" />Workshop</a></td>
			<td><a href="game.php?village={$village.id}&amp;screen=snob" ><img src="graphic/buildings/snob.png" alt="" />Academy</a></td>
			<td><a href="game.php?village={$village.id}&amp;screen=smith" ><img src="graphic/buildings/smith.png" alt="" />Smithy</a></td>
			<td><a href="game.php?village={$village.id}&amp;screen=place" ><img src="graphic/buildings/place.png" alt="" />Rally point</a></td>
			<td><a href="game.php?village={$village.id}&amp;screen=market" ><img src="graphic/buildings/market.png" alt="" />Market</a></td>
		</tr>
		</table>
	{/if}
	
	<hr width="{$user.window_width}" size="2" />
	
	<table align="center" width="{$user.window_width}" cellspacing="0" style="padding:0px;margin-bottom:4px">
	<tr>
	<td>
		{if $user.villages>1}
			{if !empty($village_array.last)}
				<a href="{$village_array.last_link}" accesskey="a"><img src="graphic/links.png" alt="" /></a> 
			{else}
				<img src="graphic/links2.png" alt="" />
			{/if}
			{if !empty($village_array.next)}
				<a href="{$village_array.next_link}" accesskey="d"><img src="graphic/rechts.png" alt="" /></a> 
			{else}
				<img src="graphic/rechts2.png" alt="" />
			{/if}
		{/if}
		<a href="game.php?village={$village.id}&amp;screen=overview_villages" accesskey="s">{$village.name}</a> <b>({$village.x}|{$village.y}) K{$village.continent}</b> - 
		<a href="game.php?village={$village.id}&amp;screen=map">Map</a> - 
		<a href="game.php?village={$village.id}&amp;screen=overview">Village overview</a>
		
	</td>
	
	<td align="right"><table cellspacing="0"><tr>
	<td><table class="box" cellspacing="0"><tr>
	<td><a href="game.php?village={$village.id}&amp;screen=wood"><img src="graphic/holz.png" title="Wood" alt="" /></a></td>
	<td><span id="wood" title="{$wood_per_hour}" {if $village.r_wood==$max_storage}class="warn"{/if}>{$village.r_wood}</span>&nbsp;</td>
	<td><a href="game.php?village={$village.id}&amp;screen=stone"><img src="graphic/lehm.png" title="Clay" alt="" /></a></td>
	<td><span id="stone" title="{$stone_per_hour}" {if $village.r_stone==$max_storage}class="warn"{/if}>{$village.r_stone}</span>&nbsp;</td>
	<td><a href="game.php?village={$village.id}&amp;screen=iron"><img src="graphic/eisen.png" title="Iron" alt="" /></a></td>
	<td><span id="iron" title="{$iron_per_hour}" {if $village.r_iron==$max_storage}class="warn"{/if}>{$village.r_iron}</span></td>
	<td style="border-left: dotted 1px;">
	&nbsp;<a href="game.php?village={$village.id}&amp;screen=storage"><img src="graphic/res.png" title="Warehouse capacity" alt="" /></a>
	</td><td id="storage">{$max_storage} </td>
	</tr></table></td>
	
	<td><table class="box" cellspacing="0"><tr>
	<td width="18" height="20" align="center"><a href="game.php?village={$village.id}&amp;screen=farm"><img src="graphic/face.png" title="Farm space" alt="" /></a></td>
	<td align="center">{$village.r_bh}/{$max_bh}</td>
	</tr></table></td>
	
	{if $user.attacks!=0}
		<td><table class="box" cellspacing="0"><tr>
		<td width="60" height="20" align="center"><img src="graphic/unit/att.png" alt="" /> ({$user.attacks})</td>
		</tr></table></td>
	{/if}
	
	</tr></table></td>
	
	</tr></table>
{/if}





{if $config.no_actions}
	<table class="main" width="{$user.window_width}" align="center">
	<tr>
	<td style="padding:2px;">
	<b>ACHTUNG:</b> Es wurde in der Spielekonfigurationsdatei eingestellt, dass keine Aktionen (Buildings bauen, Forschen, Rekrutieren,...) ausgef&uuml;hrt werden k�nnen! Tribes k�nnen trotzdem noch erstellt werden.
	</td>
	</tr>
	</table>
	<br />
{/if}

<table class="main" width="{$user.window_width}" align="center">
<tr>
<td style="padding:2px;">
{if in_array($screen,$allow_screens)}
	{include file="game_$screen.tpl"}
{/if}
<p align="right" style="font-size: 7pt; margin-top:0px; margin-bottom:0px">generiert in {$load_msec}ms
Serverzeit: <span id="serverTime">{$servertime}</span></p>
</td>
</tr>
</table>

<script type="text/javascript">startTimer();</script>
</body>
</html>