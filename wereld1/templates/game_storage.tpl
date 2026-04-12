<table>
	<tr>
		<td>
			<img src="{$config.cdn}/graphic/big_buildings/storage1.png" title="Speicher" alt="" />
		</td>
		<td>
			<h2>Speicher ({$village.storage|stage})</h2>
			{$description}
		</td>
	</tr>
</table>
<br />
<table>
	<tr>
		<td width="220">
			Aktuelle Speicherkapazität:
		</td>
		<td>
			<b>{$store_datas.storage_size}</b> Einheiten je Rohstoff
		</td>
	</tr>
	
	{if ($store_datas.storage_size_next)==false}

	{else}

		<tr>
			<td>
				Speicherkapazität bei ({$village.storage+1|stage})
			</td>
			<td>
				<b>{$store_datas.storage_size_next}</b> Einheiten je Rohstoff
			</td>
		</tr>

    {/if}

</table>
<br />

<table class="vis">
	<tr>
		<th width="150">
			Speicher voll
		</th>
		<th>
			Zeit (hh:mm:ss)
		</th>
	</tr>
	{if $wood_sec!=0}
		<tr>
			<td width="250">
				<img src="{$config.cdn}/graphic/holz.png" title="Holz" alt="" />
				{$wood_sec_date|format_date}
			</td>
			<td>
				<span class="timer">{$wood_sec|format_time}</span>
			</td>
		</tr>
	{else}
		<tr>
			<td width="250" colspan="2" class="error">
				<img src="{$config.cdn}/graphic/holz.png" title="Holz" alt="" />
				Speicher ist voll. Es können keine weiteren Rohstoffe mehr eingelagert werden!
			</td>
		</tr>
	{/if}
	{if $stone_sec!=0}
		<tr>
			<td width="250">
				<img src="{$config.cdn}/graphic/lehm.png" title="Lehm" alt="" />
				{$stone_sec_date|format_date}
			</td>
			<td>
				<span class="timer">{$stone_sec|format_time}</span>
			</td>
		</tr>
	{else}
		<tr>
			<td width="250" colspan="2" class="error">
				<img src="{$config.cdn}/graphic/lehm.png" title="Lehm" alt="" />
				Speicher ist voll. Es können keine weiteren Rohstoffe mehr eingelagert werden!
			</td>
		</tr>
	{/if}
	{if $iron_sec!=0}
		<tr>
			<td width="250">
				<img src="{$config.cdn}/graphic/eisen.png" title="Eisen" alt="" />
				{$iron_sec_date|format_date}
			</td>
			<td>
				<span class="timer">{$iron_sec|format_time}</span>
			</td>
		</tr>
	{else}
		<tr>
			<td width="250" colspan="2" class="error">
				<img src="{$config.cdn}/graphic/eisen.png" title="Eisen" alt="" />
				Speicher ist voll. Es können keine weiteren Rohstoffe mehr eingelagert werden!
			</td>
		</tr>
	{/if}
</table>