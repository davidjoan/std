<?php

/**
 * Profile form.
 *
 * @package    std
 * @subpackage form
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfileForm extends BaseProfileForm
{
	public function initialize()
	{
		$this->labels = array
		                (
		                  'name'        => 'Nombre',
                                   'description'   => 'Descripción',
		                  'actions_list' => 'Acciones', 
		                );
	}

  public function configure()
  {
  	$this->setWidgets(array
  	(
  	  'id'           => new sfWidgetFormInputHidden(),
      'name'         => new sfWidgetFormInput(array(), array('size' => '20')),
      //'description'   => new sfWidgetFormTextarea(array(), array('cols' => '40', 'rows' => '3')),
	  //'description'  => new sfWidgetFormCKEditor(array('jsoptions'=>array('skin' => 'office2003'))),
	  'description'   => new sfWidgetFormTextareaTinyMCE(
                          array
                          (
                            'width'  => 400,
                            'height' => 200,
                            'config' => 'theme_advanced_disable: "anchor,image,cleanup,help"',
                          )),
      'actions_list' => new sfWidgetFormDoctrineChoice
                        (
                          array
                          (
                            'model'            => 'Action',
                            'multiple'         => true,
                            'renderer_class'   => 'sfWidgetFormSelectDoubleList',
                            'renderer_options' => array
                                                  (
                                                    'label_associated'   => 'Acciones Seleccionadas',
                                                    'label_unassociated' => 'Accions Disponibles'
                                                  )
                          )
                        ),
  	));
  	
  	$this->types = array
  	(
  	  'profile_id'   => '=',
      'name'         => 'name',
      'description'  => 'pass',
  	  'slug'         => '-',
      'created_at'   => '-',
      'updated_at'   => '-',
      'actions_list' => 'pass',
  	);
  }

}
