<?php slot('title') ?>
Expedientes
<?php end_slot() ?>

<?php
$params = array
    (
    'from' => array('id' => 'from'),
    'to' => array('id' => 'to'),
    'status' => array('id' => 'status'),
    'filter_by' => array('id' => 'filter_by'),
    'filter' => array('id' => 'filter', 'filter' => true),    
    'order_by' => array('id' => 'order_by'),
    'order' => array('id' => 'order'),
    'max' => array('id' => 'max'),
    'page' => array('id' => 'page'),
);

$uri = '@record_list?from=from&to=to&status=status&filter_by=filter_by&filter=filter&order_by=order_by&order=order&max=max&page=page';
?>



<?php slot('buttons') ?>
<td><?php echo button_to_get_url('Recibir', '@record_change_status?slug=slug&status='.RecordTable::STATUS_RECEIVED, array('slug' => array('id' => 'record_slug', 'list' => true, 'validate' => true, 'single' => true)), array('onclick' => true, 'class' => 'inputbutton')) ?></td>

<td><?php echo button_to_get_url('Derivar', '@record_change_status?slug=slug&status='.RecordTable::STATUS_DERIVED, array('slug' => array('id' => 'record_slug', 'list' => true, 'validate' => true, 'single' => true)), array('onclick' => true, 'class' => 'inputbutton')) ?></td>

<td><?php echo button_to_get_url('Devolver', '@record_change_status?slug=slug&status='.RecordTable::STATUS_RETURNED, array('slug' => array('id' => 'record_slug', 'list' => true, 'validate' => true, 'single' => true)), array('onclick' => true, 'class' => 'inputbutton')) ?></td>

<td><?php echo button_to_get_url('Completar', '@record_change_status?slug=slug&status='.RecordTable::STATUS_COMPLETED, array('slug' => array('id' => 'record_slug', 'list' => true, 'validate' => true, 'single' => true)), array('onclick' => true, 'class' => 'inputbutton')) ?></td>

<?php end_slot() ?>

<?php slot('filter_top') ?>
<table class="search">
  <tr><td>Fecha Inicio:</td><td><?php echo input_date_jquery('from', $sf_params->get('from') == '0' ? '' : $sf_params->get('from')) ?></td>
  </tr>
  <tr>
      <td>Fecha Fin:</td><td><?php echo input_date_jquery('to', $sf_params->get('to') == '0' ? '' : $sf_params->get('to')) ?></td></tr>
  <tr>
      <td>Estado:</td>
      <td colspan="4"><?php echo select_tag('status', Doctrine::getTable('Record')->getStatuss(), $sf_params->get('status')) ?></td>
</tr>
<tr>
    <td></td>
    <td>
        <?php //echo button_to_get_url('Buscar', $uri, $params, array('id' => 'button_list_search', 'class' => 'inputsubmit')) ?>
    </td>
        
</tr>
</table>
<?php end_slot() ?>

<?php include_component('Crud', 'list', array
      (
        'pager'              => $pager,
        'params'             => $params,                    
        'uri'                => $uri,
                                
        'edit_field'         => 'code',
        'filter_fields'      => array
                                (
                                  'code'           => 'Código',
                                  'subject'        => 'Asunto',
                                  'time_limit'     => 'Limite',
                                ),
        'buttons' => array
        (
          'delete' => false,
          'show' => false,
        ),    
        'columns'            => array
                                (
                                  array('2' , ''                  , ''                , ''                             ),
                                  array('7', 'code'               , 'Codigo'          , 'getCode'                      ),
                                  //array('12', 'user_name'         , 'Usuario Creador' , 'getUserName'                ),
                                  array('14', 'area_origen_name'  , 'Area Origen'     , 'getAreaOrigenName'            ),
                                  array('14', 'area_destino_name' , 'Area Destino'    , 'getAreaDestinoName'           ),
                                  array('20', 'subject'           , 'Asunto'          , 'getSubject'                   ),
                                  array('8', 'time_limit'         , 'Limite'          , 'getTimeLimitStr'              ),
                                  array('8', 'documents_number'   , '# Docs'          , 'getDocumentsNumber'           ),
                                  array('12', 'status'            , 'Estado'          , 'getStatusColorStr'            ),
                                  array('15', 'created_at'        , 'Fecha Creaci&oacute;n' , 'getFormattedDatetime'   ),
                                  //array('6' , 'disable_image'     , 'Activo'          , 'getDisableImage', 'center', false),
                                  array('2' , ''                  , ''                , 'checkbox'                        ),
                                )
      ))
?>