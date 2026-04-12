{if $get.action == "train_mass" && $recruited != array()}
<table>
	<tr>
		<td>
			<h2>Recrutar em massa</h2>
			Nesta visualização você pode produzir qualquer tipo de unidade, desde que todos os requerimentos de tais unidades tenham sido preenchidos (edfícios e tecnologias).
		</td>
	</tr>
</table>
<b>&raquo; Você ordenou os seguintes recrutamentos:</b>
<table class="vis" width="50%">
	<tr>
		<th>Aldeia</th>
		<th>Unidade</th>
	</tr>
	{foreach from=$recruited key=current_village item=single_recruit}
	{php}$this->_tpl_vars['cur_vil_info'] = $GLOBALS['db']->fetch($GLOBALS['db']->query("SELECT * FROM `villages` WHERE `id`='".$this->_tpl_vars['current_village']."'"));{/php}
	<tr>
		<td><a href="game.php?village=395&amp;screen=info_village&amp;id=395">{$cur_vil_info.name|entparse} ({$cur_vil_info.x}|{$cur_vil_info.y}) K{$cur_vil_info.continent}</a></td>
		<td>{foreach from=$single_recruit key=single_unit item=single_count}<img title="{$cl_units->get_name($single_unit)}" src="{$config.cdn}/graphic/unit/unit_{$cl_units->get_graphicName($single_unit)}.png"/>{$single_count}{/foreach}</td>
	</tr>
	{/foreach}
