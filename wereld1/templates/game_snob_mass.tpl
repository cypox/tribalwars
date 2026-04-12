{php}$snob_limit = $this->_tpl_vars['snobLimit'];{/php}
<script type="text/javascript">
function max_gold(){ldelim}
	var zahl = 0;
	while(document.getElementsByName("anzahl[]")[zahl]){ldelim}
		document.getElementsByName("anzahl[]")[zahl].value = document.getElementsByName("max_gold[]")[zahl].value;
		zahl++;
	{rdelim}
{rdelim}
</script>
<table width="100%" class="vis" cellpadding="1" cellspacing="2" border="0">
	<tr align="left">
		<th>Aldeia</th>
		<th>Recursos</th>
		<th>Quantidade</th>
	</tr>
	<form action="game.php?village={$village.id}&amp;screen=snob&amp;mode=mass&amp;action=mass" method="post">
	{foreach from=$villages item=arr key=id}
	<tr align="left">
		<td><a href="game.php?village={$village.id}&amp;screen=info_village&amp;id={$id}">{$arr.name}</a></td>
		<td><a href="game.php?village={$village.id}&screen=overview">{$village.name} ({$village.x}|{$village.y}) K{$village.continent}</a></td>
		<td>
			<img src="../graphic/icons/wood.png" alt="">{$village.r_wood} 
			<img src="../graphic/icons/stone.png" alt="">{$village.r_stone} 
			<img src="../graphic/icons/iron.png" alt="">{$village.r_iron}
		</td>
		<td>
			<input type="hidden" value="{$village.id}" name="vill_id[]" />
			<input type="hidden" value="{$snobLimit}" name="snoblimit[]" />
			<select name="anzahl[]" width="100%">
				<option value="0">- keine -</option>
{php}
	$count = 1;
	while(true){
		$wood = $this->_tpl_vars['holz']*$count;
		$stone = $this->_tpl_vars['lehm']*$count;
		$iron = $this->_tpl_vars['eisen']*$count;
		if($this->_tpl_vars['village']['r_wood'] > $wood && $this->_tpl_vars['village']['r_stone'] > $stone && $this->_tpl_vars['village']['r_iron'] > $iron){
{/php}
				<option value="{php}echo $count;{/php}">{php}echo $count;{/php}x ({php}echo $wood;{/php}, {php}echo $stone;{/php}, {php}echo $iron;{/php})</option>
{php}
		}else{
			break;
		}
		$count++;
	}
{/php}
			</select>
			<input type="hidden" value="{php}echo $count-1;{/php}" name="max_gold[]" />
		</td>
	</tr>
	{/foreach}
	<tr>
		<th colspan="2"><input type="submit" value="Cunhar moedas &raquo;" class="button" /></th>
		<th><a href="javascript:max_gold()">&raquo; Máximo</a></th>
	</tr>
</table>