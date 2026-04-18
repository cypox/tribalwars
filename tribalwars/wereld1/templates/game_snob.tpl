<table>
	<tr>
    	<td>
			<img src="{$config.cdn}/graphic/big_buildings/snob1.png" title="Academy" alt="" />
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
				<th width="150">Training</th>
				<th width="120">Duration</th>
				<th width="150">Completion</th>
				<th width="100">Cancel *</th>
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
					<td><a href="game.php?t=129107&amp;village={$village.id}&amp;screen={$dbname}&amp;action=cancel&amp;id={$key}&amp;h={$hkey}">Cancel</a></td>
			    </tr>
			{/foreach}

		</table>
		<div style="font-size: 7pt;">* (90% of resources are refunded)</div>
		<br>
	{/if}

	{if !empty($error)}
		<div class="error">{$error}</div>
	{/if}
	<form action="game.php?village={$village.id}&amp;screen={$dbname}&amp;action=train&amp;h={$hkey}" method="post" onsubmit="this.submit.disabled=true;">
		<table class="vis">
			<tr>
				<th width="150">Unit</th>
				<th colspan="4" width="120">Costs</th>
				<th width="130">Duration (hh:mm:ss)</th>
				<th>In village/Total</th>
				<th>Recruit</th>
			</tr>

			{foreach from=$units key=unit_dbname item=name}
				<tr>
					<td><a href="javascript:popup('popup_unit.php?unit={$unit_dbname}', 520, 520)"> <img src="{$config.cdn}/graphic/unit/{$unit_dbname}.png" alt="" /> {$name}</a></td>
					<td><img src="{$config.cdn}/graphic/holz.png" title="Wood" alt="" /> {$cl_units->get_woodprice($unit_dbname)}</td>
					<td><img src="{$config.cdn}/graphic/lehm.png" title="Clay" alt="" /> {$cl_units->get_stoneprice($unit_dbname)}</td>
					<td><img src="{$config.cdn}/graphic/eisen.png" title="Iron" alt="" /> {$cl_units->get_ironprice($unit_dbname)}</td>
					<td><img src="{$config.cdn}/graphic/face.png" title="Population" alt="" /> {$cl_units->get_bhprice($unit_dbname)}</td>
					<td>{$cl_units->get_time($village.$dbname,$unit_dbname)|format_time}</td>
					<td>{$units_in_village.$unit_dbname}/{$units_all.$unit_dbname}</td>

					{$cl_units->check_needed($unit_dbname,$village)}
					{if $amountSnobsCanBeRecruited <= 0 && $ag_style == 2}
						<td class="inactive">Insufficient coins</td>
					{elseif $cl_units->last_error=='not_tec'}
					    <td class="inactive">Unit not yet researched</td>
					{elseif $cl_units->last_error=='not_needed'}
					    <td class="inactive">Building requirements not met</td>
					{elseif $cl_units->last_error=='build_ah'}
					    <td class="inactive">Academy must be upgraded.</td>
					{elseif $cl_units->last_error=='not_enough_ress'}
					    <td class="inactive">Not enough resources available</td>
					{elseif $cl_units->last_error=='not_enough_bh'}
					    <td class="inactive">Not enough farm space for additional troops</td>
					{else}
						<td><a href="game.php?h={$hkey}&amp;action=train_snob&amp;screen=snob&amp;village={$village.id}">Recruit unit</a></td>
					{/if}
				</tr>
			{/foreach}


		</table>
		<br />
		{if $ag_style==0}
			<h4>Number of nobles that can still be recruited in this village</h4>
			<table class="vis">
			<tr><td>Academy level:</td><td>{$village.snob}</td></tr>
			<tr><td>- Villages controlled from this village:</td><td>{$village.control_villages}</td></tr>
			<tr><td>- Nobles already present or in production here:</td><td>{$village.recruited_snobs}</td></tr>
			<tr><th>Can still be recruited:</th><th>{$village.snob-$village.control_villages-$village.recruited_snobs}</th></tr>
			</table>
		{elseif $ag_style==1}
			<h4>Number of nobles that can still be recruited</h4>
			<table class="vis">
			<tr><td>Academy level:</td><td>{$village.snob_info.stage_snobs}</td></tr>
			<tr><td>- Nobles available:</td><td>{$village.snob_info.all_snobs}</td></tr>
			<tr><td>- Nobles in production:</td><td>{$village.snob_info.ags_in_prod}</td></tr>
			<tr><td>- Number of conquered villages:</td><td>{$village.snob_info.control_villages}</td></tr>
			<tr><th>Can still be recruited:</th><th>{$village.snob_info.can_prod}</th></tr>
			</table>
		{elseif $ag_style==2}
			<h4>Number of nobles that can still be recruited</h4>
			<table class="vis">
				<tr><td>Noble limit:</td><td>{$snobLimit}</td></tr>
				<tr><td>- Nobles available:</td><td>{$snobsNow}</td></tr>
				<tr><td>- Nobles in production:</td><td>{$inRecruit}</td></tr>
				<tr><td>- Number of conquered villages:</td><td>{if $enobled != 0}{$enobled}{else}0{/if}</td></tr>
				<tr><th>Can still be recruited:</th><th>{$amountSnobsCanBeRecruited}</th></tr>
			</table><br />
			<table>
				<tr>
					<td><img alt="Gold coins" src="{$config.cdn}/graphic/gold_big.png" /></td>
					<td>
						<h4>Gold coins</h4>
						<p>To recruit additional nobles, you need to mint gold coins. The more gold coins you own, the more villages you can control.</p>
					</td>
				</tr>
			</table>
			<table class="vis">
				<tr><td>Total gold coins:</td><td>{$coinsAll}</td></tr>
				<tr><td>Gold coins until next noble:</td><td>{$coinsNext}</td></tr>
				<tr><td>Noble limit:</td><td>{$snobLimit}</td></tr>
			</table>
			<table class="vis">
				<tr><th>Cost</th><th>Mint</th></tr>
				<tr>
					<td>
						<img alt="" title="Wood" src="{$config.cdn}/graphic/holz.png"/> {$coinPrice.wood}
						<img alt="" title="Clay" src="{$config.cdn}/graphic/lehm.png"/> {$coinPrice.stone}
						<img alt="" title="Iron" src="{$config.cdn}/graphic/eisen.png"/> {$coinPrice.iron}
					</td>
					<td class="inactive">
					{if $makeCoin}
						<a href="game.php?village={$village.id}&screen=snob&action=coin&h={$hkey}">&raquo; Mint gold coin</a>
					{else}
						<span>Resources available in <span class="timer_replace">{$coinError}</span></span>
						<span style="display:none">Resources are available.</span>
					{/if}
					</td>
				</tr>
			</table>
		{/if}
		{if $ag_style != 2 && count($snobed_villages) > 0}
		<table class="vis" width="300">
			<tr><th>Villages controlled by this village</th></tr>
			{foreach from=$snobed_villages key=id item=villagename}
			<tr><td><a href="game.php?village={$village.id}&amp;screen=info_village&amp;id={$id}">{$villagename}</a></td></tr>
			{/foreach}
		</table>
	{/if}
{/if}