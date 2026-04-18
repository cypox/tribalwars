<h2>Estatat&iacute;sticas do servidor</h2>
<table class="vis" width="100%">
<tr>
	<tr><th>Jogadores:</th><th>{$players}</th></tr>
	<tr><td>Total de aldeias:</td><td>{$villages} ({$villagesPerPlayer} por jogador)</td></tr>
	<tr><td>Aldeias de jogadores:</td><td>{$villagesplay}</td></tr>
	<tr><td>Aldeias barb&aacute;ras:</td><td>{$villagesaband}</td></tr>
        <tr><td>Aldeias b&ocirc;nus:</td><td>Em breve!</td></tr>
</table>
<br><br>
<table class="vis" width="100%">
	<tr><th>Os seguintes valores foram calculados</th><th>Hoje &aacute;s {$time}</th></tr>
	<tr><td>Jogadores online:</td><td>{$online}</td></tr>
	<tr><td>Mensagens enviadas:</td><td>{$mails} ({$mailsPerPlayer} por jogador)</td></tr>
	<tr><td>Mensagens do f&oacute;rum:</td><td>{$forum}</td></tr>
	<tr><td>Movimentos de tropa:</td><td>{$mtrop}</td></tr>
	<tr><td>Movimentos de com&eacute;rcio:</td><td>{$mcom}</td></tr>
	<tr><td>N&uacute;mero de cl&atilde;s:</td><td>{$allys}</td></tr>
	<tr><td>N&uacute;mero de jogadores em cl&atilde;s:</td><td>{$playerallys}</td></tr>
	<tr><td>Total de pontos:</td><td>{$pointsAll|format_number} ({$pointsPerPlayer|format_number} por jogador, {$pointsPerVillage|format_number} por aldeia)</td></tr>
	<tr><td>Total de recursos:</td><td><img src="http://{$config.cdn}/graphic/icons/wood.png" title="Wood" alt="" />{$sum.wood} <img src="http://{$config.cdn}/graphic/icons/stone.png" title="Stone" alt="" />{$sum.stone} <img src="http://{$config.cdn}/graphic/icons/iron.png" title="Iron" alt="" />{$sum.iron} </td></tr>
	<tr><td>Total de habitantes:</td><td><img src="http://{$config.cdn}/graphic/icons/farm.png" title="Worker" alt="" /> {$sum.bh}</td></tr>
	<tr>
		<td>Total de tropas:</td>
		<td>
			<table class="vis" width="100%">
				<tr>{foreach from=$units item=u}<th width="45"><div align="center"><img src="http://{$config.cdn}/graphic/unit/{$u}.png" alt="" /></div></th>{/foreach}</tr>
				<tr>{foreach from=$unitsAll item=unit}<td align="center">{if $unit>0}{$unit|format_number}{else}<span class="hidden">{$unit}</span>{/if}</td>{/foreach}</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>Média de tropas por jogador:</td>
		<td>
			<table class="vis" width="100%">
				<tr>{foreach from=$units item=u}<th width="45"><div align="center"><img src="http://{$config.cdn}/graphic/unit/{$u}.png" alt="" /></div></th>{/foreach}</tr>
				<tr>{foreach from=$unitsPerPlayer item=unit}<td align="center">{if $unit>0}{$unit|ceil}{else}<span class="hidden">{$unit}</span>{/if}</td>{/foreach}</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>Média de tropas por aldeia:</td>
		<td>
			<table class="vis" width="100%">
				<tr>{foreach from=$units item=u}<th width="45"><div align="center"><img src="http://{$config.cdn}/graphic/unit/{$u}.png" alt="" /></div></th>{/foreach}</tr>
				<tr>{foreach from=$unitsPerVillage item=unit}<td align="center">{if $unit>0}{$unit|ceil}{else}<span class="hidden">{$unit}</span>{/if}</td>{/foreach}</tr>
			</table>
		</td>
	</tr>
	<tr><td>Mais novo jogador:</td><td>{$newplayer|entparse}</td></tr>
	<tr><td>Mais novo cl&atilde;:</td><td>{$newally|entparse}</td></tr>
</tr>
</table>