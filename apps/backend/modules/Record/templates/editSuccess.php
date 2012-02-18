<?php slot('title') ?>
<?php if($status == RecordTable::STATUS_DERIVED): ?>
Derivar Expediente
<?php elseif($form->isNew()): ?>
Nuevo Expediente
<?php elseif($status == RecordTable::STATUS_RECEIVED): ?>
Recibir Expediente
<?php elseif($status == RecordTable::STATUS_RETURNED): ?>
Devolver Expediente
<?php else: ?>
Editar Expediente
<?php endif; ?>
<?php end_slot() ?>

<?php include_component('Crud', 'edit', array('form' => $form)) ?>