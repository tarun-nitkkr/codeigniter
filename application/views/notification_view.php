<tr id="notificaton_row_<?php echo $q_id; ?>"><a onclick="notification_click(this.id);" class="question_row" id="notification_row_<?php echo $q_id; ?>-<?php echo $n_id; ?>">
  <!-- <div class="panel panel-default" id="panel_<?php echo $q_id; ?>">
    
    
    
  </div> -->
  <div class="panel-body" id="notification_body_<?php echo $q_id; ?>" <?php if($is_viewed){echo 'style="color:grey;"';}  ?>><span class="glyphicon glyphicon-asterisk">&nbsp</span><?php echo $details; ?></div>
  <!-- <p><?php echo $details; ?></p> -->
</a>
</tr>