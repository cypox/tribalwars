<table cellspacing="0" cellpadding="0" width="100%">
	<tr>
<td valign="top">
	<table class="vis" width="100%" style="margin-bottom:3px; border-spacing:1px;">
		<tr>
			<th width="50%"><div align="center"><a href="javascript:void(0);" onclick="changeView();" id="show_level">{$lang->get("buildinglevels")}</a></div></th>
			<th width="50%"><div align="center"><a href="game.php?village={$village.id}&amp;screen=overview&amp;action=set_visual&amp;visual=0&amp;h={$hkey}">{$lang->get("graphicshide")}</a></div></th>
		</tr>
		<tr>
			<td colspan="2">
				<div style="position:relative">
					<img width="600" height="418" src="{$config.cdn}/graphic/{$visual}/back_none.jpg" alt="" />
					<img class="p_church" src="{$config.cdn}/graphic/{$visual}/church_disabled.png" alt="" />
					<img class="npc_farmer" src="{$config.cdn}/graphic/{$visual}/farmer.gif" alt="" />
					{if rand(0,5) == '1'}<img class="npc_guard" src="{$config.cdn}/graphic/{$visual}/guard.gif" alt="" />{/if}
					{if rand(0,5) == '2'}<img class="npc_conversation" src="{$config.cdn}/graphic/{$visual}/conversation.gif" alt="" />{/if}
					{if rand(0,5) == '4'}<img class="npc_juggler" src="{$config.cdn}/graphic/{$visual}/juggler.gif" alt="" />{/if}
					{foreach from=$built_builds item=dbname key=id}
						{if $dbname == 'main'}
							{if $village.main < '5'}
								<img class="p_main_flag" src="{$config.cdn}/graphic/{$visual}/mainflag1.gif" />
							{elseif $village.main >= '5' && $village.main < '15'}
								<img class="p_main_flag" src="{$config.cdn}/graphic/{$visual}/mainflag2.gif" />
							{elseif $village.main >= '15'}
								<img class="p_main_flag" src="{$config.cdn}/graphic/{$visual}/mainflag3.gif" />
							{/if}
						{elseif $dbname == 'farm'}
							{if $village.farm >= '20'}<img class="p_farm_field" src="{$config.cdn}/{$cl_builds->getGraphic($dbname, $village.farm)|regex_replace:'/\.png$/':'_field.png'}" alt="" />{/if}
						{elseif $dbname == 'smith'}
							{if $village.smith > 0}
								{if $smithResearchActive}
					<img class="smith_anim" src="{$config.cdn}/graphic/{$visual}/smith_anim.gif" alt="" />
								{/if}
							{/if}
						{/if}
                        
					<a href="game.php?village={$village.id}&screen={$dbname}"><img class="p_{$dbname}" src="{$config.cdn}/{$cl_builds->getGraphic($dbname, $village.$dbname)}" /></a>
					{/foreach}
					<img class="empty" src="{$config.cdn}/graphic/map/empty.png" alt="" usemap="#map" />
					<map name="map" id="map">
					{foreach from=$built_builds item=dbname key=id}
						<area shape="poly" coords="{$cl_builds->get_graphicCoords($dbname)}" href="game.php?village={$village.id}&amp;screen={$dbname}" alt="{$cl_builds->get_name($dbname)}" title="{$cl_builds->get_name($dbname)}" />
					{/foreach}
					</map>
					{foreach from=$constructing key=dbname item=res_time}
						{if $village.$dbname <= '0'}
					<img class="p_{$dbname}" src="{$config.cdn}/graphic/{$visual}/{$dbname}0.gif" />
					<div id="label_{$dbname}" class="l_{$dbname}" title="{$cl_builds->get_name($dbname)}">
						<div class="{$labelClass}">
							<span style="font-size:7px; font-weight:bold">
								<span class="timer">{$res_time|format_time}</span>
							</span>
						</div>
					</div>
						{/if}
					{/foreach}
					{foreach from=$built_builds item=dbname key=id}
					<div class="l_{$dbname}" id="label_{$dbname}">
						<div class="label">
							<a href="game.php?village={$village.id}&amp;screen={$dbname}"><img src="{$config.cdn}/graphic/overview/{$dbname}.png" class="middle" alt="{$cl_builds->get_name($dbname)}" /> {$village.$dbname}</a><br /><span style="font-size:7px; font-weight:bold">{$villageOverviewDatas->get($dbname)}</span>
						</div>
					</div>
					{/foreach}
					<script type="text/javascript">overviewShowLevel();</script>
				</div>
			</td>
		</tr>
	</table>
	{if count($other_movements)>0}
    <form name="rename" onkeydown="if(event.keyCode==13){ldelim}$(this).next().click(); return false;{rdelim}">
        <table class="vis" width="100%" style="margin-bottom:3px; border-spacing:1px;">
            <tr><th colspan="5">&raquo; {$lang->get("binnenkomend")}</th></tr>
            <tr>
                <th width="250" colspan="3">{$lang->get("herkomst")}</th>
                <th width="160">{$lang->get("duur")}</th>
                <th width="100">{$lang->get("aankomst")}</th>
            </tr>
            {foreach from=$other_movements item=array}
                <tr>
                    <th width="10"><div align="center"><img src="{$config.cdn}/graphic/command/{$array.type}.png"></div></th>
                    <th width="10"><div class="rename-icon" title="Renomear" style="cursor:pointer;" onclick="openrename({$array.id})"></div></th>
                    <td>
                        <div id="mov_{$array.id}" style="display:block;"><a href="game.php?village={$village.id}&amp;screen=info_command&amp;id={$array.id}&amp;type=other"><span id="ren_{$array.id}">{$array.message}</span></a></div>
                        <div id="inp_{$array.id}" style="display:none;">
                            <input type="text" name="rename_{$array.id}" id="rename_{$array.id}" value="{$array.message}" onkeydown="if(event.keyCode==13){ldelim}renamemovs('rename_{$array.id}','{$user.id}','{$village.id}','to_user','{$array.id}',this.form.rename_{$array.id}.value){rdelim}" />
                            <input type="button" onclick="renamemovs('rename_{$array.id}','{$user.id}','{$village.id}','to_user','{$array.id}',this.form.rename_{$array.id}.value)" value="Ok" class="button" />
                        </div>
                    </td>
                    <td>{$array.end_time|format_date}</td>
                    {if $array.arrival_in< 0}
                        <td>{$array.arrival_in|format_time}</td>
                    {else}
                        <td><span class="timer">{$array.arrival_in|format_time}</span></td>
                    {/if}
                </tr>
            {/foreach}
        </table>
    </form>
	{/if}
    {if count($my_movements)>0}
    <form name="rename" onkeydown="if(event.keyCode==13){ldelim}$(this).next().click(); return false;{rdelim}">
        <table class="vis" width="100%">
            <tr><th colspan="6">&raquo;{$lang->get("troepenbeweging")}</th></tr>
            <tr>
                <th width="230" colspan="3">{$lang->get("commando")}</th>
                <th width="160">{$lang->get("duur")}</th>
                <th width="100">{$lang->get("aankomst")}</th>
                <th width="10"></th>
            </tr>
            {foreach from=$my_movements item=array}
                <tr>
                    <th width="10"><div align="center"><img src="{$config.cdn}/graphic/command/{$array.type}.png"></div></th>
                    <th width="10"><div class="rename-icon" title="Renomear" style="cursor:pointer;" onclick="openrename({$array.id})"></div></th>
                    <td>
                        <div id="mov_{$array.id}" style="display:block;"><a href="game.php?village={$village.id}&amp;screen=info_command&amp;id={$array.id}&amp;type=other"><span id="ren_{$array.id}">{$array.message}</span></a></div>
                        <div id="inp_{$array.id}" style="display:none;">
                            <input type="text" name="rename_{$array.id}" id="rename_{$array.id}" value="{$array.message}" onkeydown="if(event.keyCode==13){ldelim}renamemovs('rename_{$array.id}','{$user.id}','{$village.id}','from_user','{$array.id}',this.form.rename_{$array.id}.value){rdelim}" />
                            <input type="button" onclick="renamemovs('rename_{$array.id}','{$user.id}','{$village.id}','from_user','{$array.id}',this.form.rename_{$array.id}.value)" value="Ok" class="button" />
                        </div>
                    </td>
                    <td>{$array.end_time|format_date}</td>
                    {if $array.arrival_in<0}<td{if !$array.can_cancel} colspan="2"{/if}>{$array.arrival_in|format_time}</td>{else}<td{if !$array.can_cancel} colspan="2"{/if}><span class="timer">{$array.arrival_in|format_time}</span></td>{/if}
                    {if $array.can_cancel}
                        <td width="10"><a href="game.php?village={$village.id}&amp;screen=place&amp;action=cancel&amp;id={$array.id}&amp;h={$hkey}"><div class="button red">X</div></a></td>
                    {/if}
                </tr>
            {/foreach}
        </table>
    </form>
    {/if}
