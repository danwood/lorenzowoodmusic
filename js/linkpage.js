if (blurhashData) {
	var pixels = decode(blurhashData, 32, 32);
	if (pixels) {
		var outputCanvas = document.getElementById("outputCanvas");
		var blurhashImage = document.getElementById("blurhashImage");
		var ctx = outputCanvas.getContext("2d");
		var imageData = new ImageData(pixels, 32, 32);
		ctx.putImageData(imageData, 0, 0);

		var dataUrl = outputCanvas.toDataURL();
		blurhashImage.src = dataUrl;
	}
}

var backgroundBlur = document.getElementById('background-blur');
var blurImage = new Image();
// When the real image is loaded, display it and hide the blurhash.
blurImage.onload = function() {
    var blurhashImage = document.getElementById('blurhashImage');
    blurhashImage.style.display = 'none';
    blurImage.style.display = 'block';
};
blurImage.style.display = 'none';
blurImage.src = "<?php $blur = CLOUDPREFIX . ($release['image_blurred'] ? 'blurred_100/' . $release['image_blurred'] : 'album_art_640/' . htmlentities($release['image'])); echo htmlentities($blur, ENT_QUOTES); ?>";
blurImage.alt = "<?php echo htmlentities($release['title'], ENT_QUOTES); ?>";
backgroundBlur.appendChild(blurImage);