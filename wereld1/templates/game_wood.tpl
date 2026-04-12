<table>
	<tr>
		<td>
			<img src="{$config.cdn}/graphic/big_buildings/wood1.png" title="Holzfäller" alt="" />
		</td>
		<td>
			<h2>
				Holzfäller ({$village.wood|stage})
			</h2>
			{$description}
		</td>
	</tr>
</table>
<br />
<table class="vis">
	<tr>
		<td width="200">
			<img src="{$config.cdn}/graphic/holz.png" title="Holz" alt="" />
			Aktuelle Produktion
		</td>
		<td>
			<b>{$wood_datas.wood_production}</b>
			Einheiten pro Minute
		</td>
	</tr>


	{if ($wood_datas.wood_production_next)==false}
			
	{else}

		<tr>
			<td>
				<img src="{$config.cdn}/graphic/holz.png" title="Holz" alt="" />
				Produktion bei ({$village.wood+1|stage})
			</td>

			<td>
  				<b>{$wood_datas.wood_production_next}</b> Einheiten pro Minute
        	</td>
		</tr>
    {/if}

</table>