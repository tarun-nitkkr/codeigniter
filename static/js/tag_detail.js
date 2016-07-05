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



 var question_page=1;

 $(document).ready(function(){
   
   
    //$('[data-toggle="popover"]').popover();
    $.ajax({
      url: "http://www.askandanswer.com/index.php/tdetail/tags",
      type:"get",
      dataType: "json",
      success: function(response){
       
         console.log(response);
        //$("#follow_unfollow_button").html('Unfollow');        
        $("#tag_name").html(response['tag_name']);
        $("#tag_description").html(response['tag_description']);
        $("#no_followers").html(response['tag_followers'] );

        if(response['flag']==1)
        {
          $("#follow_unfollow_button").html('Unfollow');  
          $("#follow_unfollow_button").attr('id', 'unfollow_button');  
          
        }
        else
        {
          $("#follow_unfollow_button").html('Follow');  
          $("#follow_unfollow_button").attr('id', 'follow_button');  
          

        }


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

    var data={
      from:0
      };
    $.ajax({
      url: "http://www.askandanswer.com/index.php/tdetail/retrieve_tag_question",
      type:"get",
      data: data,
      dataType: "html",
      success: function(response){
       
         console.log(response);

        $("#question_div").html("<table>"+response+"</table>");
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


    //to get tags to populate auto complete for the ask questions div
    $.ajax({
      url: "http://www.askandanswer.com/index.php/homepage/return_tag_array",
      type:"get",
      dataType: "json",
      success: function(response){
       
      console.log(response);
       availableTags=response.set;
       
    }

    });

 
});



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


function follow_unfollow(clicked_id)
{
    if(clicked_id=="follow_button")
    {


      $.ajax({
      url: "http://www.askandanswer.com/index.php/tdetail/setFollow",
      type:"get",
      dataType: "json",
      success: function(response){
       
         console.log(response.result);
         if(response.result==1)
         {
          $("#follow_button").html('Unfollow');  
          $("#follow_button").attr('id', 'unfollow_button'); 

         }
        
        }

        });
    }
    else
    {
      $.ajax({
      url: "http://www.askandanswer.com/index.php/tdetail/setUnfollow",
      type:"get",
      dataType: "json",
      success: function(response){
       
         console.log(response.result);
         if(response.result==1)
         {
          $("#unfollow_button").html('Follow');  
          $("#unfollow_button").attr('id', 'follow_button'); 

         }
        
        }

        });

    }
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





function next_page()
{
  question_page++;

  var data={
      from:(question_page-1)*10
      };
    $.ajax({
      url: "http://www.askandanswer.com/index.php/tdetail/retrieve_tag_question",
      type:"get",
      data: data,
      dataType: "html",
      success: function(response){
       
         console.log(response);

        $("#question_div").html("<table>"+response+"</table>");
        //$("#question_div").empty().append('<tr id"row_1"><div class="panel panel-default"><div class="panel-heading" id="row_header_1">Panel heading</div><div class="panel-body" id="row_body_1">Panel Content</div><div class="panel-footer" id="row_footer_1">Panel Footer</div></div></tr>');
        
        //$(div).find('.ps_desc').html(response.result).end().appendTo($('body'));
    }

    });
  $("#page_no").html(question_page);

}

function previous_page()
{
  question_page--;
  if(question_page<1)
  {
    question_page=1;
  }
  var data={
      from:(question_page-1)*10
      };
    $.ajax({
      url: "http://www.askandanswer.com/index.php/tdetail/retrieve_tag_question",
      type:"get",
      data: data,
      dataType: "html",
      success: function(response){
       
         console.log(response);

        $("#question_div").html("<table>"+response+"</table>");
        //$("#question_div").empty().append('<tr id"row_1"><div class="panel panel-default"><div class="panel-heading" id="row_header_1">Panel heading</div><div class="panel-body" id="row_body_1">Panel Content</div><div class="panel-footer" id="row_footer_1">Panel Footer</div></div></tr>');
        
        //$(div).find('.ps_desc').html(response.result).end().appendTo($('body'));
    }

    });
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