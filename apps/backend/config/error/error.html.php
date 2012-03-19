<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php $path = sfConfig::get('sf_relative_url_root', preg_replace('#/[^/]+\.php5?$#', '', isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : (isset($_SERVER['ORIG_SCRIPT_NAME']) ? $_SERVER['ORIG_SCRIPT_NAME'] : ''))) ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="title" content="Artble Admin" />
    <meta name="robots" content="index, follow" />
    <meta name="description" content="std admin" />
    <meta name="keywords" content="std, admin" />
    <meta name="language" content="es" />
    <title>Sistema de Tramite Documentario Admin</title>
    
    <link rel="shortcut icon" href="<?php echo $path ?>/images/general/favicon.ico" type="image/x-icon" />
    
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/css/general/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/css/backend/general.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/css/backend/button.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/css/backend/default/layout.css" />
  </head>
  
  <body>
    <div class="wrap">
      <div class="header">
        <br/><br/>
        Sering S.A.C.
      </div>
      
      <div class="content">
        <h1>Ocurrio un Error</h1>
        <h5>Estamos teniendo problemas, porfavor espere unos segundos.</h5>
        
        <br/><br/>
        <br/><br/>
        
        <a href="#" onclick="history.back(); return false;">Regrese a la pagina anterior</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="/home">Ir a la página de inicio</a>
      </div>
      
      <div class="footer">
        © 2012 Sering S.A.C. Todos los derechos reservados.
        <br/>
        
      </div>
    </div>
  </body>
</html>
