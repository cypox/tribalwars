<div id="tooltip" style="position: absolute; top:0px; left:0px; right: auto; visibility: hidden;>
<h3></h3>
<div class="body">
</div>
</div>

<table>
	<tr>
        <td>
			<img src="{$config.cdn}/graphic/big_buildings/statue1.png" title="Lehmgrube" alt="" />
		</td>   
		<td>
			<h2>Estátua ({$village.statue|stage})</h2>
			{$description}
	</td>
</tr>
</table>
<br />

{if $show_build}
	<table class="vis">
	<tbody>
	<tr>
	{if $mode=='main'}
	<td class="selected" width="100">
	{else}
	<td width="100">
	{/if}
	<a href="game.php?village={$village.id}&amp;screen=statue&amp;mode=main">Paladino</a>
	</td>
	{if $mode=='inventory'}
	<td class="selected" width="100">
	{else}
	<td width="100">
	{/if}
	<a href="game.php?village={$village.id}&amp;screen=statue&amp;mode=inventory">Sala de armas</a>
	</td>
	</tr>
	</tbody>
	</table>

	{if $mode=="inventory"}
<div style="width:840px;float:left;">
	<div style="float:right;width:210px;padding-right:5px;">
		<p>Items are effective only for units joined by a Paladin equipped with that particular item.s</p>
	</div>
	<div style="float:left;position:relative;z-index:9996;width:605px;padding-left:2px;">
		<div style="width:600px;height:430px;padding:0;margin-right:10px;z-index:9997">
			{foreach from=$knight_items->name item=name key=itemname}
			{if $items_data.$itemname==true}
			<img src="{$config.cdn}/graphic/inventory/{$itemname}.png" class="inv_map inv_{$itemname}" alt=""/>
			{/if}
			{/foreach}
			<img src="{$config.cdn}/graphic/map/empty.png" alt="" title="" class="inv_empty" usemap="#inv" />
			<map id="inv" name="inv">
			{foreach from=$knight_items->name item=name key=itemname}
			{if $items_data.$itemname==true}
				<area shape="poly" id="item_{$dbname}" alt="" coords="{$knight_items->getPoly($itemname)}" title="" href="game.php?village={$village.id}&amp;screen={$dbname}&amp;mode=inventory&amp;action=equip&amp;h={$hkey}&amp;item={$itemname}" class="tooltip_item" onmouseover="knight_item_popup('{$lang->grab("knight", $itemname)|regex_replace:'/\'/':'&rsquo;'}', '{$items_des.$itemname|regex_replace:'/\'/':'&rsquo;'}')" onmousemove="knight_item_move()" onmouseout="knight_item_kill()" />
			{/if}
			{/foreach}
			</map>
			<img src="{$config.cdn}/graphic/inventory/inventory.jpg" alt="" title="" />
		</div>
	</div>
	</div>
<br style="clear:both" />
<table style="padding:0;margin:0;">
	<tr>
	{if count($knight_items->name)==$items_found}
		<th>{$lang->grab("statue", "all_items_found")}
	{else}
		<th colspan="3">Progresso para o próximo item:</th>
	</tr>
	<tr>
		<td>0%</td>
		<td style="width:390px;border:1px solid #804000;padding:0;margin:0;">
			<div style="width:{$find_progress}px; background-color:#804000;">&nbsp;</div></td>
		<td>100%</td>
	</tr>
	<tr>
		<td colspan="3" style="text-align:center;">{$f_progress}%</td>
	</tr>
	{/if}
