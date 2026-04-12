<h2 style="font-size:20px; font-weight:bold; text-transform:uppercase; margin-bottom:0px;">{$ally.short} &rArr; Membros</h2>
<table class="vis" width="100%" style="border:1px solid #804000;">
	<tr>
		<th width="280">Jogador</th>
		<th width="40">Rank</th>
		<th width="80">Pontos</th>
		<th width="40">Aldeias</th>
	</tr>
	{foreach from=$members item=arr key=id}
	<tr {if $user.id==$id}class="lit"{/if}>
		<td><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$id}">{$arr.username}</a> {if !empty($arr.titel)}({$arr.titel}){/if}	</td>
		<td>{$arr.rank}</td>
		<td>{$arr.points|format_number}</td>
		<td>{$arr.villages}</td>
  	</tr>
	{/foreach}
</table>