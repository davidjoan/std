<script type="text/javascript">
    function create( template, vars, opts ){
        return $container.notify("create", template, vars, opts);
    }
    
    $(function(){
        var records = <?php echo $records; ?>;
        $container = $("#container").notify();
        setInterval(function() {
            
            $.ajax({
                url: "<?php echo sfConfig::get('app_domain'); ?>/notify",
                success: function(data){
                    var qty = data['qty'];
                    
                    if(qty > records)
                    {
                        create("default", { title:'Nuevos Expedientes', text:'Porfavor haga click <a href=\'<?php echo sfConfig::get('app_domain'); ?>/listar/expediente/0/0/0/code/0/id/a/20/1\'><b style=\'color: #FFFFFF; font: bold 34px;\'>Aqui</b></a> para ver los cambios.'},{ expires: true });
                    }
                    
                }
            });    
        }, 1000 * 60 * 0.5);
});
</script>

<!--- container to hold notifications, and default templates --->
<div id="container" style="display:none">

    <div id="default">
        <a class="ui-notify-close ui-notify-cross" href="#">x</a>
        <h1>#{title}</h1>
        <p>#{text}</p>
    </div>

</div>

<table>
    <tr>
        <td class="left">
            <?php echo link_to(image_tag('general/logo.jpg', array('height' => '50px')), 'http://www.seringsac.com/') ?>
        </td>
        <td class="right">
            <?php echo image_tag('backend/secure_user.png') ?>&nbsp;<?php echo $sf_user->getUsername() ?>
        </td>
    </tr>
</table>
