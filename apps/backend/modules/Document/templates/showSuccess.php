<?php slot('title') ?>
  Document
<?php end_slot() ?>

<?php slot('subtitle') ?>
  # de registro: <?php echo $form->getObject()->getRecordId() ?>
<?php end_slot() ?>

<?php include_component('Crud', 'show', array('form' => $form)) ?>