</table>
<a href="game.php?village={$village.id}&amp;screen=train&amp;mode=mass">&raquo; Voltar</a>
{else}
<script type='text/javascript'>
{if $get.mode=="mass"}
	var trainManagers=new Array();
{/if}
{literal}
	function trainManager(){
		this.arrc = 0;
		this.village = false;

		this.v_wood = 0;
		this.v_stone = 0;
		this.v_iron = 0;

		this.name = new Array();
		this.wood = new Array();
		this.iron = new Array();
		this.stone = new Array();
		this.bh = new Array();
		this.maxs = new Array();
		this.arrc = 0;
		this.freebh = 0;

		this.price = new Array();

		this.price["wood"] = new Array();
		this.price["iron"] = new Array();
		this.price["stone"] = new Array();
		this.price["bh"] = new Array();

		this.setNumber = function (name,count){
			if(!this.village)
				var element = document.getElementsByName(name);
			else
				var element = document.getElementsByName("units["+this.village+"]["+name+"]");
			if(!element[0].value || element[0].value == "")
				element[0].value = 0;
			element[0].value = Number(parseInt(element[0].value))+Number(count);
		}; 
		this.setVillage = function(setvil){
			this.village = setvil;
		};
		this.reset = function(name){
			if(!this.village)
				var element = document.getElementsByName(name);
			else
				var element = document.getElementsByName("units["+this.village+"]["+name+"]");
			if(!element[0].value || element[0].value == "")
				element[0].value = 0;
			element[0].value = 0;
		};
		this.fetchMax = function(name){
			var id;
			for(var tid=0;tid<this.arrc;tid++){
				if(this.name[tid] == name){
					id = tid;
					break;
				}
			}
			if(this.maxs[id] == null)
				return 0;
			return this.maxs[id];
		};
		this.addUnit = function(name,wood,iron,stone,bh){
			this.name[this.arrc] = name;
			this.wood[this.arrc] = wood;
			this.iron[this.arrc] = iron;
			this.stone[this.arrc] = stone;
			this.bh[this.arrc] = bh;

			this.price["wood"][this.arrc] = 0;
			this.price["iron"][this.arrc] = 0;
			this.price["stone"][this.arrc] = 0;
			this.price["bh"][this.arrc] = 0;

			this.arrc++;
		};
		this.setBh = function(bh){
			this.freebh = bh;
		};
		this.setRessis = function(wood,iron,stone){
			this.v_wood = wood;
			this.v_iron = iron;
			this.v_stone = stone;
		};
		this.getUsedRess = function(name){
			var out = 0;
			for(var c=0;c<this.arrc;c++){
				if(name == "wood")
					out += this.price['wood'][c];
				else if(name == "iron")
					out += this.price['iron'][c];
				else if(name == "stone")
					out += this.price['stone'][c];
				else if(name == "bh")
					out += this.price['bh'][c];
			}
			return out;
		};
		this.reCalcAll = function(){
			for(var c=0;c<this.arrc;c++){
				this.reCalc(this.name[c]);
			}
		};
		this.tick = function(){
			this.reCalcAll();
		};
		this.reCalc = function(name){
			if(!this.village)
				var max = document.getElementsByName(name);
			else
				var max = document.getElementsByName('units['+this.village+']['+name+']');
				var max = parseInt(max[0].value);

			if(!max)
				max = 0;

			var id = 0;
			for(var tid=0;tid<this.arrc;tid++){
				if(this.name[tid] == name){
					id = tid;
					break;
				}
			}

			var wood = this.wood[id];
			var iron = this.iron[id];
			var stone = this.stone[id];
			var bh = this.bh[id];

			var c_wood = this.v_wood;
			var c_iron = this.v_iron;
			var cstone = this.v_stone;

			var bonus_wood = max*wood;
			var bonus_iron = max*iron;
			var bonus_stone = max*stone;
			var bonus_bh = max*bh;

			if(!this.village)
				var link = document.getElementById(name+"_0_a");
			else
				var link = document.getElementById(name+"_"+this.village+"_a");

			this.price["wood"][id] = bonus_wood;
			this.price["iron"][id] = bonus_iron;
			this.price["stone"][id] = bonus_stone;
			this.price["bh"][id] = bonus_bh;

			var calc_wood = (c_wood-this.getUsedRess("wood"))/wood;
			var calc_iron = (c_iron-this.getUsedRess("iron"))/iron;
			var calc_stone = (cstone-this.getUsedRess("stone"))/stone;
			var calc_bh = (this.freebh-this.getUsedRess("bh"))/bh;

			var new_value = Math.floor(Math.min(calc_wood,calc_iron,calc_stone,calc_bh));
			if(!isNaN(new_value) && new_value >= 0){
{/literal}
{if $get.mode=="mass"}
				link.href = 'javascript:trainManagers['+this.village+'].setNumber("'+name+'","'+new_value+'")';
{else}
				link.href = 'javascript:trainManager.setNumber("'+name+'","'+new_value+'")';
{/if}
{literal}

				this.maxs[id] = new_value;
{/literal}
				{if $get.mode=="mass"}new_value = "("+new_value+")";{/if}
{literal} 

				link.firstChild.wholeText = new_value;
				link.firstChild.nodeValue = new_value;
			}else if(new_value < 0){
{/literal}
				{if $get.mode=="mass"}new_value = "("+new_value+")";{/if}
{literal} 
				link.firstChild.wholeText = 0;
				link.firstChild.nodeValue = 0;
				this.maxs[id] = 0;
				link.href = 'javascript:trainManager.setNumber("'+name+'","0")';
			}
		};
	};
{/literal}
</script>
{if $get.mode != "mass"}
{php}
	$tmp = new getvillagedata();
	$this->_tpl_vars['cur_vil_inf'] = $tmp->getbyid($this->_tpl_vars['village']['id'],array("farm","r_bh","r_wood","r_iron","r_stone"));
    $tmp_farm = $this->_tpl_vars['cur_vil_inf']['farm'];
    $this->_tpl_vars['cur_vil_inf']['farmLimits'] = $this->_tpl_vars['arr_farm'][$tmp_farm]-$this->_tpl_vars['cur_vil_inf']['r_bh'];
{/php}
<script type="text/javascript">
    trainManager = new trainManager;
	trainManager.setBh({$cur_vil_inf.farmLimits});
	trainManager.setRessis({$cur_vil_inf.r_wood},{$cur_vil_inf.r_iron},{$cur_vil_inf.r_stone});
</script>
<table width="100%">
	<tr>
		<td>
			<h2>Recrutar</h2>
			Nesta visualização você pode produzir qualquer tipo de unidade, desde que todos os requerimentos de tais unidades tenham sido preenchidos (edfícios e tecnologias).
		</td>
	</tr>
