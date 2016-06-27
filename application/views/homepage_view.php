<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homepage</title>
  <?php $data=$_SESSION['user_data']?>  
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  </head>

  <body>
    <div class="container">

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

<button type="button" class="btn btn-primary" width="100px">Asked Questions <span class="badge">10 </span></button>
<button type="button" class="btn btn-primary" width="100px">Total Answers <span class="badge">20 </span></button>
<button type="button" class="btn btn-primary" width="100px">Followed Tags <span class="badge">10 </span></button>
<br>
<br>
<br>
<br>
<button data-toggle="collapse" data-target="#demo" class="badge">ASK a QUESTION <span class="glyphicon glyphicon-envelope"></span></button>

<div id="demo" class="collapse">

  <form class="form-horizontal" role="form" action="http://www.askandanswer.com/index.php/login/login_call" method="post" id="ask_form">
  <div class="form-group">
    <label class="control-label col-sm-2" for="question-title">Question Title:</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="question_title" placeholder="Enter email">
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
<!-- <form action="http://www.askandanswer.com/index.php/login/login_call" method="post" id="ask_form" >
  Question Title<input type="text" name="userid" id="question_title" ><br>
  Tags<input type="password" name="pass" id="question_tags" ><br>
  Question Detail<input type="text" name="pass" id="question_detail" ><br>
  <input type="submit" value="ASK" id = "ask_button" >
</form> -->
</div>

<br>
<br>
<br>
<br>
<ul class="nav nav-tabs">
  <li class="active"><a href="#">Recent</a></li>
  <li><a href="#">Followed</a></li>
  <!-- <li><a href="#">Menu 2</a></li>
  <li><a href="#">Menu 3</a></li> -->
</ul>
<div class="panel panel-default">
  <div class="panel-heading">Panel heading</div>
  <div class="panel-body">Panel Content</div>
  <div class="panel-footer">Panel Footer</div>
</div>
<br>

<div class="panel panel-default">
  <div class="panel-heading">Panel heading</div>
  <div class="panel-body">Panel Content</div>
  <div class="panel-footer">Panel Footer</div>
</div>

<ul class="pagination">
  <li class="active"><a href="#">1</a></li>
  <li ><a href="#">2</a></li>
  <li><a href="#">3</a></li>
  <li><a href="#">4</a></li>
  <li><a href="#">5</a></li>
</ul>
<ul class="pager">
  <li class="previous"><a href="#">Previous</a></li>
  <li class="next"><a href="#">Next</a></li>
</ul>


    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/static/js/homepage.js"></script>

        

    
    
    </div>
  </body>
</html>