</table>
	{else}
	{if count($recruit_units)>0}
	    <table class="vis">
			<tr>
				<th width="150">Trinamento</th>
				<th width="120">Dura&ccedil;&atilde;o</th>
				<th width="150">Conclus&atilde;o</th>
				<th width="100">Cancelar *</th>
			</tr>

			{foreach from=$recruit_units key=key item=value}
			    <tr {if $recruit_units.$key.lit}class="lit"{/if}>
					<td>{$knightname}</td>
	                {if $recruit_units.$key.lit && $recruit_units.$key.countdown>-1}
						<td><span class="timer">{$recruit_units.$key.countdown|format_time}</span></td>
					{else}
					   	<td>{$recruit_units.$key.countdown|format_time}</td>
					{/if}
					<td>{$recruit_units.$key.time_finished|format_date}</td>
					<td><a href="game.php?t=129107&amp;village={$village.id}&amp;screen={$dbname}&amp;action=cancel&amp;id={$key}&amp;h={$hkey}">Cancelar</a></td>
			    </tr>
			{/foreach}

		</table>
		<div style="font-size: 7pt;">* (90% dos recursos ser&atilde;o devolvidos)</div>
		<br />
	{/if}

	{if !empty($error)}
		<font class="error">{$error}</font>
	{/if}
	{if !$pala_exists}
	<form action="game.php?village={$village.id}&amp;screen={$dbname}&amp;action=train&amp;h={$hkey}" method="post" onsubmit="this.submit.disabled=true;">
		<table class="vis">
			<tr>
				<th width="150">Unidade</th>
				<th colspan="4" width="120">Custos</th>
				<th width="130">Dura&ccedil;&atilde;o (hh:mm:ss)</th>
				<th>Nomear paladino</th>
			</tr>

			{foreach from=$units key=unit_dbname item=name}
				<tr>
					<td><a href="javascript:popup('popup_unit.php?unit={$unit_dbname}', 520, 520)">  <img src="{$config.cdn}/graphic/unit/{$unit_dbname}.png" alt="" />{$knightname}</a></td>
					<td><img src="{$config.cdn}/graphic/holz.png" title="{$lang->grab("game", "wood")}" alt="" /> {$cl_units->get_woodprice($unit_dbname)}</td>
					<td><img src="{$config.cdn}/graphic/lehm.png" title="{$lang->grab("game", "stone")}" alt="" /> {$cl_units->get_stoneprice($unit_dbname)}</td>
					<td><img src="{$config.cdn}/graphic/eisen.png" title="{$lang->grab("game", "iron")}" alt="" /> {$cl_units->get_ironprice($unit_dbname)}</td>
					<td><img src="{$config.cdn}/graphic/face.png" title="{$lang->grab('game', 'worker')}" alt="" /> {$cl_units->get_bhprice($unit_dbname)}</td>
					<td>{$cl_units->get_time($village.$dbname,$unit_dbname)|format_time}</td>
					{$cl_units->check_needed($unit_dbname,$village)}
					{if $amountSnobsCanBeRecruited == 0 AND $ag_style == 2}
					    <td class="inactive">{$lang->grab("error", "no_more_snobs")}</td>
					{elseif $cl_units->last_error==not_tec}
					    <td class="inactive">{$lang->grab("error", "not_tec")}</td>
					{elseif $cl_units->last_error==not_needed}
					    <td class="inactive">{$lang->grab("error", "not_fulfilled")}</td>
					{elseif $cl_units->last_error==build_ah}
					    <td class="inactive">{$lang->grab("error", "build_ah")}</td>
					{elseif $cl_units->last_error==not_enough_ress}
					    <td class="inactive">{$lang->grab("error", "not_enough_ress")}</td>
					{elseif $cl_units->last_error==not_enough_bh}
					    <td class="inactive">{$lang->grab("error", "not_enough_bh")}</td>
					{elseif $pala_exists}
						<td class="inactive">{$lang->grab("statue", "pala_exists")}</td>
					{else}
						<td><a href="game.php?village={$village.id}&amp;screen={$dbname}&amp;action=train&amp;h={$hkey}">Nomear paladino</a></td>
					{/if}
				</tr>
			{/foreach}
		</table>
		</form>
	{else}
	{if $pala_image==true}
	<table>
	<tr><td>
	<img src="{$config.cdn}/graphic/inventory/paladin_{$pala_item}.jpg" alt="" />
	</td><td style="vertical-align: top;">
	<h3>{$lang->grab("knight", $pala_item)}</h3>
	<p>{$pala_item_des}</p>
	<br />
	{/if}
	<h3 style="margin-top: 4px;">{$knightname}</h3>
	{if !empty($pala_doing)}
	<table class="vis">
		<tr>
			<th>{$pala_doing}</th>
		</tr>
		{if $pala_moveable}
		<tr><td><a href="game.php?village={$village.id}&amp;screen={$dbname}&amp;action=deploy">Mover para essa aldeia</a></td></tr>
		{/if}
		<tr>
		</tr>
	</table>
	<br />
	{/if}
<form action="game.php?village={$village.id}&amp;screen={$dbname}&amp;action=knights_name" method="POST">
<table class="vis">
	<tr>
		<td>
			Nome: <input type="text" name="knights_name" value="{$knightname}" /> <input type="submit" value="Renomear" />
		</td>
	</tr>
</table>
</form>
{if $pala_image==true}
	</td></tr>
	</table>
{/if}
{/if}
	{/if}
{/if}