<tr id="row_<?php echo $q_id; ?>"><a onclick="alpha(this.id);" class="question_row" id="question_row<?php echo $q_id; ?>">
  <div class="panel panel-default" id="panel_<?php echo $q_id; ?>">
    <div class="panel-heading" id="row_header_<?php echo $q_id; ?>"><h3><?php echo $title; ?></h3><a href="http://www.askandanswer.com/index.php/homepage/load_user_profile_view/<?php echo $user_name;?>"><span class="badge"><?php echo $user_name; ?></span></a></div>
    <div class="panel-body" id="row_body_<?php echo $q_id; ?>"><h5><span class="label label-success" style="float:left;">Answers<span class="badge"><?php echo $no_ans; ?></span></span><span class="label label-info" style="float:right;">Created On<span class="badge"><?php echo $created_on; ?></span></span></h5></div>
    <div class="panel-footer" id="row_footer_<?php echo $q_id; ?>"><?php echo $tag_csv; ?></div>
  </div>
</a>
</tr>