<?php slot('title') ?>
Documentos
<?php end_slot() ?>

<?php
$params = array
    (
    'from' => array('id' => 'from'),
    'to' => array('id' => 'to'),
    'area' => array('id' => 'area'),
    'document_class' => array('id' => 'document_class'),
    'filter_by' => array('id' => 'filter_by'),
    'filter' => array('id' => 'filter', 'filter' => true),
    'order_by' => array('id' => 'order_by'),
    'order' => array('id' => 'order'),
    'max' => array('id' => 'max'),
    'page' => array('id' => 'page'),
);

$uri = '@document_list?from=from&to=to&area=area&document_class=document_class&filter_by=filter_by&filter=filter&order_by=order_by&order=order&max=max&page=page';
?>

<?php slot('filter_top') ?>
<table class="search">
    <tr><td>Fecha Inicio:</td><td><?php echo input_date_jquery('from', $sf_params->get('from') == '0' ? '' : $sf_params->get('from')) ?></td>
    </tr>
    <tr>
        <td>Fecha Fin:</td><td><?php echo input_date_jquery('to', $sf_params->get('to') == '0' ? '' : $sf_params->get('to')) ?></td></tr>
    <tr>
        <td>Tipo de Registro:</td>
        <td colspan="4"><?php echo select_doctrine_tag('document_class', 'DocumentClass', $sf_params->get('document_class'),array('add_empty' => '--- Todos ---')) ?></td>
    </tr>
    <tr>
        <td>Area:</td>
        <td colspan="4"><?php echo select_doctrine_tag('area', 'Area', $sf_params->get('area'),array('add_empty' => '--- Todos ---')) ?></td>
    </tr>    
</table>
<?php end_slot() ?>

<?php include_component('Crud', 'list', array
      (
        'pager'              => $pager,
        'params' => $params,
        'uri' => $uri,
                                
        //'uri'                => '@document_list?filter_by=filter_by&filter=filter&order_by=order_by&order=order&max=max&page=page',
                                
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