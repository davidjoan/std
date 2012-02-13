<?php slot('breadcrumbs') ?>
<?php include_partial
      (
        'General/breadcrumbs',
        array
        (
          'image' => 'person.jpg',
          'links' => array
                     (
                       array('Action List')
                     )
        )
      ) ?>
<?php end_slot() ?>

<?php slot('title') ?>
Actions
<?php end_slot() ?>

<?php include_component('Crud', 'list', array
      (
        'pager'              => $pager,
        'uri'                => '@action_list?filter_by=filter_by&filter=filter&order_by=order_by&order=order&max=max&page=page',
        'edit_field'         => 'name',
        'buttons'            => array
                                (
                                  'edit' => false,
                                  'add' => false,
                                ),
        'filter_fields'      => array
                                (
                                  'slug' => 'name',
                                ),
        'columns'            => array
                                (
                                  array('2' , ''            , ''            , ''                   ),
                                  array('30', 'name'        , 'Name'        , 'getName'            ),
                                  array('20', 'description' , 'Description' , 'getDescription'     ),
                                  array('20', 'route'       , 'Route'       , 'getRoute'           ),
                                  array('10', ''            , ''            , 'checkbox' , 'right' ),
                                )
      ))
?>