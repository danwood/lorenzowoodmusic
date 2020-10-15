var dest = document.getElementById('generic');
var fallback = document.getElementById('fallback');
// IE8+
var request = new XMLHttpRequest();
request.open('GET', 'shared.html', true);

request.onreadystatechange = function() {
  if (this.readyState === 4) {
	if (this.status >= 200 && this.status < 400) {
	  var resp = this.responseText;
	  dest.innerHTML = resp;
	} else {
	  fallback.innerHTML = '<a href="./">General press kit for Lorenzo Wood</a>';
	}
  }
};
request.send();
request = null;

