<?php

/**
 * User form.
 *
 * @package    std
 * @subpackage form
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserForm extends BaseUserForm
{
  public function initialize()
  {
    $this->labels = array
                    (
                      'profile_id'       => 'Perfil',
                      'area_id'          => 'Area',
                      'username'         => 'Login',
                      'password'         => 'Password',
                      'confirm_password' => 'Confirmar password',
                      'first_name'       => 'Nombres',
                      'last_name'        => 'Apellidos',
                      'email'            => 'E-mail',
                      'phone'            => 'Telefono',
                      'active'           => 'Estado',
                      'last_access_at'   => 'Ultimo Acceso'
                    ); 
  }
  
	
  public function configure()
  {
  	$this->setWidgets(array
    (
      'id'               => new sfWidgetFormInputHidden(),
      'profile_id'       => new sfWidgetFormDoctrineChoice
                              (
                                array
                                (
                                  'model' => 'Profile', 
                                  'add_empty' => '--- Select ---', 
                                  'order_by' => array('Name', 'ASC')
                                )
                              ),
      'area_id'          => new sfWidgetFormDoctrineChoice
                              (
                                array
                                (
                                  'model' => 'Area', 
                                  'add_empty' => '--- Select ---', 
                                  'order_by' => array('Name', 'ASC')
                                )
                              ),            
      'username'         => new sfWidgetFormInput(array(), array('size' => '20')),
      'password'         => new sfWidgetFormInputPassword(array(), array('size' => '20')),
      'confirm_password' => new sfWidgetFormInputPassword(array(), array('size' => '20')),
      'first_name'       => new sfWidgetFormInput(array(), array('size' => '30')),
      'last_name'        => new sfWidgetFormInput(array(), array('size' => '30')),
      'email'            => new sfWidgetFormInput(array(), array('size' => '30')),
      'phone'            => new sfWidgetFormInput(array(), array('size' => '20')),
      'active'           => new sfWidgetFormSelect(array('choices' => $this->getTable()->getStatuss())),
      //'estado'             => new sfWidgetFormSelect(array('choices' => Doctrine::getTable('Usuario')->getEstado())),
    ));
    
    $this->types = array
    (
      'id'                  => '=',
      'profile_id'          => 'combo',
      'area_id'             => 'combo',
      'username'            => 'user',
      'password'            => 'password',
      'confirm_password'    => 'password',
      'first_name'          => 'name',
      'last_name'           => 'name',
      'email'               => 'email',
      'phone'               => 'phone',
      'active'              => array('combo', array('choices' => array_keys($this->getObject()->getTable()->getStatuss()))),
      'slug'                => '-',
      'last_access_at'      => '-',
      'created_at'          => '-',
      'updated_at'          => '-',
    );
    
  $this->validatorSchema['confirm_password'] = new sfValidatorString(array('max_length' => 255, 'required' => false));
    
    $this->validatorSchema->setPostValidator
    (
      new sfValidatorAnd
      (
        array
        (
          new sfValidatorDoctrineUnique(array('model' => $this->getModelName(), 'column' => array('login')                  , 'throw_global_error' => false)),
          new sfValidatorDoctrineUnique(array('model' => $this->getModelName(), 'column' => array('first_name', 'last_name')   , 'throw_global_error' => false)),
          new sfValidatorSchemaCompare
          (
            'password', '==', 'confirm_password',
             array('throw_global_error' => false),
             array('invalid'            => 'The \'%password%\' and the \'%confirm_password%\' fields must be equal.')
          )
        )
      )
    );
    
    if (!$this->isNew())
    {
      $this->validatorSchema['password']->setOption('required', false); 
    }
  }
  

}