</table><br />
	{if count($recruit_units)>0}
<table class="vis" width="100%">
	<tr>
		<th width="150">Unidade</th>
		<th width="120">Duração</th>
		<th width="150">Término</th>
		<th width="100">Cancelar *</th>
	</tr>
		{foreach from=$recruit_units key=key item=value}
    <tr {if $recruit_units.$key.lit}class="lit"{/if}>
		<td>{$recruit_units.$key.num_unit} {$cl_units->get_name($recruit_units.$key.unit)}</td>
			{if $recruit_units.$key.lit && $recruit_units.$key.countdown>-1}
		<td><span class="timer">{$recruit_units.$key.countdown|format_time}</span></td>
			{else}
	   	<td>{$recruit_units.$key.countdown|format_time}</td>
			{/if}
		<td>{$recruit_units.$key.time_finished|format_date}</td>
		<td><a href="game.php?village={$village.id}&amp;screen=train&amp;action=cancel&amp;id={$key}&amp;h={$hkey}">cancelar</a></td>
    </tr>
		{/foreach}
</table>
<div style="font-size: 7pt;">* (Apenas 90% dos recursos serão devolvidos!)</div><br />
	{/if}
	{if !empty($error)}<div class="error">{$error}</div>{/if}
<table class="vis">
	<tr>
		<td {if $mode==''}class="selected"{/if}><a href="game.php?village={$village.id}&amp;screen=train">{if $mode==''}&raquo; {/if}Recrutar</a></td>
		<td {if $mode=='mass'}class="selected"{/if}><a href="game.php?village={$village.id}&amp;screen=train&amp;mode=mass">{if $mode=='mass'}&raquo; {/if}Recrutamento em massa</a></td>
	</tr>
</table>
<form action="game.php?village={$village.id}&screen=train&action=train&h={$hkey}" id="train_form" method="post">
	<table class="vis" width="100%">
		<tr>
			<th width="200">Unidade</th>
			<th><center><img src="{$config.cdn}/graphic/icons/wood.png"></center></th>
			<th><center><img src="{$config.cdn}/graphic/icons/stone.png"></center></th>
			<th><center><img src="{$config.cdn}/graphic/icons/iron.png"></center></th>
			<th><center><img src="{$config.cdn}/graphic/icons/farm.png"></center></th>
			<th class="nowrap" width="120">Duração</th>
			<th class="nowrap">Recrutar</th>
			<th>Recrutar</th>
		</tr>
		{foreach from=$units item=currentunit}
			{$cl_units->check_needed($currentunit,$village)}
			{if is_numeric($cl_units->last_error)}
			<script type="text/javascript">trainManager.addUnit('{$currentunit}',{$cl_units->get_woodprice($currentunit)},{$cl_units->get_stoneprice($currentunit)},{$cl_units->get_ironprice($currentunit)},{$cl_units->get_bhprice($currentunit)});</script>
		<tr class="row_a">
			<td class="nowrap"><a href="javascript:popup('popup_unit.php?unit={$currentunit}', 520, 520)" class="unit_link" onclick=""><img src="{$config.cdn}/graphic/unit/{$currentunit}.png?1" align="absmiddle" alt="" />{$cl_units->get_name($currentunit)}</a></td>
			<td class="nowrap" align="center">{$cl_units->get_woodprice($currentunit)}</td>
			<td class="nowrap" align="center">{$cl_units->get_stoneprice($currentunit)}</td>
			<td class="nowrap" align="center">{$cl_units->get_ironprice($currentunit)}</td>
			<td class="nowrap" align="center">{$cl_units->get_bhprice($currentunit)}</td>
			<td>{$cl_units->get_time($village.barracks,$currentunit)|format_time}</td>
			<td>{$units_in_village.$currentunit}/{$units_all.$currentunit}</td>
			<td class="nowrap"><input name="{$currentunit}"  id="{$currentunit}_0" type="text" size="5" maxlength="5" tabindex="1"/><a id="{$currentunit}_0_a" onmouseover='trainManager.reCalc("{$currentunit}")'  href='javascript:trainManager.setNumber("{$currentunit}","{$cl_units->last_error}")'>{$cl_units->last_error}</a></td>
		</tr>
        	{/if}
		{/foreach}
		<script type='text/javascript'>{if $get.mode!="mass"}window.setInterval("trainManager.tick()", 1000);{/if}</script>
		<tr><th colspan="8"><div align="right"><input type="submit" value="Recrutar" class="button" /></div></th></tr>
	</table>
