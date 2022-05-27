// Lazily bring in a spotify embed

function loadSpotifyIntoNode(spotifyProxy) {
	var code	= spotifyProxy.dataset.code;
	var container = document.createElement("div");
	container.setAttribute("class", "spotify-embed");
	var iframe = document.createElement( "iframe" );
	iframe.setAttribute( "frameborder", "0" );
	iframe.setAttribute( "loading", "lazy" );	
	iframe.setAttribute( "allowtransparency", "true" );
	iframe.setAttribute( "allow", "autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" );
	iframe.setAttribute( "src", "https://open.spotify.com/embed/"+ code );
	container.appendChild(iframe);
	spotifyProxy.replaceWith( container );
}

// We don't use aos for narrow (mobile) screens, which will load the spotify embeds when we scroll to reveal. So only option is to load them now.

if (window.innerWidth < 600) {
	document.querySelectorAll('.spotify-proxy').forEach(function(element) {
		loadSpotifyIntoNode(element);
	});
}
