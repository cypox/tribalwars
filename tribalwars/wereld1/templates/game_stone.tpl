<table>
	<tr>
		<td>
			<img src="{$config.cdn}/graphic/big_buildings/stone1.png" title="Clay pit" alt="" />
		</td>
		<td>
			<h2>
				Clay pit ({$village.stone|stage})
			</h2>
			{$description}
		</td>
	</tr>
</table>
<br />
	<table class="vis">
		<tr>
			<td width="200">
				<img src="{$config.cdn}/graphic/lehm.png" title="Clay" alt="" />
				Current production
			</td>
			<td>
				<b>{$stone_datas.stone_production} </b>
				Units per minute
			</td>
		</tr>

		{if ($stone_datas.stone_production_next)==false}

		{else}

			<tr>
				<td>
					<img src="{$config.cdn}/graphic/lehm.png" title="Clay" alt="" />
				Production at ({$village.stone+1|stage})
			</td>
			<td>
				<b>{$stone_datas.stone_production_next}</b>
				Units per minute
			</td>
		</tr>
    {/if}

</table>
