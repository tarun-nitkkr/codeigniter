// function field_focus(field, value)
//   {
//     if(field.value == value)
//     {
//       field.value = '';
//     }
//   }

//   function field_blur(field, value)
//   {
//     if(field.value == '')
//     {
//       field.value = value;
//     }
//   }


//var row_count=1;
//Fade in dashboard box
var question_page=1;


$(document).ready(function(){
   
   //$("#question_div").load("http://www.askandanswer.com/index.php/homepage/populate_question_recent");
   var type=$("#label").html();
   if(type=='ASKED QUESTIONS:')
   {
    var data={
      
      from: 0
    };
    $.ajax({
      url: "http://www.askandanswer.com/index.php/homepage/populate_asked_questions",
      data: data,
      type:"get",
      dataType: "html",
      success: function(response){
       
         //console.log(response);

        $("#question_div").html("<table>"+response+"</table>");
        //$("#question_div").empty().append('<tr id"row_1"><div class="panel panel-default"><div class="panel-heading" id="row_header_1">Panel heading</div><div class="panel-body" id="row_body_1">Panel Content</div><div class="panel-footer" id="row_footer_1">Panel Footer</div></div></tr>');
        
        //$(div).find('.ps_desc').html(response.result).end().appendTo($('body'));
    }

    });

   }
   else
   {
      var data={
        
        from: 0
      };
      $.ajax({
        url: "http://www.askandanswer.com/index.php/homepage/populate_answered_questions",
        data: data,
        type:"get",
        dataType: "html",
        success: function(response){
         
           //console.log(response);

          $("#question_div").html("<table>"+response+"</table>");
          //$("#question_div").empty().append('<tr id"row_1"><div class="panel panel-default"><div class="panel-heading" id="row_header_1">Panel heading</div><div class="panel-body" id="row_body_1">Panel Content</div><div class="panel-footer" id="row_footer_1">Panel Footer</div></div></tr>');
          
          //$(div).find('.ps_desc').html(response.result).end().appendTo($('body'));
      }

      });


   }
    
    

    $.ajax({
      url: "http://www.askandanswer.com/index.php/homepage/user_interaction_details",
      type:"get",
      dataType: "json",
      success: function(response){
       
        
        //var data = $.parseJSON();

        $("#no_ques").html(response.no_ques);
        $("#no_ans").html(response.no_ans);
        $("#no_tag").html(response.no_tag);
        $("#followed_tags_tooltip").attr('title', response.tag_csv);
        
        $("#followed_tags_div").html(response['html']);
        //$("#question_div").empty().append('<tr id"row_1"><div class="panel panel-default"><div class="panel-heading" id="row_header_1">Panel heading</div><div class="panel-body" id="row_body_1">Panel Content</div><div class="panel-footer" id="row_footer_1">Panel Footer</div></div></tr>');
        
        //$(div).find('.ps_desc').html(response.result).end().appendTo($('body'));
    }

    });

    $("#page_no").html(question_page);
    $.ajax({
      url: "http://www.askandanswer.com/index.php/homepage/retrieve_notification",
      type:"get",
      dataType: "html",
      success: function(response){
       
        //console.log(response);
        //$("#notification_popover").attr("html",true);
        //$("#notification_popover").attr("data-content","hello");
        $('[data-toggle="popover"]').popover({title: "", content: '<table border="1">'+response+'</table>', html: true, placement: "bottom"});
        //$("#notification_popover").attr("data-content","<table>"+response+"</table>");
        //$("#question_div").empty().append('<tr id"row_1"><div class="panel panel-default"><div class="panel-heading" id="row_header_1">Panel heading</div><div class="panel-body" id="row_body_1">Panel Content</div><div class="panel-footer" id="row_footer_1">Panel Footer</div></div></tr>');
        
        //$(div).find('.ps_desc').html(response.result).end().appendTo($('body'));
    }

    });

    
});

// //Stop click event
// $('#sign_in').click(function(event){
//     //event.preventDefault(); 
//     .submit();
// 	});



$("#followed_tab").click(function(){
    //$("#wrong_label").text('hello');
    var data={
      type: 'followed',
      from: (question_page-1)*10
    };
    $.ajax({
      url: "http://www.askandanswer.com/index.php/homepage/populate_question_recent",
      data: data,
      dataType: "html",
      type: "get",
      success: function(response){
       //if( response.indexOf('result') > -1 )
       //   console.log("result not empty");
       //console.log(response.result);
        //$("#wrong_label").html(response.result
          console.log(response);

        $("#question_div").html("<table>"+response+"</table>");
        $("#recent_tab").attr('class', '');
        $("#followed_tab").attr('class', 'active');

    }

  });
});



$("#recent_tab").click(function(){
    //$("#wrong_label").text('hello');
    var data={
      type: 'recent',
      from: (question_page-1)*10
    };
    $.ajax({
      url: "http://www.askandanswer.com/index.php/homepage/populate_question_recent",
      data: data,
      type:"get",
      dataType: "html",
      success: function(response){
       
         console.log(response);

        $("#question_div").html("<table>"+response+"</table>");
        $("#recent_tab").attr('class', 'active');
        $("#followed_tab").attr('class', '');
    }

    });
});




