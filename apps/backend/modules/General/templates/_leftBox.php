<table class="left_box">
  <tr>
    <th colspan="2"><?php echo sfConfig::get('app_site') ?> - ADMIN</th>
  </tr>
  <tr><td></td></tr>
  <tr>
    <td>Cantidad de Expedientes:</td>
    <td><?php echo $records; ?></td>
  </tr>
  <tr>
    <td>Cantidad de Documentos:</td>
    <td><?php echo $documents; ?></td>
  </tr>  
  <tr>
    <td>Cantidad de Usuarios:</td>
    <td><?php echo $users; ?></td>
  </tr>    
  <tr><td></td></tr>
  <tr><td></td></tr>
  <tr>
    <th colspan="2">Ultima Visita</th>
  </tr>
  <tr><td></td></tr>
  <tr>
    <td>Remote Address</td>
    <td><b><?php echo $lastVisit->getRemoteAddress() ?></b></td>
  </tr>
  <tr>
    <td>HTTP User Agent</td>
    <td><b><small><?php echo $lastVisit->getHttpUserAgent() ?></small></b></td>
  </tr>
  <tr>
    <td>Datetime</td>
    <td><b><?php echo $lastVisit->getDatetime() ?></b></td>
  </tr>
  <tr><td></td></tr>
  <tr>
    <th colspan="2"><?php echo sfConfig::get('app_site') ?>  Versi&oacute;n</th>
  </tr>
  <tr><td></td></tr>
  <tr>
    <td>Version</td>
    <td><b>1.0</b></td>
  </tr>
  <tr><td></td></tr>
  <tr><td></td></tr>
</table>
