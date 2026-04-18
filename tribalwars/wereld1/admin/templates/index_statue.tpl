{if $reload}
{$reload}
{else}
	{if $no_mysql}
		{if $no_mysql == 'de'}
		Baza de date nu este inca Optimizata. <a href="index.php?screen=statue&amp;do=sql">&raquo; Optimizeaza acum &laquo;</a><br />(Sau nu exista nici un sat. Daca asa e, va rugam sa faceti cel putin un sat.)
		{else}
		Baza de date nu este inca Optimizata. <a href="index.php?screen=statue&amp;do=sql">&raquo; Optimizeaza acum &laquo;</a><br />(Sau nu exista nici un sat. Daca asa e, va rugam sa faceti cel putin un sat.)
		{/if}
	{elseif $deactivated}
		{if $deactivated == 'de'}
		Statuia & Paladinul <u>nu sunt</u> activate acum. <a href="index.php?screen=statue&amp;do=activate">&raquo; Activeaza-le &laquo;</a>
		{else}
		Statuia & Paladinul <u>nu sunt</u> activate acum. <a href="index.php?screen=statue&amp;do=activate">&raquo; Activeaza-le &laquo;</a>
		{/if}
	{elseif $activated}
		{if $activated == 'de'}
		Statuia & Paladinul sunt activate acum. <a href="index.php?screen=statue&amp;do=deactivate">&raquo; Dezactiveaza-le &laquo;</a>
		{else}
		Statuia & Paladinul sunt activate acum. <a href="index.php?screen=statue&amp;do=deactivate">&raquo; Dezactiveaza-le &laquo;</a>
		{/if}
	{/if}
{/if}
<br /><br /><span style="font-size: 10px;">&copy; by <a href="http://www.paladini.ro">Adryan</a> (thx to <a href="http://paladini.ro">marian^</a> for assist)</span>