</form>
{else}
<table>
	<tr>
		<td>
			<h2>Recrutar em massa</h2>
			<p>Nesta visualização você pode produzir qualquer tipo de unidade, desde que todos os requerimentos de tais unidades tenham sido preenchidos (edfícios e tecnologias).</p>
		</td>
	</tr>
</table><br />
<form method="post" action="#" id="mr_all_form">
	<table width="100%" class="vis">
	    <tr>{foreach from=$units item=currentunit}<th width="35" style="text-align:center"><img title="{$cl_units->get_name($currentunit)}" src="{$config.cdn}/graphic/unit/unit_{$cl_units->get_graphicName($currentunit)}.png"></th>{/foreach}</tr>
		<tr>{foreach from=$units item=currentunit}<td align="center"><input type="text" size="3" class="unit_input_field" id="unit_input_{$currentunit}"  value="0"></td>{/foreach}</tr>
	</table>
</form>
<script type="text/javascript">
{literal}
	function filler(arg1){
		var units = new Array();
		var vals = new Array();
		var c = 0;
		var buffer,elem,link;
	{/literal}
	{foreach from=$units item=currentunit}
		units[c] = "{$currentunit}";
		c++;
	{/foreach}
	{literal}
		for(var c=0;c<units.length;c++){
			buffer = "unit_input_"+units[c];
			elem = document.getElementById(buffer);
			vals[c] = elem.value;
		}
		for(var i in trainManagers){
			for(var c=0;c<units.length;c++){
				if(arg1 == false){
					trainManagers[i].reset(units[c]);
					trainManagers[i].setNumber(units[c],vals[c]);
				}else{
					trainManagers[i].setNumber(units[c],trainManagers[i].fetchMax(units[c]));
				}
			}
		}
	}
{/literal}
   </script>
<div style="text-align:center">
	<input type="button" value="Inserir tropas" onclick="return filler(false);" class="button" alt="" />
	<input type="button" value="Inserir máximo" onclick="return filler(true);" class="button" alt="" />
</div>
{if !empty($error)}<div class="error">{$error}</div>{/if}
<table class="vis">
	<tr>
		<td {if $mode==''}class="selected"{/if}><a href="game.php?village={$village.id}&amp;screen=train">{if $mode==''}&raquo; {/if}Recrutar</a></td>
		<td {if $mode=='mass'}class="selected"{/if}><a href="game.php?village={$village.id}&amp;screen=train&amp;mode=mass">{if $mode=='mass'}&raquo; {/if}Recrutamento em massa</a></td>
	</tr>
