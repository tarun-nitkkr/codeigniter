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
    

   //  $.ajax({
   //    url: "http://www.askandanswer.com/index.php/homepage/user_interaction_details",
   //    type:"get",
   //    dataType: "json",
   //    success: function(response){
       
   //       //console.log(response);

   //      $("#no_ques").html(response.no_ques);
   //      $("#no_ans").html(response.no_ans);
   //      $("#no_tag").html(response.no_tag);
   //      $("#followed_tags_tooltip").attr('title', response.tag_csv);
   //      //$("#question_div").empty().append('<tr id"row_1"><div class="panel panel-default"><div class="panel-heading" id="row_header_1">Panel heading</div><div class="panel-body" id="row_body_1">Panel Content</div><div class="panel-footer" id="row_footer_1">Panel Footer</div></div></tr>');
        
   //      //$(div).find('.ps_desc').html(response.result).end().appendTo($('body'));
   //  }

   //  });
    
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




function tag_click(clicked_id)
{
  //var id=$(this).attr('id');
  //$("#question_div").html(id);
  //$("#question_div").html(clicked_id);
}