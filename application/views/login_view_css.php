<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Simple HTML & CSS Login Form</title>
    
    
    
    
        <link rel="stylesheet" href="/static/css/style.css">

    
    
    
  </head>

  <body>
<div id="sexydiv">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,600' rel='stylesheet' type='text/css'>

<div class="box">
<form method="post" action="http://www.askandanswer.com/index.php/login/login_call" id="signin_form" >

<h1>Sign In</h1>

<input type="text" name="userid" value="email" id="userid" onFocus="field_focus(this, 'email');" onblur="field_blur(this, 'email');" class="email" />
  
<input type="password" name="pass" value="email" id="pass" onFocus="field_focus(this, 'email');" onblur="field_blur(this, 'email');" class="email" />

  
<button id="submit_button" class="btn" value='sign_in' type="button"> Sign In</button>
<button id="signup_button" class="btn" value='sign_up' type="button"> Sign Up</button>

<!-- <a href="#"><div id="btn2">Sign Up</div></a> <!-- End Btn2 --> 


</form>
<form action="http://www.askandanswer.com/index.php/login/register" method="post"  enctype="multipart/form-data" id="signup_form">
  <h1>Sign Up</h1>
  <input type="text" name="userid" value="Username" id="reg_userid" onFocus="field_focus(this, 'Username');" onblur="field_blur(this, 'Username');" class="email"><br>
  <div id="username_label" >12</div>
  <input type="text" name="emailid" value="Email" id="emailid" onFocus="field_focus(this, 'Email');" onblur="field_blur(this, 'Email');" class="email"><br>
  

  <input type="password" name="pass" value="password" id="reg_pass" onFocus="field_focus(this, 'Password');" onblur="field_blur(this, 'Password');" class="email" ><br>
  <input type="password" name="repass" value="password" id="reg_repass" onFocus="field_focus(this, 'Password');" onblur="field_blur(this, 'Password');" class="email"><br>
  <input type="text" name="f_name" value="Firstname" id="f_name" onFocus="field_focus(this, 'Firstname');" onblur="field_blur(this, 'Firstname');" class="email"><br> 
  <input type="text" name="l_name" value="Lastname" id="l_name" onFocus="field_focus(this, 'Lastname');" onblur="field_blur(this, 'Lastname');" class="email"><br>
  <input type="text" name="about_me" value="About Me" id="about_me" onFocus="field_focus(this, 'About Me');" onblur="field_blur(this, 'About Me');" class="email"><br>
  <input type="hidden" name="MAX_FILE_SIZE" value="2097150" />
  <input type="file" name="profile" class='email'><br>
  
         <br/> 
         <button id="register_button" class="btn" type="submit"> Register</button>
</form> 
</div> <!-- End Box -->
  <div id="wrong_label" ></div>
<div id="emailid_label" >34</div>
<p>New here?<a href="http://www.askandanswer.com/index.php/login/signup_view"><u style="color:#f1c40f;">Register</u></a></p>
<p>Forgot your password? <u style="color:#f1c40f;">Click Here!</u></p>
  
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
    
        <script src="/static/js/index.js"></script>

    
    
  </div> 
  </div> 
  </body>
  
</html>