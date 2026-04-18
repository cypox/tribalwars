<table width="100%">
<tr><th width="60">Seller:</th><th><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$report.from_user}">{$report.from_username}</a></th></tr>
<tr><td>Village:</td><td><a href="game.php?village={$village.id}&amp;screen=info_village&amp;id={$report.from_village}">{$report.from_villagename} ({$report.from_x}|{$report.from_y})</a></th></tr>

<tr><th width="60">Buyer:</th><th><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$report.to_user}">{$report.to_username}</a></th></tr>
<tr><td>Village:</td><td><a href="game.php?village={$village.id}&amp;screen=info_village&amp;id={$report.to_village}">{$report.to_villagename} ({$report.to_x}|{$report.to_y})</a></th></tr>
</table><br />

<table style="border: 1px solid #DED3B9">
<tr><td>Sold:</td><td>{if $report.sell_ress=='wood'}<img src="graphic/holz.png" title="Wood" alt="" />{/if}{if $report.sell_ress=='stone'}<img src="graphic/lehm.png" title="Clay" alt="" />{/if}{if $report.sell_ress=='iron'}<img src="graphic/eisen.png" title="Iron" alt="" />{/if}{$report.sell}</td>
<tr><td>Bought:</td><td>{if $report.buy_ress=='wood'}<img src="graphic/holz.png" title="Wood" alt="" />{/if}{if $report.buy_ress=='stone'}<img src="graphic/lehm.png" title="Clay" alt="" />{/if}{if $report.buy_ress=='iron'}<img src="graphic/eisen.png" title="Iron" alt="" />{/if}{$report.buy}</td>
</table><br />

The resources were sent automatically.