for(var iOS=/iPad|iPhone|iPod/.test(navigator.userAgent)&&!window.MSStream,youtube=document.querySelectorAll(".youtube"),i=0;i<youtube.length;i++){var embed=youtube[i].dataset.embed.split(":"),code=embed[0],title=embed[1],caption=embed[2];if(iOS){var iframe=document.createElement("iframe");iframe.setAttribute("allowfullscreen",""),iframe.setAttribute("src","https://www.youtube.com/embed/"+code),youtube[i].appendChild(iframe)}else{var source="https://img.youtube.com/vi/"+code+"/sddefault.jpg",image=new Image;image.src=source,image.id="video-"+code,image.alt="YouTube thumbnail",image.addEventListener("load",void youtube[i].appendChild(image)),youtube[i].addEventListener("click",function(){var e,t=this.dataset.embed.split(":")[0],i=document.createElement("iframe");i.setAttribute("frameborder","0"),i.setAttribute("allowfullscreen",""),i.setAttribute("src","https://www.youtube.com/embed/"+t+"?rel=0&showinfo=0&autoplay=1"),this.innerHTML="",this.appendChild(i)});var play=document.createElement("div");play.setAttribute("class","play-button"),youtube[i].appendChild(play);var t=document.createElement("div");t.setAttribute("class","title"),t.innerText=title,youtube[i].appendChild(t)}if(caption){var captionDiv=document.createElement("p");captionDiv.innerText=caption,youtube[i].insertAdjacentElement("afterend",captionDiv)}}