</table>
<form method="post" action="game.php?village={$village.id}&amp;screen=train&amp;mode=mass&amp;group=0&amp;action=train_mass&amp;h={$hkey}&amp;site={$get.site}" id="mass_train_form">
	<table class="vis" width="100%">
		<tr>
			<th width="100%">Aldeias ({php} echo count($this->_tpl_vars['villages']); {/php})</th>
			<th><center><img src="{$config.cdn}/graphic/icons/wood.png"></center></th>
			<th><center><img src="{$config.cdn}/graphic/icons/stone.png"></center></th>
			<th><center><img src="{$config.cdn}/graphic/icons/iron.png"></center></th>
			<th><center><img src="{$config.cdn}/graphic/icons/farm.png"></center></th>
			{foreach from=$units item=currentunit}<th width="35" style="text-align:center"><img title="{$cl_units->get_name($currentunit)}" src="{$config.cdn}/graphic/unit/unit_{$cl_units->get_graphicName($currentunit)}.png?1"></th>{/foreach}
		</tr>
		{foreach from=$villages item=currentvillage}
{php}
	$this->_tpl_vars['cur_vil_inf'] = $GLOBALS['db']->fetch($GLOBALS['db']->query("SELECT * FROM `villages` WHERE `id`='".$this->_tpl_vars['currentvillage']."'"));
	$tmp_farm = $this->_tpl_vars['cur_vil_inf']['farm'];
	$this->_tpl_vars['cur_vil_inf']['farmLimits'] = $this->_tpl_vars['arr_farm'][$tmp_farm]-$this->_tpl_vars['cur_vil_inf']['r_bh'];
{/php}
		<script type="text/javascript">
			trainManagers[{$currentvillage}]=new trainManager;
			trainManagers[{$currentvillage}].setVillage({$currentvillage});
			trainManagers[{$currentvillage}].setBh({$cur_vil_inf.farmLimits});
			trainManagers[{$currentvillage}].setRessis({$cur_vil_inf.r_wood},{$cur_vil_inf.r_iron},{$cur_vil_inf.r_stone});
			window.setInterval("trainManagers[{$currentvillage}].tick()",1000);
		</script>
		<tr class="row_a selected">
			<td><a href="game.php?village={$currentvillage}&amp;screen=overview">{php}echo urldecode($this->_tpl_vars['cur_vil_inf']['name']);{/php} ({$cur_vil_inf.x}|{$cur_vil_inf.y}) K{$cur_vil_inf.continent}</a></td>
			<td style="white-space:nowrap; text-align:center;">{$cur_vil_inf.r_wood|round}</td>
			<td style="white-space:nowrap; text-align:center;">{$cur_vil_inf.r_stone|round}</td>
			<td style="white-space:nowrap; text-align:center;">{$cur_vil_inf.r_iron|round}</td>
			<td align="center">{$cur_vil_inf.r_bh}/<br />{php} echo $this->_tpl_vars['farmLimits'][$this->_tpl_vars['cur_vil_inf']['farm']];{/php}</td>
			{foreach from=$units item=currentunit}	
				{$cl_units->check_needed($currentunit,$cur_vil_inf)}
				{if not is_numeric($cl_units->last_error)}{php}$this->_tpl_vars['cl_units']->last_error=-1;{/php}{/if}						
			<td align="center">
				<div style="white-space:nowrap; margin-bottom: 3px;">
					{php}$this->_tpl_vars['prod_tmp'] = $this->_tpl_vars['in_prod'][$this->_tpl_vars['cur_vil_inf']['id']];{/php}
						{if not $prod_tmp.$currentunit}
					<a href="game.php?village={$village.id}&amp;screen=train"><span class="dot brown"></a>
						{else}
					<a href="game.php?village={$village.id}&amp;screen=train"><span class="dot green"></a>
						{/if}
				</div>
				<input type="text" tabindex="" size="3" onmouseover='trainManagers[{$currentvillage}].reCalcAll()' name="units[{$currentvillage}][{$currentunit}]" id="{$currentunit}_{$currentvillage}"><br />
						{if $cl_units->last_error!=-1} 
				<a href='javascript:trainManagers[{$currentvillage}].setNumber("{$currentunit}","{$cl_units->last_error}")' id="{$currentunit}_{$currentvillage}_a">({$cl_units->last_error})</a>
				<script type='text/javascript'>trainManagers[{$currentvillage}].addUnit("{$currentunit}",{$cl_units->get_woodprice($currentunit)},{$cl_units->get_ironprice($currentunit)},{$cl_units->get_stoneprice($currentunit)},{$cl_units->get_bhprice($currentunit)});</script>
						{else}
				<div><br /></div>
						{/if}
			</td>
			{/foreach}
		</tr>
		{/foreach}
		<tr><th colspan="15"><div align="right"><input type="submit" value="Recrutar" class="button" /></div></th></tr>
	</table>
	<div align="center">
    {section name=show_sites start=1 loop=$sites+1 step=1}
	    {if $smarty.section.show_sites.index != $get.site}
			<a href='game.php?village={$village.id}&screen=train&mode=mass&site={$smarty.section.show_sites.index}'>[{$smarty.section.show_sites.index}]</a>
    	{else}
			<b>>{$smarty.section.show_sites.index}<</b>
	    {/if}
    {/section}
	</div>
</form>
	{/if}
{/if}
