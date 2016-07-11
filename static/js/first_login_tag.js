
var tag_string="";

var tags_selected=0;

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
   
   //$("#question_div").load("http://www.askandanswer.com/index.php/homepage/populate_question_recent");
       

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



    // //to get tags to populate auto complete for the ask questions div
    // $.ajax({
    //   url: "http://www.askandanswer.com/index.php/homepage/return_tag_array",
    //   type:"get",
    //   dataType: "json",
    //   success: function(response){
       
    //   console.log(response);
    //    availableTags=response.set;
       
    //    //search bar tags autocomplete
    //    $("#srch-term").autocomplete({
    //       source: availableTags,
    //       appendTo: $('#search_form'),
    //       select: function( event, ui ) {
    //         //alert("tag_select-"+ui.item.value);
    //         var id="tag_"+ui.item.value;
    //         tag_click(id);
          
    //       }
    //     });
       
    // }

    // });


    //get all the tags in the db for selection
    $.ajax({
      url: "http://www.askandanswer.com/index.php/homepage/get_all_tags",
      type:"get",
      dataType: "html",
      success: function(response){
       
       $("#tags_div").html(response);
      
       
    }

    });




    //to disable the done button
    $("#done_button").attr('class',"btn btn-block btn-primary disabled");
    $("#done_button").attr('onclick',"");

    

    
});

// //Stop click event
// $('#sign_in').click(function(event){
//     //event.preventDefault(); 
//     .submit();
// 	});






function tag_click(clicked_id)
{

  var str=""+clicked_id;
  var id=str.substring(4);
  //console.log(id);
  
  

  if($("#"+clicked_id).attr('class')=='btn-primary')
  {
    tags_selected++;
    $("#"+clicked_id).attr('class', 'btn-success');
    tag_string+=id+",";
    
  }

  else
  {
      tags_selected--;
      var index = tag_string.indexOf(id+",");
        if(index != -1)
            tag_string =tag_string.substr(0,index)+tag_string.substr(index+id.length+1); 
      //tag_string.replace(",","");
      $("#"+clicked_id).attr('class', 'btn-primary');
     
      //tag_string+=id+",";
      
  }
  console.log(tag_string);
  if(tags_selected<5)
  {
    $("#done_button").attr('class',"btn btn-block btn-primary disabled");
    $("#done_button").attr('onclick',"");
  }
  else
  {
    $("#done_button").attr('class',"btn btn-block btn-success");
    $("#done_button").attr('onclick',"proceed();");

  }

  



  
}



function proceed()
{
  var tag_array = tag_string.split(',');
  var tag_formatted="'"+tag_array[0]+"'";
  var limit=0;

  limit=tag_array.length-1;
  
  for(i=1; i< limit; i++)
  {
    tag_formatted+=",'"+tag_array[i]+"'";

  }

  console.log(tag_formatted);
  var data={
    'tags':tag_formatted
  };

  $.ajax({
      url: "http://www.askandanswer.com/index.php/homepage/update_followed_tags_and_isfirst",
      type:"get",
      data : data,
      dataType: "json",
      success: function(response){
       
       if(response['result']==1)
       {
        window.location.replace('http://www.askandanswer.com/index.php/login/homepage');
       }

       else
       {
        console.log("There has been some error in updating tags or isfirst!");
       }
        
        
    }

    });

}

