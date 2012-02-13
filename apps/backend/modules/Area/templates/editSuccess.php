<?php slot('title') ?>
  Area
<?php end_slot() ?>

<?php slot('subtitle') ?>
  <?php echo $form->isNew() ? 'Agregar' : 'Editar' ?> Area
<?php end_slot() ?>

<?php include_component('Crud', 'edit', array('form' => $form)) ?>
