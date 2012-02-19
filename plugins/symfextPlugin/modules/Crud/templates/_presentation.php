<table class="form" cellspacing="1" cellpadding="5" align="center" width="100%">
  <tr class="title" style="height: 25px; cursor: pointer;" id="1">
    <th colspan="100" class="title">
      <table class="clear" width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <?php echo $title ?>
        </tr>
      </table>
    </th>
  </tr>  
  <?php include_slot($slot) ?>
</table>