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

// Responsively resize the hero image. In sweet spot of screen aspect ratio, hero is full screen.
function fullscreen(event){
	var width = $(window).width();
	var height= $(window).height();
	var fullSizeHero = false;
	if (width/height < 0.575) height = Math.round(width/0.575); // fill iphone x/xr/xs
	else if (width/height > 1.55) height = Math.round(width/1.55);	// 1 is square, higher is more "landscape" - find a ratio that works
	else fullSizeHero = true;

	// Show scroll arrow if first time here and we are showing full-screen hero
	if (fullSizeHero && !event) {
		$('#scroll-arrow').css('display', 'block');
	} else {
		$('#scroll-arrow').remove();
	}

	jQuery('.covering').css({
		width: width,
		height: height
	});
	//$( ".info" ).text( width + ' x ' + height + ' … ' + width/height );
}

fullscreen(null);

// Run the function in case of window resize
$(window).resize(function(event) {
	fullscreen(event);
});

