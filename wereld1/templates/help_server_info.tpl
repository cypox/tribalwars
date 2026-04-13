<h3>Serverinfo</h3>

<table class="vis">
<tr><th>Eigenschaft</th><th>Wert</th></tr>
<tr><td>Geschwindigkeit</td><td>{$conf->get('speed')}</td></tr>
<tr><td>Einheitengeschwindigkeit</td><td>{$conf->get('movement_speed')}</td></tr>

<tr><td>Moral</td><td>{if $conf->get('moral_activ')}aktiv{else}inaktiv{/if}</td></tr>
<tr><td>Angriffschutz für Neueinsteiger</td><td>{$conf->get('noob_protection')} Minuten</td></tr>
<tr><td>Abbruchzeit für Attacks</td><td>{$conf->get('cancel_movement')} Minuten </td></tr>
<tr><td>Abbruchzeit für Händler</td><td>{$conf->get('cancel_dealers')} Minuten </td></tr>

<tr><td>Zustimmungsverlust durch AG</td><td>{$conf->get('agreement_min')} bis {$conf->get('agreement_max')}</td></tr>
<tr><td>Version</td><td>{$conf->get('version')}</td>
</tr>
</table>
<br />
