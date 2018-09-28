jQuery(document).ready(function($) {
    //$("select.form-control").niceSelect();



    $(".change-view").click(function() {
        $(".row").toggleClass("change-list-view");
    });


    $('.remove-image').hide();

    $('[data-toggle="tooltip"]').tooltip();

    $(".edit-link").on('click',function(e) {
        e.preventDefault();
        
        var _parent_div       = $(this).parents('div.editable-section');
           //hide the form and show the editiable sections and socail icon class
       _parent_div.find('form').show();
       _parent_div.find('.editable-icon').hide();
       _parent_div.find('.hide-social-icon').hide();

    });

    $(".reply").click(function() {
        //alert("The paragraph was clicked.");
        $(".media-body .reply-form").show();
    });

    $("#show-qusetion-modal").click(function() {
        $("#add-new-question-modal").show();
        $("#add-new-question-modal").addClass("show");
    });

     $("#add-new-question-modal .close,#add-new-question-modal #cancel").click(function() {
        $("#add-new-question-modal").hide();
        $("#add-new-question-modal").removeClass("show");
    });

     $(".user-Anonymous-question-adds").hide();

     $("#anonymous-user").click(function(){
        $(".user-question-adds").toggleClass("d-none");
        $(".user-Anonymous-question-adds").toggleClass("show");
     });

     $(".view-all-comment").click(function() {
        $(this).toggleClass('comment-on');
         $('.profile-comment-section').slideToggle(500);
     });


     //$('.profile-coment-comment .form-group').hide();
     //show on click its div only
     $('#write-comment-1').click(function() {
        $('#comment-1').slideToggle(500);
     });

     $('#write-comment-2').click(function() {
        $('#comment-2').slideToggle(500);
     });

     $('.comment-method input[type="checkbox"').click(function() {
        $('.anonymously-user').slideToggle(500);
     });



    //  $("#add-new-question-modal #cancel").click(function() {
    //     alert("closed");
    //     $("#add-new-question-modal").hide();
    //     $("#add-new-question-modal").removeClass("show");
    // });



    //equal height
    equalheight = function(container) {

        var currentTallest = 0,
            currentRowStart = 0,
            rowDivs = new Array(),
            $el,
            topPosition = 0;
        $(container).each(function() {

            $el = $(this);
            $($el).height('auto')
            topPostion = $el.position().top;

            if (currentRowStart != topPostion) {
                for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                    rowDivs[currentDiv].height(currentTallest);
                }
                rowDivs.length = 0; // empty the array
                currentRowStart = topPostion;
                currentTallest = $el.height();
                rowDivs.push($el);
            } else {
                rowDivs.push($el);
                currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
            }
            for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                rowDivs[currentDiv].height(currentTallest);
            }
        });
    }

    //on scroll add  and remove class
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 200) {
            $(".front-profile-menu").addClass("darkHeader");
        } else {
            $(".front-profile-menu").removeClass("darkHeader");
        }
    });




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

$(window).load(function() {
    equalheight('.same-height');
});


$(window).resize(function(){
    equalheight('.same-height');
});