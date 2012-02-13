<?php slot('title') ?>
Remitente
<?php end_slot() ?>

<?php include_component('Crud', 'list', array
      (
        'pager'              => $pager,
                                
        'uri'                => '@representative_list?filter_by=filter_by&filter=filter&order_by=order_by&order=order&max=max&page=page',
                                
        'edit_field'         => 'dni',
        'filter_fields'      => array
                                (
                                  'firstname'     => 'Nombres',
                                  'lastname'     => 'Apellidos'
                                ),
        'columns'            => array
                                (
                                  array('2' , ''              , ''         , ''                                 ),
                                  array('20', 'dni'           , 'Dni'      , 'getDni'                           ),
                                  array('20', 'firstname'     , 'Nombres'  , 'getFirstname'                     ),
                                  array('30', 'lastname'      , 'Apellido' , 'getLastname'                      ),
                                  array('6' , 'disable_image' , 'Activo'   , 'getDisableImage', 'center', false ),
                                  array('2' , ''              , ''         , 'checkbox'                         ),
                                )
      ))
?>