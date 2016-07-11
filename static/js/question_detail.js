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

var like_valid=1;

var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
function split( val ) {
  return val.split( /,\s*/ );
}
function extractLast( term ) {
  return split( term ).pop();
}

// //var row_count=1;
// //Fade in dashboard box
 $(document).ready(function(){
   
   
    
    $.ajax({
      url: "http://www.askandanswer.com/index.php/qdetail/load_question_detail",
      type:"get",
      dataType: "html",
      success: function(response){
       
         console.log(response);

        $("#question_info_div").html(response);
        //$("#question_div").empty().append('<tr id"row_1"><div class="panel panel-default"><div class="panel-heading" id="row_header_1">Panel heading</div><div class="panel-body" id="row_body_1">Panel Content</div><div class="panel-footer" id="row_footer_1">Panel Footer</div></div></tr>');
        
        //$(div).find('.ps_desc').html(response.result).end().appendTo($('body'));
    }

    });

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

    $.ajax({
      url: "http://www.askandanswer.com/index.php/qdetail/load_answers",
      type:"get",
      dataType: "html",
      success: function(response){
       
         console.log(response);
        //var str = "Visit W3Schools!";
        var n = response.search("#myeditModal");
        if(n==-1)
        {

        }
        else
        {
          $("#answer_button").hide();
        }      

        $("#answer_div").html("<table>"+response+"</table>");
        //$("#question_div").empty().append('<tr id"row_1"><div class="panel panel-default"><div class="panel-heading" id="row_header_1">Panel heading</div><div class="panel-body" id="row_body_1">Panel Content</div><div class="panel-footer" id="row_footer_1">Panel Footer</div></div></tr>');
        
        //$(div).find('.ps_desc').html(response.result).end().appendTo($('body'));
    }

    });
    
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


    //return tag array
    $.ajax({
      url: "http://www.askandanswer.com/index.php/homepage/return_tag_array",
      type:"get",
      dataType: "json",
      success: function(response){
       
      console.log(response);
       availableTags=response.set;

       //search bar tags autocomplete
       $("#srch-term").autocomplete({
          source: availableTags,
          appendTo: $('#search_form'),
          select: function( event, ui ) {
            //alert("tag_select-"+ui.item.value);
            var id="tag_"+ui.item.value;
            tag_click(id);
          
          }
        });
       
    }

    });
    
});

// // //Stop click event
// // $('#sign_in').click(function(event){
// //     //event.preventDefault(); 
// //     .submit();
// // 	});



// $("#followed_tab").click(function(){
//     //$("#wrong_label").text('hello');
//     var data={
//       type: 'followed',
//       from: 0
//     };
//     $.ajax({
//       url: "http://www.askandanswer.com/index.php/homepage/populate_question_recent",
//       data: data,
//       dataType: "html",
//       type: "get",
//       success: function(response){
//        //if( response.indexOf('result') > -1 )
//        //   console.log("result not empty");
//        //console.log(response.result);
//         //$("#wrong_label").html(response.result
//           console.log(response);

//         $("#question_div").html("<table>"+response+"</table>");
//         $("#recent_tab").attr('class', '');
//         $("#followed_tab").attr('class', 'active');

//     }

//   });
// });



// $("#recent_tab").click(function(){
//     //$("#wrong_label").text('hello');
//     var data={
//       type: 'recent',
//       from: 0
//     };
//     $.ajax({
//       url: "http://www.askandanswer.com/index.php/homepage/populate_question_recent",
//       data: data,
//       type:"get",
//       dataType: "html",
//       success: function(response){
       
//          console.log(response);

//         $("#question_div").html("<table>"+response+"</table>");
//         $("#recent_tab").attr('class', 'active');
//         $("#followed_tab").attr('class', '');
//     }

//     });
// });


//ask_question_autocomplete
    $( "#ask_question_tags" )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        minLength: 0,
        source: function( request, response ) {
          // delegate back to autocomplete, but extract the last term
          response( ($.ui.autocomplete.filter(
            availableTags, extractLast( request.term ) )).slice(0, 10) );
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( "," );
          var index=availableTags.indexOf(""+ui.item.value);
          if (index > -1) {
              availableTags.splice(index, 1);
              console.log(ui.item.value+" removed from autocomplete");
          }
          return false;
        }
      });
    

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



function submit_answer()
{
  var answer_data=$("#answer_data").val();
  var data={
    a_data: answer_data
  };
  var flag=0;
  $.ajax({
      url: "http://www.askandanswer.com/index.php/qdetail/post_answer",
      data: data,
      type:"post",
      dataType: "json",
      success: function(response){
       
         //console.log(response.result);

          $.ajax({
            url: "http://www.askandanswer.com/index.php/qdetail/load_answers",
            type:"get",
            dataType: "html",
            success: function(response){
             
               console.log(response);
               flag=1;

              $("#answer_div").html("<table>"+response+"</table>");
              //$("#question_div").empty().append('<tr id"row_1"><div class="panel panel-default"><div class="panel-heading" id="row_header_1">Panel heading</div><div class="panel-body" id="row_body_1">Panel Content</div><div class="panel-footer" id="row_footer_1">Panel Footer</div></div></tr>');
              
              //$(div).find('.ps_desc').html(response.result).end().appendTo($('body'));
          }

          });

         
      }



    });

  if(flag)
  {
    $.ajax({
            url: "http://www.askandanswer.com/index.php/qdetail/contibutors_mailer",
            type:"get",
            dataType: "html",
            success: function(response){
             
               console.log(response);

              
          }

    });

  }
  

}




