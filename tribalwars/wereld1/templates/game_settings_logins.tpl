<h3>Logins</h3>
<p>Auf dieser Seite kannst du sehen, wann Logins und fehlerhafte Loginversuche in deinen Account stattgefunden haben. Solltest du feststellen, dass jemand unbefugtes Zugriff auf deinen Account hatte, solltest du umgehend dein Passwort ändern. Die IP ändert sich im Allgemeinen, wenn man sich neu ins Internet einwählt.</p>

<h4>Letzte 20 Logins</h4>
<table class="vis">
<tr><th>Datum</th><th>IP</th><th>Urlaubsvertreter</th></tr>
{foreach from=$logins item=arr key=id}
	<tr><td>{$arr.time}</td><td>{$arr.ip}</td><td>{$arr.uv}</td></tr>
{/foreach}
</table>