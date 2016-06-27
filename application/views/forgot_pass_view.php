<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Reset Password Form</title>
    
  </head>

  <body>

 <form action="http://www.askandanswer.com/index.php/login/forgot_password" method="post" id="login_form">

 
  	   Email-ID <input type="text" name="emailid" id = "email"><br> 
      <!-- <button type = "submit" value = "Submit" id = "b" onclick="form_validate()"/> -->
      <input type="button" value="Submit" id = "button" onclick="form_validate()">
	</form>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script type="text/javascript" src="/static/js/registration.js"></script>


  </body>
</html>