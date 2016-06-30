<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Ask  Page<?php echo $u_id;?></title>
    <h1>THIS IS ASK QUESTION  PAGE</h1>
    <br>
  </head>

  <body>


<br>
<br>
<br>
<br>

  <form action="http://www.askandanswer.com/index.php/login/post_question" method="post"  enctype="multipart/form-data" id = "question_form">
  
  Quesition Title: <input type="text" name="question_title"><br><br>
 

  Question Data: <input type="text" name="question_data"><br><br>

  <div class="form-group">
  <label class="control-label" for="question_tags">Select tags from list(ctrl+click):</label>
  <select class="form-control" id="question_tags" name = "tags">
    <option>Tobias</option>
    <option>Dennis</option>
    <option>Jerry</option>
    <option>Jack</option>
  </select>
</div>
<br>
<br>

 <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>

</form> 


</div>
<script> document.getElementById("question_form").reset();
</body>
</html>
