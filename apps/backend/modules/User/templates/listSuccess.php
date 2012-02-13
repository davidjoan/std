<?php slot('title') ?>
Usuarios
<?php end_slot() ?>

<?php include_component('Crud', 'list', array
      (
        'pager'              => $pager,
                                
        'uri'                => '@user_list?filter_by=filter_by&filter=filter&order_by=order_by&order=order&max=max&page=page',
                                
        'edit_field'         => 'last_name',
        'filter_fields'      => array
                                (
                                  'username'     => 'Login', 
                                  'last_name' => 'Apellido',
                                  'area_name'     => 'Area', 
            
                                ),
        'columns'            => array
                                (
                                  array('2' , ''               , ''           , ''                                ),
                                  array('20', 'username'       , 'Login'      , 'getUsername'                     ),
                                  array('30', 'last_name'      , 'Nombre'     , 'getName'                         ),
                                  array('18', 'profile_name'   , 'Perfil'     , 'getProfileName'                  ),
                                  array('18', 'area_name'      , 'Area'       , 'getAreaName'                     ),
                                  array('16', 'last_access_at' , 'Last Access', 'getLastAccessAtFormatedByProfile'),
                                  array('6' , 'disable_image'  , 'Activo'      , 'getDisableImage', 'center', false),
                                  array('2' , ''               , ''           , 'checkbox'                        ),
                                )
      ))
?>