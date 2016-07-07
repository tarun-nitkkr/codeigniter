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
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/smoothness/jquery-ui.css" />
     <style>
  /* Popover */
  .popover {
     /* position: absolute;
      border: 2px black;
      max-width: 600px;
      left: 0;
      right: 0;*/
      top: 50px;
      left: -15px;
      display: block;
      width: 300px;

  }
  
  /*.popover-title {
      background-color: #73AD21;
      color: #FFFFFF;
      font-size: 28px;
      text-align:center;
  }
  
  .popover-content {
      background-color: coral;
      color: #FFFFFF;
      padding: 50px;
  }*/
  
  .arrow {
      /*border-right-color: red !important;*/
      left: 24%;
  }
  </style>
  </head>
  <body>
    <div class="container">
      <!-- <h1><?php echo $_SESSION['q_id']?></h1> -->
      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="http://www.askandanswer.com">ASK&ANSWER</a>
          </div>
          <ul class="nav navbar-nav">
            <!-- <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Page 1</a></li>
            <li><a href="#">Page 2</a></li>
            <li></li> -->
          </ul>
          <div class="col-sm-3 col-md-3">
            <form class="navbar-form" role="search">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                <div class="input-group-btn">
                  <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
              </div>
            </form>
          </div>
          <ul class="nav navbar-nav navbar-right">
            <li ><a href="#" data-toggle="popover" data-trigger="focus" id="notification_popover"><span class="glyphicon glyphicon-bell"></span>Notification</a></li>
            <li><a href="#" data-toggle="collapse" data-target="#demo"><span class="glyphicon glyphicon-user"></span>Hi,<?php echo $data['first_name']?></a></li>
            <li><a href="http://www.askandanswer.com/index.php/login/logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
          </ul>
        </div>
      </nav>
      <!-- <button data-toggle="collapse" data-target="#demo" class="badge" style="width:100%;"><h4><span class="glyphicon glyphicon-user"></span>My Profile</h4></button> -->
      <div id="demo" class="collapse">
        <br><br><br><br><br><br>
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
          <!-- <button id="logout_button" type="button" class="btn btn-info"><a href="http://www.askandanswer.com/index.php/login/logout">Logout</a></button> -->
        </div>
        
        
      </div>
      
      <!-- <div id="firstname">Name:<?php echo $data['first_name']?></div>
      <div id="lastname"><?php echo $data['last_name']?></div><br>
      <div id="about_me">About Me:<?php echo $data['about']?></div>
      <div id="email_id">My Email-ID:<?php echo $data['email_id']?></div> -->
      <a href="http://www.askandanswer.com/index.php/homepage/load_user_specific_question_view/asked"<button type="button" class="btn btn-primary" width="100px">Asked Questions <span class="badge" id="no_ques">10 </span></button></a>
      <a href="http://www.askandanswer.com/index.php/homepage/load_user_specific_question_view/answered"<button type="button" class="btn btn-primary" width="100px">Total Answers <span class="badge" id="no_ans">20 </span></button></a>
      <button data-toggle="collapse" type="button" data-target="#followed_tags_div" class="btn btn-primary" width="100px">Followed Tags <a  id="followed_tags_tooltip" data-toggle="tooltip" title="Hooray!"><span class="badge" id="no_tag">10 </span></a></button>
      <div id="followed_tags_div" class="collapse">
      </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <button data-toggle="collapse" data-target="#ask_question_div" class="btn btn-primary" style="width:100%;"><span class="glyphicon glyphicon-envelope"></span>ASK a QUESTION</button>
      <div id="ask_question_div" class="collapse">
        <br>
        <form class="form-horizontal" role="form" action="http://www.askandanswer.com/index.php/homepage/post_question" method="get" >
          <div class="form-group">
            <label class="control-label col-sm-2" for="question-title">Question Title:</label>
            <div class="col-sm-10">
              <input class="form-control" id="question_title" placeholder="Question Title">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="question_detail">Question Detail:</label>
            <div class="col-sm-10">
              <textarea class="form-control" rows="5" id="question_detail"></textarea>
            </div>
          </div>
          <div class="form-group ui-widget">
            <label class="control-label col-sm-2" for="ask_question_tags">Select tags from list:</label>
            <div class="col-sm-10">
              <input class="form-control" id="ask_question_tags">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="button" class="btn btn-default" id="ask_question_button">Submit</button>
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
    <br>
    <br>
    <br>
    <br>
    <button data-toggle="modal" data-target="#myModal" class="btn btn-success" style="width:100%;" id="answer_button"><span class="glyphicon glyphicon-pencil"></span>Answer this Question</button>
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Type in your answer:</h4>
          </div>
          <div class="modal-body">
            
              <!-- <input type="text" placeholder="Your Answer"> -->
              <textarea rows="15" cols="68" id="answer_data"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" onclick="submit_answer();" class="btn btn-default" data-dismiss="modal" id="submit_answer_button">Submit Answer</button>
          
          </div>
        </div>
        
      </div>
    </div>



    <div class="modal fade" id="myeditModal" role="dialog">
      <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Type in your answer:</h4>
          </div>
          <div class="modal-body">
            
              <!-- <input type="text" placeholder="Your Answer"> -->
              <textarea rows="15" cols="68" id="answer_data_edit"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" onclick="submit_edited_answer();" class="btn btn-default" data-dismiss="modal" id="submit_edited_answer_button">Update Answer</button>
          
          </div>
        </div>
        
      </div>
    </div>
    <h2>ANSWERS</h2>
    <div id="answer_div">
      
      <!-- <tr id="row">
        <div class="panel panel-success">
          <div class="panel-heading"><h4><span class="badge" style="float:left;">UserName</span><span class="label label-info" style="float:right;">Posted on<span class="badge">X</span></span><br></h4></div>
          <div class="panel-body">Panel Content</div>
        </div>
      </tr> -->
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
      
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/static/js/question_detail.js"></script>
    
    
    
  </div>
</body>
</html>