// shorthand, so my selectors sort of resemble jquery and are shorter
var d$ = document.querySelector.bind(document);
//var d$a = document.querySelectorAll.bind(document);


// -----
// ----- HERO IMAGE - SCROLL ARROW
// -----

function hideScrollArrow() {
	var scrollArrow = d$('.scrolldown');
	if (scrollArrow) {
		scrollArrow.parentNode.removeChild(scrollArrow);
    }
}

window.addEventListener('scroll', hideScrollArrow);

// Hide the arrow after a bit
setTimeout(hideScrollArrow, 4000);

d$('.scrolldown').addEventListener('click', function() {
	setTimeout(function () {
		var topOfMain = d$('main').getBoundingClientRect().top + document.documentElement.scrollTop;
		window.scrollTo(0, topOfMain);
		// TODO: detect if smooth option is available
       },0.25);	// somehow, a delay is needed
	return false;
});
