<p>Nesta página as relações com outras tribos podem ser administradas. As configurações <b>não</b> estão conectadas com o jogo em si, porém as aldeias serão coloridas no mapa. Tal status será visível apenas aos membros das tribos e poderá ser mudado apenas pelos Diplomatas.</p>
<table class="vis" width="300">
	<tr><th colspan="2">Aliados</th></tr>
	{foreach from=$contracts.partner item=partner}
	<tr>
		<td><a href="game.php?village={$village.id}&screen=info_ally&id={$partner.to_ally}">{$partner.short}</a></td>
		<td><a href="game.php?village={$village.id}&screen=ally&mode=contracts&action=cancel_contract&id={$partner.id}&hkey={$hkey}">terminar</a></td>
	</tr>
	{/foreach}
</table><br />
<table class="vis" width="300">
	<tr><th colspan="2">Pactos de não-Agressão (PNA)</th></tr>
	{foreach from=$contracts.nap item=partner}
	<tr>
		<td><a href="game.php?village={$village.id}&screen=info_ally&id={$partner.to_ally}">{$partner.short}</a></td>
		<td><a href="game.php?village={$village.id}&screen=ally&mode=contracts&action=cancel_contract&id={$partner.id}&hkey={$hkey}">terminar</a></td>
	</tr>
	{/foreach}
</table><br />
<table class="vis" width="300">
	<tr><th colspan="2">Inimigos</th></tr>
	{foreach from=$contracts.enemy item=partner}
	<tr>
		<td><a href="game.php?village={$village.id}&screen=info_ally&id={$partner.to_ally}">{$partner.short}</a></td>
		<td><a href="game.php?village={$village.id}&screen=ally&mode=contracts&action=cancel_contract&id={$partner.id}&hkey={$hkey}">terminar</a></td>
	</tr>
	{/foreach}
</table><br />
<h3>Adicionar relação diplomática</h3>
<form method="post" action="/game.php?village={$village.id}&screen=ally&mode=contracts&action=add_contract&h=835c">
	Tribo (TAG):
	<input type="text" name="tag" maxlength="6" />
	<select name="type">
		<option value="partner">Aliado</option>
		<option value="nap">Pacto de não-Agressão (PNA)</option>
		<option value="enemy">Inimigo</option>
	</select>
	<input type="submit" value="OK" class="button green" />
</form>