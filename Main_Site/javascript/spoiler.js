$(document).ready(function() {
	$('.sectionFour__items_item_titleH3').click(function(event) {
		if ($('.sectionFour__items').hasClass('one-active-spoiler')) {
			$('.sectionFour__items_item_titleH3').not($(this)).removeClass('active');
			$('.sectionFour__items_item_descriptionContainer').not($(this).next()).slideUp(300);
		}
		$(this).toggleClass('active').next().slideToggle(300);
	});
});