<a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$report.from_user}">{$report.from_username}</a> hat die Einladung des Stammes
{if $report.ally_exist==0}{$report.allyname} (aufgelöst){else}<a href="game.php?village={$village.id}&amp;screen=info_ally&amp;id={$report.ally}">{$report.allyname}</a>{/if}
&nbsp;zurückgezogen.