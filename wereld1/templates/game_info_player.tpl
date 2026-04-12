<h2 style="margin-bottom:5px;">Jogador: {$info_user.username}</h2>
<table width="100%">
	<tr>
		<td valign="top" width="45%">
			<table class="vis" width="100%" style="border:1px solid #804000;">
				<tr><th colspan="2">Titulo de nobresa: {$tUser.title}</th></tr>
				<tr><td width="100">Pontos:</td><td>{$info_user.points|format_number}</td></tr>
				<tr><td>Ranking:</td><td>{$info_user.rang}</td></tr>
				<tr><td width="155">Oponentes derrotados:</td><td>{$info_user.killed_units_altogether|format_number} P (Rank: <B>{$info_user.killed_units_altogether_rank}</b>)</td></tr>
				{if !empty($info_ally.short)}
				<tr><td>Tribo:</td><td><a href="game.php?village={$village.id}&amp;screen=info_ally&amp;id={$info_ally.id}">{$info_ally.short}</a></td></tr>
				{/if}
				<tr><td colspan="2"><a href="game.php?village={$village.id}&amp;screen=mail&amp;mode=new&amp;player={$info_user.id}">&raquo; Enviar mensagem</a></td></tr>
			{if $can_invite}
				<tr><td colspan="2"><a href="javascript:ask('Deseja convidar o jogador {$info_user.username} para sua tribo?', 'game.php?village={$village.id}&screen=ally&mode=invite&action=invite_id&id={$info_user.id}&h={$hkey}')">&raquo; Convidar para tribo</a></td></tr>
			{/if}
			{if $friend_invite && $info_user.id != $user.id}
				<tr><td colspan="2"><a href="game.php?village={$village.id}&screen=friends&amp;action=add_buddy_id&id={$info_user.id}">&raquo; Adicionar como amigo</a></td></tr>
			{/if}
			</table><br />
			<table class="vis" width="100%" style="border:1px solid #804000;">
				<tr>
					<th width="180" {if $info_user.id == $user.id}colspan="2"{/if}>Aldeias</th>
					<th width="80">Coordenada</th>
					<th>Pontos</th>
				</tr>
				{foreach from=$villages item=arr key=id}
				<tr>
					{if $info_user.id == $user.id}<td width="10"><a href="game.php?village={$id}&screen=overview"><img src="{$config.cdn}/graphic/icons/go.png" /></a></td>{/if}
					<td><a href="game.php?village={$village.id}&amp;screen=info_village&amp;id={$id}">{$arr.name}</a></td>
					<td align="center"><a href="game.php?village={$village.id}&screen=map&x={$arr.x}&y={$arr.y}">{$arr.x}|{$arr.y}</a></td>
					<td align="center">{$arr.points|format_number}</td>
				</tr>
				{/foreach}
			</table>
		</td>
		<td align="right" valign="top" width="55%">
			{if !empty($info_user.image) || $age != '-1' || $sex != '-1' || $info_user.home != ''}
			<table class="vis" width="100%" style="border:1px solid #804000;">
				<tr><th colspan="2">Perfil <span style="float:right;">{if $info_user.id == $user.id}<a href="game.php?village={$village.id}&screen=settings&mode=profile"><span class="button">Editar</span></a>{/if}</span></th></tr>
				{if !empty($info_user.image)}
				<tr><td colspan="2" align="center"><img src="{$config.cdn}/graphic/player/{$info_user.image}" title="Brasão de: {$info_user.username}" /></td></tr>
				{/if}
				{if $age!=-1}
				<tr><td>Idade:</td><td>{$age}</td></tr>
				{/if}
				{if $sex!=-1}
				<tr><td>Sexo:</td><td>{$sex}</td></tr>
				{/if}
				{if $info_user.home!=''}
				<tr><td>Localizaçãoo:</td><td>{$info_user.home}</td></tr>
				{/if}
			</table><br />
			{/if}
			{if !empty($info_user.personal_text)}
			<table class="vis" width="100%" style="border:1px solid #804000;">
				<tr><th>Testo pessoal</th></tr>
				<tr><td align="center">{$info_user.personal_text}</td></tr>
			</table>
			{/if}
			<table width="100%" class="vis" style="border:1px solid #804000;">
				<tr><th colspan="2">Medalhas Obtidas</th></tr>
				{foreach from=$medalhas item=medalha key=dbname}
				<tr>
					<td width="60" valign="top" rowspan="2"><div class="award level{$medalha.id}"{if $info_user.id == $user.id}title="{$medalha.title}"{/if}><img src="{$config.cdn}/graphic/awards/{$dbname}.png" /></td>
					<td valign="top"><div><strong>{$cl_awards->get_name($dbname)} {$cl_awards->desc_stage[$medalha.id]}</strong></div></td>
				</tr>
				<tr>
					<td valign="bottom">
						<div style="font-size:7pt; color:#666; margin-top:2px;">{$cl_awards->get_thisStage($dbname,$medalha.id)}</div>
						{if $info_user.id == $user.id}<div style="font-size:7pt; color:#666; margin-top:2px;">&raquo; Próximo nível: {$cl_awards->get_nextStage($dbname,$medalha.id)}</div>{/if}
					</td>
				</tr>
				{/foreach}
			</table><br />
			{if $info_user.id == $user.id}
			<table width="100%" class="vis" style="border:1px solid #804000;">
				<tr><th colspan="2">Medalhas que ainda não foram obtidas</th></tr>
				{foreach from=$medalof item=medalha key=dbname}
				<tr>
					<td width="60" rowspan="2"><div class="award level{$medalha.id}" title="{$medalha.title}"><img src="{$config.cdn}/graphic/awards/dummy.png" /></div></td>
				    <td valign="top"><div><strong>{$cl_awards->get_name($dbname)}</strong></div></td>
				</tr>
				<tr>
					<td valign="bottom">
						<div style="font-size:7pt; color:#666; margin-top:3px;">{$cl_awards->get_description($dbname)}</div>
						<div style="font-size:7pt; color:#666; margin-top:3px;">&raquo; {$cl_awards->get_nextStage($dbname,$medalha.id)}</div>
					</td>
				</tr>
				{/foreach}
			</table>
			{/if}
		</td>
	</tr>
</table>