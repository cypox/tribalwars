<table class="vis" width="100%">
	<tr>
		<th width="100">Comando</th>
		<th width="200">Destino</th>
		<th width="150">Jogador</th>
		<th width="160">Chegada</th>
		<th width="80">Chegada em</th>
	</tr>
	{foreach from=$other_movements item=array}
	<tr style="white-space:nowrap" class="nowrap row_a">
		<td><a href="game.php?village={$village.id}&amp;screen=info_command&amp;id={$array.id}&amp;type=other"><img src="{$config.cdn}/graphic/command/{$array.type}.png"> {$array.message}</a></td>
		<td><a href="game.php?village={$array.to_village}&amp;&amp;screen=overview">{$array.to_villagename}</a></td>
		<td><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$array.send_from_user}">{$array.send_from_username}</a></td>
		<td>{$array.end_time|format_date}</td>
		<td><span class="timer">{$array.arrival_in|format_time}</span></td>
	</tr>
	{/foreach}
</table>