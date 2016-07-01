<tr id="row_<?php echo $a_id; ?>">
    <div class="panel panel-success">
      <div class="panel-heading"><h4><span class="badge" style="float:left;"><?php echo $user_name; ?></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a onclick="like_click(this.id)" id="status_<?php echo $like_status; ?>-<?php echo $a_id; ?>"><span class="glyphicon glyphicon-thumbs-up" style="<?php if($like_status){echo "color:blue;";} else{ echo "color:grey;";}?>"></span><span class="badge" style="background-<?php if($like_status){echo "color:blue;";} else{ echo "color:grey;";}?>"><?php echo $upvotes; ?></span></a><span class="label label-info" style="float:right;">Posted on<span class="badge"><?php echo $created_on; ?></span></span><?php echo $button; ?><br></h4></div>
      <div class="panel-body" <?php echo $data_id; ?>><?php echo $a_data; ?></div>
    </div>
</tr>