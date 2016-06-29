<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Tag_Detail_<?php echo $tag_name;?></title>
    
  </head>

  <body>

    <h>Tag Name ::<?php echo $tag_name?></h>
    <br>
    <h>Tag Id:: <?php echo$tag_id?></h>
    <p>Tag Description::<br>
    <?php echo$tag_description?>
    </p>
    <br>
   <?php
   $no_of_questions  = sizeof($list_questions);
   echo "No. of questions=".$no_of_questions;
   echo "<br>";
      
     //  $a = '<a href="http://www.askandanswer.com/index.php/login/question_detail">answer1</a>';
    //echo $a;
  

  //echo $list_questions[0][0].": In stock: ".$list_questions[0][1].".<br>";
   // for ($row = 0; $row < $no_of_questions; $row++) {
    //oreach($foo as $key1 => $val1) 
    foreach($list_questions as $key1=> $val)
    {
      $l = $val['0'];
      $k = $val['1'];
    //  echo $l;

      //echo "Q_id=".$list_questions[0][0].": Q_title: ".$list_questions[0][1].".<br>";

     echo '<a href="http://www.tutorialspoint.com" target="_self">q_id::'.$l."Q_title::".$k."</a>";
     echo "<br>";


    }

?>
        

    
    
    
  </body>
</html>

