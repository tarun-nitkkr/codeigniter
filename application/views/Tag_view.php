<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Tag_Detail_<?php echo $tag_name;?>></title>
    
  </head>

  <body>

    <h>Tag Name ::$tag_name</h>
    <br>
    <h>Tag Id:: $tag_id</h>
    <p>Tag Description::<br>
    $tag_description
    </p>
    <br>
   <?php
   $no_of_questions  = count($list_questions);
   echo "<ul>";
  for ($row = 0; $row < $no_of_questoins; $row++) {

    echo "<li><a href=".$list_questions[$row][0].">".$list_questions[$row][1]."</a></li>"

  }
  echo "</ul>";
}
?>
        

    
    
    
  </body>
</html>

