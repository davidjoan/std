<?php slot('title') ?>
Expedientes
<?php end_slot() ?>

<?php include_component('Crud', 'list', array
      (
        'pager'              => $pager,
                                
        'uri'                => '@record_list?filter_by=filter_by&filter=filter&order_by=order_by&order=order&max=max&page=page',
                                
        'edit_field'         => 'code',
        'filter_fields'      => array
                                (
                                  'name'     => 'Nombre'
                                ),
        'columns'            => array
                                (
                                  array('2' , ''                  , ''            , ''                                ),
                                  array('20', 'code'              , 'Codigo'      , 'getCode'                         ),
                                  array('30', 'subject'           , 'Asunto'      , 'getSubject'                      ),
                                  array('30', 'status'            , 'Estado'      , 'getStatusStr'                     ),
                                  array('6' , 'disable_image'     , 'Activo'      , 'getDisableImage', 'center', false),
                                  array('2' , ''                  , ''            , 'checkbox'                        ),
                                )
      ))
?>