function alpha(clicked_id)
{
  var str=""+clicked_id;
  var id=str.substring(12);
  var data={
    q_id: id
  };
  $.ajax({
      url: "http://www.askandanswer.com/index.php/qdetail/load_question_id",
      data: data,
      type:"get",
      dataType: "json",
      success: function(response){
       
         console.log(response.result);

        window.location.replace('http://www.askandanswer.com/index.php/qdetail/load_view');
    }

    });

}

function tag_click(clicked_id)
{
  var str=""+clicked_id;
  var id=str.substring(4);
  var data={
    tag_name: id
  };
  $.ajax({
      url: "http://www.askandanswer.com/index.php/homepage/load_tag_name",
      data: data,
      type:"get",
      dataType: "json",
      success: function(response){
       
         console.log(response.result);

        window.location.replace('http://www.askandanswer.com/index.php/homepage/load_tag_view');
    }

    });
}



function next_page()
{
  question_page++;
  var type=$("#label").html();
   if(type=='ASKED QUESTIONS:')
   {
    var data={
      
      from: (question_page-1)*10
    };
    $.ajax({
      url: "http://www.askandanswer.com/index.php/homepage/populate_asked_questions",
      data: data,
      type:"get",
      dataType: "html",
      success: function(response){
       
         //console.log(response);

        $("#question_div").html("<table>"+response+"</table>");
        //$("#question_div").empty().append('<tr id"row_1"><div class="panel panel-default"><div class="panel-heading" id="row_header_1">Panel heading</div><div class="panel-body" id="row_body_1">Panel Content</div><div class="panel-footer" id="row_footer_1">Panel Footer</div></div></tr>');
        
        //$(div).find('.ps_desc').html(response.result).end().appendTo($('body'));
    }

    });

   }
   else
   {
      var data={
        
        from: 0
      };
      $.ajax({
        url: "http://www.askandanswer.com/index.php/homepage/populate_answered_questions",
        data: data,
        type:"get",
        dataType: "html",
        success: function(response){
         
           //console.log(response);

          $("#question_div").html("<table>"+response+"</table>");
          //$("#question_div").empty().append('<tr id"row_1"><div class="panel panel-default"><div class="panel-heading" id="row_header_1">Panel heading</div><div class="panel-body" id="row_body_1">Panel Content</div><div class="panel-footer" id="row_footer_1">Panel Footer</div></div></tr>');
          
          //$(div).find('.ps_desc').html(response.result).end().appendTo($('body'));
      }

      });


   }
  $("#page_no").html(question_page);

}

function previous_page()
{
  question_page--;
  if(question_page<1)
  {
    question_page=1;
  }
  var type=$("#label").html();
   if(type=='ASKED QUESTIONS:')
   {
    var data={
      
      from: (question_page-1)*10
    };
    $.ajax({
      url: "http://www.askandanswer.com/index.php/homepage/populate_asked_questions",
      data: data,
      type:"get",
      dataType: "html",
      success: function(response){
       
         //console.log(response);

        $("#question_div").html("<table>"+response+"</table>");
        //$("#question_div").empty().append('<tr id"row_1"><div class="panel panel-default"><div class="panel-heading" id="row_header_1">Panel heading</div><div class="panel-body" id="row_body_1">Panel Content</div><div class="panel-footer" id="row_footer_1">Panel Footer</div></div></tr>');
        
        //$(div).find('.ps_desc').html(response.result).end().appendTo($('body'));
    }

    });

   }
   else
   {
      var data={
        
        from: 0
      };
      $.ajax({
        url: "http://www.askandanswer.com/index.php/homepage/populate_answered_questions",
        data: data,
        type:"get",
        dataType: "html",
        success: function(response){
         
           //console.log(response);

          $("#question_div").html("<table>"+response+"</table>");
          //$("#question_div").empty().append('<tr id"row_1"><div class="panel panel-default"><div class="panel-heading" id="row_header_1">Panel heading</div><div class="panel-body" id="row_body_1">Panel Content</div><div class="panel-footer" id="row_footer_1">Panel Footer</div></div></tr>');
          
          //$(div).find('.ps_desc').html(response.result).end().appendTo($('body'));
      }

      });


   }
  $("#page_no").html(question_page);

}


function notification_click(clicked_id)
{
  var str=""+clicked_id;
  var str1=str.substring(17);
  var ids=str1.split("-",2);
  var q_id=ids[0];
  var n_id=ids[1];

  console.log(q_id+"+"+n_id);

  var data={
    n_id: n_id
  };
  $.ajax({
      url: "http://www.askandanswer.com/index.php/homepage/setViewed_Notification",
      data: data,
      type:"get",
      dataType: "json",
      success: function(response){
       
         console.log(response.result);

        
    }

    });

  clicked_id="question_row"+q_id;
  alpha(clicked_id);



}