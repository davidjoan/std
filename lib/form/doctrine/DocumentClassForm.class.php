<?php

/**
 * DocumentClass form.
 *
 * @package    std
 * @subpackage form
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentClassForm extends BaseDocumentClassForm
{
    public function initialize() {
        $this->labels = array
            (
            'name' => 'Nombre',
            'description' => 'Descripción',
            'active' => 'Activo',
        );
    }

    public function configure() {
        $this->setWidgets(array
            (
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInput(array(), array('size' => '20')),
            'description'   => new sfWidgetFormTextarea(array(), array('cols' => '40', 'rows' => '3')),
            'active'           => new sfWidgetFormSelect(array('choices' => $this->getTable()->getStatuss())),
        ));
        
        $this->types = array
            (
            'id' => '=',
            'name' => 'name',
            'description' => '=',
            'slug' => '-',
            'active' => array('combo', array('choices' => array_keys($this->getObject()->getTable()->getStatuss()))),
            'created_at' => '-',
            'updated_at' => '-',
        );
    }

}
