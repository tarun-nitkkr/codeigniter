<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Question Detail Page<?php echo $u_id;?></title>
    
  </head>

  <body>
  <p>

  <h>$q_id<br> $q_title</h>
  <br>
  <b>Likes:$no_of_likes</b><br>
  <b>Date::$q_create_date</b><br>
  <b>Last Modified::$q_modified_date</b><br>
  <b>No. of answers::$q_num_answer</b><br>
  
  <p>$q_data</p>

  <br>
  <br>
  <br>
  <p>
  <?php
  $n = $q_num_answer;
  while($n>0)
  {
  	<h>echo "a_id:"+$answer_data[$n][0]</h>
  	<p><b>echo $answer_data[$n][1]</b></p>
  	<p><b>echo $answer_data[$n][3]</b></p>
  	<p><b>echo "Date::"+ $answer_data[$n][4]</b></p>
  	<p></b>echo "Last Modified::" + $answer_data[$n][5]</b></p>
  	<p>echo"Detailed::"<br> $answer_data[$n][2]</p>
  	$n = $n - 1;
  }
  </p>
 
  
  </body>
  </html>>