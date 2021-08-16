$(function() {
	$('.js-carousel').slick({
		dots: true,
		slidesToShow: 1,
		centerMode: true,
		variableWidth: true,
		appendArrows: '.carousel-controls',
		nextArrow:'<button type="button" class="slick-next"><svg class="slick-arrow-icon"><use xlink:href="#svg-arrow-slider"></use></svg></button>',
		prevArrow:'<button type="button" class="slick-prev"><svg class="slick-arrow-icon"><use xlink:href="#svg-arrow-slider"></use></svg></button>',
		responsive: [
			{
				breakpoint: 701,
				settings: {
					centerMode: false,
					variableWidth: false,
					slidesToShow: 1,
  					slidesToScroll: 1,
				}
			}
		]
	});


	
	$('.js-select').selectize({
        sortField: 'text',
  		//create: true
    });
});