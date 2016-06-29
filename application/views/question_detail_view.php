<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homepage|Question</title> 
  <?php $data=$_SESSION['user_data']?>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  </head>

  <body>
    <div class="container">

      <!-- <h1><?php echo $_SESSION['q_id']?></h1> -->
      <button data-toggle="collapse" data-target="#demo" class="badge" style="width:100%;"><h4>My Profile<span class="glyphicon glyphicon-user"></span></h4></button>
      <div id="demo" class="collapse">
   <div class="row">
        <div class="col-sm-6" >
          <img src="/uploads/<?php echo $data['pic_url']?>.png" class="img-circle" alt="Cinque Terre" width="100" height="100">      
        </div>
    
        <div id="firstname" class="col-sm-6" ><h2>Welcome <?php echo $data['first_name']?> <?php echo $data['last_name']?></h2>
        </div>
      
    
  </div>
  
  <div class="row">
        <div class="col-sm-6" >
        
        </div>
    
        <div id="email_id" class="col-sm-3" ><p>My Email-ID:<?php echo $data['email_id']?></p>
          
        </div>
        <div class="col-sm-3" >
          <button id="logout_button" type="button" class="btn btn-info"><a href="http://www.askandanswer.com/index.php/login/logout">Logout</a></button>
        </div>
      
    
  </div>
      

<!-- <div id="firstname">Name:<?php echo $data['first_name']?></div>
<div id="lastname"><?php echo $data['last_name']?></div><br>
<div id="about_me">About Me:<?php echo $data['about']?></div>
<div id="email_id">My Email-ID:<?php echo $data['email_id']?></div> -->

<button type="button" class="btn btn-primary" width="100px">Asked Questions <span class="badge" id="no_ques">10 </span></button>
<button type="button" class="btn btn-primary" width="100px">Total Answers <span class="badge" id="no_ans">20 </span></button>
<button type="button" class="btn btn-primary" width="100px">Followed Tags <a href="" id="followed_tags_tooltip" data-toggle="tooltip" title="Hooray!"><span class="badge" id="no_tag">10 </span></a></button>
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
  <label for="question_tags">Select tags from list(ctrl+click):</label>
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

<br>
<br>
<br>
<br>


<div id="question_info_div">
<div class="panel panel-primary" id="panel_question">
      <div class="panel-heading" id="question_title"><h3>Question Title</h3></div>
      <div class="panel-body" id="question_body">Question Data</div>
    </div>
<h3><span class="label label-success" style="float:left;">Answers<span class="badge">X</span></span><span class="label label-info" style="float:right;">Posted on<span class="badge">X</span></span></h3>
</div>
<div id="tag_div">
  
</div>
<br>
<br>
<br>
<br>
<button data-toggle="collapse" data-target="#demo" class="btn btn-success" style="width:100%;">Answer this Question<span class="glyphicon glyphicon-pencil"></span></button>


<div id="answer_div">
<table>
  
  <!-- <tr id"row_1">
    <div class="panel panel-default">
  <div class="panel-heading" id="row_header_1">Panel heading</div>
  <div class="panel-body" id="row_body_1">Panel Content</div>
  <div class="panel-footer" id="row_footer_1">Panel Footer</div>
</div>
  </tr> -->
  <!-- <tr>
    <div class="panel panel-default">
  <div class="panel-heading" >Panel heading</div>
  <div class="panel-body">Panel Content</div>
  <div class="panel-footer">Panel Footer</div>
</div>
  </tr>
  <tr>
    <div class="panel panel-default">
  <div class="panel-heading" >Panel heading</div>
  <div class="panel-body">Panel Content</div>
  <div class="panel-footer">Panel Footer</div>
</div>
  </tr>
  <tr>
    <div class="panel panel-default">
  <div class="panel-heading" >Panel heading</div>
  <div class="panel-body">Panel Content</div>
  <div class="panel-footer">Panel Footer</div>
</div>
  </tr> -->
  
</table>
</div>





    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/static/js/question_detail.js"></script>

        

    
    
    </div>
  </body>
</html>
