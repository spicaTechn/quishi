jQuery(document).ready(function($) {
    //$("select.form-control").niceSelect();



    $(".change-view").click(function() {
        $(".row").toggleClass("change-list-view");
    });


    $('.remove-image').hide();

    $('[data-toggle="tooltip"]').tooltip();



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

    $('.profile-coment-comment .form-group').hide();

    $(".user-Anonymous-question-adds").hide();

    $("#anonymous-user").click(function() {
        $(".user-question-adds").toggleClass("d-none");
        $(".user-Anonymous-question-adds").toggleClass("show");
    });

    $(".reply-inner .view-all-comment span").click(function() {
        $(this).toggleClass('comment-on');
        $('.reply-inner .profile-comment-section').toggle(500);
        $('.view-all-comment').hide();
    });


    //$('.profile-coment-comment .form-group').hide();
    //show on click its div only
    $('.profile-comment-section .write-comment').click(function() {
        //$(this).find('.form-group').slideToggle("fast");
        $('.profile-comment-section .form-group').slideToggle();
    });

    $('#write-comment-2').click(function() {
        $('#comment-2').slideToggle();
    });

    $('.comment-method input[type="checkbox"').click(function() {
        $('.anonymously-user').slideToggle(500);
    });



    //  $("#add-new-question-modal #cancel").click(function() {
    //     alert("closed");
    //     $("#add-new-question-modal").hide();
    //     $("#add-new-question-modal").removeClass("show");
    // });

    /*$('.like-comment-view a.go-to-comment').click(function(){
        alert("clicked");

        $('.profile-question-answer-section .profile-leave-comment textarea').focus();
        $(".profile-question-answer-section .profile-leave-comment textarea").css("border-color", "red");
    });*/

    $('.like-comment-view a.go-to-comment').click(function() {
        setTimeout(function() {
            $('.profile-question-answer-section .profile-leave-comment textarea').focus();
            $(".profile-question-answer-section .profile-leave-comment textarea").css("border-color", "#8ac43f");
        }, 0);
        $('.profile-question-answer-section .profile-leave-comment').show();
    });

    $(document).on('click', '.like-comment-view a[href^="#"]', function(event) {
        event.preventDefault();
        //alert('clicked');
        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top
        }, 500);
    });




    // donation-modal
    $(".donation-modal-btn").click(function() {
        //alert("closed");
        $("#donation-Modal").modal('show');
    });

    $("#donation-Modal .close").click(function() {
        $("#donate_now")[0].reset();
        $("#donation-Modal").modal('hide');
    });

    /*// notification
    $(".navbar-light .navbar-nav li.notification-box a ").click(function() {
        //alert("closed");
        $(".notification-list").slideDown();
        $(".navbar-light .navbar-nav li.notification-box .badge").hide();
    });


        $(document).on("click", function(event){
            var $trigger = $(".notification-box");
            if($trigger !== event.target && !$trigger.has(event.target).length){
                $(".notification-list").slideUp();
            }            
        });*/

    // Show hide notification
    $(".notification-box").click(function() {
        $(this).find(".notification-list").slideToggle();
        $(".navbar-light .navbar-nav li.notification-box .badge").hide();
    });

    $(document).on("click", function(event) {
        var $trigger = $(".notification-box");
        if ($trigger !== event.target && !$trigger.has(event.target).length) {
            $(".notification-list").slideUp();
        }
    });



// read notification
$(".notification-list li a").click(function() {
    $(this).addClass("mark-as-read");
});


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


$(window).resize(function() {
    equalheight('.same-height');
});