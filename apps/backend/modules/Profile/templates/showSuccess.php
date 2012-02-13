<?php slot('title') ?>
  Perfiles
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Perfil: <?php echo $form->getObject()->getName() ?>
<?php end_slot() ?>

<?php include_component('Crud', 'show', array('form' => $form)) ?>
