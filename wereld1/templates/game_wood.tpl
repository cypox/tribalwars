<table>
	<tr>
		<td>
			<img src="{$config.cdn}/graphic/big_buildings/wood1.png" title="Timber camp" alt="" />
		</td>
		<td>
			<h2>
				Timber camp ({$village.wood|stage})
			</h2>
			{$description}
		</td>
	</tr>
</table>
<br />
<table class="vis">
	<tr>
		<td width="200">
			<img src="{$config.cdn}/graphic/holz.png" title="Wood" alt="" />
			Current production
		</td>
		<td>
			<b>{$wood_datas.wood_production}</b>
			Units per minute
		</td>
	</tr>


	{if ($wood_datas.wood_production_next)==false}
			
	{else}

		<tr>
			<td>
				<img src="{$config.cdn}/graphic/holz.png" title="Wood" alt="" />
				Production at ({$village.wood+1|stage})
			</td>

			<td>
	 			<b>{$wood_datas.wood_production_next}</b> Units per minute
        	</td>
		</tr>
    {/if}

</table>