function edit_answer_model()
{
    var ans_data=$("#answer_div").find('#editable_answer_data').html();
    //console.log(ans_data);
    $("#answer_data_edit").text(ans_data);
}


function submit_edited_answer()
{
    var answer_data=$("#answer_data_edit").val();
  var data={
    a_data: answer_data
  };
  var flag;
  $.ajax({
      url: "http://www.askandanswer.com/index.php/qdetail/post_edited_answer",
      data: data,
      type:"post",
      dataType: "json",
      success: function(response){
       
         console.log(response.result);
         

        
      }



    });


  

    $.ajax({
      url: "http://www.askandanswer.com/index.php/qdetail/load_answers",
      type:"get",
      dataType: "html",
      success: function(response){
       
         console.log(response);

        $("#answer_div").html("<table>"+response+"</table>");
        //$("#question_div").empty().append('<tr id"row_1"><div class="panel panel-default"><div class="panel-heading" id="row_header_1">Panel heading</div><div class="panel-body" id="row_body_1">Panel Content</div><div class="panel-footer" id="row_footer_1">Panel Footer</div></div></tr>');
        
        //$(div).find('.ps_desc').html(response.result).end().appendTo($('body'));
    }

    });

}

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

function like_click(clicked_id)
{
 
  if(like_valid==0)
  {
    console.log("invalid like");
    return;

  } 
  like_valid=0;
  var str=""+clicked_id;
  var str1=str.substring(7);
  var ids=str1.split("-",2);
  var status=ids[0];
  var ans_id=ids[1];

  if(status==0)
  {
    //like
    var data={
    type: 1,
    a_id: ans_id
    };
  }
  else
  {
    //unlike
    var data={
    type: 0,
    a_id: ans_id
    };
  }

  $.ajax({
      url: "http://www.askandanswer.com/index.php/qdetail/like_dislike_answer",
      data: data,
      type:"get",
      dataType: "json",
      success: function(response){
       
         console.log(response.result);
         $.ajax({
            url: "http://www.askandanswer.com/index.php/qdetail/load_answers",
            type:"get",
            dataType: "html",
            success: function(response){
             
               //console.log(response);

              $("#answer_div").html("<table>"+response+"</table>");
              like_valid=1;
              //$("#question_div").empty().append('<tr id"row_1"><div class="panel panel-default"><div class="panel-heading" id="row_header_1">Panel heading</div><div class="panel-body" id="row_body_1">Panel Content</div><div class="panel-footer" id="row_footer_1">Panel Footer</div></div></tr>');
              
              //$(div).find('.ps_desc').html(response.result).end().appendTo($('body'));
          }

        });

         

        
      }

    });


  // setTimeout(function(){ 

  //   $.ajax({
  //     url: "http://www.askandanswer.com/index.php/qdetail/load_answers",
  //     type:"get",
  //     dataType: "html",
  //     success: function(response){
       
  //        console.log(response);

  //       $("#answer_div").html("<table>"+response+"</table>");
  //       //$("#question_div").empty().append('<tr id"row_1"><div class="panel panel-default"><div class="panel-heading" id="row_header_1">Panel heading</div><div class="panel-body" id="row_body_1">Panel Content</div><div class="panel-footer" id="row_footer_1">Panel Footer</div></div></tr>');
        
  //       //$(div).find('.ps_desc').html(response.result).end().appendTo($('body'));
  //   }

  //   });

  //  }, 1000);



  

  //$("#"+clicked_id).attr('id', 'status_'+data['type']);


  
}



$("#ask_question_button").click(function(event) {
  /* Act on the event */

  var tags_csv=$("#ask_question_tags").val();
  var tag_array = tags_csv.split(',');
  var tag_formatted="'"+tag_array[0]+"'";
  var limit=0;
  if(tag_array.length <= 5)
  {
    
    if(tag_array[tag_array.length-1]=="")
    {
      //console.log("last element null");
      limit=tag_array.length-1;
    }
    else
    {
      //console.log("last element not null");
      limit=tag_array.length;

    }
  }
  else
  {
    limit=5;
  }
  for(i=1; i< limit; i++)
  {
    tag_formatted+=",'"+tag_array[i]+"'";

  }

  //console.log(tag_formatted);
  var data={
    title : $("#question_title").val(),
    data : $("#question_detail").val(),
    tags: tag_formatted
  };


  $.ajax({
      url: "http://www.askandanswer.com/index.php/homepage/post_question",
      data: data,
      type:"post",
      dataType: "json",
      success: function(response){
       
         console.log(response.result);
         alert("Question Posted!");
         location.reload();

        
    }

    });


});



function answer_modal_click()
{
  $('#answer_data').focus();
  console.log("modal click");  
}