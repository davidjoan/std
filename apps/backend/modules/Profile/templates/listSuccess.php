<?php slot('title') ?>
Perfiles
<?php end_slot() ?>

<?php include_component('Crud', 'list', array
      (
        'pager'              => $pager,
                                
        'uri'                => '@profile_list?filter_by=filter_by&filter=filter&order_by=order_by&order=order&max=max&page=page',
                                
        'edit_field'         => 'name',
        'filter_fields'      => array
                                (
                                  'slug'      => 'Nombre'
                                ),
        'columns'            => array
                                (
                                  array('2' , ''              , ''           , ''                ),
                                  array('20', 'name'          , 'Nombre'       , 'getName'         ),
                                  array('56', 'description'   , 'Descripción', 'getDescription'  ),
                                  array('15', 'actions_number', '# Acciones'  , 'getActionsNumber'),
                                  array('2' , ''              , ''           , 'checkbox'        ),
                                )
      ))
?>