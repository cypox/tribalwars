<table>
	<tr>
    	<td>
			<img src="{$config.cdn}/graphic/big_buildings/iron1.png" title="Iron mine" alt="" />
		</td>   
		<td>
			<h2>Iron mine ({$village.iron|stage})</h2>
       	    {$description}
		</td>
	</tr>
</table>
<table class="vis" width="50%" style="border:1px solid #804000; margin-left:5px;">
	<tr>
		<th width="200"><img src="{$config.cdn}/graphic/icons/iron.png" title="Iron" alt="" /> Current production</th>
		<td><b>{$iron_datas.iron_production} </b> Units per minute</td>
	</tr>
	{if $iron_datas.iron_production_next != false}
	<tr>
		<th><img src="{$config.cdn}/graphic/icons/iron.png" title="Iron" alt="" /> Production at ({$village.iron+1|stage})</th>
		<td><b>{$iron_datas.iron_production_next}</b> Units per minute</td>
	</tr>
    {/if}
</table>