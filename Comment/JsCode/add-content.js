

$(document).ready(function () {
    Load_Content();

    function Load_Content() {
        let data = {
            'load': true
        };

        $.ajax({
            type: "POST",
            url: "../Code/Content.php",
            data: data,
            dataType: 'json',
            success: function (response) {

                console.log(response);
                location.reload();
                res = response; 
                if (Array.isArray(response)) { 
                    response.forEach(function (value) {
                        console.log(value.content.image);

                        let imagesHTML = '';
                            var images = JSON.parse(value.content.image);

                        if (images.length>0 ) { 
                            images.forEach(function (image) {
                                imagesHTML = '<div class="image-Container d-flex align-content-stretch flex-nowrap"><img src="Code/uploads/' + image + '" alt="image1"></div>';
                            });
                        } else {
                            imagesHTML = '<img src="Code/uploads/'+ images + '" alt="image">';
                        }

                        let contentHTML = '<div class="col-md-8">\
                            <div class="card">\
                                <div class="card-header d-flex justify-content-between">\
                                    <h4>' + value.user.fullName + '</h4> <p>' + value.content.created + '</p> <button type="submit" value='+value.content.content_id+' class="delete_content_btn">delete</button>\
                                </div>\
                                <div class="card-body">\
                                    <div class="post-Container d-flex align-content-stretch flex-nowrap">\
                                        ' + imagesHTML + '\
                                    </div>\
                                    <div class="main-comment" style="margin-top: 20px;">\
                                    <div id="error_status"></div>\
                                    <p>Add Comment</p>\
                                    <input class="comment_text form-control" id="comment_textbox"></input>\
                                    <div class="button-Container d-flex justify-content-between" style="margin-top:20px">\
                                        <button type="button" class="btn btn-primary add_comment_btn" id="add_comment_btn">Comment</button>\
                                        <button class="btn btn-primary view_content_comment">View Comments</button>\
                                    </div>\
                                    <hr>\
                                    <div class="comment-container">\
                                    </div>\
                                </div>\
                                </div>\
                            </div>\
                        </div>';

                        $('.content_Container').append(contentHTML);
                    });
                } 
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    }

    
});
