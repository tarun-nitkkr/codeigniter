<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Sign-Up/Login Form</title>
    
  </head>

  <body>

    
    
    <form action="http://www.askandanswer.com/index.php/login/login_call" method="post" id="login_form" >
  Username/Email <input type="text" name="userid" id="username" ><br>
  Password<input type="password" name="pass" id="password" ><br>
  <input type="button" value="Login" id = "button" onclick="form_validate()">
</form>
Forgot Password?
<a href="http://www.askandanswer.com/index.php/login/forget_password_load_view">Reset Password</a>
<br>
Not a user yet?
<a href="http://www.askandanswer.com/index.php/login/signup_view">Register</a>


    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script type="text/javascript" src="/static/js/registration.js"></script>

        

    
    
    
  </body>
</html>

