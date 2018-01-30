$(function() {

    // ANIMATED TEXT
    window.setTimeout(function() {
        $(".jumbo-text h1").css("display", "block").addClass("fadeInDown");
    }, 1500);
    window.setTimeout(function() {
        $(".jumbo-text h2").css("display", "block").addClass("fadeInDown");
    }, 2000);
    window.setTimeout(function() {
        $(".jumbo-text h3").css("display", "block").addClass("fadeInUp");
    }, 3500);
    window.setTimeout(function() {
        $(".scroll-down").css("display", "block").addClass("fadeInUp");
    }, 4500);
    
    
    
    // ANIMATED NAVBAR
    var page = window.location.pathname;
    var pageWidth = $(window).width();

    console.log(page);

    function checkScroll() {
        var startY = $('.navbar').height() * 1.25; //The point where the navbar changes in px

        if (page == '/') {
            if($(window).scrollTop() > startY) {
                $('.navbar-fixed-top').addClass("scrolled");
            } else {
                $('.navbar-fixed-top').removeClass("scrolled");
            }
        }
    }
    
    if (pageWidth > 768) {
        if($('.navbar').length > 0) {
            $(window).on("scroll load resize", function(){
                checkScroll();
            });
        }
    }
    
    //LIGHTBOX
    var $overlay = $("<div class='lightbox-overlay'></div>");
    var $container = $("<div class='lightbox-container'></div>");
    var $caption = $("<p class='caption'></p>");
    var $image = $("<img>");


    $container.append($image);
    $container.append($caption);
	// An image
	$overlay.append($container);
	// A caption


	// Add overlay
	$("body").append($overlay);

    //1. Capture the click even of an anchor tag linking to an image.
    $("img").click(function(event) {
      var imageLocation = $(this).attr("src");


        //1.2 Update overlay with the image linked in the link.
        $image.attr("src", imageLocation);

        //1.3 Get child's alt attribute and set caption.
        var captionText = ($(this).attr("alt"));
        $caption.text(captionText);

        //1.1 Show the overlay.
        $overlay.fadeIn();

    });

    //3. When overlay is clicked
    $overlay.click(function(){
        //3.1 Hide the overlay
        $(this).hide();
    });
    
    //Scroll down button
    $(".scroll-down").click(function() {
        $('html, body').animate({
            scrollTop: $("#usp").offset().top
        },1500);
    });
    
    //FORM VALIDATION
    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,6})?$/;
        return emailReg.test($email);
    }
    
    $("#enquire").click(function(){
        $("#error").empty();
    });

    $("form").submit(function(event){
        event.preventDefault();
        var error = "";
        var email = $("#email").val();
        
        if (!validateEmail(email)) {
            error = "The email address provided was invalid.<br>"
        }
        
        if (error != "") {
            $("#error").html('<div class="alert alert-danger" role="alert"><p><strong>There was an error with your form:</strong></p>' + error + '</div>');
        } else {
            $("#error").html('<div class="alert alert-success" role="alert"><p>Your message has been sent!</p></div>');
            window.setTimeout(function() {
                error = "";
                $("form").unbind("submit").submit();
            }, 1500);
        }
    });

});