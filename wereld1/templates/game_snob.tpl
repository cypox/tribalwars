<table>
	<tr>
    	<td>
			<img src="{$config.cdn}/graphic/big_buildings/snob1.png" title="Lehmgrube" alt="" />
		</td>   
		<td>
			<h2>{$buildname} ({$village.$dbname|stage})</h2>
			{$description}
		</td>
	</tr>
</table><br />
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
		<div class="error">{$error}</div>
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
					<td><img src="{$config.cdn}/graphic/holz.png" title="Holz" alt="" /> {$cl_units->get_woodprice($unit_dbname)}</td>
					<td><img src="{$config.cdn}/graphic/lehm.png" title="Lehm" alt="" /> {$cl_units->get_stoneprice($unit_dbname)}</td>
					<td><img src="{$config.cdn}/graphic/eisen.png" title="Eisen" alt="" /> {$cl_units->get_ironprice($unit_dbname)}</td>
					<td><img src="{$config.cdn}/graphic/face.png" title="Arbeiter" alt="" /> {$cl_units->get_bhprice($unit_dbname)}</td>
					<td>{$cl_units->get_time($village.$dbname,$unit_dbname)|format_time}</td>
					<td>{$units_in_village.$unit_dbname}/{$units_all.$unit_dbname}</td>

					{$cl_units->check_needed($unit_dbname,$village)}
					{if $amountSnobsCanBeRecruited <= 0 && $ag_style == 2}
						<td class="inactive">Moedas insulficientes</td>
					{elseif $cl_units->last_error==not_tec}
					    <td class="inactive">Einheit noch nicht erforscht</td>
					{elseif $cl_units->last_error==not_needed}
					    <td class="inactive">Geb�udevorraussetzungen nicht erf�llt</td>
					{elseif $cl_units->last_error==build_ah}
					    <td class="inactive">Adelshof muss ausgebaut werden.</td>
					{elseif $cl_units->last_error==not_enough_ress}
					    <td class="inactive">Nicht gen�gend Rohstoffe vorhanden</td>
					{elseif $cl_units->last_error==not_enough_bh}
					    <td class="inactive">Zu wenig Bauernh�fe um zus�tzliche Soldaten zu versorgen</td>
					{else}
						<td><a href="game.php?h={$hkey}&amp;action=train_snob&amp;screen=snob&amp;village={$village.id}">Einheit erzeugen</a></td>
					{/if}
				</tr>
			{/foreach}


		</table>
		<br />
		{if $ag_style==0}
			<h4>Anzahl Adelsgeschlechter, die in diesem Dorf noch erzeugt werden k�nnen</h4>
			<table class="vis">
			<tr><td>Stufe Adelshof:</td><td>{$village.snob}</td></tr>
			<tr><td>- von diesem Dorf beherrschte D�rfer:</td><td>{$village.control_villages}</td></tr>
			<tr><td>- vorhandene und gerade erzeugte AGs in diesem Dorf:</td><td>{$village.recruited_snobs}</td></tr>
			<tr><th>Es k�nnen noch erzeugt werden:</th><th>{$village.snob-$village.control_villages-$village.recruited_snobs}</th></tr>
			</table>
		{elseif $ag_style==1}
			<h4>Anzahl Adelsgeschlechter, die noch erzeugt werden k�nnen</h4>
			<table class="vis">
			<tr><td>Stufe Adelshof:</td><td>{$village.snob_info.stage_snobs}</td></tr>
			<tr><td>- AGs vorhanden:</td><td>{$village.snob_info.all_snobs}</td></tr>
			<tr><td>- AGs in Produktion:</td><td>{$village.snob_info.ags_in_prod}</td></tr>
			<tr><td>- Anzahl eroberter D�rfer:</td><td>{$village.snob_info.control_villages}</td></tr>
			<tr><th>Es k�nnen noch erzeugt werden:</th><th>{$village.snob_info.can_prod}</th></tr>
			</table>
		{elseif $ag_style==2}
			<h4>Anzahl Adelsgeschlechter, die noch erzeugt werden k�nnen</h4>
			<table class="vis">
				<tr><td>AG-Limit:</td><td>{$snobLimit}</td></tr>
				<tr><td>- AGs vorhanden:</td><td>{$snobsNow}</td></tr>
				<tr><td>- AGs in Produktion:</td><td>{$inRecruit}</td></tr>
				<tr><td>- Anzahl eroberter D�rfer:</td><td>{if $enobled != 0}{$enobled}{else}0{/if}</td></tr>
				<tr><th>Es k�nnen noch erzeugt werden:</th><th>{$amountSnobsCanBeRecruited}</th></tr>
			</table><br />
			<table>
				<tr>
					<td><img alt="Goldm�nzen" src="{$config.cdn}/graphic/gold_big.png" /></td>
					<td>
						<h4>Goldm�nzen</h4>
						<p>Um weitere Adelsgeschlechter zu erschaffen, musst du Goldm�nzen pr�gen. Je mehr Goldm�nzen du besitzt, desto mehr D�rfer kannst du beherrschen.</p>
					</td>
				</tr>
			</table>
			<table class="vis">
				<tr><td>Goldm�nzen insgesamt:</td><td>{$coinsAll}</td></tr>
				<tr><td>Goldm�nzen bis zum n�chsten AG:</td><td>{$coinsNext}</td></tr>
				<tr><td>AG-Limit:</td><td>{$snobLimit}</td></tr>
			</table>
			<table class="vis">
				<tr><th>Bedarf</th><th>Pr�gen</th></tr>
				<tr>
					<td>
						<img alt="" title="Holz" src="{$config.cdn}/graphic/holz.png"/> {$coinPrice.wood}
						<img alt="" title="Lehm" src="{$config.cdn}/graphic/lehm.png"/> {$coinPrice.stone}
						<img alt="" title="Eisen" src="{$config.cdn}/graphic/eisen.png"/> {$coinPrice.iron}
					</td>
					<td class="inactive">
					{if $makeCoin}
						<a href="game.php?village={$village.id}&screen=snob&action=coin&h={$hkey}">&raquo; Goldm�nze pr�gen</a>
					{else}
						<span>Rohstoffe verf�gbar in <span class="timer_replace">{$coinError}</span></span>
						<span style="display:none">Rohstoffe sind verf�gbar.</span>
					{/if}
					</td>
				</tr>
			</table>
		{/if}
		{if $ag_style != 2 && count($snobed_villages) > 0}
		<table class="vis" width="300">
			<tr><th>Von diesem Dorf beherschte D�rfer</th></tr>
			{foreach from=$snobed_villages key=id item=villagename}
			<tr><td><a href="game.php?village={$village.id}&amp;screen=info_village&amp;id={$id}">{$villagename}</a></td></tr>
			{/foreach}
		</table>
	{/if}
{/if}