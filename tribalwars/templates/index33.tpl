<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>{$config.name} - {$lang->get("title")}</title>
	<link rel="stylesheet" href="{$config.cdn}/css/index.css" type="text/css" />
	<script type="text/javascript" src="{$config.cdn}/js/jquery.js"></script>
	<script type="text/javascript" src="{$config.cdn}/js/jquery.ui.js"></script>
	<script type="text/javascript" src="{$config.cdn}/js/jquery.form.js"></script>
	<script type="text/javascript" src="{$config.cdn}/js/jquery.onenter.js"></script>
	<script type="text/javascript" src="{$config.cdn}/js/index.js"></script>
</head>
<body id="body">
	<div id="top_bg"></div>
	<div id="main">
		<table width="100%" height="32" id="menu_top">
			<tr>
				<td><div align="center"><a href="?screen=home">{$lang->get("menuHome")}</a></div></td>
				<td><div align="center"><a href="?screen=rules">{$lang->get("menuRules")}</a></div></td>
				<td><div align="center"><a href="?screen=team">{$lang->get("menuTeam")}</a></div></td>
				<td><div align="center"><a href="{$config.support}" target="_blank">{$lang->get("menuSupport")}</a></div></td>
				<td><div align="center"><a href="stats.php">{$lang->get("menuStatistics")}</a></div></td>
				<td><div align="center"><a href="{$config.forum}" target="_blank" target="_blank">{$lang->get("menuForum")}</a></div></td>
			</tr>
		</table>
		<table class="antet">
			<tr>
				<td class="stanga"></td>
				<td class="header" width="90%" style="background: transparent url('{$config.cdn}/Imperalis.png') no-repeat 20% bottom;">
					<table width="100%" style="border-spacing:0px;">
						<tr>
							<td width="50%" valign="middle" align="center"></td>
							<td width="50%" valign="bottom" align="right" style="padding: 0px;">
								<table class="header_login" style="padding: 2px;" width="60%">
								{if $logged_in}
									<tr><td colspan="2"><h3>{$lang->get("welcome")} {$user.username|entparse}!</h3></td></tr>
									<tr>
										<td width="50%"><a onclick="setVisibility('words', 'inline');"><div id="world" class="button">{$lang->get("login")}</div></a></td>
										<form action="process.php" id="logout" method="POST">
											<input type="hidden" name="action" value="logout">
											<td><input type="button" id="do_logout" onclick="TWLan.logout();" class="button red" value="Uitloggen" style="width:115px" /></td>
										</form>
									</tr>
								{else}
									<form action="process.php" id="login" method="POST">
										<input type="hidden" name="action" value="login">
										<tr>
											<td>{$lang->get("username")}:</td>
											<td align="right"><input type="text" size="15" id="username" name="username" autocomplete="off" onenter="TWLan.login();" /></td>
										</tr>
										<tr>
											<td>{$lang->get("password")}:</td>
											<td align="right"><input type="password" size="15" id="password" name="password" autocomplete="off" onenter="TWLan.login();" /></td>
										</tr>
										<tr>
