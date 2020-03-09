
// REQUIREMENT: JQUERY

$('.down-arrow').click(function(event) {
	event.preventDefault();
	$('html, body').animate({
		scrollTop: $('.down-arrow').offset().top
	}, 1000);
	return false;
});

// Hide the arrow after a bit
setTimeout(function(){
	$( "#scroll-arrow" ).fadeOut( "slow", function() {
		$('#scroll-arrow').remove();
	});
}, 2000);

// Bands in Town - display past events. Not showing anything if no javascript.
$('#recent-performances').html('<a id="recent-link" href="#">& Recent</a>');

// If we click to show recent performances too, this gets revealed. A one-way street BTW.
$('#recent-link').click(function() {
	$('.bit-header').text('Recent & Upcoming Performances');
	$('.bit-past').show();
	return false;
});



// Form Submission

$('#contact-form').submit(function( event ) {
	$.ajax({
		type: 'POST',
		url: 'https://www.lorenzowoodmusic.com/mailme.php',
		data: $("#contact-form").serialize(),

		success: function(data, textStatus, jqXHR ) {
			if (data !== '') {
				$('#e_fm').val('');
				$('#e_ms').val('');
				$('#e_na').val('');
				setTimeout(function(){ window.alert("Your message was sent. You should hear back from us soon!"); },0);
			} else {
				window.alert('Sorry, but the contact form submission did not work as expected.');
			}
		},
		error: function(jqXHR, textStatus, errorThrown ) {
			window.alert('ERROR. ' + errorThrown + ' ' + textStatus);
		},
		complete: function(jqXHR, textStatus ) {

		}
	});
	event.preventDefault();
});


$('#redeem-form').submit(function( event ) {
	if ($('#redeem-input').val().length > 0) {
		$.ajax({
			type: 'POST',
			url: '/redeem.php',
			data: $("#redeem-form").serialize(),

			success: function(data, textStatus, jqXHR ) {
				if (data !== '') {
					$('#cover').show();
					$('#redeemer').show();
					$('#close-redeem').show();
					$('#redeemer').html(data);		// We’re done; let the content here do the rest.
				} else {
					window.alert('Sorry, but the code you entered has already been redeemed or was entered incorrectly.');
					$('#redeem-input').focus();
				}
			},
			error: function(jqXHR, textStatus, errorThrown ) {
				window.alert(errorThrown + ' ' + textStatus);
			},
			complete: function(jqXHR, textStatus ) {

			}
		});
	}
	event.preventDefault();
});
$('#close-redeem').click(function() {
	$('#cover').fadeOut('slow');
	$('#close-redeem').fadeOut('slow');
	$('#redeemer').fadeOut('fast');
});


// Do something clever: when we scroll past the hero image, turn off the grayscale filter to make it color

var targetOffset = $("main").offset().top;

var $w = $(window).scroll(function(){
	$('#scroll-arrow').remove();
	if ( $w.scrollTop() > targetOffset ) {
		$('img.hero-image').css({filter:"grayscale(0%)",opacity:"1.0"});
	}
});



