{if $user.graphical_overview == 0}
	{include file="game_overview_noGraphic.tpl"}
{else}
	{include file="game_overview_graphics.tpl"}
{/if}