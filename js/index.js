// shorthand, so my selectors sort of resemble jquery and are shorter
var d$ = document.querySelector.bind(document);
var d$a = document.querySelectorAll.bind(document);


// ----- HOME PAGE - RECENT PERFORMANCES



// Bands in Town - display past events. Not showing anything if no javascript.
var recentPerformances = d$('#recent-performances');

recentPerformances.innerHTML = '<a id="recent-link" href="#">& Recent</a>';

// If we click to show recent performances too, this gets revealed. A one-way street BTW.
var recentLink = d$('#recent-link');
recentLink.onclick = function() {
	d$('.bit-header').textContent = 'Recent & Upcoming Performances';
	var pastEvents = d$a('.bit-past');
	Array.prototype.forEach.call(pastEvents, function(image){
		image.classList.remove('none');
	});
	return false;
};

// -----
// ----- HOME PAGE - RECENT PERFORMANCES
// -----

// Only on the home page does the contact form link bring up a modal layer.

var contactLink = d$('.contact-link');
contactLink.onclick = function() {
	d$('#cover').classList.remove('none');
	d$('#contacter').classList.remove('none');
	d$('#close-modal').classList.remove('none');
	return false;
};

// -----
// ----- HOME PAGE - FUN SCROLLING EASTER EGG
// -----

// Do something clever: when we scroll past the hero image,
// turn off any specified grayscale filter to make it color
// and change the image from image1 to image2 if that's specified

window.addEventListener('scroll', function() {
	var topOfMain = d$('main').getBoundingClientRect().top + document.documentElement.scrollTop;
	if (window.scrollY > topOfMain) {
		if (! document.body.classList.contains('swapped-hero') ) {

			var showing2 = document.body.classList.contains('showing-2');
			var images = d$a('img.swapping-image');
			Array.prototype.forEach.call(images, function(image){

				if (showing2) {
					image.src    = image.src   .replace(/2_/g, '1_');
					image.srcset = image.srcset.replace(/2_/g, '1_');
				}
				else {
					image.src    = image.src   .replace(/1_/g, '2_');
					image.srcset = image.srcset.replace(/1_/g, '2_');
				}
			});

			if (showing2) {
				document.body.classList.remove('showing-2');
			} else {
				document.body.classList.add('showing-2');
			}
			document.body.classList.add('swapped-hero');
		}
	}
	if (window.scrollY === 0) {
		document.body.classList.remove('swapped-hero');
	}
});




// -----
// ------ HOME PAGE - CONTACT FORM POPUP
// -----

// TODO - share this JS so contact form can pop up from any page

var contactForm = d$('#contact-form');
contactForm.onsubmit = function( event ) {

	event.preventDefault();

	var request = new XMLHttpRequest();
	request.open('POST', 'https://www.lorenzowoodmusic.com/mailme.php', true);
	request.send(new FormData(contactForm));

	request.onload = function() {
	  if (this.status >= 200 && this.status < 400) {
	    // Success!
	    if (this.responseText !== '') {
			d$('#e_fm').value = '';
			d$('#e_ms').value = '';
			d$('#e_na').value = '';
			d$('#close-modal').click();	// might not be found if this is not on the homepage modal
			setTimeout(function(){ window.alert("Your message was sent. You should hear back from us soon!"); },0);
		} else {
			d$('#contact_submit').classList.add('none');	// hide submit button so message can be copied
			window.alert('RESPONSE ERROR. Sorry, but the contact form submission did not work as expected.');
		}

	  } else {
	    // We reached our target server, but it returned an error
		d$('#contact_submit').classList.add('none');	// hide submit button so message can be copied
		window.alert('STATUS ERROR. ' + this.response + ' ' + this.status);

	  }
	};

	request.onerror = function() {
		d$('#contact_submit').classList.add('none');	// hide submit button so message can be copied
		window.alert('REQUEST ERROR. ' + this.response + ' ' + this.status);
	};

	request.send();
};

var closeModal = d$('#close-modal');

closeModal.onclick = function() {
	d$('#cover').classList.add('none');
	d$('#close-modal').classList.add('none');	// TODO fade out all these
	d$('#contacter').classList.add('none');
};


