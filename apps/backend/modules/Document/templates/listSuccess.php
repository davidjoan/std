<?php slot('title') ?>
Documentos
<?php end_slot() ?>

<?php include_component('Crud', 'list', array
      (
        'pager'              => $pager,
                                
        'uri'                => '@document_list?filter_by=filter_by&filter=filter&order_by=order_by&order=order&max=max&page=page',
                                
        'edit_field'         => 'code',
        'filter_fields'      => array
                                (
                                  'code'     => 'Código',
                                  'main'     => 'Asunto',
                                ),
        'columns'            => array
                                (
                                  array('2' , ''                  , ''                   , ''                         ),
                                  array('10', 'code'              , 'Codigo'             , 'getCode'                  ),
                                  array('20', 'main'              , 'Asunto'             , 'getMain'                  ),
                                  array('10', 'document_class_id' , 'Tipo de Registro'   , 'getDocumentClassName'     ),
                                  array('10', 'representative_id' , 'Remitente'          , 'getRepresentativeName'    ),
                                  array('10', 'registration_type' , 'Tipo de Tramite'    , 'getRegistrationTypeName'  ),
                                  array('10', 'document_date'     , 'Fecha de documento' , 'getDocumentDate'          ),
                                  array('10', 'qty'               , 'Folios'             , 'getQty'                   ),
                                  array('6' , 'disable_image'     , 'Activo'             , 'getDisableImage', 'center', false),
                                  array('2' , ''                  , ''                   , 'checkbox'                 ),
                                )
      ))
?>