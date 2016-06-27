function field_focus(field, value)
  {
    if(field.value == value)
    {
      field.value = '';
    }
  }

  function field_blur(field, value)
  {
    if(field.value == '')
    {
      field.value = value;
    }
  }



//Fade in dashboard box
$(document).ready(function(){
    $('#signup_form').hide();
   $('#emailid_label').hide();
   $('#username_label').hide();
    $('.box').hide().fadeIn(1000);
    //$("#emailid_label").html("changed");
    
    });

// //Stop click event
// $('#sign_in').click(function(event){
//     //event.preventDefault(); 
//     .submit();
// 	});



$("#submit_button").click(function(){
    //$("#wrong_label").text('hello');
    var data={
      userid: $('#userid').val(),
      pass: $('#pass').val()
    };
    $.ajax({
      url: "http://www.askandanswer.com/index.php/login/login_call",
      data: data,
      dataType: "json",
      type: "post",
      success: function(response){
       //if( response.indexOf('result') > -1 )
       //   console.log("result not empty");
       //console.log(response.result);
        //$("#wrong_label").html(response.result
          console.log(response);

        $("#sexydiv").html(response.result).fadeIn('slow/400/fast');
    }

  });
});


$("#signup_button").click(function() {
  /* Act on the event */
  $('#signin_form').hide();
  $('#signup_form').fadeIn('slow');
});


$("#emailid").change(function() {
  //console.log("selected");
  //fire ajax for email check
  var data={
      data: $('#emailid').val(),
      type: "emailid"
     
    };
    $.ajax({
      url: "http://www.askandanswer.com/index.php/login/check_username",
      data: data,
      dataType: "json",
      type: "get",
      success: function(response){
       //if( response.indexOf('result') > -1 )
       //   console.log("result not empty");
       //console.log(response.result);
        //$("#wrong_label").html(response.result
          //console.log(response.result);

          
          if(response.result !='0')
          {

            //$("#wrong_label").html(response.result);
            $("#emailid_label").html(response.result);
            $("#emailid_label").fadeOut(1000);
          }
          else
          {
            //$("#wrong_label").html(response.result);
            $("#emailid_label").hide();
          }
        //$("#sexydiv").html(response.result).fadeIn('slow/400/fast');
    }

  });
});

$("#reg_userid").change(function() {
  //console.log("selected");
  //fire ajax for username check
  var data={
      data: $('#reg_userid').val(),
      type: "username"
     
    };
    $.ajax({
      url: "http://www.askandanswer.com/index.php/login/check_username",
      data: data,
      dataType: "json",
      type: "get",
      success: function(response){
       //if( response.indexOf('result') > -1 )
       //   console.log("result not empty");
       //console.log(response.result);
        //$("#wrong_label").html(response.result
         //console.log(response.result);
          if(response.result!='0')
          {
            //console.log(response.result);

            $("#username_label").html(response.result);
            $("#username_label").show();
          }
          else
          {
            $("#username_label").hide();
          }
        //$("#sexydiv").html(response.result).fadeIn('slow/400/fast');
    }

  });
});