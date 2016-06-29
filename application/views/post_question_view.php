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
<button type="button" class="btn btn-primary" width="100px">Asked Questions <span class="badge" id="no_ques">10 </span></button>
<button type="button" class="btn btn-primary" width="100px">Total Answers <span class="badge" id="no_ans">20 </span></button>
<button data-toggle="collapse" type="button" data-target="#followed_tags_div"  class="btn btn-primary" width="100px">Followed Tags <a href="" id="followed_tags_tooltip" data-toggle="tooltip" title="Hooray!"><span class="badge" id="no_tag">10 </span></a></button>
<div id="followed_tags_div" class="collapse">

  Hello
</div>
<br>
<br>
<br>
<br>
<button data-toggle="collapse" data-target="#ask_question_div" class="btn btn-primary" style="width:100%;">ASK a QUESTION <span class="glyphicon glyphicon-envelope"></span></button>

<div id="ask_question_div" class="collapse">

  <form class="form-horizontal" role="form" action="http://www.askandanswer.com/index.php/login/login_call" method="post" id="ask_form">
  <div class="form-group">
    <label class="control-label col-sm-2" for="question-title">Question Title:</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="question_title" placeholder="Question Title">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="question_detail">Question Detail:</label>
    <div class="col-sm-10"> 
      <textarea class="form-control" rows="5" id="question_detail"></textarea>
    </div>
  </div>
  <div class="form-group">
  <label class="control-label" for="question_tags">Select tags from list(ctrl+click):</label>
  <select class="form-control" id="question_tags">
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
  </select>
</div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>

</div>
</body>
</html>
