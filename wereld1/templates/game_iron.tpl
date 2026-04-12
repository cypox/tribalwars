<table>
	<tr>
    	<td>
			<img src="{$config.cdn}/graphic/big_buildings/iron1.png" title="Lehmgrube" alt="" />
		</td>   
		<td>
			<h2>Mina de Ferro ({$village.iron|stage})</h2>
       	    {$description}
		</td>
	</tr>
</table>
<table class="vis" width="50%" style="border:1px solid #804000; margin-left:5px;">
	<tr>
		<th width="200"><img src="{$config.cdn}/graphic/icons/iron.png" title="Ferro" alt="" /> Produção atual</th>
		<td><b>{$iron_datas.iron_production} </b> Unidades por minuto</td>
	</tr>
	{if $iron_datas.iron_production_next != false}
	<tr>
		<th><img src="{$config.cdn}/graphic/icons/iron.png" title="Ferro" alt="" /> Produção no ({$village.iron+1|stage})</th>
		<td><b>{$iron_datas.iron_production_next}</b> Unidades por minuto</td>
	</tr>
    {/if}
</table>