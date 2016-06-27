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

 <form action="http://www.askandanswer.com/index.php/login/enter_new_pass" method="post" id="tag_form">


      Email_id <input type = "hidden" name ="email_id" value = <?php echo $emailid;?> id = "email">
       New Password<input type="password" name="pass" id="password" ><br>
       Re-Enter Password<input type="password" name="pass1" id="repassword" ><br>
       <input type="button" value="submit" id = "button" onclick="form_validate()">

      <!-- <button type = "submit" value = "Submit" id = "b" onclick="form_validate()"/> -->
	</form>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script type="text/javascript" src="/static/js/registration_tag.js"></script>


  </body>
</html>