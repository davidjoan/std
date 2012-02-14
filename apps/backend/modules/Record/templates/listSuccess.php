<?php slot('title') ?>
Expedientes
<?php end_slot() ?>

<?php slot('buttons') ?>
  <td><?php echo button_to_get_url('Derivar', '@record_new?slug=slug&status=3', array('slug' => array('id' => 'record_slug', 'list' => true, 'validate' => true, 'single' => true)), array('onclick' => true, 'class' => 'inputbutton')) ?></td>
<?php end_slot() ?>

<?php slot('filter_top') ?>
<table class="search">
  <tr>
    <td>Fecha Inicio:</td>
    <td><?php echo input_date_tag('from', $sf_params->get('from')) ?></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>Fecha Fin:</td><td><?php echo input_date_tag('to', $sf_params->get('to')) ?></td>
    <td>&nbsp;</td>
  </tr>  
  <tr>
      <td>Status:</td>
      <td colspan="4"><?php echo select_tag('status', Doctrine::getTable('Record')->getStatuss(), $sf_params->get('status')) ?></td>
  </tr>      
</table>
<?php end_slot() ?>

<?php include_component('Crud', 'list', array
      (
        'pager'              => $pager,
                                
        'uri'                => '@record_list?filter_by=filter_by&filter=filter&order_by=order_by&order=order&max=max&page=page',
                                
        'edit_field'         => 'code',
        'filter_fields'      => array
                                (
                                  'code'           => 'Código',
                                  'name'           => 'Nombre',
                                  'subject'        => 'Asunto',
                                  'time_limit_str' => 'Limite',
                                ),
        'buttons' => array
        (
          'delete' => false,
          'show' => false,
        ),    
        'columns'            => array
                                (
                                  array('2' , ''                  , ''                , ''                                ),
                                  array('10', 'code'              , 'Codigo'          , 'getCode'                         ),
                                  array('15', 'user_name'         , 'Usuario Creador' , 'getUserName'                     ),
                                  array('15', 'from_area_name'    , 'Area Origen'     , 'getFromAreaName'                 ),
                                  array('15', 'to_area_name'      , 'Area Destino'    , 'getToAreaName'                   ),
                                  array('20', 'subject'           , 'Asunto'          , 'getSubject'                      ),
                                  array('10', 'time_limit'        , 'Limite'          , 'getTimeLimitStr'                 ),
                                  array('15', 'status'            , 'Estado'          , 'getStatusStr'                    ),
                                  //array('6' , 'disable_image'     , 'Activo'          , 'getDisableImage', 'center', false),
                                  array('2' , ''                  , ''                , 'checkbox'                        ),
                                )
      ))
?>