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
   $no_of_questions  = count($list_questions);
   echo "<ul>";
   ?>
 <?php for ($row = 0; $row < $no_of_questions; $row++) {
  ?>

   // \\echo<<<HTML
    echo '<li><a href="'.'http://www.askandanswer.com/index.php/login/question_detail">'."Hello WORDDDDDDDD</a></li>";
    <a href="http://www.askandanswer.com/index.php/login/question_detail">answer1</a>
  
  }
  
  echo "</ul>";

?>
        

    
    
    
  </body>
</html>

