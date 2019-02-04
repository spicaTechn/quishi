
   function mobileNav() {
	    var node = $(".profile-sidemenu").clone();

        $('.navbar-nav').before(node);
	  
	    // $(".navbar-nav").append(
	    //     "<li class='has-child mobile-profile-sidemenu'>" + node + "</li>"
	    // );
	}

	mobileNav();

    $('.change-view').click(function() {
        $('.show_more_career_advisior').toggleClass('change-list-view');
        $(this).toggleClass('change-list-view-icon');
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

    $(".blog-dropdown > a").click(function() {
        $(".blog-dropdown-menu").slideToggle();
        $(".blog-dropdown").toggleClass("open");
    });


    $('.dropdown-toggle').dropdown()

    // $(".reply-inner .view-all-comment span").click(function() {
    //     $(this).toggleClass('comment-on');
    //     //$('.reply-inner .profile-comment-section').slideToggle();
    //     $(this).parent(".profile-comment-section").slideDown(500);
    //     $(this).parent('.view-all-comment').hide();
    // });

    // show profile inner comment
    $('body').on('click',".profile-leave-comment .view-all-comment span", function() {
        $(this).parent().closest("div.reply-inner").find('.profile-comment-section').slideDown();
        $(this).hide();
        //$(this).hide();
    });

    //fixed footer
    if ($(window).height() >= $(document).height())
        $(".footer").addClass("fixed-footer");
    else $(".footer").removeClass("fixed-footer");




    $('.view-all-profile-comment span').click(function() {
        $(this).parent().closest('div.profile-question-answer-section').find('.profile-comment-wrapper').slideDown();
        $(this).hide();
    });

    // // show all profile coments
    // $(".view-all-blog-comments span").click(function() {
    //     $(".blog-leave-comment").find(".profile-comment-wrapper").show();
    //     $(".blog-leave-comment").find('.view-all-blog-comments').hide();
    // });

    // show blog inner comment
    $(".blog-leave-comment .view-all-comment span").click(function() {
        $(".profile-comment-section").slideDown();
        $('.view-all-comment').hide();
    });

    // show all coments
    $(".view-all-blog-comments span").click(function() {
        $(".blog-leave-comment").find(".profile-comment-wrapper").show();
        $(".blog-leave-comment").find('.view-all-blog-comments').hide();
    });

    //profile_accordion focus
        // $('.profile_accordion .btn').click(function(){
        //     $(this).parent('div.profile_accordion').find('textarea').focus();
        // });


    //$('.profile-coment-comment .form-group').hide();
    //show on click its div only
    $('body').on('click', '.write-comment', function(e) {
        e.preventDefault();
        //$(this).find('.form-group').slideToggle("fast");
        $(this).parent().closest('div.profile-coment-comment').find('.form-group').slideToggle();
        //$('.profile-comment-section .form-group').slideToggle();
    });
    
    //navbar-toggler
    $(document).on('click', '.navbar-toggler', function(event) {
        $('.navbar-collapse').toggleClass('slideIn');
        $('body').toggleClass('overflow-hidden');
        $('.navbar-toggler').toggleClass('on');
        $('.dashboard-toggle').fadeOut();
    });
    
    if ($(window).width() <= 991) {
       $('.notification-box').prependTo('.navbar .container-fluid');
       $('.navbar-collapse').prepend('<span class="close">&times;</span>');
   }

   if ($(window).width() <= 767) {
        $('.static-login-menu').prependTo('#navbarSupportedContent');

       // Add slideDown animation to Bootstrap dropdown when expanding.
         $('.dropdown').on('show.bs.dropdown', function() {
           $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
         });

         // Add slideUp animation to Bootstrap dropdown when collapsing.
         $('.dropdown').on('hide.bs.dropdown', function() {
           $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
         });
   }
   
   $(document).on('click', '.navbar-collapse .close', function(event) {
        $('.navbar-collapse').toggleClass('slideIn');
        $('body').toggleClass('overflow-hidden');
        $('.navbar-toggler').toggleClass('on');
        $('.dashboard-toggle').fadeIn();
    });


    $('.comment-method input[type="checkbox"').click(function() {
        $('.anonymously-user').slideToggle(500);
    });

    $(document).on('click', '.total_likes', function(event) {
        $(this).parent().closest('div.view-section').addClass('liked');
    });

    $(document).on('click', '.blog-page-like i', function(event) {
        $('.blog-page-like').addClass('liked_2');
    });



    $(document).on('click', '.dashboard-toggle', function(event) {
        $('.profile-sidemenu').toggleClass('profile-sidemenu-show');
        $('.dashboard-toggle').toggleClass('open');
    });


    $(document).on('click', '.dashboard-toggle-hide', function(event) {
        $('.profile-sidemenu').toggleClass('profile-sidemenu-show');
        $('.dashboard-toggle').toggleClass('open');
    });

    $(document).on('click', '.dashboard-toggle-hide', function(event) {
        $('.profile-sidemenu').toggleClass('show');
    });
    
    //blog masonary
    var blogMasonary = window.blogMasonary || {},
        $win = $(window);
    blogMasonary.Isotope = function() {
        // 3 column layout
        var isotopeContainer2 = $('.isotopeContainer2');
        if (!isotopeContainer2.length || !jQuery().isotope) return;
        $win.load(function() {
            isotopeContainer2.isotope({
                itemSelector: '.isotopeSelector'
            });

        });
    };
    
    blogMasonary.Isotope();
    if ($(window).width() > 767) {
        $('.fixed-top-section').scrollToFixed();
    }
    
   /* $('.like-comment-view a.go-to-comment').click(function() {

        setTimeout(function() {
            $('div.profile-question-answer-section').find('div.profile-leave-comment textarea').focus();
            $('div.profile-question-answer-section').find('div.profile-leave-comment textarea').css("border-color", "#8ac43f");
        }, 0);

        $(this).parent().closest('div.profile-question-answer-section').find('div.profile-leave-comment').slideToggle(500);
    });*/

    $('body').on('click', '.like-comment-view a[href^="#"]', function(event) {
        event.preventDefault();
        //alert('clicked');
        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top - 100
        }, 500);
    });
    
    // forum-leave-comment

    $('.forum-like-comment-view  a.go-to-comment').click(function() {

        setTimeout(function() {
            $('div.forum-question-answer-section').find('div.forum-leave-comment textarea').focus();
            $('div.forum-question-answer-section').find('div.forum-leave-comment textarea').css("border-color", "#8ac43f");
        }, 0);

        $(this).parent().closest('div.forum-question-answer-section').find('div.forum-leave-comment').slideToggle('slow');
    });

    $(document).on('click', '.like-comment-view a[href^="#"]', function(event) {
        event.preventDefault();
        //alert('clicked');
        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top - 100
        }, 500);
    });

       $(document).on('click', '.view-all-forum-comment span', function(event) {
        event.preventDefault();
        $(this).parent().closest('div.forum-question-answer-section').find('div.forum-comment-wrapper').slideToggle('slow');
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

    autosize(document.querySelectorAll('.forum-leave-comment textarea.form-control'));
    autosize(document.querySelectorAll('.blog-leave-comment textarea.form-control'));
    autosize(document.querySelectorAll('.profile-author-comment .form-group textarea.form-control'));
    autosize(document.querySelectorAll('.profile-author-comment .form-group textarea.form-control'));


    //mobile login menu
    $(".mobile-login-btn").click(function() {
        $(".login-menu-mobile").slideToggle(500);
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
    //equalheight('.same-height');
    //equalheight('.the-media .blog-conten h4');
});




$(window).resize(function() {
    //equalheight('.same-height');
    //equalheight('.the-media .blog-conten h4');
    if ($(window).width() <= 991) {

        $('.notification-box').prependTo('.navbar .container-fluid');
        $('.navbar-collapse').prepend('<span class="close">&times;</span>');

    }
});

