// From https://webdesign.tutsplus.com/tutorials/how-to-lazy-load-embedded-youtube-videos--cms-26743
// No jquery needed


var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;

var youtube = document.querySelectorAll( ".youtube" );
for (var i = 0; i < youtube.length; i++) {
    var embed = youtube[i].dataset.embed.split(':');
    var code = embed[0];
    var title = embed[1];

    if (iOS) {
      // regular YouTube iframe embed so that it needs just one tap as expected
      var iframe = document.createElement( "iframe" );
      iframe.setAttribute( "allowfullscreen", "" );
      iframe.setAttribute( "src", "https://www.youtube.com/embed/"+ code );
      youtube[i].appendChild( iframe );
    }
    else {
      var source = "https://img.youtube.com/vi/"+ code +"/sddefault.jpg"; // 640 x 480, letterboxed
      var image = new Image();
      image.src = source;
      image.id = "video-" + code;
      image.alt = "YouTube thumbnail";
      image.addEventListener( "load", function() {
          youtube[ i ].appendChild( image );
      }( i ) );
 
      youtube[i].addEventListener( "click", function() {

          // Need to recalculate the code we are using
          var embed = this.dataset.embed.split(':');
          var code = embed[0];

          var iframe = document.createElement( "iframe" );
          iframe.setAttribute( "frameborder", "0" );
          iframe.setAttribute( "allowfullscreen", "" );
          iframe.setAttribute( "src", "https://www.youtube.com/embed/"+ code +"?rel=0&showinfo=0&autoplay=1" );
          this.innerHTML = "";
          this.appendChild( iframe );
      } );
      var play = document.createElement("div");
      play.setAttribute("class", "play-button");
      youtube[i].appendChild(play);
      var t = document.createElement("div");
      t.setAttribute("class", "title");
      t.innerText = title;
      youtube[i].appendChild(t);
    }
  }
