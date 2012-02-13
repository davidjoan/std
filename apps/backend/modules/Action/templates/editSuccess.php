<?php slot('breadcrumbs') ?>
<?php include_partial
      (
        'General/breadcrumbs',
        array
        (
          'image' => 'person.jpg',
          'links' => array
                     (
                       array('Action List', get_entrance_route()),
                       array($form->isNew() ? 'New' : 'Edit')
                     )
        )
      ) ?>
<?php end_slot() ?>

<?php slot('title') ?>
  <?php echo $form->isNew() ? 'New' : 'Edit' ?> Action
<?php end_slot() ?>

<?php include_component('Crud', 'edit', array('form' => $form)) ?>
