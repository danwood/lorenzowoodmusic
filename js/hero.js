// shorthand, so my selectors sort of resemble jquery and are shorter
var d$ = document.querySelector.bind(document);
//var d$a = document.querySelectorAll.bind(document);

var topOfMain = 0;

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
	window.scrollTo(0, topOfMain);
        },0.25);	// somehow, a delay is needed
	return false;
});


// -----
// ----- HERO IMAGE - RESIZE SMARTLY
// -----


// Responsively resize the hero image. In sweet spot of screen aspect ratio, hero is full screen.
function fullscreen(event){
	var width = window.innerWidth;
	var height= window.innerHeight;
	var fullSizeHero = false;
	if (width/height < 0.575) { height = Math.round(width/0.575); 
		//console.log("<0.575 ... " + width + " x " + height);
		 } // fill iphone x/xr/xs
	else if (width/height > 1.55) { height = Math.round(width/1.55);
		//console.log(">1.55 ... " + width + " x " + height);
	}	// 1 is square, higher is more "landscape" - find a ratio that works
	else { fullSizeHero = true;
		//console.log(width + " x " + height);
	 }

	// Show scroll arrow if first time here and we are showing full-screen hero
	var scrollArrow = d$('#scroll-arrow');
	if (scrollArrow) {
		if (fullSizeHero && !event) {
			scrollArrow.classList.remove('none');
		} else {
			scrollArrow.parentNode.removeChild(scrollArrow);
		}
	}
	//var elements = d$a('.covering');
	//Array.prototype.forEach.call(elements, function(el){
	//	el.setAttribute("style","width:" + width + "px; height:" + height + "px");
	//});

	// recalculate topOfMain for use by scroll arrow and hero image easter egg
	topOfMain = d$('main').getBoundingClientRect().top + document.documentElement.scrollTop;
}

fullscreen(null);

// Run the function in case of window resize.
// Adding event listener so we can have multiple listeners registered
window.addEventListener("resize",  function(event) {
	fullscreen(event);
});

