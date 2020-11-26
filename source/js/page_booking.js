document.getElementById('disclosure').addEventListener('click', function(event) {
	document.getElementById('disclose').classList.remove('js-none');
	document.getElementById('disclosure').classList.add('none');
	event.preventDefault();
	return false;
});