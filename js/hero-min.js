function fullscreen(o){var r=$(window).width(),e=$(window).height(),n=!1;r/e<.575?e=Math.round(r/.575):r/e>1.55?e=Math.round(r/1.55):n=!0,n&&!o?$("#scroll-arrow").css("display","block"):$("#scroll-arrow").remove(),jQuery(".covering").css({width:r,height:e})}$(".down-arrow").click((function(o){return o.preventDefault(),$("html, body").animate({scrollTop:$(".down-arrow").offset().top},1e3),!1})),setTimeout((function(){$("#scroll-arrow").fadeOut("slow",(function(){$("#scroll-arrow").remove()}))}),2e3),fullscreen(null),$(window).resize((function(o){fullscreen(o)}));