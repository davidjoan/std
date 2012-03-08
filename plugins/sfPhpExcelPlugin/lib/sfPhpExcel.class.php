<?php

class sfPhpExcel extends PHPExcel
{
  public function __construct()
  {
    parent::__construct();
    
    $this->getProperties()->setCreator(sfConfig::get('app_meta_creator'));
    $this->getProperties()->setTitle(sfConfig::get('app_meta_title'));
    $this->getProperties()->setSubject(sfConfig::get('app_meta_subject'));
    $this->getProperties()->setDescription(sfConfig::get('app_meta_description'));
    $this->getProperties()->setKeywords(sfConfig::get('app_meta_keyword'));
    $this->getProperties()->setCategory(sfConfig::get('app_meta_category'));
    $this->setActiveSheetIndex(0);
    
  }
}