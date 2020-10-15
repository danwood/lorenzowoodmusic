// shorthand, so my selectors sort of resemble jquery and are shorter
var d$ = document.querySelector.bind(document);
//var d$a = document.querySelectorAll.bind(document);


// -----
// ----- HERO IMAGE - SCROLL ARROW
// -----

window.addEventListener('scroll', function() {
	var scrollArrow = d$('#scroll-arrow');
	if (scrollArrow) {
		scrollArrow.parentNode.removeChild(scrollArrow);
    }
});

// Hide the arrow after a bit
setTimeout(function(){
	var scrollArrow = d$('#scroll-arrow');
	if (scrollArrow) {
		scrollArrow.parentNode.removeChild(scrollArrow);
	}
}, 4000);

var downArrow = d$('.down-arrow');

downArrow.addEventListener('click', function() {
	setTimeout(function () {
	var topOfMain = d$('main').getBoundingClientRect().top + document.documentElement.scrollTop;
	window.scrollTo(0, topOfMain);
        },0.25);	// somehow, a delay is needed
	return false;
});
