$(document).ready(function() {
	$('.sectionFour__items_item_titleH3').click(function(event) {
		if ($('.sectionFour__items').hasClass('one-active-spoiler')) {
			$('.sectionFour__items_item_titleH3').not($(this)).removeClass('active');
			$('.sectionFour__items_item_descriptionContainer').not($(this).next()).slideUp(300);
		}
		$(this).toggleClass('active').next().slideToggle(300);
	});
});

$(document).ready(function() {
	$('.header__menuBurger').click(function(event) {
		$('.header__menuBurger, .header__MainMenu').toggleClass('click');
		$('.header__menuBurger, .header__MainMenu').remove('click');
		$('body').toggleClass('lockScroll');
	});
});