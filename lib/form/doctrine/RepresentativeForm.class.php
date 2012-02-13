<?php

/**
 * Representative form.
 *
 * @package    std
 * @subpackage form
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RepresentativeForm extends BaseRepresentativeForm {

    public function initialize() {
        $this->labels = array
            (
            'dni' => 'Dni',
            'firstname' => 'Nombres',
            'lastname' => 'Apellidos',
            'description' => 'Descripción',
            'active' => 'Activo',
        );
    }

    public function configure() {
        $this->setWidgets(array
            (
            'id' => new sfWidgetFormInputHidden(),
            'dni' => new sfWidgetFormInputText(array(), array('size' => 8, 'maxlength' => 8)),
            'firstname' => new sfWidgetFormInput(array(), array('size' => '20')),
            'lastname' => new sfWidgetFormInput(array(), array('size' => '20')),
            'description'   => new sfWidgetFormTextarea(array(), array('cols' => '40', 'rows' => '3')),
            'active'           => new sfWidgetFormSelect(array('choices' => $this->getTable()->getStatuss())),
            //'description'  => new sfWidgetFormCKEditor(array('jsoptions'=>array('skin' => 'office2003'))),
            /*'description' => new sfWidgetFormTextareaTinyMCE(
                    array
                        (
                        'width' => 400,
                        'height' => 200,
                        'config' => 'theme_advanced_disable: "anchor,image,cleanup,help"',
            ))*/
        ));
        
    $this->addValidators(array
    (
      'dni'            => new sfValidatorString(array('max_length' => 8, 'min_length' => 8)),
    ));        

        $this->types = array
            (
            'id' => '=',
            'dni' => 'fixed_number',
            'firstname' => 'name',
            'lastname' => 'name',
            'description' => '=',
            'slug' => '-',
            'active' => array('combo', array('choices' => array_keys($this->getObject()->getTable()->getStatuss()))),
            'created_at' => '-',
            'updated_at' => '-',
        );
    }

}
