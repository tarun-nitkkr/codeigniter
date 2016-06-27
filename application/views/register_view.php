<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Sign-up Form</title>
    
  </head>

  <body>
  
  <form action="http://www.askandanswer.com/index.php/login/register" method="post"  enctype="multipart/form-data">
  
  Username <input type="text" name="userid"><br>
  Email-ID <input type="text" name="emailid"><br>

  Password<input type="password" name="pass"><br>
  Firstname<input type="text" name="f_name"><br> 
  Lastname<input type="text" name="l_name"><br>
  About Me<input type="text" name="about_me"><br>
  <input type="hidden" name="MAX_FILE_SIZE" value="2097150" />
  Profile Pic<input type="file" name="profile"><br>
  Re-enter Password<input type="password" name="repass"><br>
         <br/> 
         <input type = "submit" value = "Register" />
</form> 


  

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        

    
    
    
  </body>
</html>

