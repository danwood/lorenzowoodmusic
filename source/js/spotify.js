// Lazily bring in a spotify embed

function loadSpotifyIntoNode(spotifyProxy) {
	var code	= spotifyProxy.dataset.code;
	var container = document.createElement("div");
	container.setAttribute("class", "spotify-embed");
	var iframe = document.createElement( "iframe" );
	iframe.setAttribute( "frameborder", "0" );
	iframe.setAttribute( "loading", "lazy" );	
	iframe.setAttribute( "allowtransparency", "true" );
	iframe.setAttribute( "allow", "encrypted-media" );
	iframe.setAttribute( "src", "https://open.spotify.com/embed/track/"+ code );
	container.appendChild(iframe);
	spotifyProxy.replaceWith( container );
}