function updateZoom(value) {
	var video = document.getElementById('video');
	video.style.transform = 'scale(' + value + ')';
	document.getElementById('zoom-value').textContent = value;
}