
// REQUIREMENT: JQUERY

// Bands in Town - display past events. Not showing anything if no javascript.
$('#recent-performances').html('<a id="recent-link" href="#">& Recent</a>');

// If we click to show recent performances too, this gets revealed. A one-way street BTW.
$('#recent-link').click(function() {
	$('.bit-header').text('Recent & Upcoming Performances');
	$('.bit-past').show();
	return false;
});


// Only on the home page does the contact form link bring up a modal layer.

$('.contact-link').click(function() {
	$('#cover').show();
	$('#contacter').show();
	$('#close-modal').show();

	return false;
});

// Since this requires jquery, we're only using this in the home page.
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
				$('#close-modal').click();	// might not be found if this is not on the homepage modal
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


$('#close-modal').click(function() {
	$('#cover').fadeOut('slow');
	$('#close-modal').fadeOut('slow');
	$('#contacter').fadeOut('fast');	// hide whichever modal is showing
});



// Do something clever: when we scroll past the hero image,
// turn off any specified grayscale filter to make it color
// and change the image from image1 to image2 if that's specified

var $w = $(window).scroll(function(){
	$('#scroll-arrow').remove();
	if ( $w.scrollTop() > $("main").offset().top) {
		if (! $('body').hasClass('swapped-hero') ) {

			if ($('body').hasClass('showing-2') ) {

				$('img.swapping-image').attr('src', function() {
					return $(this).attr('src').replace(/2_/g, '1_');
				});
				$('img.swapping-image').attr('srcset', function() {
					return $(this).attr('srcset').replace(/2_/g, '1_');
				});
				$('body').removeClass('showing-2');
			} else {
				$('img.swapping-image').attr('src', function() {
					return $(this).attr('src').replace(/1_/g, '2_');
				});
				$('img.swapping-image').attr('srcset', function() {
					return $(this).attr('srcset').replace(/1_/g, '2_');
				});
				$('body').addClass('showing-2');
			}
			$('body').addClass('swapped-hero');
		}
	}
	if ( $w.scrollTop() == 0) {
		$('body').removeClass('swapped-hero');
	}
});



