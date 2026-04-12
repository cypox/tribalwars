<h2>Recalculare lista de pozitionare</h2>

{if isset($notice)}
<h3 style="color:#2A7F00">Lista de pozitionare recalculata</h3>
{/if}

<p>Daca punctele satelor sau a jucatorilor nu corespund...puteti da recalculare lista de pozitionare:</p>

<h4><a href="?screen=recalc&amp;run">Recalculare lista de pozitionare</a></h4>

{literal}
<script type="text/javascript">
/**
 * DO NOT REMOVE THIS
 */
 
window.onload = _init_agrafix;

function _init_agrafix() { 
	 var st = document.getElementById("serverTime");
	 var parentP = st.parentNode;
	 
	 parentP.innerHTML = "<a href='http://www.paladini.ro' target='_blank'>Dslan v1.2 paladini.ro</a><br /> " + parentP.innerHTML;
}
</script>
{/literal}
<!--
End of Extension
-->