</td>


		<td valign="top" width="100%">
	<table class="vis" width="100%" style="margin-bottom:3px; border-spacing:1px;">
		<tr><th colspan="3">Production</th></tr>
		<tr>
			<th width="10"><img src="{$config.cdn}/graphic/holz.png" title="Wood" alt="" /></th>
			<td>Wood: <b>{$wood_prod_overview}</b> per {if $config.speed > 10}minute{else}hour{/if}</td>
		</tr>
		<tr>
			<th><img src="{$config.cdn}/graphic/lehm.png" title="Clay" alt="" /></th>
			<td>Clay: <b>{$stone_prod_overview}</b> per {if $config.speed > 10}minute{else}hour{/if}</td>
		</tr>
		<tr>
			<th><img src="{$config.cdn}/graphic/eisen.png" title="Iron" alt="" /></th>
			<td>Iron: <b>{$iron_prod_overview}</b> per {if $config.speed > 10}minute{else}hour{/if}</td>
		</tr>
	</table>






	{if count($in_village_units)>0}
	<table class="vis" width="100%" style="margin-bottom:3px; border-spacing:1px;">
		<tr><th colspan="2">{$lang->get("troepen")}</th></tr>
		{foreach from=$in_village_units item=num key=dbname}
		<tr>
			<th width="10"><img src="{$config.cdn}/graphic/unit/{$dbname}.png"></th>
{if $dbname == 'unit_knight'}
<td> <a href="javascript:popup('popup_unit.php?unit={$dbname}', 520, 520)">{$user.knightname}</a></td>

{else}
			<td><b>{$num}</b> <a href="javascript:popup('popup_unit.php?unit={$dbname}', 520, 520)">{$cl_units->get_name($dbname)}</a></td>
{/if}	
	</tr>
		{/foreach}
	</table>
	{/if}

			{if $village.agreement!=100}
			<table class="vis" width="100%" style="margin-bottom:3px; border-spacing:1px;">
				<tr><th>{$lang->get("toestemming")}:</th><th>{$village.agreement}</th></tr>
			</table>
			{/if}
</td>
	</tr>
</table>
