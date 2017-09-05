
jQuery(document).ready(function( $ ){
  // Carousel
  // --------
	$('.carousel__inner__slider').slick({
		dots: true,
		infinite: true,
		speed: 500,
		autoplay: true,
		autoplaySpeed: 10000,
		slidesToShow: 1,
		slidesToScroll: 1,
		prevArrow: '<button type="button" class="material-icons slick-prev">arrow_back</button>',
		nextArrow: '<button type="button" class="material-icons slick-next">arrow_forward</button>',
		responsive: [
		{
			breakpoint: 769,
			settings: {
				arrows: false
			}
		}
		]
	});
});