<td><a href="javascript:void(0);" onclick="$('#lost').fadeIn(200);" style="font-size:10px;">{$lang->get("forgotpassword")}</a></td>
<td colspan="2" align="right"><input type="button" id="do_login" onclick="TWLan.login();" class="button green" value="{$lang->get('login')}" /></td>
</tr>
									</form>
								{/if}
								</table>
							</td>
						</tr>
					</table>
				</td>
				<td class="dreapta"></td>
			</tr>
		</table>
		<div class="words-list" id="words">
			<table width="100%" align="center">
            	<form action="" method="post">
				<tr>
				{foreach from=$worlds item=world}
				<td align="left"><input type="button" value="{$world.name}" class="button{$world.class}" onclick="TWLan.selectw('{$world.db}');" style="width:105px;" /></td>
				{/foreach}
				</tr>
				</form>
                <tr><td align="right"><div style="float:none;"><a href="javascript:void(0);" onclick="setVisibility('words', 'inline');" >{$lang->get("close")}</a></div></td></tr>
            </table>
		</div>
		<table class="principal" id="round">
			<tr>
				<th class="sus_s">&raquo; {if $logged_in}{$lang->get("userinfo")}{else}{$lang->get("registernow")}{/if}</th>
				<th style="text-align: right;"><img src="{$config.cdn}/NL.png" title="Nederlands" /></th>
			</tr>
			<tr>
				<td width="27%">
					<table class="vis" cellspacing="1" width="100%" align="center">
					{if $logged_in}
                    	<tr><td>{$lang->get("premiumpoints")}:</td><td align="right">{$user.premium_points|format_number}</td></tr>
                        <tr><td>{$lang->get("email")}:</td><td align="right">{$user.email}</td></tr>
                        <tr><td>{$lang->get("ipaddress")}:</td><td align="right">{$ip}</td></tr>
						<tr><td>{$lang->get("titlename")}:</td><td align="right">{$title}</td></tr>
					    <tr><td>{$lang->get("rank")}:</td><td align="right">{$rank}</td></tr>
					    <tr><td>{$lang->get("victorys")}:</td><td align="right">{$user.wins|format_number}</td></tr>
						<tr><th colspan="2" style="text-align:center;">{$lang->get("registeredsince")} {$user.join_date|format_date}</th></tr>
					{else}
						<form action="process.php" id="register" method="post">
							<input type="hidden" name="action" value="register">
							<tr>
								<td>{$lang->get("username")}:</td>
								<td><input type="text" size="15" id="reg_username" name="username" autocomplete="off" maxlength="15" onenter="TWLan.register();"></td>
							</tr>
							<tr>
								<td>{$lang->get("password")}:</td>
								<td><input type="password" size="15" id="reg_password" name="password" autocomplete="off" maxlength="30" onenter="TWLan.register();"></td>
							</tr>
							<tr>
								<td>{$lang->get("email")}:</td>
								<td><input type="text" size="15" id="reg_email" name="email" autocomplete="off" maxlength="30" onenter="TWLan.register();"></td>
							</tr>
						<tr>
							<td>{$lang->get("securitycode")}:</td>
							<td>
								<input type="text" size="7" id="reg_captcha" name="captcha" autocomplete="off" maxlength="30" onenter="TWLan.register();">
								<img src="verifyimage.php" title="Security Code" style="position:absolute" />
							</td>
						</tr>
							<tr><td colspan="2" align="right"><button type="submit" class="button green" id="do_reg" onclick="TWLan.register();">{$lang->get("register")}</button></td></tr>
						</form>
					{/if}
					</table>
				</td>
				<td>
					{if in_array($screen,$allow_screens)}{include file="index_$screen.tpl"}{else}{include file="index_home.tpl"}{/if}
					<table id="lost" class="lost" style="display:none;">
					<tr>
						<td align="center" style="padding:0px;">
							<table class="vis" style="padding:0px;float:center;" width="397">
								<tr>
									<th style="line-height:16px;">
										<b>{$lang->get("forgotpassword")}:</b>
										<span style="float: right;"><input type="button" onclick="$('#lost').hide('slow');" class="button red" value="X" /></span>
									</th>
								</tr>	
							</table>
						</td>
					</tr>
					<tr>
						<td align="center" style="padding:0px;">
								<h5>Dombo :)!</h5>
						</td>
					</tr>
				</table>
		
			</td>
			</tr>
		<tr>
			<th style="text-align:center;">
				<span id="slim">{$lang->get('loadingtime')}: <strong>{$load_msec}</strong>ms</span>
			</th>
			<th style="text-align:center;">
				{$config.version}
				<span style="float:right;">
					<span id="slim">{$lang->get('servertime')}: <strong><span id="serverTime">{$servertime}</span></strong> | <strong>{$serverdate}</strong></span>
				</span>
			</th>
		</tr>
	</table>
	<table class="antet" style="height:35px; width:{$user.window_width}px;">
		<tr>
			<td class="stanga"></td>
			<td width="90%"></td>
			<td class="dreapta"></td>
		</tr>
	</table>
	<table class="principal" style="width:{$user.window_width}px; min-width:{$user.window_width}px; margin-bottom: 30px;">
	<tr>
            <th style="text-align:center;">&copy;{php}echo date("Y");{/php} | {$config.name} - {$lang->get("rightsreserved")}</th>
        </tr>
	</table>
	</div>
   <script type="text/javascript">startTimer();</script>
</body>
</html>