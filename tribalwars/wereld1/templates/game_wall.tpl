<table>
	<tr>
		<td>
			<img src="{$config.cdn}/graphic/big_buildings/wall1.png" title="Wall" alt="" />
		</td>
		<td>
			<h2>
				Wall ({$village.wall|stage})
			</h2>
			{$description}
		</td>
	</tr>
</table>
<br />
<table class="vis">
	<tr>
		<td width="200">
			Current
		</td>
		<td width="200">
			<strong>{$wall_datas.basic_defense}</strong>
			Basic defence
		</td>
		<td width="200">
			<strong>{$wall_datas.wall_bonus}%</strong>
			Defence bonus
		</td>
	</tr>

	{if $wall_datas.basic_defense_next}

		<tr>
			<td>
				At ({$village.wall+1|stage})
			</td>
			<td>
				<strong>{$wall_datas.basic_defense_next}</strong>
				Basic defence
			</td>
			<td>
				<strong>{$wall_datas.wall_bonus_next}%</strong>
				Defence bonus
			</td>
		</tr>

    {/if}
    
</table>
