$(document).ready(function() {
	$('.appContainer__FAQimg').click(function(event) {
		$('appContainer__FAQimg').toggleClass('click');
		$('appContainer__FAQimg').remove('click');
		$(this).toggleClass('active').next().slideToggle(300);
		$('.appContainer').toggleClass('darkScreen');
	});
});