$(document).ready(function() {
	$('.main__controlsContainer__button_clue').click(function(event) {
		$('.main__controlsContainer__button_clue, .main__controlsContainer__button_clue_info').toggleClass('click');
		$('.main__controlsContainer__button_clue, .main__controlsContainer__button_clue_info').remove('click');
	});
});