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
