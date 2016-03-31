$(window).load(function () {
	pageLoader();
	scrollBar();
});
$(document).ready(function() {
	fullWidthHeight();
	getSetImage();
	countdownClock();
	navMiddle();
	subscription();
	contactForm();
});
$(window).resize(function() {
	fullWidthHeight();
	navMiddle();
	scrollBar();
});

// PAGE-LOADER
function pageLoader(){
    if ($("html").hasClass('ie9')) {
        $("#loader").addClass('display_none');
        $("#ie9-loader").addClass('display_block');
        $("#loader-wrapper").fadeOut(200);
    }else{
        $("#loader-wrapper").fadeOut(200);
    }
}

// SCROLLBAR
function scrollBar(){
	if($("body").hasClass("light-version")){
		$(".md-modal").mCustomScrollbar({
        	theme:"light"
        });
	}else{
		$(".md-modal").mCustomScrollbar({
        	theme:"dark"
        });
	}
}

// FULLSCREEN MAIN-WRAPPER
function fullWidthHeight(){
	var w = $(window).width();
	var h = $(window).height();
	$(".main-wrapper").css({
		width : w,
		height: h
	});
}

// GET AND SET IMAGE
function getSetImage(){
	var path = $(".bg-wrapper.single-bg").attr("data-background");
	$(".bg-wrapper.single-bg").css({
		"background-image" : "url("+path+")"
	});
}

// COUNTDOWN-CLOCK
function countdownClock(){

	var day = 1;
	var month = 5;
	var year = 2016;
	var hour = 8;
	var min = 13;
	var sec = 0;

	// DESKTOP CLOCK
	$('#countdown_dashboard').countDown({
		targetDate: {
			'day': 		day,
			'month': 	month,
			'year': 	year,
			'hour': 	hour,
			'min': 		min,
			'sec': 		sec
		},
		omitWeeks: true
	});

	// MOBILE CLOCK
	$('#countdown_dashboard_mob').countDown({
		targetDate: {
			'day': 		day,
			'month': 	month,
			'year': 	year,
			'hour': 	hour,
			'min': 		min,
			'sec': 		sec
		},
		omitWeeks: true
	});
}

// NAVIGATION
function navMiddle(){
	var h = $(".navigation-wrp").outerHeight();
	var finalHeight = h/2;
	$(".navigation-wrp").css({
		"margin-top" : -finalHeight
	});
}

// CONTACT-US FORM
function contactForm(){
	$('#cntForm').submit(function () {
	    $('#cntForm .error-form').remove();
	    $('#cntForm .success').remove();
	    var hasError = false;
	    $('.form-control').each(function () {
	        if (jQuery.trim($(this).val()) === '') {
	        	$(this).addClass('error-box');
	            $(this).parent().append('<span class="error-form animated flash"><i class="fa fa-exclamation-triangle"></i></span>');
	            hasError = true;
	        } else if ($(this).hasClass('email')) {
	            var emailReg = /^([\w-\.]+@([\w]+\.)+[\w]{2,4})?$/;
	            if (!emailReg.test(jQuery.trim($(this).val()))) {
	            	$(this).addClass('error-box');
	                $(this).parent().append('<span class="error-form animated flash"><i class="fa fa-exclamation-triangle"></i></span>');
	                hasError = true;
	            }
	        }
	    });
	    if (!hasError) {
	        formInput = $(this).serialize();
	        $.post($(this).attr('action'), formInput, function (data) {
	        	$("#cntForm input, #cntForm textarea, #cntForm button").attr("disabled", "disabled");
	        	$(".disable").fadeIn('200');
	        	$('#returnmessage').css("opacity", 1);
	        	$('#returnmessage').fadeIn('300');
	            $('#returnmessage').text('Your message has been sent, we will get back to you as soon as possible !');
	            $('#returnmessage').fadeOut(6000);
	            $('#returnmessage').css("opacity", 0);
	            $(".disable").delay(3000).fadeOut(4500, function () {
	            	$("#cntForm input, #cntForm textarea, #cntForm button").removeAttr("disabled");
	            });
	        });
	        $('.form-field').val('');
	    }
	    return false;
	});
	$('#cntForm .form-control').focus(function () {
		$('#cntForm .form-control').removeClass('error-box');
	    $('#cntForm .error-form').remove();
	    $('#cntForm .success').remove();
	});
	$('#cntForm textarea').focus(function () {
		$('#cntForm .form-control').removeClass('error-box');
	    $('#cntForm .error-form').remove();
	    $('#cntForm .success').remove();
	});
}


// SUBSCRIPTION
function subscription(){
	$("#notifyMe .submit").on( "click", function() {
		 "use strict";
        $(".subscription .notifyMe").notifyMe();
        $(".subscription .error-text").delay(2000).fadeOut(2000);
	});
}
