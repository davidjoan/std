<?php slot('title') ?>
  <?php echo $form->isNew() ? 'Nuevo' : 'Editar' ?> Perfil
<?php end_slot() ?>

<?php include_component('Crud', 'edit', array('form' => $form)) ?>

<?php echo javascript_tag
(
  sprintf
  (
    '
    function preSubmitForm()
    {
      sfDoubleList.submit(document.forms.%s, "double_list_select");
      return true;
    }
    ', 
    $sf_params->get('usClass')
  )
)
?>
