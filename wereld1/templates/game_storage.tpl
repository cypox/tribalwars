<table>
	<tr>
		<td>
			<img src="{$config.cdn}/graphic/big_buildings/storage1.png" title="Warehouse" alt="" />
		</td>
		<td>
			<h2>Warehouse ({$village.storage|stage})</h2>
			{$description}
		</td>
	</tr>
</table>
<br />
<table>
	<tr>
		<td width="220">
			Current storage capacity:
		</td>
		<td>
			<b>{$store_datas.storage_size}</b> units per resource
		</td>
	</tr>
	
	{if ($store_datas.storage_size_next)==false}

	{else}

		<tr>
			<td>
				Storage capacity at ({$village.storage+1|stage})
			</td>
			<td>
				<b>{$store_datas.storage_size_next}</b> units per resource
			</td>
		</tr>

    {/if}

</table>
<br />

<table class="vis">
	<tr>
		<th width="150">
			Warehouse full
		</th>
		<th>
			Time (hh:mm:ss)
		</th>
	</tr>
	{if $wood_sec!=0}
		<tr>
			<td width="250">
				<img src="{$config.cdn}/graphic/holz.png" title="Wood" alt="" />
				{$wood_sec_date|format_date}
			</td>
			<td>
				<span class="timer">{$wood_sec|format_time}</span>
			</td>
		</tr>
	{else}
		<tr>
			<td width="250">
				<img src="{$config.cdn}/graphic/holz.png" title="Wood" alt="" />
				Warehouse full
			</td>
			<td class="error">
				0:00:00
			</td>
		</tr>
	{/if}
	{if $stone_sec!=0}
		<tr>
			<td width="250">
				<img src="{$config.cdn}/graphic/lehm.png" title="Clay" alt="" />
				{$stone_sec_date|format_date}
			</td>
			<td>
				<span class="timer">{$stone_sec|format_time}</span>
			</td>
		</tr>
	{else}
		<tr>
			<td width="250">
				<img src="{$config.cdn}/graphic/lehm.png" title="Clay" alt="" />
				Warehouse full
			</td>
			<td class="error">
				0:00:00
			</td>
		</tr>
	{/if}
	{if $iron_sec!=0}
		<tr>
			<td width="250">
				<img src="{$config.cdn}/graphic/eisen.png" title="Iron" alt="" />
				{$iron_sec_date|format_date}
			</td>
			<td>
				<span class="timer">{$iron_sec|format_time}</span>
			</td>
		</tr>
	{else}
		<tr>
			<td width="250">
				<img src="{$config.cdn}/graphic/eisen.png" title="Iron" alt="" />
				Warehouse full
			</td>
			<td class="error">
				0:00:00
			</td>
		</tr>
	{/if}
</table>