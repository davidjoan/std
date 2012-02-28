<table class="menu">
  <tr>
    <td width="99%">
      <table class="submenu">
        <tr>
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Inicio', 
                  'uri'         => '@home',
                  'image'       => 'backend/menu/home.gif',
                ))
          ?>
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Expedientes', 
                  'uri'         => '@record_list',
                  'image'       => 'backend/menu/inventory.gif',
                ))
          ?>            

          <?php include_partial('General/tab', array
                (
                  'title'       => 'Documentos', 
                  'uri'         => '@document_list',
                  'image'       => 'backend/menu/inventory.gif',
                ))
          ?>            
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Areas', 
                  'uri'         => '@area_list',
                  'image'       => 'backend/menu/inventory.gif',
                ))
          ?>            
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Remitentes', 
                  'uri'         => '@representative_list',
                  'image'       => 'backend/menu/inventory.gif',
                ))
          ?>
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Tipo de Documento', 
                  'uri'         => '@document_class_list',
                  'image'       => 'backend/menu/inventory.gif',
                ))
          ?>            
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Perfiles', 
                  'uri'         => '@profile_list',
                  'image'       => 'backend/menu/inventory.gif',
                ))
          ?>            
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Usuarios', 
                  'uri'         => '@user_list',
                  'image'       => 'backend/menu/user.gif',
                ))
          ?>
        </tr>
      </table>
    </td>
    <td width="1%">
      <table class="submenu">
        <tr>
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Cerrar Sesi&oacute;n', 
                  'uri'         => '@log_logout',
                  'image'       => 'backend/menu/logout.gif',
                ))
          ?>
      </table>
    </td>
  </tr>
</table>
