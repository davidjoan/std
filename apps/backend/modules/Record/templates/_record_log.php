<?php foreach ($record->getRecordLogs() as $record_log): ?>
 <tr>
   <td class="label popup_dialog_body_left_padded" style="vertical-align: top;" width="20%">
     <?php echo $record_log->getDateTimeObject('created_at')->format('m/d/Y'); ?><br /><br />
     <?php echo $record_log->getDateTimeObject('created_at')->format('H:m:i'); ?>
   </td>              
   <td class="value popup_dialog_body_right_padded" width="75%" style="border-bottom: 1px solid #939FC2;">
     <table width="100%">
       <tr>            
         <td width="100%">
           <?php include_partial('Record/template_log', array('record_log' => $record_log)) ?>
         </td>          
       </tr>
     </table>
   </td>
 </tr>
<?php endforeach; ?>
