<script type="text/javascript">
//<![CDATA[
	$(document).ready(function(){ldelim}
		$('.inactive img').fadeTo(0, .5);
	{rdelim});
//]]>
</script>
<table width="100%">
	<tr>
    	<td>
			<img src="{$config.cdn}/graphic/big_buildings/main1.png" title="Hoofdgebouw" alt="" />
		</td>
		<td>
			<h2>{$lang->get("main")} ({$village.main|stage})</h2>
			{$description}
		</td>
	</tr>
</table><br />
{if $num_build_all > 0}
<table class="vis">
	<tr>
		<th width="250">Ordem{$lang->get("build")}</th>
		<th width="100">{$lang->get("during")}</th>
		<th width="150">{$lang->get("doneat")}</th>
		<th>{$lang->get("cancel")}</th>
	</tr>
	{foreach from=$do_build item=item key=id}
		{assign var="buildname" value=$do_build.$id.build}
	<tr {if $id==0}class="lit"{/if}>
		{if $do_build.$id.mode=='destroy'}<td>({$lang->get("demolish")}) {$cl_builds->get_name($buildname)} ({$do_build.$id.stage+1|stage})</td>{/if}
		{if $do_build.$id.mode!='destroy'}<td>{$cl_builds->get_name($buildname)} ({$do_build.$id.stage|stage})</td>{/if}
		{if $id==0}
			{if $do_build.$id.finished < $time}
		<td>{$do_build.$id.dauer|format_time}</td>
			{else}
		<td><span class="timer">{$do_build.$id.dauer|format_time}</span></td>
			{/if}
		{else}
		<td>{$do_build.$id.dauer|format_time}</td>
		{/if}
		<td>{$do_build.$id.finished|format_date}</td>
		<td><a href="javascript:ask('Weet je zeker dat je dit wilt annuleren?', 'game.php?village={$village.id}&amp;screen=main&amp;action=cancel&amp;id={$do_build.$id.r_id}&amp;mode={$mode}&amp;h={$hkey}')">{$lang->get("cancel")}</a></td>
	</tr>
	{/foreach}
	{if $num_do_build > 2}
	<tr><td colspan="4">{$lang->get("extrags")}: <b>{$cl_builds->get_buildsharpens_costs($num_do_build)}%</b><br /><small>{$lang->get("novergoeding")}</small></td></tr>
	{/if}
</table><br />
{/if}
{if !empty($error)}<div class="error">{$error}</div>{/if}
{if $village.main >= 15 && $village.agreement == 100 && $config.build_destroy}
<table class="vis">
	<tr>
		<td {if $mode=='build'}class="selected"{/if} width="100"><a href="game.php?village={$village.id}&amp;screen=main&amp;mode=build">{$lang->get("construct")}</a></td>
		<td {if $mode=='destroy'}class="selected"{/if} width="100"><a href="game.php?village={$village.id}&amp;screen=main&amp;mode=destroy">{$lang->get("demolish")}</a></td>
	</tr>
