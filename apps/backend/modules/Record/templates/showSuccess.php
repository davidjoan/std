<?php slot('title') ?>
  Expediente
<?php end_slot() ?>

<?php slot('subtitle') ?>
  # de registro: <?php echo $form->getObject()->getCode() ?>
<?php end_slot() ?>

<?php include_component('Crud', 'show', array('form' => $form)) ?>
