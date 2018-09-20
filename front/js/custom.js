jQuery(document).ready(function($) {
    // $("select.form-control").niceSelect();



    $(".change-view").click(function() {
        $(".row").toggleClass("change-list-view");
    });


    $('.remove-image').hide();

});


// https://codepen.io/aaronvanston/pen/yNYOXR
function readURL(input) {
    $('.remove-image').show();
    if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function(e) {
            $('.image-upload-wrap').hide();
           

            $('.file-upload-image').attr('src', e.target.result);
            $('.file-upload-content').show();

            $('.image-title').html(input.files[0].name);
        };

        reader.readAsDataURL(input.files[0]);

    } else {
        removeUpload();
    }
}

function removeUpload() {
    $('.file-upload-input').replaceWith($('.file-upload-input').clone());
    $('.file-upload-content').hide();
    $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function() {
    $('.image-upload-wrap').addClass('image-dropping');
});
$('.image-upload-wrap').bind('dragleave', function() {
    $('.image-upload-wrap').removeClass('image-dropping');
});


$("input").tagsinput('items');