<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Questions|User</title>
    <?php $data=$_SESSION['user_data']?>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
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
            <form class="navbar-form" role="search" action="#">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                <div class="input-group-btn">
                  <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
                </div>
              </div>
            </form>
          </div>
          <ul class="nav navbar-nav navbar-right">
            <li ><a href="#" data-toggle="popover" data-trigger="focus" id="notification_popover"><span class="glyphicon glyphicon-bell"></span>Notification</a></li>
            <!-- <li><a href="#" data-toggle="collapse" data-target="#demo"><span class="glyphicon glyphicon-user"></span>Hi,<?php echo $data['first_name']?></a></li> -->
            <li><a href="http://www.askandanswer.com/index.php/login/logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
          </ul>
        </div>
      </nav>
      <br><br><br><br>
      <h3 id="label" data-userid="<?php echo $u_id; ?>">User Profile:<?php echo $user_name; ?></h3>
      <div id="profile_div">
        <br>
        <div class="row">
          <div class="col-sm-6" >
            <img src="/uploads/<?php echo $pic_url; ?>.png" class="img-circle" alt="Cinque Terre" width="200" height="200">
          </div>
          
          <div id="firstname" class="col-sm-6" ><h2><?php echo $first_name;?> <?php echo $last_name;?></h2>
          </div>
          
          
        </div>
        
        <div class="row">
          <div class="col-sm-6" >
            
          </div>
          
          <div id="email_id" class="col-sm-3" ><p>Email-ID:<?php echo $email_id;?></p>
          
        </div>
        <div class="col-sm-3" >
          <!-- <button id="logout_button" type="button" class="btn btn-info"><a href="http://www.askandanswer.com/index.php/login/logout">Logout</a></button> -->
        </div>
        
        
      </div>
      
      <!-- <div id="firstname">Name:<?php echo $data['first_name']?></div>
      <div id="lastname"><?php echo $data['last_name']?></div><br>
      <div id="about_me">About Me:<?php echo $data['about']?></div>
      <div id="email_id">My Email-ID:<?php echo $data['email_id']?></div> -->
      <a ><button type="button" class="btn btn-primary" width="100px">Asked Questions <span class="badge" id="no_ques">10 </span></button></a>
      <a ><button type="button" class="btn btn-primary" width="100px">Total Answers <span class="badge" id="no_ans">20 </span></button></a>
      <button data-toggle="collapse" type="button" data-target="#followed_tags_div"  class="btn btn-primary" width="100px">Followed Tags <a  id="followed_tags_tooltip" data-toggle="tooltip" title="Hooray!"><span class="badge" id="no_tag">10 </span></a></button>
      <div id="followed_tags_div" class="collapse">
        Hello
      </div>
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
      
      <h3>Questions asked by <?php echo $first_name; ?>:</h3>
      <div id="question_div">
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
      
      <ul class="pager">
        <li class="previous"><a onclick="previous_page();">Previous</a></li>
        <li><a id="page_no">Test</a></li>
        <li class="next"><a onclick="next_page();">Next</a></li>
      </ul>
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="/static/js/user_profile.js"></script>
      
      
      
    </div>
  </body>
</html>