</table>
{/if}
{if $mode == 'destroy' && $village.main >= 15 && $village.agreement == 100 && $config.build_destroy}
	{include file='game_main_destroy.tpl'}
{else}
<table class="vis" width="100%">
	<tr>
		<th style="width:100px;" colspan="2">{$lang->get("buildings")}</th>
		<th style="width:60px;"><div align="center"><img src="{$config.cdn}/graphic/holz.png" title='{$lang->get("wood")}' /></div></th>
		<th style="width:60px;"><div align="center"><img src="{$config.cdn}/graphic/lehm.png" title='{$lang->get("stone")}' /></div></th>
		<th style="width:60px;"><div align="center"><img src="{$config.cdn}/graphic/eisen.png" title='{$lang->get("iron")}' /></div></th>
		<th style="width:30px;"><div align="center"><img src="{$config.cdn}/graphic/face.png" title='{$lang->get("head")}' /></div></th>
		<th style="width:50px;">{$lang->get("during")}</th>
		<th colspan="2" style="width:350px;">{$lang->get("builds")}</th>
	</tr>
	{foreach from=$fulfilled_builds item=dbname key=id}
	<tr {if $cl_builds->get_maxstage($dbname) == $build_village.$dbname}class="fulfilled"{/if}{if $cl_builds->get_maxstage($dbname) == $build_village.$dbname && $smarty.cookies.fulfilled_hide == 1} style="display: none;"{/if}>
		<th width="25"><div align="center"><a href="javascript:popup_scroll('popup_building.php?building={$dbname}', 520, 520)"><img src="{$config.cdn}/graphic/buildings/{$dbname}.png"></a></div></th><td><a href="game.php?village={$village.id}&screen={$dbname}">{$cl_builds->get_name($dbname)}</a> <span style="float:right;">(<b>Max {$cl_builds->get_maxstage($dbname)}</b>|{$village.$dbname|stage})</span></td>
        
        
				{if $cl_builds->get_maxstage($dbname)<=$build_village.$dbname}
		<td colspan="6" align="center" class="inactive">{$lang->get("uitgebouwd")}</td>
				{else}
		<td align="center">{$cl_builds->get_wood($dbname,$build_village.$dbname+1)}</td>
		<td align="center">{$cl_builds->get_stone($dbname,$build_village.$dbname+1)}</td>
		<td align="center">{$cl_builds->get_iron($dbname,$build_village.$dbname+1)}</td>
		<td align="center">{if $cl_builds->get_bh($dbname,$build_village.$dbname+1)>0}{$cl_builds->get_bh($dbname,$build_village.$dbname+1)}{/if}</td>
		<td align="center">{$cl_builds->get_time($village.main,$dbname,$build_village.$dbname+1)|format_time}</td>
					{$cl_builds->build($village,$id,$build_village,$plus_costs)}
					{if $cl_builds->get_build_error2()=='not_enough_ress'}
		<td class="inactive" align="center"><span>{$lang->get("gsbeschikbaarin")} <span class="timer_replace">{$cl_builds->get_build_error()}</span></span><span style="display:none">{$lang->get("genoegbeschikbaar")}</span></td>
					{elseif $cl_builds->get_build_error2()=='not_enough_ress_plus'}
		<td class="inactive">{$lang->get("nietgenoeg")}</td>
					{elseif $cl_builds->get_build_error2()=='not_fulfilled'}
		<td class="inactive">{$lang->get("eisenniet")}</td>
					{elseif $cl_builds->get_build_error2()=='not_enough_bh'}
		<td class="inactive">{$lang->get("boerderijruimte")}</td>
					{elseif $cl_builds->get_build_error2()=='not_enough_storage'}
		<td class="inactive">{$lang->get("opslagteklein")}</td>
					{else}
						{if $build_village.$dbname < 1}
							{if count($do_build)>2 && $user.confirm_queue==1}
		<td align="center"><a href="javascript:ask('Wil je extra betalen?', 'game.php?village={$village.id}&amp;screen=main&amp;action=build&amp;id={$dbname}&amp;force&amp;h={$hkey}')">{$lang->get("builds")}</a></td>
							{else}
		<td align="center"><a href="game.php?village={$village.id}&screen=main&action=build&id={$dbname}&h={$hkey}">{$lang->get("builds")}</a></td>
							{/if}
						{else}
{assign var="porcents" value=$cl_builds->get_porcent($dbname,$village.$dbname)}
							{if count($do_build)>2 && $user.confirm_queue==1}
		<td align="center">
			<table cellpadding="0" rowspacing="0" cellspacing="0">
				<tr>
					<td width="300" title="{$c1.$dbname}%">
					<div style="width:100%; background-image: url({$config.cdn}/graphic/bars/bars_bg.jpg); border: solid 1px #CFAB65;">
					<div style="width:{$porcents}%; background:url({$config.cdn}/graphic/bars/bars.gif) repeat; color:#000000; text-align:center;"><b>{$porcents}%</b></div>
					</td>
					<td align="center"><a href="javascript:ask('Het kost je extra grondstoffen om te bouwen. Wil je doorgaan?', 'game.php?village={$village.id}&amp;screen=main&amp;action=build&amp;id={$dbname}&amp;force&amp;h={$hkey}')"><img src="{$config.cdn}/graphic/icons/plus.png"></a></td>
				</tr>
			</table>
		</td>
							{else}
		<td align="center">
			<table cellpadding="0" rowspacing="0" cellspacing="0">
				<tr>
					<td width="300" title="{$c1.$dbname}%">
					<div style="width:100%; background-image: url({$config.cdn}/graphic/bars/bars_bg.jpg); border: solid 1px #CFAB65;">
					<div style="width:{$porcents}%; background:url({$config.cdn}/graphic/bars/bars.gif) repeat; color:#000000; text-align:center;"><b>{$porcents}%</b></div>
					</td>
					<td align="center"><a href="game.php?village={$village.id}&screen=main&action=build&id={$dbname}&h={$hkey}"><img src="{$config.cdn}/graphic/icons/plus.png"></a></td>
				</tr>
			</table>
		</td>
							{/if}
						{/if}
					{/if}
				{/if}
	</tr>
		{/foreach}
	<span {if $smarty.cookies.needed_hide==0}style="display: none;"{/if}>
		{foreach from=$neconstruit item=nume key=id}
			{if !in_array($nume, $fulfilled_builds)}
	<tr class="inactive togglereq" {if $smarty.cookies.needed_hide==0}style="display: none;"{/if}>
		<td align="left"><a href="javascript:popup_scroll('popup_building.php?building={$nume}', 520, 520)"><img src="{$config.cdn}/graphic/icons/help.png" width="15" /></a> <img src="{$config.cdn}/graphic/overview/{$nume}.png"><a href="game.php?village={$village.id}&screen={$nume}"> {$cl_builds->get_name($nume)}</a></td>
		<td colspan="6">{$lang->get("benodigd")}: 
				{foreach from=$cl_builds->get_needed_by_dbname($nume) item=nivel key=cladire}
			<img src="{$config.cdn}/graphic/overview/{$cladire}.png"> <b>{$cl_builds->get_name($cladire)}</b> ({$nivel|stage})&nbsp;
				{/foreach}
		</td>
	</tr>
			{/if}
		{/foreach}
	</span>
    	</table>
	<table class="vis" width="100%">

	<tr>
		<th width="25"><div align="center"><input type="checkbox" name="not_built" id="not_built"  {if $smarty.cookies.needed_hide == 1}checked="yes"{/if} onclick="$('.togglereq').fadeToggle(); {literal}if ($.cookie('needed_hide') == 1) { var hidden =  0 } else var hidden =1;{/literal} $.cookie('needed_hide', hidden);"></div></th>
			 <td><label for="not_built">{$lang->get("showallbuildings")}</label></td>
	</tr>
	<tr>
			<th width="25"><div align="center"><input type="checkbox" name="hide_fulfilled" id="hide_fulfilled" {if $smarty.cookies.fulfilled_hide == 1}checked="yes"{/if} onclick="$('.fulfilled').fadeToggle(); {literal}if ($.cookie('fulfilled_hide') == 1) { var hidden =  0 } else var hidden =1;{/literal} $.cookie('fulfilled_hide', hidden);"></div></th>
            <td><label for="hide_fulfilled">{$lang->get("hidebuildout")}</label></td>
	</tr>
</table><br />
{/if}
<br />
<!--<table width="100%" class="ind">
		<tr><th>{$lang->get("hidebuildout")}</th></tr>
		<tr>
<td>
<div title="{$porcent}%" style="width:100%; background:url({$config.cdn}/graphic/bars/bars_bg.jpg) repeat; color:#000000; text-align:center;">
<div title="{$porcent}%" style="width:{$porcent}%; background:url({$config.cdn}/graphic/bars/bars.gif) repeat; color:#000000; text-align:center;" >
<strong>{$porcent}%</strong>
</div>
</div>

</td></tr>
	</table>  -->
	<br />
<form action="game.php?village={$village.id}&amp;screen=main&amp;action=change_name&amp;h={$hkey}" method="post">
	<table>
		<tr><th colspan="3">{$lang->get("dorpsnaam")}</th></tr>
		<tr>
			<td><input type="text" name="name" value="{$village.name}" /></td>
			<td><input type="submit" value="Aanpassen" class="button" /></td>
		</tr>
	</table>
</form>