<form action="game.php?village={$village.id}&amp;screen=ally&amp;mode=members&amp;action=mod&amp;h={$hkey}" method="post">
	<table class="vis" width="100%" style="border:1px solid #804000; margin-bottom:5px;">
		<tr>
			<th width="280">Jogador</th>
			<th width="40">Rank</th>
			<th width="80">Pontos</th>
			<th width="40">Aldeias</th>
			{if $user.ally_lead == 1}
			<th><div align="center"><span class="icon ally founder" alt="Fundador" title="Fundador"></span></div></th>
			<th><div align="center"><span class="icon ally lead" alt="Administrador" title="Administrador"></span></div></th>
			<th><div align="center"><span class="icon ally invite" alt="Recrutador" title="Recrutador"></span></div></th>
			<th><div align="center"><span class="icon ally diplomacy" alt="Diplom&aacute;ta" title="Diplomáta"></span></div></th>
			<th><div align="center"><span class="icon ally mass" alt="Mensagem em massa" title="Mensagem em massa"></span></div></th>
			{*<th><div align="center"><span class="icon ally mod" alt="Moderador do fórum" title="Moderador do fórum"></span></div></th>
			<th><div align="center"><span class="icon ally internal" alt="Fórum oculto" title="Fórum oculto"></span></div></th>
			<th><div align="center"><span class="icon ally trusted" alt="Membros confiáveis" title="Membros confiáveis"></span></div></th>*}
			<th><div align="center">Modo de férias</div></th>
			{/if}
		</tr>
	    {foreach from=$members item=arr key=id}
		<tr {if $id==$user.id}class="lit"{/if}>
			<td>
			{if $user.ally_lead == '1'}<input type="radio" name="player_id" value="{$id}" />
				{foreach from=$arr.icons item=graphic}<img src="graphic/stat/{$graphic}.png" /> {/foreach}
			{/if}
				<a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$id}">{$arr.username}</a> 
				{if !empty($arr.ally_titel)}({$arr.ally_titel}){/if}
			</td>
			<td align="center">{$arr.rank}</td>
			<td align="center">{$arr.points}</td>
			<td align="center">{$arr.villages}</td>
			{if $user.ally_lead == '1'}
			<td align="center">{if $arr.ally_found==1}<span class="dot green"></span>{else}<span class="dot grey"></span>{/if}</td>
			<td align="center">{if $arr.ally_lead==1}<span class="dot green"></span>{else}<span class="dot grey"></span>{/if}</td>
			<td align="center">{if $arr.ally_invite==1}<span class="dot green"></span>{else}<span class="dot grey"></span>{/if}</td>
			<td align="center">{if $arr.ally_diplomacy==1}<span class="dot green"></span>{else}<span class="dot grey"></span>{/if}</td>
			<td align="center">{if $arr.ally_mass_mail==1}<span class="dot green"></span>{else}<span class="dot grey"></span>{/if}</td>
			<td align="center">{if !empty($arr.vacation_id)}<a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$arr.vacation_id}">{$arr.vacation_name}</a>{/if}</td>
			{/if}
		</tr>
		{/foreach}
	</table>
	{if $user.ally_lead == '1'}
	<select name="action" style="text-align:center;">
		<option label="Selecione uma a&ccedil;&atilde;o..." value="">Selecione uma a&ccedil;&atilde;o...</option>
		<option label="Tit&uacute;los e permiss&otilde;es" value="rights">Tit&uacute;los e permiss&otilde;es</option>
		<option label="Expulsar" value="kick">Expulsar</option>
	</select>
	<input type="submit" value="OK" class="button" />
	{/if}
</form>

{if $user.ally_lead == '1'}
<table class="vis" width="200" style="border:1px solid #804000; margin-top:5px;">
	<tr><th colspan="2">Status</th></tr>
	<tr><td align="center"><span class="dot green"></span></td><td>Ativo</td></tr>
	<tr><td align="center"><span class="dot yellow"></span></td><td>Inativo a 2 dias</td></tr>
	<tr><td align="center"><span class="dot red"></span></td><td>inativo a uma semana</td></tr>
	<tr><td align="center"><span class="dot blue"></span></td><td>Modo de férias</td></tr>
	<tr><td align="center"><span class="dot locked"></span></td><td>Banido</td></tr>
</table>
<div style="font-size:7pt;">* Apenas <b>Fundadores</b> e <b>Administradores</b> podem ver os status dos jogadores!</div>
{/if}