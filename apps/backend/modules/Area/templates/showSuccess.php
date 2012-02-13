<?php slot('title') ?>
  Areas
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Area: <?php echo $form->getObject()->getName() ?>
<?php end_slot() ?>

<?php include_component('Crud', 'show', array('form' => $form)) ?>
