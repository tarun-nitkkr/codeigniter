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
    .ui-autocomplete-highlight {
    font-weight: bold;
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
            <form class="navbar-form" id="search_form" role="search" action="#">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                <div class="input-group-btn">
                  <button class="btn btn-default" type="button" onclick="question_search();"><i class="glyphicon glyphicon-search"></i></button>
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
      <div id="demo" class="collapse">
        <br><br><br><br><br><br>
        <div class="row">
          <div class="col-sm-6" >
            <div class="col-sm-3">
            <img src="/uploads/<?php echo $data['pic_url']?>.png" class="img-circle" alt="Cinque Terre" width="100" height="100">
          </div>
          <div class="col-sm-6">
            <h2>Welcome <?php echo $data['first_name']?> <?php echo $data['last_name']?></h2><p>My Email-ID:<?php echo $data['email_id']?></p>
          </div>
          </div>
          
          <div id="firstname" class="col-sm-6">
            <a href="http://www.askandanswer.com/index.php/homepage/load_user_specific_question_view/asked"<button type="button" class="btn btn-primary" width="100px">Asked Questions <span class="badge" id="no_ques">10 </span></button></a>
            <a href="http://www.askandanswer.com/index.php/homepage/load_user_specific_question_view/answered"<button type="button" class="btn btn-primary" width="100px">Total Answers <span class="badge" id="no_ans">20 </span></button></a>
            <button data-toggle="collapse" type="button" data-target="#followed_tags_div"  class="btn btn-primary" width="100px">Followed Tags <a  id="followed_tags_tooltip" data-toggle="tooltip" title="Hooray!"><span class="badge" id="no_tag">10 </span></a></button>
            <div id="followed_tags_div" class="collapse">
              Hello
            </div>
          </div>
          
          
        </div>
        
      </div>
      <br>
      <br>
      <br>
      <br>
      
      <button data-toggle="collapse" data-target="#ask_question_div" class="btn btn-primary" style="width:100%;">ASK a QUESTION <span class="glyphicon glyphicon-envelope"></span></button>
      
      
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
      <ul class="nav nav-tabs">
        <li class="active" id="recent_tab"><a >Recent</a></li>
        <li id="followed_tab"><a >Followed</a></li>
        <!-- <li><a href="#">Menu 2</a></li>
        <li><a href="#">Menu 3</a></li> -->
      </ul>
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
      <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="/static/js/homepage.js"></script>
      
      
      
    </div>
  </body>
</html>