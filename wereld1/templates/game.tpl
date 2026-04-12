<?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>{$village.name} ({$village.x}|{$village.y}) K{$village.continent} - {$config.name}</title>
	<link rel="stylesheet" href="{$config.cdn}/css/game.css?{$now}" type="text/css" />
	<link rel="shortcut icon" href="{$config.cdn}/rabe.png" type="image/x-icon">
	<script type="text/javascript" src="{$config.cdn}/js/jquery.js?{$now}"></script>
	<script type="text/javascript" src="{$config.cdn}/js/jquery.form.js?{$now}"></script>
	<script type="text/javascript" src="{$config.cdn}/js/game.js?{$now}"></script>
	<script type="text/javascript" src="quests.js"></script>
	<script type="text/javascript">
		var vid = {$village.id};
		var act_vid = {$village.id};
		var act_points = {$user.points};
		var userid = {$user.id};
		var storage = {$max_storage};
	</script>
	
	<!--[if IE 6]><script type="text/javascript">document.execCommand("BackgroundImageCache",false,true);</script><![endif]-->
</head>
<body id="body">
<div id="top_bg"></div>
<div id="main">
	<table width="100%" id="menu_top">
		<tr>
			<td><div align="center"><a href="game.php?village={$village.id}&amp;screen=overview_villages" accesskey="s">{$lang->get("overview")}</a></div>
				<table width="135">
					<tr><td><a href="game.php?village={$village.id}&amp;screen=overview_villages&amp;mode=combined">&raquo; {$lang->get("combined")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=overview_villages&amp;mode=prod">&raquo; {$lang->get("production")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=overview_villages&amp;mode=units">&raquo; {$lang->get("troops")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=overview_villages&amp;mode=commands">&raquo; {$lang->get("commands")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=overview_villages&amp;mode=incomings">&raquo; {$lang->get("incomings")}</a></td></tr>
				</table>
			</td>
			<td><div align="center"><a href="game.php?village={$village.id}&amp;screen=report">{if $user.new_report==1}<img src="{$config.cdn}/graphic/icons/new_rep.png" title="Novo relatório" alt="" />{/if} {$lang->get("reports")}</a></div>
				<table cellspacing="0" width="150">
					<tr><td><a href="game.php?village={$village.id}&amp;screen=report&amp;mode=all">&raquo; {$lang->get("all")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=report&amp;mode=attack">&raquo; {$lang->get("attacks")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=report&amp;mode=defense">&raquo; {$lang->get("defjes")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=report&amp;mode=support">&raquo; {$lang->get("os")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=report&amp;mode=trade">&raquo; {$lang->get("market")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=report&amp;mode=other">&raquo; {$lang->get("else")}</a></td></tr>
				</table>
			</td>
			<td><div align="center"><a href="game.php?village={$village.id}&amp;screen=mail">{if $user.new_mail==1}<img src="{$config.cdn}/graphic/icons/new_mail.png" title="Nova mensagem" alt="" />{/if} {$lang->get("messages")}</a></div>
				<table cellspacing="0" width="180">
					<tr><td><a href="game.php?village={$village.id}&amp;screen=mail&amp;mode=in">&raquo; {$lang->get("newmessage")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=mail&amp;mode=out">&raquo; {$lang->get("sendmessage")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=mail&amp;mode=arch">&raquo; {$lang->get("archive")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=mail&amp;mode=new">&raquo; {$lang->get("writemessage")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=mail&amp;mode=block">&raquo; {$lang->get("blockmessager")}</a></td></tr>
				</table>
			</td>
			<td><div align="center"><a href="game.php?village={$village.id}&amp;screen=ranking">{$lang->get("ranking")}</a> <b>({$user.rang}.|{$user.points|format_number} P)</b></div>
				<table cellspacing="0" width="255">
					<tr><td><a href="game.php?village={$village.id}&amp;screen=ranking&amp;mode=ally">&raquo; {$lang->get("alliances")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=ranking&amp;mode=player">&raquo; {$lang->get("players")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=ranking&amp;mode=kill_player">&raquo; {$lang->get("odaplayer")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=ranking&amp;mode=kill_ally">&raquo; {$lang->get("odatribe")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=ranking&amp;mode=medal">&raquo; {$lang->get("prestaties")}</a></td></tr>
				</table>
			</td>
			<td><div align="center"><a href="game.php?village={$village.id}&amp;screen=ally">{$lang->get("alliance")}</a></div>
				{if $user.ally!=-1}
					<table cellspacing="0" width="150">
						<tr><td><a href="game.php?village={$village.id}&amp;screen=ally&amp;mode=overview">&raquo; {$lang->get("tribeOverview")}</a></td></tr>
						<tr><td><a href="game.php?village={$village.id}&amp;screen=ally&amp;mode=profile">&raquo; {$lang->get("profile")}</a></td></tr>
						<tr><td><a href="game.php?village={$village.id}&amp;screen=ally&amp;mode=members">&raquo; {$lang->get("members")}</a></td></tr>
						<tr><td><a href="game.php?village={$village.id}&screen=ally&mode=contracts">&raquo; {$lang->get("diplomacy")}</a></td></tr>
						{if $user.ally_invite==1}<tr><td><a href="game.php?village={$village.id}&amp;screen=ally&amp;mode=invite">&raquo; {$lang->get("tribeInvites")}</a></td></tr>{/if}
						{if $user.ally_lead == 1}<tr><td><a href="game.php?village={$village.id}&screen=ally&mode=intro_igm">&raquo; {$lang->get("tribeWelcome")}</a></td></tr>{/if}
						{if $user.ally_diplomacy==1}<tr><td><a href="game.php?village={$village.id}&amp;screen=ally&amp;mode=properties">&raquo; {$lang->get("tribeoptions")}</a></td></tr>{/if}
						<tr><td><a href="game.php?village={$village.id}&amp;screen=ally&amp;mode=forum">&raquo; {$lang->get("tribeForum")}</a></td></tr>
					</table>
				{/if}
			</td>
			<td><div align="center"><a href="game.php?village={$village.id}&amp;screen=settings">{$lang->get("configure")}</a></div>
				<table cellspacing="0" width="145">
					<tr><td><a href="game.php?village={$village.id}&amp;screen=settings&amp;mode=profile">&raquo; {$lang->get("profile")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=settings&amp;mode=settings">&raquo; {$lang->get("myaccount")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=settings&amp;mode=change_passwd">&raquo; {$lang->get("changepass")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=settings&amp;mode=vacation">&raquo; {$lang->get("vacation")}</a></td></tr>
					<tr><td><a href="game.php?village={$village.id}&amp;screen=settings&amp;mode=logins">&raquo; {$lang->get("loggedin")}</a></td></tr>
				</table>
			</td>
			<td><div align="center"><a href="game.php?village={$village.id}&amp;screen=memo">{$lang->get("notes")}</a></div></td>
			<td><div align="center"><a href="game.php?village={$village.id}&amp;screen=&amp;action=logout&amp;h={$hkey}" target="_top">{$lang->get("logout")}</a></div></td>
		</tr>
	</table>
	<table class="antet" style="width:{$user.window_width}px;">
		<tr>
			<td class="stanga"></td>
			<td class="header" width="90%" style="background: transparent url('{$config.cdn}/logo3.png') no-repeat bottom right;">
				<table width="100%" style="border-spacing: 0px;">
					<tr>
						<th width="50%" valign="bottom" align="left" style="padding: 0px;">
							<table class="header_login" style="padding:2px;" width="30%">
								<tr>
									<td align="center"><font color="black"><b>Rank: {$user.rang}º ({$user.points|format_number} P)</b></font></td>
									{if $user.villages>1}
                                                                              <td>
											{if !empty($village_array.last)}
										<a class="village_switch_link" href="{$village_array.last_link}" accesskey="a"><span class="arrowLeft"> </span></a>
											{else}
										<span class="arrowLeftGrey"> </span>
											{/if}
											{if !empty($village_array.next)}
										<a class="village_switch_link" href="{$village_array.next_link}" accesskey="d"><span class="arrowRight"> </span></a>
											{else}
										<span class="arrowRightGrey"> </span>
											{/if}
                                                                               </td>
									{/if}
								</tr>
							</table>
						</th>
					</tr>
				</table>
			</td>
			<td class="dreapta"></td>
		</tr>
	</table>
	<table class="principal" id="round" cellspacing="0">
		<tr>
			<th class="sus_s" style="text-align:center;" width="10%"><a href="game.php?village={$village.id}&screen=map">{$lang->get("kaart")}</a></th>
			<th class="sus_d">
				<span style="float:left;"><a href="game.php?village={$village.id}&screen=overview">{$village.name} ({$village.x}|{$village.y}) K{$village.continent}</a></span>
				<span id="slim" style="float: right;">
					<img src="{$config.cdn}/graphic/holz.png" class="info_res"><span id="wood" title="{$wood_per_hour}" {if $village.r_wood==$max_storage}class="warn"{/if}>{$village.r_wood}</span>
					<img src="{$config.cdn}/graphic/lehm.png" class="info_res"><span id="stone" title="{$stone_per_hour}" {if $village.r_stone==$max_storage}class="warn"{/if}>{$village.r_stone}</span>
					<img src="{$config.cdn}/graphic/eisen.png" class="info_res"><span id="iron" title="{$iron_per_hour}" {if $village.r_iron==$max_storage}class="warn"{/if}>{$village.r_iron}</span> 
					<img src="{$config.cdn}/graphic/res.png" class="info_res"><b><span id="storage">{$max_storage}</span></b> | 
					<img src="{$config.cdn}/graphic/face.png" class="info_res"><b><span id="actual_farm">{$village.r_bh}</span>/{$max_bh}</b>
				</span>
			</th>
		</tr>
		<tr>
		{if $user.attacks > 0}
			<td align="center" class="att" id="new_att" {if $user.attacks <= 0}style="display: none;"{/if} onclick="document.location='game.php?village={$village.id}&screen=overview_villages&mode=incomings';" title="Recebendo {$user.attacks} ataque(s)">
				{$user.attacks}
			</td>
		{/if}
			<td align="center" {if $user.attacks <= 0}colspan="2"{else}colspan="1"{/if}>
				<a href="game.php?village={$village.id}&screen=main">{$lang->get("main")}</a> | 
				<a href="game.php?village={$village.id}&screen=train">{$lang->get("kazerne")}</a> | 
				<a href="game.php?village={$village.id}&screen=snob">{$lang->get("adelshoeve")}</a> | 
				<a href="game.php?village={$village.id}&screen=place">{$lang->get("verzamelplaats")}</a> | 
				<a href="game.php?village={$village.id}&screen=smith">{$lang->get("smederij")}</a> | 
				<a href="game.php?village={$village.id}&screen=market">{$lang->get("markt")}</a>
			</td>
		</tr>
		<tr>
			<td colspan="2" {if $screen!='main'}colspan=""{/if}>
			{if $config.no_actions}
				<b style="color:red;">{$lang->get("attentie")}:</b> {$lang->get("blockedactions")}As ações no jogo (Ex: construções, pesquisas, recrutamento, etc.) estão temporariamente bloqueadas!
			{else}
				{if in_array($screen,$allow_screens)}
					{include file="game_$screen.tpl"}
				{/if}
			{/if}
			</td>
		</tr>
		<tr>
			<th style="text-align:center;">{$lang->get("geladenin")} <strong>{$load_msec}</strong>ms</th>
			<th>
				<span style="float:right;">
					<span id="slim">{$lang->get("servertijd")}: <strong><span id="serverTime">{$servertime}</span> | {$serverdate}</strong></span>
				</span>
			</th>
		</tr>
	</table>
	<table class="antet" style="height:35px;">
		<tr>
			<td class="stanga"></td>
			<td width="90%">
				{if $user.protection >= $now}
				<div class="noob">{$lang->get("beginnersbescherming")} <b>{$user.protection|format_date}</b> | {$lang->get("tot")}: <b><span class="timer">{$user.protection-$now|format_time}</span></b></div>
				{/if}
			</td>
			<td class="dreapta"></td>
		</tr>
	</table>
	<table class="principal" style="margin-bottom: 30px;">
		<tr><th style="text-align:center;">&copy;2012 | {$config.name} - {$lang->get("rights")}</th></tr>
	</table>
	<div id="footer">
		<div id="linkContainer">
			<div id="footer_left">
				<a href="http://{$config.forum}" target="_blank">{$lang->get("forum")}</a> - 
				<a href="help.php">{$lang->get("help")}</a> - 
				<a href="game.php?village={$village.id}&amp;screen=settings&amp;mode=profile">{$lang->get("profile")}</a>
			</div>
			<div id="footer_right">
				<a href="game.php?village={$village.id}&amp;screen=friends">{$lang->get("vrienden")}</a>
			</div>
		</div>
	</div>
</div>

</div>
<script type="text/javascript">startTimer();</script>

</body>
</html>