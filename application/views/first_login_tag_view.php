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
     
      top: 50px;
      left: -15px;
      display: block;
      width: 300px;

  }
  .ui-autocomplete-highlight {
    font-weight: bold;
  }
  
  
  
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
            <!-- <form class="navbar-form" role="search" action="#">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                <div class="input-group-btn">
                  <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
                </div>
              </div>
            </form> -->
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
      
      
      <a href="http://www.askandanswer.com/index.php/homepage/load_user_specific_question_view/asked"<button type="button" class="btn btn-primary" width="100px">Asked Questions <span class="badge" id="no_ques">10 </span></button></a>
      <a href="http://www.askandanswer.com/index.php/homepage/load_user_specific_question_view/answered"<button type="button" class="btn btn-primary" width="100px">Total Answers <span class="badge" id="no_ans">20 </span></button></a>
      <button data-toggle="collapse" type="button" data-target="#followed_tags_div"  class="btn btn-primary" width="100px">Followed Tags <a  id="followed_tags_tooltip" data-toggle="tooltip" title="Hooray!"><span class="badge" id="no_tag">10 </span></a></button>
      <div id="followed_tags_div" class="collapse">
        Hello
      </div>
    </div>
      <br>
      <br>
      <br>
      <br>
      <h2>Choose atleast 5 tags to proceed:-</h2>
      <div id="tags_div">
      </div>
      <br>
      <button class="btn-block btn-primary" id="done_button" onclick="proceed();">PROCEED</button>
      <br>
      <br>
      <br>
      <br>
      
       
      
     
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="/static/js/first_login_tag.js"></script>
      
      
      
    </div>
  </body>
</html>