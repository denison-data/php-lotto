$(function(){
	/*
	var slider = $('#slides1').bxSlider({
		prev_image: 'http://image.mrlotto.co.kr/lot_b_left.jpg',
		next_image: 'http://image.mrlotto.co.kr/lot_b_right.jpg',
		wrapper_class: 'slides1_wrap',
		margin: 70,
		auto: false,
		auto_controls: false
	});*/
	if($("#slides1").length>0){
		var slider = $('#slides1').bxSlider({
			prevText: '<img src="./add-img/lot_b_left.jpg">',
			nextText: '<img src="./add-img/lot_b_right.jpg">',
			pager : false,
			auto : false,
			onSlideNext: function () {
				var slide_count = slider.getSlideCount();
				var slide_curr = slider.getCurrentSlide();
				var r_seq = $("#seq_id_"+slide_curr).val();
				view_tables(r_seq);
			},
			onSlidePrev: function () {
				var slide_count = slider.getSlideCount();
				var slide_curr = slider.getCurrentSlide();
				
				var r_seq = $("#seq_id_"+slide_curr).val();

				console.log(slide_curr+"||"+r_seq);
				view_tables(r_seq);
			}
			
		});
	}
	if($("#main_bn").length>0){
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
	}
	if($("#main_bn2").length>0){
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
	}
	$('.autoplay').slick({
	  slidesToShow: 6,
	  slidesToScroll: 1,
	  autoplay: true,
	  autoplaySpeed: 2000,
	  arrows:false,
	});
	
});

function addCommas(nStr) {
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

function addComaHtml(nStr) {
	var nm = nStr;
	var ct = nm.length;
	var rthtml = "";
	for(var i=0; i<ct;i++){
		rthtml += '<li class="ball_info_nb">'+nm[i]+'</li>\n';
		if((ct-1) != i && ct != 2){
			if(i%3==0){
				
				rthtml += '<li class="ball_info_txt">,</li>';
			}
		}
	//	console.log(nm[i]+"||"+i+"||"+i%3);	
			
		
	}
	
	return rthtml;
}
function view_tables(seq){
	var lgurl = "/info/lotto.php";
	var form_data = {
		seq : seq,
		mode : "lotto_select"
	};
	$("#nseq").html(seq);
	$.ajax({
		type	:	"POST",
		url		:	lgurl,
		data : form_data,
		dataType : "json",
		async: false,
		cache: false,
		success : function(data){
			if(data['data']){
				var rank_1_c = addCommas(data['data'][seq].rank_1_count);
				var rank_1_ca = addComaHtml(data['data'][seq].rank_1_count);
				var rank_1_p = addComaHtml(data['data'][seq].rank_1_price);
				var rank_1_pa = addCommas(data['data'][seq].rank_1_price);

				var rank_2_p = addCommas(data['data'][seq].rank_2_price);
				var rank_3_p = addCommas(data['data'][seq].rank_3_price);
				var rank_2_c = addCommas(data['data'][seq].rank_2_count);
				var rank_3_c = addCommas(data['data'][seq].rank_3_count);
				

				var mrank_1_c = addCommas(data['data'][seq].rank_1);
				var mrank_2_c = addCommas(data['data'][seq].rank_2);
				var mrank_3_c = addCommas(data['data'][seq].rank_3);
				if(mrank_1_c == "null"){
					mrank_1_c = 0;
				}
				if(mrank_2_c == "null"){
					mrank_2_c = 0;
				}
				if(mrank_3_c == "null"){
					mrank_3_c = 0;
				}

				$("#num1_num").html(rank_1_ca);
				$("#num1_price").html(rank_1_p);

				$("#num1_num_a").html(rank_1_c+"명");
				$("#num1_price_a").html(rank_1_pa+"원");

				$("#num2_num").html(rank_2_c+"명");				
				$("#num2_price").html(rank_2_p+"원");

				$("#num3_num").html(rank_3_c+"명");
				$("#num3_price").html(rank_3_p+"원");

				$("#num1_mrlotto").html(mrank_1_c);
				$("#num2_mrlotto").html(mrank_2_c);
				$("#num3_mrlotto").html(mrank_3_c);
				
				$("#num1_price_a2").html(rank_1_pa+"원");
				$("#num2_price_a2").html(rank_2_p+"원");
				$("#num3_price_a2").html(rank_3_p+"원");
				
				var rank_1_ma = addCommas(data['data'][seq].rank_1_price*data['data'][seq].rank_1);
				var rank_2_ma = addCommas(data['data'][seq].rank_2_price*data['data'][seq].rank_2);
				var rank_3_ma = addCommas(data['data'][seq].rank_3_price*data['data'][seq].rank_3);

				$("#num1_mrlotto_g").html(rank_1_ma+"원");
				$("#num2_mrlotto_g").html(rank_2_ma+"원");
				$("#num3_mrlotto_g").html(rank_3_ma+"원");
			}	
		},
		error: function(request, status, error) {
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
	return false;
}