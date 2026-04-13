<table>
	<tr>
   		<td>
			<img src="{$config.cdn}/graphic/big_buildings/hide1.png" title="Warehouse" alt="" />
		</td>
		<td>
			<h2>Hiding place ({$village.hide|stage})</h2>
			{$description}
		</td>
	</tr>
</table>
<table class="vis" style="border:1px solid #804000; margin-left:5px;" width="500">
	<tr>
		<th width="250">Current capacity:</th>
		<td><b>{$hide_datas.max_hide}</b> units per resource</td>
	</tr>
	{if $hide_datas.max_hide_next != false}
	<tr>
		<th>Capacity at ({$village.hide+1|stage})</th>
		<td><b>{$hide_datas.max_hide_next}</b> units per resource</td>
	</tr>
	{/if}
	<tr>
		<th>Plunderable resources:</th>
		<td align="center">
			<img src="{$config.cdn}/graphic/icons/wood.png" title="Wood" alt="" />{$village.r_wood-$hide_datas.max_hide} |
			<img src="{$config.cdn}/graphic/icons/stone.png" title="Clay" alt="" />{$village.r_stone-$hide_datas.max_hide} |
			<img src="{$config.cdn}/graphic/icons/iron.png" title="Iron" alt="" />{$village.r_iron-$hide_datas.max_hide}
		</td>
	</tr>
	<tr><th colspan="2"><div align="center">Offers on the market can be plundered even if the resources fit into your hiding place.</div></th></tr>
</table>