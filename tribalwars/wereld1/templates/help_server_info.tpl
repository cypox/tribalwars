<h3>Serverinfo</h3>

<table class="vis">
<tr><th>Property</th><th>Value</th></tr>
<tr><td>Speed</td><td>{$conf->get('speed')}</td></tr>
<tr><td>Unit speed</td><td>{$conf->get('movement_speed')}</td></tr>

<tr><td>Moral</td><td>{if $conf->get('moral_activ')}active{else}inactive{/if}</td></tr>
<tr><td>Beginner protection</td><td>{$conf->get('noob_protection')} minutes</td></tr>
<tr><td>Cancel time for attacks</td><td>{$conf->get('cancel_movement')} minutes </td></tr>
<tr><td>Cancel time for merchants</td><td>{$conf->get('cancel_dealers')} minutes </td></tr>

<tr><td>Loyalty loss by noble</td><td>{$conf->get('agreement_min')} to {$conf->get('agreement_max')}</td></tr>
<tr><td>Version</td><td>{$conf->get('version')}</td>
</tr>
</table>
<br />
