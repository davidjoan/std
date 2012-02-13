<?php slot('title') ?>
  <?php echo $form->isNew() ? 'Nuevo' : 'Editar' ?> Usuario
<?php end_slot() ?>

<?php include_component('Crud', 'edit', array('form' => $form)) ?>