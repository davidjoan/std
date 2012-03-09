<table class="template_log">
  <tr>
    <td>Area Origen:</td>
    <td class="value"><?php echo $record_log->getFromArea()->getName() ?></td>
  </tr>
  <tr>
    <td>Area Destino:</td>
    <td class="value"><?php echo $record_log->getToArea()->getName() ?></td>
  </tr>
  <tr>
    <td>Estado:</td>
    <td class="value"><?php echo $record_log->getStatusStr() ?></td>
  </tr>
  <tr>
    <td>Descripción:</td>
    <td class="value"><?php echo $record_log->getDescription() ?></td>
  </tr>  
</table>