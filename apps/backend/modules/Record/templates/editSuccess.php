<?php $function = sprintf('%ssubmitForm("%s")', !$form->isNew() ? 'sureClose = false; ' : '', $sf_params->get('usClass')) ?>
<?php slot('title') ?>
<?php if($status == RecordTable::STATUS_DERIVED): ?>
Derivar Expediente
<?php elseif($form->isNew()): ?>
Nuevo Expediente
<?php elseif($status == RecordTable::STATUS_RECEIVED): ?>
Recibir Expediente
<?php elseif($status == RecordTable::STATUS_RETURNED): ?>
Devolver Expediente
<?php elseif($status == RecordTable::STATUS_COMPLETED): ?>
Terminar Expediente
<?php else: ?>
Editar Expediente
<?php endif; ?>
<?php end_slot() ?>


<?php slot('buttons_edit') ?>
<?php if($status == RecordTable::STATUS_DERIVED): ?>
<?php $action_url = '@record_change_status?slug=' . $form->getObject()->getSlug().'&status='.$status; ?>

<table class="buttons_container">
    <tr>
      <td align="right">
        <table class="buttons">
          <tr>
            <td><?php echo button_to_function('Derivar', $function, array('type' => 'submit', 'id' => 'Save', 'class' => 'inputsubmit')) ?></td>
            <td><?php echo button_to('Cancelar', get_entrance_route(), array('onclick' => true, 'class' => 'inputbutton inputaux')) ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
<?php elseif($form->isNew()): ?>
<?php $action_url = '@record_new'; ?>
<table class="buttons_container">
    <tr>
      <td align="right">
        <table class="buttons">
          <tr>
            <td><?php echo button_to_function($object ? ($form->object->isNew() ? 'Grabar' : 'Modificar') : 'Grabar Cambios', $function, array('type' => 'submit', 'id' => 'Save', 'class' => 'inputsubmit')) ?></td>
            <td><?php echo button_to('Cancelar', get_entrance_route(), array('onclick' => true, 'class' => 'inputbutton inputaux')) ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table><?php elseif($status == RecordTable::STATUS_RECEIVED): ?>
<?php $action_url = '@record_change_status?slug=' . $form->getObject()->getSlug().'&status='.$status; ?>

<table class="buttons_container">
    <tr>
      <td align="right">
        <table class="buttons">
          <tr>
            <td><?php echo button_to_function('Recibir', $function, array('type' => 'submit', 'id' => 'Save', 'class' => 'inputsubmit')) ?></td>
            <td><?php echo button_to('Cancelar', get_entrance_route(), array('onclick' => true, 'class' => 'inputbutton inputaux')) ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>

<?php elseif($status == RecordTable::STATUS_RETURNED): ?>
Devolver Expediente
<?php $action_url = '@record_change_status?slug=' . $form->getObject()->getSlug().'&status='.$status; ?>
<?php elseif($status == RecordTable::STATUS_COMPLETED): ?>
tERMINAR Expediente
<?php $action_url = '@record_change_status?slug=' . $form->getObject()->getSlug().'&status='.$status; ?>
<table class="buttons_container">
    <tr>
      <td align="right">
        <table class="buttons">
          <tr>
            <td><?php echo button_to_function('Completar', $function, array('type' => 'submit', 'id' => 'Save', 'class' => 'inputsubmit')) ?></td>
            <td><?php echo button_to('Cancelar', get_entrance_route(), array('onclick' => true, 'class' => 'inputbutton inputaux')) ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>

<?php else: ?>
<?php $action_url = '@record_edit?slug=' . $form->getObject()->getSlug(); ?>
<table class="buttons_container">
    <tr>
      <td align="right">
        <table class="buttons">
          <tr>
            <td><?php echo button_to_function($object ? ($object->isNew() ? 'Grabar' : 'Modificar') : 'Grabar Cambios', $function, array('type' => 'submit', 'id' => 'Save', 'class' => 'inputsubmit')) ?></td>
            <td><?php echo button_to('Cancelar', get_entrance_route(), array('onclick' => true, 'class' => 'inputbutton inputaux')) ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
<?php endif; ?>
<?php end_slot() ?>


<?php if ($form->isNew()): ?>

<?php else: ?>
<?php endif; ?>

<?php include_component('Crud', 'edit', array('form' => $form, 'action_uri' => $action_url)) ?>