<h3>Medalha {$cl_awards->get_name($report.m_dbname)} {$cl_awards->desc_stage[$report.m_stage]} Conquistada!</h3>

<table width="100%" class="ind">
  <tr>
    <td width="60" valign="top" rowspan="2"><div class="awards"><div class="frame{$report.m_stage}"><img src="{$config.cdn}/graphic/awards/{$report.m_dbname}.png" /></div><div class="frame{$report.m_stage}b"></div></div> </td>
    <td valign="top">
    <div><strong>{$cl_awards->get_name($report.m_dbname)} {$cl_awards->desc_stage[$report.m_stage]}</strong></div>
    </td>
  </tr>
  <tr>
    <td valign="bottom">
    <div style="font-size:7pt; color: #666; margin-top:2px;">{$cl_awards->get_thisStage($report.m_dbname,$report.m_stage)}</div>
    
    <div style="font-size:7pt; color: #666; margin-top:2px;"> Próximo nível: {$cl_awards->get_nextStage($report.m_dbname,$report.m_stage)}</div> 
    </td>
  </tr>
</table>