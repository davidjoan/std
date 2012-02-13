<?php slot('title') ?>
  Procesos
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Usuario: <?php echo $form->getObject()->getName() ?>
<?php end_slot() ?>

<?php include_component('Crud', 'show', array('form' => $form)) ?>
