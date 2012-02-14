<?php slot('title') ?>
<?php if($status == 3): ?>
Derivar Expediente
<?php elseif($form->isNew()): ?>
Nuevo Expediente
<?php else: ?>
Editar Expediente
<?php endif; ?>
<?php end_slot() ?>

<?php include_component('Crud', 'edit', array('form' => $form)) ?>