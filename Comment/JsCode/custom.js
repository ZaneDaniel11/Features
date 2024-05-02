$(document).ready(function () {

  
  load();

  function load()
  {
    $.ajax({
      type: "POST",
      url: "./Code/add-Comment.php",
      data: {
        'comment_load_data': true
      },
     
      success: function (response) {
  
       $('.comment-container').html("");
        $.each(response, function (key, value) { 
          $('.comment-container').
          append('<div class="reply_box border p-2 mb-2">\
          <h6 class="border-bottom d-inline"> '+value.user['fullName']+' : '+value.cmt['commented_on']+' </h6>\
           <p class="para">'+value.cmt['msg']+'</p>\
          <button class="btn btn-primary reply_btn" value="'+value.cmt['id']+'">Reply</button>\
         <button class="btn btn-success view_reply_btn" value="'+value.cmt['id']+'">View reply</button>\
         <button class="btn btn-success delete_reply_btn" value="'+value.cmt['id']+'">Delete</button>\
          <div class="ml-4 reply_section"></div>\
         </div>\
          ');
        });
      console.log(response);
  
      }
    });
  }



$(document).on('click','.delete_reply_btn', function (e) {
  e.preventDefault();

  var click = $(this);

  var delete_comment = click.val();

  var data = {
    'delete_comment':delete_comment,
    'delete_comment_btn':true
  }
  $.ajax({
    type: "POST",
    url: "./Code/add-Comment.php",
    data: data,
   
    success: function (response) {
      location.reload();
    }
  });
  
});

$(document).on('click','.view_reply_btn',function (e) { 
  e.preventDefault();

  var clicked = $(this);
  var reply_id = clicked.val();

  $.ajax({
    type: "POST",
    url: "./Code/add-Comment.php",
    data:{ 'reply_on_comment_id': reply_id,
            'view_comment':true
  },

    success: function (response) {
      $('.reply_section').html("");
       console.table(response);
      $.each(response, function (key, value) { 
         
          clicked.closest('.reply_box').find
      ('.reply_section').append('<div class="sub_reply_box border p-2 mb-2">\
      <h6 class="border-bottom d-inline">'+value.user['fullName']+'</h6>\
       <p class="para">'+value.rcmt['reply_msg']+'</p>\
      <button class="btn btn-primary sub_reply_btn" value="">Reply</button>\
      <div class="ml-4 sub_reply_section"></div>\
     </div>\
      ')
      });
      // console.log(response);
    }
  });
  $(document).on('click','.view_reply_btn', function (e) {
    e.preventDefault();
    $('.reply_section').html("");
 });
 
  // var reply_id = clicked.closest('.reply_box').find('.view_reply_btn').val();

  
});

$(document).on('click', '.reply_btn', function () {

      var thisClicked = $(this);
      var cmt_id = thisClicked
      $('.reply_section').html("");
      thisClicked.closest('.reply_box').find('.reply_section').
      html('<input type="text" placeholder="reply" class="reply_input">\
      <div class="reply_btn_container">\
        <button class="reply_add_btn">reply</button>\
        <button class="reply_cancel_btn">cancel</button>\
      </div>\
      ');
      
});



$(document).on('click','.reply_cancel_btn',function () {
  $('.reply_section').html("");
});
  
$(document).on('click','.reply_add_btn',function (e) { 
  e.preventDefault();

  var thisClicked = $(this);
  var cmt_id = thisClicked.closest('.reply_box').find('.reply_btn').val();
  var reply = thisClicked.closest('.reply_box').find('.reply_input').val();

  var data = {
      'comment_id':cmt_id,
      'reply':reply,
      'add_reply':true
  }
  $.ajax({
    type: "POST",
    url: "./Code/add-Comment.php",
    data: data,
    success: function (response) {

      alert(response);
      $('.reply_section').html("");
      
    }
  });
});

$(".add_comment_btn").click(function (e) {
      e.preventDefault();

  
      var msg = $("#comment_textbox").val();
      var isError = false;
  
      if ($.trim(msg).length == 0) {
        $("#error_status").text("Please type a comment");
        isError = true;
      } else {
        $("#error_status").text("");
      }
  
      if (isError) {
        return false;
      } else {
        var data = {
          'msg': msg,
          'add_comment': true,
        };
  
        $.ajax({
          type: "POST",
          url: "./Code/add-Comment.php",
          data: data,
          success: function (response) {
            // alert(response);
            location.reload();
            $(".comment_textbox").val("");
          },
          error: function () {
            alert("Error occurred while adding the comment.");
          }
        });
      }
    });
  });
  