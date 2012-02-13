<?php slot('title') ?>
  Documentos
<?php end_slot() ?>

<?php slot('subtitle') ?>
  # de Registro: <?php echo $form->getObject()->getRecordId() ?>
<?php end_slot() ?>

<?php include_component('Crud', 'show', array('form' => $form)) ?>
