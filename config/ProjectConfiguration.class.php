<?php
//require_once 'D://xampp//htdocs//symfony//lib/autoload/sfCoreAutoload.class.php';
require_once(dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php');
sfCoreAutoload::register();
require_once(dirname(__FILE__).'/../plugins/symfextPlugin/config/sfProjectConfigurationExt.class.php');

class ProjectConfiguration extends sfProjectConfigurationExt
{
  protected function getActivePlugins()
  {
    return array
           (
             'sfDoctrinePlugin',
             'sfFormExtraPlugin',
             'symfextPlugin',
             'sfPhpExcelPlugin'
           );
  }
  
  protected function setConfigVariables()
  {
    parent::setConfigVariables();
    
    $this->setConfigDirPathVariable('document_path'        , sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'document_path'        );

    sfConfig::set('site_name', 'std');
    
 
  }
}