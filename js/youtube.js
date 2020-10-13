// From https://webdesign.tutsplus.com/tutorials/how-to-lazy-load-embedded-youtube-videos--cms-26743

var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;

var youtube = document.querySelectorAll( ".youtube-player" );
for (var i = 0; i < youtube.length; i++) {
	var code	= youtube[i].dataset.code;
	var title	= youtube[i].dataset.title;
	var caption = youtube[i].dataset.caption;
	var linking = youtube[i].dataset.linking;

	// experiment - try ALWAYS linking iOS
	if (iOS) { linking = true; }



	// EXPERIMENT - take out the special iOS embedding
	
	if (false) {
		// regular YouTube iframe embed so that it needs just one tap as expected
		var iframe = document.createElement( "iframe" );
		iframe.setAttribute( "allowfullscreen", "" );
		iframe.setAttribute( "src", "https://www.youtube.com/embed/"+ code );
		youtube[i].appendChild( iframe );
	}
	else {
		// 
		
		// NON-CDN:
		//var source = "https://img.youtube.com/vi/" + code +"/maxresdefault.jpg"; // 640 x 480, letterboxed
		// Special Cloudinary URL:
		var source = "https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/youtube/" + code + ".jpg";
		var image = new Image();
		image.src = source;
		image.id = "video-" + code;
		image.setAttribute("loading", "lazy");
		image.alt = "YouTube thumbnail";
		image.addEventListener( "load", function() {
			youtube[ i ].appendChild( image );
		}( i ) );
 
		youtube[i].addEventListener( "click", function() {

			var code	= this.dataset.code;

			if (linking) {
				window.location.href = 'https://www.youtube.com/watch?v=' + code;
			}
			else {
				// Need to recalculate the code we are using

				var iframe = document.createElement( "iframe" );
				iframe.setAttribute( "frameborder", "0" );
				iframe.setAttribute( "allowfullscreen", "" );
				iframe.setAttribute( "src", "https://www.youtube.com/embed/"+ code +"?rel=0&showinfo=0&autoplay=1" );
				this.innerHTML = "";
				this.appendChild( iframe );
			}
		});
		var play = document.createElement("div");
		play.setAttribute("class", "play-button");
		youtube[i].appendChild(play);
		if (typeof title !== 'undefined') {
			var t = document.createElement("div");
			t.setAttribute("class", "title");
			t.innerText = title;
			youtube[i].appendChild(t);
		}
	}
	if (caption) {
		var captionDiv = document.createElement("p");
		captionDiv.innerText = caption;
		youtube[i].insertAdjacentElement('afterend',captionDiv);
	}
}
