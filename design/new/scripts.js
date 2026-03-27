$(function(){
	$('#slides1').bxSlider({
		prev_image: 'http://image.mrlotto.co.kr/lot_b_left.jpg',
		next_image: 'http://image.mrlotto.co.kr/lot_b_right.jpg',
		wrapper_class: 'slides1_wrap',
		margin: 70,
		auto: false,
		auto_controls: false
	});
	$('#main_bn').ulslide({
		statusbar: true,
		width: 284,
		height: 291, 
		affect: 'slide', 
		axis: 'x', 	
		navigator: '#main_bn_btn a',
		duration: 400, 
		autoslide: 2500 
	});
	$('#main_bn2').ulslide({
		statusbar: true,
		width: 593,
		height: 669, 
		affect: 'slide', 
		axis: 'x', 	
		navigator: '#main_bn_btn a',
		duration: 400, 
		autoslide: 3000,
	});
	$('.autoplay').slick({
	  slidesToShow: 6,
	  slidesToScroll: 1,
	  autoplay: true,
	  autoplaySpeed: 2000,
	  arrows:false,
	});
});