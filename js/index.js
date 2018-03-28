
// REQUIREMENT: JQUERY

// ASAP, Fix styling where safe-area padding is zero. Not sure of any other workaround.

if($('section, .safe-area').css('padding-left') === '0px') {
    $('section, .safe-area').css('padding-left', '1em');
    $('section, .safe-area').css('padding-right', '1em');
}





// Do something clever: when we scroll past the hero image, turn off the grayscale filter to make it color

var targetOffset = $("main").offset().top;

var $w = $(window).scroll(function(){
    $('#scroll-arrow').remove();
    if ( $w.scrollTop() > targetOffset ) {
        $('.hero img').css({"filter":"grayscale(0%)"});
    }
});

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
}, 4000);






// MANUALLY BRING IN: http://lightwidget.com/widgets/lightwidget.js
window.lightwidget||(window.lightwidget=function(){"use strict";var e=[],t=0,i=!1,n=!1,o=["lightwidget.com","instansive.com","dev.lightwidget.com"],d=function(e){return n=e},s=function(e,t){e.contentWindow&&e.contentWindow.postMessage("sizing:"+t,window.location.protocol+"//lightwidget.com")},c=function(t){var i=t.origin.replace(/^https?\:\/\//i,"");if(-1!==o.indexOf(i)){var n=t.data.split(":");try{"sizing"==n[0]&&void 0!=e[parseInt(n[2])]&&(e[parseInt(n[2])].style.height=n[1]+"px")}catch(e){}}},r=function(e){n&&console.log(e);var t=e.origin.replace(/^https?\:\/\//i,"");if(-1!==o.indexOf(t)){var i=e.data.split(":");n&&console.log(i);try{if("sizing_iid"==i[0]){var d=i[2],s=d.replace("instansive_","").replace("lightwidget_");void 0!==document.querySelectorAll('iframe[src*="lightwidget.com/widgets/'+s+'"]')[0]?(n&&console.log("iframesrc"),document.querySelectorAll('iframe[src*="lightwidget.com/widgets/'+s+'"]')[0].style.height=i[1]+"px"):void 0!=document.getElementById(d)?document.getElementById(d).style.height=i[1]+"px":(d=d.replace("instansive","lightwidget"),void 0!=document.getElementById(d)&&(document.getElementById(d).style.height=i[1]+"px"))}}catch(e){n&&console.log(e)}}},g=function(e){n&&console.log("json",e);var t=e.origin.replace(/^https?\:\/\//i,"");if(-1!==o.indexOf(t))try{var i=JSON.parse(e.data);"lightwidget_widget_size"===i.type&&i.size>0&&(void 0!==document.querySelectorAll('iframe[src*="lightwidget.com/widgets/'+i.widgetId+'"]')[0]?document.querySelectorAll('iframe[src*="lightwidget.com/widgets/'+i.widgetId+'"]')[0].style.height=i.size+"px":void 0!==document.querySelectorAll('iframe[src*="instansive.com/widgets/'+i.widgetId+'"]')[0]&&(document.querySelectorAll('iframe[src*="instansive.com/widgets/'+i.widgetId+'"]')[0].style.height=i.size+"px"))}catch(t){n&&console.log(t,e.data)}},l=function(){window.addEventListener?(window.addEventListener("message",c,!1),window.addEventListener("message",r,!1),window.addEventListener("message",g,!1)):(window.attachEvent("onmessage",c),window.attachEvent("onmessage",r),window.attachEvent("onmessage",g))};return l(),{refresh:function(){if(i)for(var n=0;n<t;n++)s(e[n],n)},reload:function(){l()},debug:function(e){return d(e)}}}()),window.lightwidget.refresh();

// LightWidget for Instagram: 6x2, @900=4x2, @600=2x4. Zoom in, padding 5, preloader
//
// Insert this widget HTML into the DOM after everything has loaded so that the page won't block waiting for this to load in.

$('#lightweight_widget').html('<iframe src="https://lightwidget.com/widgets/9b560c45f4e75b9f93dd8bcca23a28a3.html" scrolling="no" allowtransparency="true" class="lightwidget-widget"></iframe>');



// Form Submission

$('#contact-form').submit(function( event ) {
    $.ajax({
      type: 'POST',
      url: 'https://jumprock.co/mail/lozobooking',
      data: $("#contact-form").serialize(),

      success: function(data, textStatus, jqXHR ) {
            if (data !== '') {
                $('#email').val('');
                $('#message').val('');
                setTimeout(function(){ window.alert("Success sending message"); },0);
            } else {
                window.alert('Sorry, but the contact form submission did not work as expected.');
            }
      },
      error: function(jqXHR, textStatus, errorThrown ) {
            window.alert(errorThrown + ' ' + textStatus + ' ' + jqXHR);
      },
      complete: function(jqXHR, textStatus ) {

      }
    });
    event.preventDefault();
});


$('#redeem-form').submit(function( event ) {
    $.ajax({
      type: 'POST',
      url: '/redeem.php',
      data: $("#redeem-form").serialize(),

      success: function(data, textStatus, jqXHR ) {
            if (data !== '') {
                $('#cover').show();
                $('#redeemer').show();
                $('#close-redeem').show();
                $('#redeemer').html(data);  // We’re done; let the content here do the rest.
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
    event.preventDefault();
});
$('#close-redeem').click(function() {
    $('#cover').fadeOut('slow');
    $('#close-redeem').fadeOut('slow');
    $('#redeemer').fadeOut('fast');
});

// From https://webdesign.tutsplus.com/tutorials/how-to-lazy-load-embedded-youtube-videos--cms-26743
// No jquery needed


var youtube = document.querySelectorAll( ".youtube" );
for (var i = 0; i < youtube.length; i++) {
    var embed = youtube[i].dataset.embed.split(':');
    var code = embed[0];
    var title = embed[1];

    var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
    if (iOS) {
      // regular YouTube iframe embed so that it needs just one tap as expected
      var iframe = document.createElement( "iframe" );
      iframe.setAttribute( "allowfullscreen", "" );
      iframe.setAttribute( "src", "https://www.youtube.com/embed/"+ code );
      youtube[i].appendChild( iframe );
    }
    else {
      var source = "https://img.youtube.com/vi/"+ code +"/sddefault.jpg";
      var image = new Image();
      image.src = source;
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
  };

// Replace all soundcloud proxies with a real embed.

$('.soundcloud-proxy').each(function() {
  var code = $(this).data('code');
  var iframeCode = '<iframe class="soundcloud" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/'+ code + '&amp;color=ff9900&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=false&amp;show_artwork=false&amp;show_reposts=false" />';
   $(this).replaceWith(iframeCode);
});


// Responsively resize the hero image. In sweet spot of screen aspect ratio, hero is full screen.
function fullscreen(event){
    var width = $(window).width();
    var height= $(window).height();
    var fullSizeHero = false;
    if (width/height < 1.21) height = Math.round(width/1.21);
    else if (width/height > 1.79) height = Math.round(width/1.79);
    else fullSizeHero = true;

    if (fullSizeHero && !event) {
      $('#scroll-arrow').css('display', 'block');
    } else {
      $('#scroll-arrow').remove();
    }

    jQuery('#main-header').css({
        width: width,
        height: height
    });
    $( ".info" ).text( width + ' x ' + height + ' … ' + width/height  );
}

fullscreen(null);

// Run the function in case of window resize
$(window).resize(function(event) {
     fullscreen(event);
  });



//Modernizer-like
// Remove "no-js" class from element, if it exists
document.documentElement.className = document.documentElement.className.replace("no-js","js");
