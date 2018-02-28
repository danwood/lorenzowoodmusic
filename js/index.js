
// REQUIREMENT: JQUERY

// ASAP, Fix styling where safe-area padding is zero. Not sure of any other workaround.

if($('section, .safe-area').css('padding-left') === '0px') {
    $('section, .safe-area').css('padding-left', '1em');
    $('section, .safe-area').css('padding-right', '1em');
}





// Do something clever: when we scroll past the hero image, turn off the grayscale filter to make it color

var targetOffset = $(".popular").offset().top;

var $w = $(window).scroll(function(){
    if ( $w.scrollTop() > targetOffset ) {
        $('.hero img').css({"filter":"grayscale(0%)"});
    }
});



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
                $alert('data:' + data);
            } else {
                alert('Sorry, but the contact form submission did not work as expected.');
            }
      },
      error: function(jqXHR, textStatus, errorThrown ) {
            alert('errr:' + errorThrown + ' ' + textStatus + ' ' + jqXHR);
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
                alert('Sorry, but the code you entered has already been redeemed or was entered incorrectly.');
                $('#redeem-input').focus();
            }
      },
      error: function(jqXHR, textStatus, errorThrown ) {
            alert(errorThrown + ' ' + textStatus);
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



//Modernizer-like
// Remove "no-js" class from element, if it exists
document.documentElement.className = document.documentElement.className.replace("no-js","js");
