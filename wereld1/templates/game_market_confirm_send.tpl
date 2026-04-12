<td colspan="2">
	<h2>Confirmar transporte</h2>
	<form action="game.php?village={$village.id}&amp;screen=market&amp;action=send&amp;h={$hkey}" method="post">
		<table class="vis" width="50%">
			<tr><th colspan="2">Transporte</th></tr>
			<tr><td>Destino:</td><td><a href="game.php?village={$village.id}&amp;screen=info_village&amp;id={$confirm.to_villageid}">{$confirm.to_villagename} ({$confirm.to_x}|{$confirm.to_y}) K{$confirm.to_continent}</a></td></tr>
			<tr><td>Jogador:</td><td><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$confirm.to_userid}">{$confirm.to_username}</a></td></tr>
			<tr><td width="150">Recursos:</td><td width="200">{if $confirm.wood>0}<img src="{$config.cdn}/graphic/icons/wood.png" title="Madeira" alt="" /> {$confirm.wood} {/if}{if $confirm.stone>0}<img src="{$config.cdn}/graphic/icons/stone.png" title="Argila" alt="" /> {$confirm.stone} {/if}{if $confirm.iron>0}<img src="{$config.cdn}/graphic/icons/iron.png" title="Ferro" alt="" /> {$confirm.iron} {/if}</td></tr>
			<tr><td>Mercadores necessários:</td><td>{$confirm.dealers}</td></tr>
			<tr><td>Duração (Ida e volta):</td><td>{$confirm.dealer_running}</td></tr>
			<tr><td>Chegada:</td><td>{$confirm.time_to}</td></tr>
			<tr><td>Retorno:</td><td>{$confirm.time_back}</td></tr>
			<tr><th colspan="2"><div align="right"><input type="submit" value="Ok" class="button" /></div></th></tr>
		</table><br />		
		<input type="hidden" name="target_id" value="{$confirm.to_villageid}" />
		<input type="hidden" name="wood" value="{$confirm.wood}" />
		<input type="hidden" name="stone" value="{$confirm.stone}" />
		<input type="hidden" name="iron" value="{$confirm.iron}" />
	</form>
</td>