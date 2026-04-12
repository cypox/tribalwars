<table>
	<tr>
		<td>
			<img src="{$config.cdn}/graphic/big_buildings/stone1.png" title="Lehmgrube" alt="" />
		</td>
		<td>
			<h2>
				Lehmgrube ({$village.stone|stage})
			</h2>
			{$description}
		</td>
	</tr>
</table>
<br />
	<table class="vis">
		<tr>
			<td width="200">
				<img src="{$config.cdn}/graphic/lehm.png" title="Lehm" alt="" />
				Aktuelle Produktion
			</td>
			<td>
				<b>{$stone_datas.stone_production} </b>
				Einheiten pro Minute
			</td>
		</tr>

		{if ($stone_datas.stone_production_next)==false}

		{else}

			<tr>
				<td>
					<img src="{$config.cdn}/graphic/lehm.png" title="Lehm" alt="" />
				Produktion bei ({$village.stone+1|stage})
			</td>
			<td>
				<b>{$stone_datas.stone_production_next}</b>
				Einheiten pro Minute
			</td>
		</tr>
    {/if}

</table>
