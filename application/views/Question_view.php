<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Question Detail Page<?php echo $u_id;?></title>
    <h1>THIS IS QUESTION DETAIL PAGE</h1>
    <br>
  </head>

  <body>
  
  <h1>QUESTION</h1>
  <h>$q_id::<br> <?php echo $q_title?></h>
  <br>
  <b>Likes::<br><?php echo $no_of_likes?></b><br>
  <b>Date::<br><?php echo $q_create_date?></b><br>
  <b>Last Modified::<br><?php echo $q_modified_date?></b><br>
  <b>No. of answers::<br><?php echo $q_num_answer?></b><br>
  
  <p><b>$q_data::</b><br><?php echo $q_data?></p>

  <br>
  <br>
  <br>
  <h1>ANSWERS</h1>
  <br>
  <?php
  $n = $q_num_answer-1;
  //echo "No. of answers="+$n;//+"Check data="+$answer_data[0][0];
	

  while($n>=0)
  {

  	echo<<<HTML
  	<h> "a_id:"<br>{$answer_data[$n]['a_id']}</h>
	<p><b> "user:"<br>{$answer_data[$n]['u_id']}</b></p>
	<p><b> "Upvotes:"<br>{$answer_data[$n]['upvotes']}</b></p>
	<p><b> "Date::"<br>{$answer_data[$n]['created_on']}</b></p>
	<p><b> "Last Modified::"<br>{$answer_data[$n]['last_modified']}</b></p>
  	<p><b>"Detailed::<b>"<br> {$answer_data[$n]['a_data']}</p>

  	<br>
  	<br>
  	<br>

HTML;
  	$n = $n - 1;
  }
 	?>
  </body>
  </html>