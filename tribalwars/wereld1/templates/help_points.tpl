<h3>Points</h3>
<p>You receive points for completing buildings. As soon as a building finishes, points and ranking are recalculated (some calculations may be delayed to reduce server load). Research and units do not grant points.</p>

<p>Total points for each building level are shown below.</p>

<table class="vis">
	<tr>
		<th>Level</th>
		{foreach from=$builds item=f_dbname key=f_id}
			<th><img src="graphic/buildings/{$f_dbname}.png"></th>
		{/foreach}
	</tr>
		{section name=foo start=1 loop=$max_stage+1 step=1}
			<tr>
				<td>{$smarty.section.foo.index}</td>
				{foreach from=$builds item=f_dbname key=f_id}
					{if $cl_builds->get_maxstage($f_dbname)<$smarty.section.foo.index}
						<td></td>
					{else}
						<td>{$cl_builds->get_points($f_dbname,$smarty.section.foo.index)}</td>
					{/if}
				{/foreach}
			</tr>
		{/section}
</table>
