<table>
	<tr>
    	<td>
			<img src="{$config.cdn}/graphic/big_buildings/{$dbname}1.png" title="Lehmgrube" alt="" />
		</td>   
		<td>
			<h2>{$buildname} ({$village.$dbname|stage})</h2>
			{$description}
		</td>
	</tr>
</table>
<br />
{if $show_build}
	{if count($recruit_units)>0}
	    <table class="vis">
			<tr>
				<th width="150">Ausbildung</th>
				<th width="120">Dauer</th>
				<th width="150">Fertigstellung</th>
				<th width="100">Abbruch *</th>
			</tr>

			{foreach from=$recruit_units key=key item=value}
			    <tr {if $recruit_units.$key.lit}class="lit"{/if}>
					<td>{$recruit_units.$key.num_unit} {$cl_units->get_name($recruit_units.$key.unit)}</td>
	                {if $recruit_units.$key.lit && $recruit_units.$key.countdown>-1}
						<td><span class="timer">{$recruit_units.$key.countdown|format_time}</span></td>
					{else}
					   	<td>{$recruit_units.$key.countdown|format_time}</td>
					{/if}
					<td>{$recruit_units.$key.time_finished|format_date}</td>
					<td><a href="game.php?t=129107&amp;village={$village.id}&amp;screen={$dbname}&amp;action=cancel&amp;id={$key}&amp;h={$hkey}">abbrechen</a></td>
			    </tr>
			{/foreach}

		</table>
		<div style="font-size: 7pt;">* (90% der Rohstoffe werden wiedergegeben)</div>
		<br>
	{/if}

	{if !empty($error)}
		<font class="error">{$error}</font>
	{/if}
	<form action="game.php?village={$village.id}&amp;screen={$dbname}&amp;action=train&amp;h={$hkey}" method="post" onsubmit="this.submit.disabled=true;">
		<table class="vis">
			<tr>
				<th width="150">Einheit</th>
				<th colspan="4" width="120">Bedarf</th>
				<th width="130">Zeit (hh:mm:ss)</th>
				<th>Im Dorf/Insgesamt</th>
				<th>Rekrutieren</th>
			</tr>

			{foreach from=$units key=unit_dbname item=name}
				<tr>
					<td><a href="javascript:popup('popup_unit.php?unit={$unit_dbname}', 520, 520)"> <img src="{$config.cdn}/graphic/unit/{$unit_dbname}.png" alt="" /> {$name}</a></td>
					<td><img src="{$config.cdn}/graphic/icons/wood.png" title="wood" alt="" /> {$cl_units->get_woodprice($unit_dbname)}</td>
					<td><img src="{$config.cdn}/graphic/icons/stone.png" title="stone" alt="" /> {$cl_units->get_stoneprice($unit_dbname)}</td>
					<td><img src="{$config.cdn}/graphic/icons/iron.png" title="iron" alt="" /> {$cl_units->get_ironprice($unit_dbname)}</td>
					<td><img src="{$config.cdn}/graphic/icons/farm.png" title="farm" alt="" /> {$cl_units->get_bhprice($unit_dbname)}</td>
					<td>{$cl_units->get_time($village.$dbname,$unit_dbname)|format_time}</td>
					<td>{$units_in_village.$unit_dbname}/{$units_all.$unit_dbname}</td>

					{$cl_units->check_needed($unit_dbname,$village)}
					{if $cl_units->last_error==not_tec}
					    <td class="inactive">Einheit noch nicht erforscht</td>
					{elseif $cl_units->last_error==not_needed}
					    <td class="inactive">Geb�udevorraussetzungen nicht erf�llt</td>
					{elseif $cl_units->last_error==not_enough_ress}
					    <td class="inactive">Nicht gen�gend Rohstoffe vorhanden</td>
					{elseif $cl_units->last_error==not_enough_bh}
					    <td class="inactive">Zu wenig Bauernh�fe um zus�tzliche Soldaten zu versorgen</td>
					{else}
						<td><input name="{$unit_dbname}" type="text" size="5" maxlength="5" id="input_{$unit_dbname}" /> <a href="javascript:void(0);" onclick="insertUnit($('#input_{$unit_dbname}'), {$cl_units->last_error})">(max. {$cl_units->last_error})</a></td>
					{/if}
				</tr>
			{/foreach}

		    <tr><td colspan="8" align="right"><input name="submit" type="submit" value="Rekrutieren" style="font-size: 10pt;" /></td></tr>
		</table>
	</form>
{/if}