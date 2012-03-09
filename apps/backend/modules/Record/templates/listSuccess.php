<?php slot('title') ?>
Expedientes
<?php end_slot() ?>

<?php
$params = array
    (
    'from' => array('id' => 'from'),
    'to' => array('id' => 'to'),
    'record_status' => array('id' => 'record_status'),
    'filter_by' => array('id' => 'filter_by'),
    'filter' => array('id' => 'filter', 'filter' => true),
    'order_by' => array('id' => 'order_by'),
    'order' => array('id' => 'order'),
    'max' => array('id' => 'max'),
    'page' => array('id' => 'page'),
);

$uri = '@record_list?from=from&to=to&record_status=record_status&filter_by=filter_by&filter=filter&order_by=order_by&order=order&max=max&page=page';
$checkbox = "<input type=\"checkbox\" value=\"seleccionar\" id=\"seleccionar_todo\" name=\"seleccionar_todo\">";
?>



<?php slot('buttons') ?>


<td><?php echo button_to_get_url('Recibir', '@record_change_status?slug=slug&status=' . RecordTable::STATUS_RECEIVED, array('slug' => array('id' => 'record_slug', 'list' => true, 'validate' => true, 'single' => true)), array('onclick' => true, 'class' => 'inputbutton')) ?></td>

<td><?php echo button_to_get_url('Derivar', '@record_change_status?slug=slug&status=' . RecordTable::STATUS_DERIVED, array('slug' => array('id' => 'record_slug', 'list' => true, 'validate' => true, 'single' => true)), array('onclick' => true, 'class' => 'inputbutton')) ?></td>

<td><?php echo button_to_get_url('Devolver', '@record_change_status?slug=slug&status=' . RecordTable::STATUS_RETURNED, array('slug' => array('id' => 'record_slug', 'list' => true, 'validate' => true, 'single' => true)), array('onclick' => true, 'class' => 'inputbutton')) ?></td>

<td><?php echo button_to_get_url('Finalizar', '@record_change_status?slug=slug&status=' . RecordTable::STATUS_COMPLETED, array('slug' => array('id' => 'record_slug', 'list' => true, 'validate' => true, 'single' => true)), array('onclick' => true, 'class' => 'inputbutton')) ?></td>

<td><?php echo button_to_get_url('Imprimir', '@report_record_list?slug=slug', array('slug' => array('id' => 'record_slug', 'list' => true, 'validate' => true, 'to_delete' => false)), array('onclick' => true, 'class' => 'inputbutton')) ?></td>

<?php end_slot() ?>

<?php slot('filter_top') ?>
<table class="search">
    <tr><td>Fecha Inicio:</td><td><?php echo input_date_jquery('from', $sf_params->get('from') == '0' ? '' : $sf_params->get('from')) ?></td>
    </tr>
    <tr>
        <td>Fecha Fin:</td><td><?php echo input_date_jquery('to', $sf_params->get('to') == '0' ? '' : $sf_params->get('to')) ?></td></tr>
    <tr>
        <td>Estado:</td>
        <td colspan="4"><?php echo select_tag('record_status', Doctrine::getTable('Record')->getStatuss(), $sf_params->get('record_status')) ?></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <?php //echo button_to_get_url('Buscar', $uri, $params, array('id' => 'button_list_search', 'class' => 'inputsubmit')) ?>
        </td>

    </tr>
</table>
<?php end_slot() ?>

<?php
include_component('Crud', 'list', array
    (
    'pager' => $pager,
    'params' => $params,
    'uri' => $uri,
    'edit_field' => 'code',
    'filter_fields' => array
        (
        'code' => 'Código',
        'subject' => 'Asunto',
        'time_limit' => 'Limite',
        'user_name' => 'Apellido Usuario Actual'
    ),
    'buttons' => array
        (
        'delete' => false,
        'show' => false,
    ),
    'columns' => array
        (
        array('2', '', '', ''),
        array('2', '', $checkbox, 'checkbox','center',false),
        array('10', 'code', 'Codigo', 'getCode'),
        array('20', 'created_at', 'Fecha Emisi&oacute;n', 'getFormattedDatetime'),
        array('20', 'subject', 'Asunto', 'getSubject'),
        array('5', 'documents_number', '# Docs', 'getDocumentsNumber'),
        array('10', 'status', 'Estado', 'getStatusColorStr'),
        array('15', 'updated_at', 'Fecha Movimiento', 'getFormattedUpdatedAt'),
        array('20', 'user_name', 'Usuario Actual', 'getUserName'),
    //
    //array('14', 'area_origen_name'  , 'Area Origen'     , 'getAreaOrigenName'            ),
    //array('14', 'area_destino_name' , 'Area Destino'    , 'getAreaDestinoName'           ),
    //array('8', 'time_limit'         , 'Limite'          , 'getTimeLimitStr'              ),
    //array('6' , 'disable_image'     , 'Activo'          , 'getDisableImage', 'center', false),
    )
))
?>


<script type="text/javascript">
    $(document).ready(function(){

        $("[name='seleccionar_todo']").click(function(){

            if ($("#seleccionar_todo").is(":checked"))
            {
                
                $("[name='seleccion[]']").each(function()
                {
                    this.checked = true;
                    $("[name='seleccion[]']").attr('checked', 'checked');
                });
            }
            else
            {
                $("[name='seleccion[]']").each(function()
                {
                    $("[name='seleccion[]']").attr('checked', '');
                });
            }
        });
    }); 
</script>