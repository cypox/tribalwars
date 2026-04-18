<table width="100%"> 
<tr><th width="60">From:</th><th>
	{if !empty($report.from_username)}
		<a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$report.from_user}">{$report.from_username}</a>
	{else}
		<b>unknown</b>
	{/if}
</th></tr> 
<tr><td>Village:</td><td><a href="game.php?village={$village.id}&amp;screen=info_village&amp;id={$report.fromto_village}">{$report.from_villagename} ({$report.from_x}|{$report.from_y})</a></th></tr> 
 
<tr><th>To:</th><th>
	{if !empty($report.to_username)}
		<a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$report.to_user}">{$report.to_username}</a></th></tr> 
	{else}
		<b>unknown</b>
	{/if}
<tr><td>Village:</td><td><a href="game.php?village={$village.id}&amp;screen=info_village&amp;id={$report.to_village}">{$report.to_villagename} ({$report.to_x}|{$report.to_y})</a></th></tr> 
 
</table><br> 
           
<h4>Units:</h4>
<table class="vis"> 
	<tr> 
	    {foreach from=$cl_units->get_array("dbname") item=dbname key=name}
			<th width="35"><img src="graphic/unit/{$dbname}.png" title="{$name}" alt="" /></th>
		{/foreach}
	</tr> 
	<tr> 
		{foreach from=$support_units item=num_units}
			{if $num_units>0}
				<td>{$num_units}</td>
			{else}
				<td class="hidden">0</td>
			{/if}
		{/foreach}
	</tr> 
</table>