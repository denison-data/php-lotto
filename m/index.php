<?
$_pp_e = 0;
$_pp_s = 0;

include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
include(BASE_DIR.'inc/html/head_m_main.html');
//echo BASE_DIR;

$cur_seq = getCurSeq();
$_WIN = getSeqRank($cur_seq-5, $cur_seq, 'desc');

$_BRO = getBrod($cur_seq-3, $cur_seq, 'desc');

$_BBS_n = getBbsList(0,1,'n','desc');


$_BBS = getBbsList(0,2,'e','desc');

$_BBS_m = getBbsList(0,2,'m','rand');

$code = $_SESSION['code'];
$rs = ordrGoods($code,'','asc');

?>
<style>
.btn {
  cursor: pointer;  }

.close {
  width: 50px;
  height: 50px;
  position: absolute;
  left: 0px;
  top: 0px;
  background-image: url("http://s1.daumcdn.net/cfs.tistory/custom/blog/204/2048858/skin/images/close.png");
  background-size: 50%;
  background-repeat: no-repeat;
  background-position: center;
  cursor: pointer;
}

#menu {
  width: 150px;
  height: 100%;
  position: fixed;
  top: 0px;
  left: -152px;
  z-index: 10;
  background-color: white;
  border-right: 1px solid #063980;
  transition: All 0.5s ease;
  -webkit-transition: All 0.5s ease;
  -moz-transition: All 0.5s ease;
  -o-transition: All 0.5s ease;
  color:#fff;
  padding-top:15%;
}

#menu.open {
  left: 0px;
}

.page_cover.open {
  display: block;
}

.page_cover {
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0px;
  left: 0px;
  background-color: rgba(0, 0, 0, 0.6);
  z-index: 4;
  display: none;
}
.top ul {}		
.top ul li {display:table-cell }


#nav { font-family:'arial'; }
#nav ul{ width:100%; margin:0; padding:0; }
#nav ul.menu li{ position:relative; float:left; width:100%; list-style-type:none;border-bottom:1px solid #eee}
#nav ul.menu li a{ display:block; width:100%; height:100%;text-indent:20px; color:#8d8d8d; text-decoration:none; line-height: 34px; font-size: 1.05em;color:#333}
#nav ul.menu li a:hover{ background:#eee; }
#nav ul.menu li .sub a{ position:relative; float:left; display:block; width:100%; z-index:999;  background:#eee; font-size: 0.9em;line-height: 30px; padding-left:10px; box-sizing: border-box;color:#8d8d8d}
#nav ul.menu li .sub a:hover{ background:#444; color:#fff; }


	</style>	
<form name="logout_form" id="logout_form" method="post">
<input type="hidden" name="mode" value="logout">
</form>		


<script src="http://js.mrlotto.co.kr/jquery.bpopup.min.js"></script>
<script>
function set_cookie(name, value, expirehours, domain) 
{
	var today = new Date();
	today.setTime(today.getTime() + (60*60*1000*expirehours));
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + today.toGMTString() + ";";
	if (domain) {
		document.cookie += "domain=" + domain + ";";
	}
}
function get_cookie(name) 
{
	var find_sw = false;
	var start, end;
	var i = 0;
	for (i=0; i<= document.cookie.length; i++)
	{
		start = i;
		end = start + name.length;

		if(document.cookie.substring(start, end) == name) 
		{
			find_sw = true
			break
		}
	}
	if (find_sw == true) 
	{
		start = end + 1;
		end = document.cookie.indexOf(";", start);

		if(end < start)
			end = document.cookie.length;

		return document.cookie.substring(start, end);
	}
	return "";
}

function layer_close(id,hiddenWay) {
	var obj = document.getElementById("expirehours"+ id);
	var tmpid = document.getElementById("mpop"+id);
	if (obj.checked == true) {
		set_cookie("mit_ck_pop_"+id, "done", obj.value, window.location.host);
	}
	if(hiddenWay == "ts_slideDownBack"){
		ts_slideDownBack(tmpid);
	}else if(hiddenWay == "ts_slideLeftBack"){
		ts_slideLeftBack(tmpid);
	}else if(hiddenWay == "ts_slideLeftDownBack"){
		ts_slideLeftDownBack(tmpid);
	}else if(hiddenWay == "ts_fadeInBack"){
		ts_fadeInBack(tmpid);
	}else{
		tmpid.style.display = "none";
		$('#mpop'+id).bPopup().close();

	}
	selectbox_visible();
}
function selectbox_visible() 
{ 
	for (i=0; i<document.forms.length; i++) { 
		for (k=0; k<document.forms[i].length; k++) { 
			el = document.forms[i].elements[k];    
			if (el.type == "select-one" && el.style.visibility == 'hidden') 
				el.style.visibility = 'visible'; 
		} 
	} 
}

$(document).ready(function(){
	var obj = document.getElementById("expirehours8");
	console.log(obj.value);

	var ck = get_cookie("mit_ck_pop_8");
	if(ck=="done"){
		$("#mpop8").hide();
	} else {
		$("#mpop8").bPopup({});
	}	
	//$("#mpop8").bPopup({});
});
</script>
<style>
.button:hover{
    background-color: #1e1e1e;
}
.button{
    background-color: #2B91AF;
    border-radius: 10px;
    box-shadow: 0 2px 3px rgba(0, 0, 0, 0.3);
    color: #FFFFFF;
    cursor: pointer;
    display: inline-block;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
}
.button.b-close, .button.bClose{
    border-radius: 7px 7px 7px 7px;
    box-shadow: none;
    font: bold 231% sans-serif;
    padding: 0 6px 2px;
    position: absolute;
    right: -7px;
    top: -7px;
}
</style>
<div id="mpop8" style="position:absolute;display: none; background-color: white; width: 400px; height: 400px;">
	<span class="button b-close"><span>X</span></span>
   <p>
    <div style="width:400px;overflow:hidden;">	 
	<table cellpadding="0" cellspacing="0" bgcolor="#edf2fc" width="100%" height="100%">
		<tr>
			<td>
			<table cellspacing="0" cellpadding="0" width="100%" height="400">
				<tr>
					<td><div style="overflow:hidden;"><div style="text-align: center"><img id="image_0.43562147746718776" style="width: 400px;" alt="pop.jpg" src="http://image.mrlotto.co.kr/popup/190122_popup.jpg" /><br /></div></div></td>
				</tr>
			</table>
			<div style="background:#000000;color:#FFFFFF;text-align:left;font-size:12px;">
				<input type="checkbox"  id="expirehours8" name="expirehours8" value="24" onchange="javascript:layer_close(8)">24시간 동안 이 창을 다시 열지 않음
				<!--<a href="javascript:layer_close(8)"><img src="http://image.mrlotto.co.kr/popup/close.jpg" width="14" height="14" border="0" style="width:auto"></a>--->
			</div>
			</td>
		</tr>
	</table>
	</div>
   </p>
</div>
	<div class="top" style="position:absolute;top:0;z-index: 9999;width:100%;">
			<!--table cellpadding="0" cellspacing="0" border="0" class="top_td">
				<tr>
					<td><a href=""><img src="http://<?=$img_url?>/mobile/category.png"></a></td>
					<td><img src="http://<?=$img_url?>/mobile/logo.png"></td>
					<td><img src="http://<?=$img_url?>/mobile/login.png"></td>
					<td><img src="http://<?=$img_url?>/mobile/logout.png"></td>
				</tr>
			</table-->
			
			<?
			include($_SERVER['DOCUMENT_ROOT'].'/inc/html/top_menu_mobile.php');
			?>
			
		<div class="container">
			<!-- slider -->
			<ul class="slider">
				<li>
					<img src="http://<?=$img_url?>/mobile/main_banner2.jpg">
				</li>
				<li>
					<img src="http://<?=$img_url?>/mobile/banner1.jpg">
				</li>
			</ul>
		</div>
		<div class="notice">
			<ul>
				<li><img src="http://<?=$img_url?>/mobile/notice.jpg"></li>
				<?
				if(sizeof($_BBS_n)!=0) {
					foreach($_BBS_n as $bsq_n => $barr_n){
				?>
				<li><?=$barr_n['title']?></li>
				<?
					}
				}
				?>
			</ul>
		</div>
		<div class="contents2 lottoball" style="padding:2% 0 4% 0">
			<div>
				<div class="swiper-container2" style="padding-top:4%">
					<div class="swiper-wrapper2">
						<? $n= 0; foreach($_WIN as $seq => $arr) { ?>
						<div class="swiper-slide2">
							<input type="hidden" name="seq_id_<?=$n?>" id="seq_id_<?=$n?>" value="<?=$seq?>">
							
							<p>
								<!--span class="ball_prev"><a href=""><img src="http://<?=$img_url?>/mobile/ball_arrow_prev.jpg"></a></span-->
								<span class="number"><?=$seq?></span>
								<span class="text">회 당첨 번호 안내</span>
								<span class="date"><?=str_replace('-', '.', $arr['date']);?></span>
								<!--span class="ball_next"><a href=""><img src="http://<?=$img_url?>/mobile/ball_arrow_next.jpg"></a></span-->
							</p>
							<div style="background-color:#f8f8f8;margin-top:4%;padding:2%" class="lotto_ball">
								<p>
									<? foreach(getBallField() as $field) { ?>
									<span><img src="http://<?=$img_url?>/mobile/ball_<?=$arr[$field]?>.png" style="width:8%"></span>
									<? } ?>
									<span><img src="http://<?=$img_url?>/mobile/plus.png" style="width: 4%;padding-top: 2%;"></span>
									<span><img src="http://<?=$img_url?>/mobile/ball_<?=$arr['bonus'];?>.png" style="width:8%"></span>
								</p>
							</div>
						</div>
						<? $n=$n+1; } ?>

					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
				<script src="http://<?=$js_url?>/mobile/swiper2.js"></script>
				
				<script>
					
				    var mySwiper = new Swiper('.swiper-container2', {
						navigation: {
							nextEl: '.swiper-button-next',
							prevEl: '.swiper-button-prev',
						},	
						//loop: true
				    });
					var totalSlides = mySwiper.slides.length - 1;

					mySwiper.on('slideChange', function() {
						var nums = $(".swiper-slide2 .number").text();

						var r_idx = mySwiper.activeIndex;
						var r_seq = $("#seq_id_"+r_idx).val();
						view_tables(r_seq);
					});
					
					function view_tables(seq){
						var lgurl = "<?=$mobile_dir?>/info/lotto.php";
						var form_data = {
							seq : seq,
							mode : "lotto_select"
						};

						
						$.ajax({
							type	:	"POST",
							url		:	lgurl,
							data : form_data,
							dataType : "json",
							async: false,
							cache: false,
							success : function(data){
								if(data['data']){
									var rank_1_p = addCommas(data['data'][seq].rank_1_price);
									var rank_2_p = addCommas(data['data'][seq].rank_2_price);
									var rank_3_p = addCommas(data['data'][seq].rank_3_price);
									
									var rank_1_c = addCommas(data['data'][seq].rank_1_count);
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
									//console.log(mrank_1_c);

									$("#num1_price").html(rank_1_p+" 원");
									$("#num2_price").html(rank_2_p+" 원");
									$("#num3_price").html(rank_3_p+" 원");

									$("#num1_num").html(rank_1_c);
									$("#num2_num").html(rank_2_c);
									$("#num3_num").html(rank_3_c);

									$("#num1_mrlotto").html(mrank_1_c);
									$("#num2_mrlotto").html(mrank_2_c);
									$("#num3_mrlotto").html(mrank_3_c);

								}
							},
							error: function(request, status, error) {
								console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
							}
						});
						return false;
					}
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
				  </script>


			</div>
			<div class="lotto_table">
				<table cellpadding="0" cellspacing="0" border="0" style="width:100%;" class="lottotable">
					<colgroup>
						<col width="15%">
						<col width="35%">
						<col width="18%">
						<col width="30%">
					</colgroup>
					<tbody>
						<tr>
							<td>순위</td>
							<td>당첨금액</td>
							<td>당첨자 수</td>
							<td>미스터로또씨 조합 수</td>
						</tr>
						<tr>
							<td>1</td>
							<td id="num1_price">0원</td>
							<td id="num1_num">0명</td>
							<td id="num1_mrlotto">0조합</td>
						</tr>
						<tr>
							<td>2</td>
							<td id="num2_price">0원</td>
							<td id="num2_num">0명</td>
							<td id="num2_mrlotto">0조합</td>
						</tr>
						<tr>
							<td>3</td>
							<td id="num3_price">0원</td>
							<td id="num3_num">0명</td>
							<td id="num3_mrlotto">0조합</td>
						</tr>
					</tbody>
				</table>
				<!--a href=""><img src="http://<?=$img_url?>/mobile/tablemore.jpg"></a-->
			</div>
		</div>
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		
		<div class="contents" style="position:relative;padding:0 !important;width:100%;background: url('http://<?=$img_url?>/mobile/awardsbg.jpg') no-repeat; background-size: cover">
			<div class="swiper-container3" style="width:70%;margin:0;padding:15% 4% 6% 4%">
				<div class="swiper-wrapper">
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto1.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto2.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto3.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto4.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto5.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto6.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto7.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto8.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto9.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto10.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto11.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto12.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto13.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto14.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto15.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto16.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto17.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto18.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto19.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto20.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto21.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto22.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto23.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto24.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto25.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto26.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto27.jpg" >
					</div>
				</div>
			</div>

		</div>
		
		
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		<div class="contents" style="position:relative">
			<div class="news">
				<p><img src="http://<?=$img_url?>/mobile/news_tit.jpg"></p>
				<span><a href="<?=$mobile_dir?>/bbs/board.php?dep=n"><img src="http://<?=$img_url?>/mobile/more.jpg"></a></span>
			</div>
			<div class="news_table">
				<?
				
				if(sizeof($_BBS_m)!=0) {
					$bm =0;
					foreach($_BBS_m as $bsq_m => $barr_m){
				?>
				<div <? if($bm==0){?>style="border-bottom:1px solid #d8d8d8"<?}?>>
					<a href="<?=$barr_m['title2']?>" target="_new">
					<div class="news_table_thum"><img src="<?=$barr_m['file01']?>"></div>
					<p class="news_tit f2 word"><?=$barr_m['title']?></p>
					<span class="news_date f3"><?=date("y.m.d",$barr_m['reg_datetime'])?></span>
					</a>
				</div>
				
				<?
						$bm = $bm+1;
					}
				}
				?>
			</div>
		</div>
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		<div><img src="http://<?=$img_url?>/mobile/img1.jpg"></div>
		<div><a href="javascript:;" id="layer_popup" class="ex1"><img src="http://<?=$img_url?>/mobile/img2.jpg" style="width:50%"></a><a href="javascript:;" id="layer_popup2" class="ex2"><img src="http://<?=$img_url?>/mobile/img3.jpg" style="width:50%"></a></div>
	
	
		
		<div class="ow-overlay ow-closed"></div> 
		
		<div class="modal ow-closed">
		  <img src="http://<?=$img_url?>/mobile/m2.jpg">
		  <a class="close-button" href='#' style="color:#111;background-color: #fff;padding:1% 5% ;">닫기</a>
		</div>
		<div class="modal2 ow-closed">
		  <img src="http://<?=$img_url?>/mobile/m_1.jpg">
		  <a class="close-button2" href='#' style="color:#111;background-color: #fff;padding:1% 5% ;">닫기</a>
		</div>
		
			
		<script type="text/javascript" src="http://<?=$js_url?>/mobile/jquery.omniwindow.js"></script> 
		
		
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		<div class="chart" >
			
			<div class="contents">
				<p style="width:100%;padding-bottom:2%;border-bottom: 1px solid #111;"><img src="http://<?=$img_url?>/mobile/chart_tit.jpg" style="width:80%"></p>
			</div>
			
			<div class="container">
				<!-- slider -->
				<ul class="slider">
					<li>
						<div class="contents">
							<h3>통계 분석 시스템(Statistical Analysis System)</h3>
							<p>미스터로또씨는 역대 로또 당첨 번호를 빅데이터화 하여 당첨 정보를 분석합니다. 최다 당첨번호 및 최저 당첨번호 추출, 홀짝 비율, 고저 비율을 더한 총합, 당첨 조합 끝자리, 끝자리를 모두 더한 끝수 합 등을 분석하여 패턴화 합니다.</p>
						</div>
						<img src="http://<?=$img_url?>/mobile/chart1.jpg">
					</li>
					<li>
						<div class="contents">
							<h3>패턴 비율 예측 시스템(Pattern Proportion System)</h3>
							<p>위의 데이터를 기반으로 패턴을 분석하고 비율을 예측합니다. 과거부터 현재까지 이른 장기적인 동향 분석과 최근 회차의 단기적인 동향을 분석하여, 현재 추세를 확인합니다. 28가지의 자체 알고리즘 필터링 방식을 사용하여 안정성이 높은 패턴과 낮은 패턴을 분류하게 됩니다.</p>
						</div>
						<img src="http://<?=$img_url?>/mobile/chart2.jpg">
					</li>
					<li>
						<div class="contents">
							<h3>변수 제거 시스템(Variable emoval System)</h3>
							<p>체계적인 패턴 필터링 후 조합 변수를 제거하는 작업을 거칩니다. 1,2단계를 거친 누적 데이터를 기반으로 한 데이터 베이스를 반영하여 가장 최적화 된 추첨 패턴을 적용합니다. 선별된 패턴 내에도 동일한 작업이 이루어지며, 당첨 번호 출현 가능 범위를 압축하여 변수를 제거 합니다.</p>
						</div>
						<img src="http://<?=$img_url?>/mobile/chart3.jpg">
					</li>
					<li>
						<div class="contents">
							<h3>변수 제거 시스템(Variable emoval System)</h3>
							<p>체계적인 패턴 필터링 후 조합 변수를 제거하는 작업을 거칩니다. 1,2단계를 거친 누적 데이터를 기반으로 한 데이터 베이스를 반영하여 가장 최적화 된 추첨 패턴을 적용합니다. 선별된 패턴 내에도 동일한 작업이 이루어지며, 당첨 번호 출현 가능 범위를 압축하여 변수를 제거 합니다.</p>
						<img src="http://<?=$img_url?>/mobile/chart4.jpg">
					</li>
					<li>
						<div class="contents">
							<h3>최적 번호 추출 및 맞춤형 초이스 넘버링 시스템<br>(Extract Optimal Number / Choice Number System)</h3>
							<p>시스템을 활용한 번호 조합이 완료되면 미스터로또씨의 연구원 및 전문가들이 이를 검토 및 분석하게 됩니다. 슈퍼 컴퓨터 시스템이 미처 닿지 못하는 세밀한 부분까지 확인하게 되면 당첨 확률을 높이는 최적의 번호 조합이 완성됩니다.</p>
						<img src="http://<?=$img_url?>/mobile/chart5.jpg">
					</li>
				</ul>
				
			</div>
		</div>
		<!--
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		<div><a href="<?=$mobile_dir?>/bbs/board_v.php?dep=e&page=1&uid=13"><img src="http://<?=$img_url?>/mobile/event_banner.jpg"></a></div>--->
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		
		<div class="contents" style="position:relative; ">
			<div class="product">
				<p><img src="http://<?=$img_url?>/mobile/product_tit.jpg"></p>
				<span><a href="<?=$mobile_dir?>/info/sub.php?dep=2"><img src="http://<?=$img_url?>/mobile/more.jpg"></a></span>
			</div>
			<div class="swiper-container">
			<div class="swiper-wrapper">
			<div class="swiper-slide" >
				<div class="pro_tit1">프리미엄 2년제</div>
				<div class="pro_tit2">50% 할인</div>
				<span>300명 제한</span>
				<div style="padding:0 8px"><img src="http://<?=$img_url?>/mobile/red_box.jpg" style="width:100%"></div>
				<div class="mon_s"><s>900,000원</s></div>
				<div class="mon_b">449,000원</div>
				<div class="pro_bt"><a href="<?=$mobile_dir?>/info/sub.php?dep=2">상품 보러가기</a></div>
			</div>
			<div class="swiper-slide">
				<div class="pro_tit1">프리미엄 1년제</div>
				<div class="pro_tit2">45% 할인</div>
				<span>2,000명 제한</span>
				<div style="padding:0 8px"><img src="http://<?=$img_url?>/mobile/prd_label2.jpg" style="width:100%"></div>
				<div class="mon_s"><s>540,000원</s></div>
				<div class="mon_b">299,000원</div>
				<div class="pro_bt" style="margin-bottom:0 !important"><a href="<?=$mobile_dir?>/info/sub.php?dep=2#pro2">상품 보러가기</a></div>
				<div style="padding: 0 !important;text-align: right !important;font-size:0.5rem !important;padding-right:15px !important;color:#bbb !important">판매정책변경 (2019.02.11)</div>
			</div>
			<div class="swiper-slide">
				<div style="background-color: #111;width:100%;height:100%;position: absolute;z-index: 9999;border-radius: 9px; opacity: 0.8"></div>
				<div class="soldout">
					<div class="pro_tit1">골드 2년제</div>
					<div class="pro_tit2">40% 할인</div>
					<div class="mon_s" style="padding-top:45px"><s>410,000원</s></div>
					<div class="mon_b">245,000원</div>
					<div class="pro_bt"><a href="<?=$mobile_dir?>/info/sub.php?dep=2#pro3">상품 보러가기</a></div>
					<img src="http://<?=$img_url?>/mobile/soldout.png">
				</div>
			</div>
			<div class="swiper-slide">
				<div style="background-color: #111;width:100%;height:100%;position: absolute;z-index: 9999;border-radius: 9px; opacity: 0.8"></div>
				<div class="soldout">
					<div class="pro_tit1">골드 1년제</div>
					<div class="pro_tit2">35% 할인</div>
					<div class="mon_s" style="padding-top:45px"><s>300,000원</s></div>
					<div class="mon_b">199,000원</div>
					<div class="pro_bt"><a href="<?=$mobile_dir?>/info/sub.php?dep=2#pro3">상품 보러가기</a></div>
					<img src="http://<?=$img_url?>/mobile/soldout.png">
				</div>
			</div>
			<div class="swiper-slide">
				<div class="pro_tit1">실버 1년제</div>
				<div class="pro_tit2">25% 할인</div>
				<div class="mon_s" style="padding-top:45px"><s>200,000원</s></div>
				<div class="mon_b">149,000원</div>
				<div class="pro_bt"><a href="<?=$mobile_dir?>/info/sub.php?dep=2#pro3">상품 보러가기</a></div>
			</div>
			<div class="swiper-slide">
				<div class="pro_tit1">골드 1개월</div>
				<div class="pro_tit2">20% 할인</div>
				<div class="mon_s" style="padding-top:45px"><s>25,000원</s></div>
				<div class="mon_b">20,000원</div>
				<div class="pro_bt"><a href="<?=$mobile_dir?>/info/sub.php?dep=2#pro4">상품 보러가기</a></div>
			</div>
			</div>
			
			<!--div class="swiper-pagination"></div-->
			</div>

		</div>
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		<div><a href="<?=$mobile_dir?>/info/sub.php?dep=1"><img src="http://<?=$img_url?>/mobile/footer_banner.png"></a></div>
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		
		<div class="contents" style="position:relative">
			<!-- 방송--->
			<div class="tv">
				<p><img src="http://<?=$img_url?>/mobile/tv_tit.jpg"></p>
				<div id="brod_img"><img src="http://<?=$img_url?>/mobile/video.jpg"></div>
			</div>
		</div>
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		
		<div><a href="<?=$mobile_dir?>/info/sub.php?dep=1"><img src="http://<?=$img_url?>/mobile/banner2.jpg"></a></div>
		
		
		
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		<div class="contents" style="position:relative">
			<div class="event" style="margin-bottom:2%">
				<p><img src="http://<?=$img_url?>/mobile/event_tit.jpg"></p>
				<span><a href="<?=$mobile_dir?>/bbs/board.php?dep=e"><img src="http://<?=$img_url?>/mobile/more.jpg"></a></span>
			</div>
			<div>
				<?
				if(sizeof($_BBS)!=0) {
					$ind = 0;
					foreach($_BBS as $bsq => $barr){
					?>
					<div style="border:1px solid #d8d8d8; border-radius: 15px;padding:2% 3%;margin-bottom:2%">
						<div class="event_thum"><a href="<?=$mobile_dir?>/bbs/board_v.php?dep=e&uid=<?=$barr['uid']?>"><img src="<?=$barr['file02']?>"></a></div>
						<div class="event_thum_tit">
							<h4><a href="<?=$mobile_dir?>/bbs/board_v.php?dep=e&uid=<?=$barr['uid']?>"><?=$barr['title']?></a></h4>
							<p class="f4 word2"><a href="<?=$mobile_dir?>/bbs/board_v.php?dep=e&uid=<?=$barr['uid']?>"><?=$barr['title2']?></a></p>
						</div>
					</div>
					<?
						}
					} else {
					?>
					<div style="border:1px solid #d8d8d8; border-radius: 15px;padding:2% 3%;margin-bottom:2%">
						<div colspan="2" class="main_notice_1">게시된 내용이 조회되지 않습니다.</div>
					</div>
					<?
					}
					?>
			</div>
		</div>
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		<div class="contents">
			<ul style="overflow: hidden">
				<li style="width:50%;float: left;padding-right:2%;box-sizing: border-box">
					<img src="http://<?=$img_url?>/mobile/cc_tit.jpg" style="width:43%">
					<a href="tel:1811-7335"><img src="http://<?=$img_url?>/mobile/footer_call.jpg" style="width:95%;margin:4% 0 2% 0"></a>
					<p class="f4" style="color:#2a76ce;margin-bottom:5%">클릭 시 바로 통화 가능합니다.</p>
					<p class="f4" style="font-weight:bold">평일 09:30 ~ 18:30<br>(점심시간 12:30 ~ 13:30 제외)</p>
					<p class="f4">주말 및 공휴일 고객센터 휴무</p>
				</li>
				<li style="width:50%;float: left;padding-left:1%;box-sizing: border-box">
					<img src="http://<?=$img_url?>/mobile/money_tit.jpg" style="width:77%">
					<p class="f2" style="color:#2a76ce;margin:4% 0 2% 0">신한은행</p>
					<p class="f1">110-459-382099</p>
					<p class="f4">예금주 : 조정윤</p>
					<div class="f5" style="background-color:#f8f8f8;border-radius: 10px; color:#2a76ce;padding:4%;margin-top:3%">무통장입금 하신 경우 입금자확인을 위해 미스터로또씨로 꼭 연락주시기 바랍니다.</div>
				</li>
			</ul>
		</div>
		<div class="f4" style="border-top:1px solid #111; border-bottom:1px solid #111; text-align: center;padding:1% 0">
			<span><a href="<?=$mobile_dir?>/agree/join1.php">이용약관</a></span>
			<span style="margin:0 3%"><a href="<?=$mobile_dir?>/agree/join2.php">개인정보 처리방침</a></span>
			<span><a href="<?=$mobile_dir?>/agree/join3.php">마케팅 정보 수신 동의</a></span>
		</div>
		<div style="background-color: #333;color:#ccc;text-align: center;padding:2% 0" class="f5">
			<p>케이큐&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TEL : 1811-7335&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FAX : 02-2067-3090</p>
			<p>대표이사 : 조정윤&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;개인정보책임관리자 : 조정윤&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;사업자등록번호 : 178-01-01503</p>
			<p>주소 : 경기도 광명시 가림일로 79, 104동 18층 1806호(철산동, 도덕파크타운)</p>
			<p class="f5" style="padding-top:1%;color:#666">COPYRIGHT ⓒ 2018 Mr.quant All rights reserved.</p>
		</div>
		<div style="background-color:#222;color:#888;text-align: center; padding:2% 4%" class="f5">* 당사의 분석 시스템은 전체 로또번호 조합 중 등급별 압축 필터링한 조합 정보제공만을 목적으로 하며, 당첨 확정 서비스가 아니므로 서비스 이용 과정에서 기대이익을 얻지 못하거나 발생한 손해 등에 대한 최종책임은 서비스 이용자 본인에게 있습니다.</div>
		
		
	<script src="http://<?=$js_url?>/mobile/swiper.min.js"></script>
	<script>
		var swiper22 = new Swiper('.swiper-container3', {
			slidesPerView:5,
			spaceBetween:15,
			centeredSlides: true,
			loop: true,
			//effect: 'coverflow',
			loopAdditionalSlides: 2,
			autoplay: {
				delay: 2500,
				disableOnInteraction: false,
			},
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
		  navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		  },
		});
	    var swiper = new Swiper('.swiper-container', {
	      slidesPerView: 3,
	      spaceBetween: 5,
	      pagination: {
	        el: '.swiper-pagination',
	        clickable: true,
	      },
	    });
	  </script>
	</body>
</html>
<?
if($_SERVER['REMOTE_ADDR']=="183.109.79.201"){
?>
<script type="text/javascript" src="https://openmain.pstatic.net/js/openmain.js"></script>
<div class="nv-openmain"  data-type="W2" ></div>

<?
}
?><?
$_pp_e = 0;
$_pp_s = 0;

include($_SERVER['DOCUMENT_ROOT'].'/inc/func/common.php');
include(BASE_DIR.'inc/html/head_m_main.html');
//echo BASE_DIR;

$cur_seq = getCurSeq();
$_WIN = getSeqRank($cur_seq-5, $cur_seq, 'desc');

$_BRO = getBrod($cur_seq-3, $cur_seq, 'desc');

$_BBS_n = getBbsList(0,1,'n','desc');


$_BBS = getBbsList(0,2,'e','desc');

$_BBS_m = getBbsList(0,2,'m','rand');

$code = $_SESSION['code'];
$rs = ordrGoods($code,'','asc');

?>
<style>
.btn {
  cursor: pointer;  }

.close {
  width: 50px;
  height: 50px;
  position: absolute;
  left: 0px;
  top: 0px;
  background-image: url("http://s1.daumcdn.net/cfs.tistory/custom/blog/204/2048858/skin/images/close.png");
  background-size: 50%;
  background-repeat: no-repeat;
  background-position: center;
  cursor: pointer;
}

#menu {
  width: 150px;
  height: 100%;
  position: fixed;
  top: 0px;
  left: -152px;
  z-index: 10;
  background-color: white;
  border-right: 1px solid #063980;
  transition: All 0.5s ease;
  -webkit-transition: All 0.5s ease;
  -moz-transition: All 0.5s ease;
  -o-transition: All 0.5s ease;
  color:#fff;
  padding-top:15%;
}

#menu.open {
  left: 0px;
}

.page_cover.open {
  display: block;
}

.page_cover {
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0px;
  left: 0px;
  background-color: rgba(0, 0, 0, 0.6);
  z-index: 4;
  display: none;
}
.top ul {}		
.top ul li {display:table-cell }


#nav { font-family:'arial'; }
#nav ul{ width:100%; margin:0; padding:0; }
#nav ul.menu li{ position:relative; float:left; width:100%; list-style-type:none;border-bottom:1px solid #eee}
#nav ul.menu li a{ display:block; width:100%; height:100%;text-indent:20px; color:#8d8d8d; text-decoration:none; line-height: 34px; font-size: 1.05em;color:#333}
#nav ul.menu li a:hover{ background:#eee; }
#nav ul.menu li .sub a{ position:relative; float:left; display:block; width:100%; z-index:999;  background:#eee; font-size: 0.9em;line-height: 30px; padding-left:10px; box-sizing: border-box;color:#8d8d8d}
#nav ul.menu li .sub a:hover{ background:#444; color:#fff; }


	</style>	
<form name="logout_form" id="logout_form" method="post">
<input type="hidden" name="mode" value="logout">
</form>		


<script src="http://js.mrlotto.co.kr/jquery.bpopup.min.js"></script>
<script>
function set_cookie(name, value, expirehours, domain) 
{
	var today = new Date();
	today.setTime(today.getTime() + (60*60*1000*expirehours));
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + today.toGMTString() + ";";
	if (domain) {
		document.cookie += "domain=" + domain + ";";
	}
}
function get_cookie(name) 
{
	var find_sw = false;
	var start, end;
	var i = 0;
	for (i=0; i<= document.cookie.length; i++)
	{
		start = i;
		end = start + name.length;

		if(document.cookie.substring(start, end) == name) 
		{
			find_sw = true
			break
		}
	}
	if (find_sw == true) 
	{
		start = end + 1;
		end = document.cookie.indexOf(";", start);

		if(end < start)
			end = document.cookie.length;

		return document.cookie.substring(start, end);
	}
	return "";
}

function layer_close(id,hiddenWay) {
	var obj = document.getElementById("expirehours"+ id);
	var tmpid = document.getElementById("mpop"+id);
	if (obj.checked == true) {
		set_cookie("mit_ck_pop_"+id, "done", obj.value, window.location.host);
	}
	if(hiddenWay == "ts_slideDownBack"){
		ts_slideDownBack(tmpid);
	}else if(hiddenWay == "ts_slideLeftBack"){
		ts_slideLeftBack(tmpid);
	}else if(hiddenWay == "ts_slideLeftDownBack"){
		ts_slideLeftDownBack(tmpid);
	}else if(hiddenWay == "ts_fadeInBack"){
		ts_fadeInBack(tmpid);
	}else{
		tmpid.style.display = "none";
		$('#mpop'+id).bPopup().close();

	}
	selectbox_visible();
}
function selectbox_visible() 
{ 
	for (i=0; i<document.forms.length; i++) { 
		for (k=0; k<document.forms[i].length; k++) { 
			el = document.forms[i].elements[k];    
			if (el.type == "select-one" && el.style.visibility == 'hidden') 
				el.style.visibility = 'visible'; 
		} 
	} 
}

$(document).ready(function(){
	var obj = document.getElementById("expirehours8");
	console.log(obj.value);

	var ck = get_cookie("mit_ck_pop_8");
	if(ck=="done"){
		$("#mpop8").hide();
	} else {
		$("#mpop8").bPopup({});
	}	
	//$("#mpop8").bPopup({});
});
</script>
<style>
.button:hover{
    background-color: #1e1e1e;
}
.button{
    background-color: #2B91AF;
    border-radius: 10px;
    box-shadow: 0 2px 3px rgba(0, 0, 0, 0.3);
    color: #FFFFFF;
    cursor: pointer;
    display: inline-block;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
}
.button.b-close, .button.bClose{
    border-radius: 7px 7px 7px 7px;
    box-shadow: none;
    font: bold 231% sans-serif;
    padding: 0 6px 2px;
    position: absolute;
    right: -7px;
    top: -7px;
}
</style>
<div id="mpop8" style="position:absolute;display: none; background-color: white; width: 400px; height: 400px;">
	<span class="button b-close"><span>X</span></span>
   <p>
    <div style="width:400px;overflow:hidden;">	 
	<table cellpadding="0" cellspacing="0" bgcolor="#edf2fc" width="100%" height="100%">
		<tr>
			<td>
			<table cellspacing="0" cellpadding="0" width="100%" height="400">
				<tr>
					<td><div style="overflow:hidden;"><div style="text-align: center"><img id="image_0.43562147746718776" style="width: 400px;" alt="pop.jpg" src="http://image.mrlotto.co.kr/popup/190122_popup.jpg" /><br /></div></div></td>
				</tr>
			</table>
			<div style="background:#000000;color:#FFFFFF;text-align:left;font-size:12px;">
				<input type="checkbox"  id="expirehours8" name="expirehours8" value="24" onchange="javascript:layer_close(8)">24시간 동안 이 창을 다시 열지 않음
				<!--<a href="javascript:layer_close(8)"><img src="http://image.mrlotto.co.kr/popup/close.jpg" width="14" height="14" border="0" style="width:auto"></a>--->
			</div>
			</td>
		</tr>
	</table>
	</div>
   </p>
</div>
	<div class="top" style="position:absolute;top:0;z-index: 9999;width:100%;">
			<!--table cellpadding="0" cellspacing="0" border="0" class="top_td">
				<tr>
					<td><a href=""><img src="http://<?=$img_url?>/mobile/category.png"></a></td>
					<td><img src="http://<?=$img_url?>/mobile/logo.png"></td>
					<td><img src="http://<?=$img_url?>/mobile/login.png"></td>
					<td><img src="http://<?=$img_url?>/mobile/logout.png"></td>
				</tr>
			</table-->
			
			<?
			include($_SERVER['DOCUMENT_ROOT'].'/inc/html/top_menu_mobile.php');
			?>
			
		<div class="container">
			<!-- slider -->
			<ul class="slider">
				<li>
					<img src="http://<?=$img_url?>/mobile/main_banner2.jpg">
				</li>
				<li>
					<img src="http://<?=$img_url?>/mobile/banner1.jpg">
				</li>
			</ul>
		</div>
		<div class="notice">
			<ul>
				<li><img src="http://<?=$img_url?>/mobile/notice.jpg"></li>
				<?
				if(sizeof($_BBS_n)!=0) {
					foreach($_BBS_n as $bsq_n => $barr_n){
				?>
				<li><?=$barr_n['title']?></li>
				<?
					}
				}
				?>
			</ul>
		</div>
		<div class="contents2 lottoball" style="padding:2% 0 4% 0">
			<div>
				<div class="swiper-container2" style="padding-top:4%">
					<div class="swiper-wrapper2">
						<? $n= 0; foreach($_WIN as $seq => $arr) { ?>
						<div class="swiper-slide2">
							<input type="hidden" name="seq_id_<?=$n?>" id="seq_id_<?=$n?>" value="<?=$seq?>">
							
							<p>
								<!--span class="ball_prev"><a href=""><img src="http://<?=$img_url?>/mobile/ball_arrow_prev.jpg"></a></span-->
								<span class="number"><?=$seq?></span>
								<span class="text">회 당첨 번호 안내</span>
								<span class="date"><?=str_replace('-', '.', $arr['date']);?></span>
								<!--span class="ball_next"><a href=""><img src="http://<?=$img_url?>/mobile/ball_arrow_next.jpg"></a></span-->
							</p>
							<div style="background-color:#f8f8f8;margin-top:4%;padding:2%" class="lotto_ball">
								<p>
									<? foreach(getBallField() as $field) { ?>
									<span><img src="http://<?=$img_url?>/mobile/ball_<?=$arr[$field]?>.png" style="width:8%"></span>
									<? } ?>
									<span><img src="http://<?=$img_url?>/mobile/plus.png" style="width: 4%;padding-top: 2%;"></span>
									<span><img src="http://<?=$img_url?>/mobile/ball_<?=$arr['bonus'];?>.png" style="width:8%"></span>
								</p>
							</div>
						</div>
						<? $n=$n+1; } ?>

					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
				<script src="http://<?=$js_url?>/mobile/swiper2.js"></script>
				
				<script>
					
				    var mySwiper = new Swiper('.swiper-container2', {
						navigation: {
							nextEl: '.swiper-button-next',
							prevEl: '.swiper-button-prev',
						},	
						//loop: true
				    });
					var totalSlides = mySwiper.slides.length - 1;

					mySwiper.on('slideChange', function() {
						var nums = $(".swiper-slide2 .number").text();

						var r_idx = mySwiper.activeIndex;
						var r_seq = $("#seq_id_"+r_idx).val();
						view_tables(r_seq);
					});
					
					function view_tables(seq){
						var lgurl = "<?=$mobile_dir?>/info/lotto.php";
						var form_data = {
							seq : seq,
							mode : "lotto_select"
						};

						
						$.ajax({
							type	:	"POST",
							url		:	lgurl,
							data : form_data,
							dataType : "json",
							async: false,
							cache: false,
							success : function(data){
								if(data['data']){
									var rank_1_p = addCommas(data['data'][seq].rank_1_price);
									var rank_2_p = addCommas(data['data'][seq].rank_2_price);
									var rank_3_p = addCommas(data['data'][seq].rank_3_price);
									
									var rank_1_c = addCommas(data['data'][seq].rank_1_count);
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
									//console.log(mrank_1_c);

									$("#num1_price").html(rank_1_p+" 원");
									$("#num2_price").html(rank_2_p+" 원");
									$("#num3_price").html(rank_3_p+" 원");

									$("#num1_num").html(rank_1_c);
									$("#num2_num").html(rank_2_c);
									$("#num3_num").html(rank_3_c);

									$("#num1_mrlotto").html(mrank_1_c);
									$("#num2_mrlotto").html(mrank_2_c);
									$("#num3_mrlotto").html(mrank_3_c);

								}
							},
							error: function(request, status, error) {
								console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
							}
						});
						return false;
					}
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
				  </script>


			</div>
			<div class="lotto_table">
				<table cellpadding="0" cellspacing="0" border="0" style="width:100%;" class="lottotable">
					<colgroup>
						<col width="15%">
						<col width="35%">
						<col width="18%">
						<col width="30%">
					</colgroup>
					<tbody>
						<tr>
							<td>순위</td>
							<td>당첨금액</td>
							<td>당첨자 수</td>
							<td>미스터로또씨 조합 수</td>
						</tr>
						<tr>
							<td>1</td>
							<td id="num1_price">0원</td>
							<td id="num1_num">0명</td>
							<td id="num1_mrlotto">0조합</td>
						</tr>
						<tr>
							<td>2</td>
							<td id="num2_price">0원</td>
							<td id="num2_num">0명</td>
							<td id="num2_mrlotto">0조합</td>
						</tr>
						<tr>
							<td>3</td>
							<td id="num3_price">0원</td>
							<td id="num3_num">0명</td>
							<td id="num3_mrlotto">0조합</td>
						</tr>
					</tbody>
				</table>
				<!--a href=""><img src="http://<?=$img_url?>/mobile/tablemore.jpg"></a-->
			</div>
		</div>
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		<div><a href="<?=$mobile_dir?>/info/sub.php?dep=1"><img src="http://<?=$img_url?>/mobile/banner2.jpg"></a></div>
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		<div class="contents" style="position:relative">
			<div class="news">
				<p><img src="http://<?=$img_url?>/mobile/news_tit.jpg"></p>
				<span><a href="<?=$mobile_dir?>/bbs/board.php?dep=n"><img src="http://<?=$img_url?>/mobile/more.jpg"></a></span>
			</div>
			<div class="news_table">
				<?
				
				if(sizeof($_BBS_m)!=0) {
					$bm =0;
					foreach($_BBS_m as $bsq_m => $barr_m){
				?>
				<div <? if($bm==0){?>style="border-bottom:1px solid #d8d8d8"<?}?>>
					<a href="<?=$barr_m['title2']?>" target="_new">
					<div class="news_table_thum"><img src="<?=$barr_m['file01']?>"></div>
					<p class="news_tit f2 word"><?=$barr_m['title']?></p>
					<span class="news_date f3"><?=date("y.m.d",$barr_m['reg_datetime'])?></span>
					</a>
				</div>
				
				<?
						$bm = $bm+1;
					}
				}
				?>
			</div>
		</div>
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		<div><img src="http://<?=$img_url?>/mobile/img1.jpg"></div>
		<div><a href="javascript:;" id="layer_popup" class="ex1"><img src="http://<?=$img_url?>/mobile/img2.jpg" style="width:50%"></a><a href="javascript:;" id="layer_popup2" class="ex2"><img src="http://<?=$img_url?>/mobile/img3.jpg" style="width:50%"></a></div>
	
	
		
		<div class="ow-overlay ow-closed"></div> 
		
		<div class="modal ow-closed">
		  <img src="http://<?=$img_url?>/mobile/m2.jpg">
		  <a class="close-button" href='#' style="color:#111;background-color: #fff;padding:1% 5% ;">닫기</a>
		</div>
		<div class="modal2 ow-closed">
		  <img src="http://<?=$img_url?>/mobile/m_1.jpg">
		  <a class="close-button2" href='#' style="color:#111;background-color: #fff;padding:1% 5% ;">닫기</a>
		</div>
		
			
		<script type="text/javascript" src="http://<?=$js_url?>/mobile/jquery.omniwindow.js"></script> 
		
		
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		<div class="chart" >
			
			<div class="contents">
				<p style="width:100%;padding-bottom:2%;border-bottom: 1px solid #111;"><img src="http://<?=$img_url?>/mobile/chart_tit.jpg" style="width:80%"></p>
			</div>
			
			<div class="container">
				<!-- slider -->
				<ul class="slider">
					<li>
						<div class="contents">
							<h3>통계 분석 시스템(Statistical Analysis System)</h3>
							<p>미스터로또씨는 역대 로또 당첨 번호를 빅데이터화 하여 당첨 정보를 분석합니다. 최다 당첨번호 및 최저 당첨번호 추출, 홀짝 비율, 고저 비율을 더한 총합, 당첨 조합 끝자리, 끝자리를 모두 더한 끝수 합 등을 분석하여 패턴화 합니다.</p>
						</div>
						<img src="http://<?=$img_url?>/mobile/chart1.jpg">
					</li>
					<li>
						<div class="contents">
							<h3>패턴 비율 예측 시스템(Pattern Proportion System)</h3>
							<p>위의 데이터를 기반으로 패턴을 분석하고 비율을 예측합니다. 과거부터 현재까지 이른 장기적인 동향 분석과 최근 회차의 단기적인 동향을 분석하여, 현재 추세를 확인합니다. 28가지의 자체 알고리즘 필터링 방식을 사용하여 안정성이 높은 패턴과 낮은 패턴을 분류하게 됩니다.</p>
						</div>
						<img src="http://<?=$img_url?>/mobile/chart2.jpg">
					</li>
					<li>
						<div class="contents">
							<h3>변수 제거 시스템(Variable emoval System)</h3>
							<p>체계적인 패턴 필터링 후 조합 변수를 제거하는 작업을 거칩니다. 1,2단계를 거친 누적 데이터를 기반으로 한 데이터 베이스를 반영하여 가장 최적화 된 추첨 패턴을 적용합니다. 선별된 패턴 내에도 동일한 작업이 이루어지며, 당첨 번호 출현 가능 범위를 압축하여 변수를 제거 합니다.</p>
						</div>
						<img src="http://<?=$img_url?>/mobile/chart3.jpg">
					</li>
					<li>
						<div class="contents">
							<h3>변수 제거 시스템(Variable emoval System)</h3>
							<p>체계적인 패턴 필터링 후 조합 변수를 제거하는 작업을 거칩니다. 1,2단계를 거친 누적 데이터를 기반으로 한 데이터 베이스를 반영하여 가장 최적화 된 추첨 패턴을 적용합니다. 선별된 패턴 내에도 동일한 작업이 이루어지며, 당첨 번호 출현 가능 범위를 압축하여 변수를 제거 합니다.</p>
						<img src="http://<?=$img_url?>/mobile/chart4.jpg">
					</li>
					<li>
						<div class="contents">
							<h3>최적 번호 추출 및 맞춤형 초이스 넘버링 시스템<br>(Extract Optimal Number / Choice Number System)</h3>
							<p>시스템을 활용한 번호 조합이 완료되면 미스터로또씨의 연구원 및 전문가들이 이를 검토 및 분석하게 됩니다. 슈퍼 컴퓨터 시스템이 미처 닿지 못하는 세밀한 부분까지 확인하게 되면 당첨 확률을 높이는 최적의 번호 조합이 완성됩니다.</p>
						<img src="http://<?=$img_url?>/mobile/chart5.jpg">
					</li>
				</ul>
				
			</div>
		</div>
		<!--
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		<div><a href="<?=$mobile_dir?>/bbs/board_v.php?dep=e&page=1&uid=13"><img src="http://<?=$img_url?>/mobile/event_banner.jpg"></a></div>--->
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		
		<div class="contents" style="position:relative">
			<div class="product">
				<p><img src="http://<?=$img_url?>/mobile/product_tit.jpg"></p>
				<span><a href="<?=$mobile_dir?>/info/sub.php?dep=2"><img src="http://<?=$img_url?>/mobile/more.jpg"></a></span>
			</div>
			<div class="swiper-container">
			<div class="swiper-wrapper">
			<div class="swiper-slide">
				<div class="pro_tit1">프리미엄 2년제</div>
				<div class="pro_tit2">50% 할인</div>
				<span>30명 제한</span>
				<div style="padding:0 8px"><img src="http://<?=$img_url?>/mobile/red_box.jpg" style="width:100%"></div>
				<div class="mon_s"><s>900,000원</s></div>
				<div class="mon_b">449,000원</div>
				<div class="pro_bt"><a href="<?=$mobile_dir?>/info/sub.php?dep=2">상품 보러가기</a></div>
			</div>
			<div class="swiper-slide">
				<div class="pro_tit1">프리미엄 1년제</div>
				<div class="pro_tit2">45% 할인</div>
				<span>100명 제한</span>
				<div style="padding:0 8px"><img src="http://<?=$img_url?>/mobile/red_box.jpg" style="width:100%"></div>
				<div class="mon_s"><s>540,000원</s></div>
				<div class="mon_b">299,000원</div>
				<div class="pro_bt"><a href="<?=$mobile_dir?>/info/sub.php?dep=2#pro2">상품 보러가기</a></div>
			</div>
			<div class="swiper-slide">
				<div style="background-color: #111;width:100%;height:100%;position: absolute;z-index: 9999;border-radius: 9px; opacity: 0.8"></div>
				<div class="soldout">
					<div class="pro_tit1">골드 2년제</div>
					<div class="pro_tit2">40% 할인</div>
					<div class="mon_s" style="padding-top:45px"><s>410,000원</s></div>
					<div class="mon_b">245,000원</div>
					<div class="pro_bt"><a href="<?=$mobile_dir?>/info/sub.php?dep=2#pro3">상품 보러가기</a></div>
					<img src="http://<?=$img_url?>/mobile/soldout.png">
				</div>
			</div>
			<div class="swiper-slide">
				<div class="pro_tit1">골드 1년제</div>
				<div class="pro_tit2">35% 할인</div>
				<div class="mon_s" style="padding-top:45px"><s>300,000원</s></div>
				<div class="mon_b">199,000원</div>
				<div class="pro_bt"><a href="<?=$mobile_dir?>/info/sub.php?dep=2#pro3">상품 보러가기</a></div>
			</div>
			<div class="swiper-slide">
				
				<div style="background-color: #111;width:100%;height:100%;position: absolute;z-index: 9999;border-radius: 9px; opacity: 0.8"></div>
				<div class="soldout">
					<div class="pro_tit1">실버 2년제</div>
					<div class="pro_tit2">30% 할인</div>
					<div class="mon_s" style="padding-top:45px"><s>210,000원</s></div>
					<div class="mon_b">145,000원</div>
					<div class="pro_bt"><a href="<?=$mobile_dir?>/info/sub.php?dep=2#pro3">상품 보러가기</a></div>
					<img src="http://<?=$img_url?>/mobile/soldout.png">
				</div>
			</div>
			<div class="swiper-slide">
				<div class="pro_tit1">실버 6개월</div>
				<div class="pro_tit2">25% 할인</div>
				<div class="mon_s" style="padding-top:45px"><s>130,000원</s></div>
				<div class="mon_b">99,000원</div>
				<div class="pro_bt"><a href="<?=$mobile_dir?>/info/sub.php?dep=2#pro3">상품 보러가기</a></div>
			</div>
			<div class="swiper-slide">
				<div class="pro_tit1">골드 1개월</div>
				<div class="pro_tit2">20% 할인</div>
				<div class="mon_s" style="padding-top:45px"><s>25,000원</s></div>
				<div class="mon_b">20,000원</div>
				<div class="pro_bt"><a href="<?=$mobile_dir?>/info/sub.php?dep=2#pro4">상품 보러가기</a></div>
			</div>
			</div>
			
			<!--div class="swiper-pagination"></div-->
			</div>

		</div>
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		<div><a href="<?=$mobile_dir?>/info/sub.php?dep=1"><img src="http://<?=$img_url?>/mobile/footer_banner.png"></a></div>
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		
		<div class="contents" style="position:relative">
			<!-- 방송--->
			<div class="tv">
				<p><img src="http://<?=$img_url?>/mobile/tv_tit.jpg"></p>
				<div id="brod_img"><img src="http://<?=$img_url?>/mobile/video.jpg"></div>
			</div>
		</div>
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		
		
		
		<div class="contents" style="position:relative;padding:0 !important;width:100%;background: url('http://<?=$img_url?>/mobile/awardsbg.jpg') no-repeat; background-size: cover">
			<div class="swiper-container3" style="width:70%;margin:0;padding:15% 4% 6% 4%">
				<div class="swiper-wrapper">
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto1.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto2.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto3.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto4.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto5.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto6.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto7.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto8.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto9.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto10.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto11.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto12.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto13.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto14.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto15.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto16.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto17.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto18.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto19.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto20.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto21.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto22.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto23.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto24.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto25.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto26.jpg" >
					</div>
					<div class="swiper-slide" style="box-shadow: none;border-radius: 0;border:none">
						<img src="http://<?=$img_url?>/mobile/lotto27.jpg" >
					</div>
				</div>
			</div>

		</div>
		
		
		
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		<div class="contents" style="position:relative">
			<div class="event" style="margin-bottom:2%">
				<p><img src="http://<?=$img_url?>/mobile/event_tit.jpg"></p>
				<span><a href="<?=$mobile_dir?>/bbs/board.php?dep=e"><img src="http://<?=$img_url?>/mobile/more.jpg"></a></span>
			</div>
			<div>
				<?
				if(sizeof($_BBS)!=0) {
					$ind = 0;
					foreach($_BBS as $bsq => $barr){
					?>
					<div style="border:1px solid #d8d8d8; border-radius: 15px;padding:2% 3%;margin-bottom:2%">
						<div class="event_thum"><a href="<?=$mobile_dir?>/bbs/board_v.php?dep=e&uid=<?=$barr['uid']?>"><img src="<?=$barr['file02']?>"></a></div>
						<div class="event_thum_tit">
							<h4><a href="<?=$mobile_dir?>/bbs/board_v.php?dep=e&uid=<?=$barr['uid']?>"><?=$barr['title']?></a></h4>
							<p class="f4 word2"><a href="<?=$mobile_dir?>/bbs/board_v.php?dep=e&uid=<?=$barr['uid']?>"><?=$barr['title2']?></a></p>
						</div>
					</div>
					<?
						}
					} else {
					?>
					<div style="border:1px solid #d8d8d8; border-radius: 15px;padding:2% 3%;margin-bottom:2%">
						<div colspan="2" class="main_notice_1">게시된 내용이 조회되지 않습니다.</div>
					</div>
					<?
					}
					?>
			</div>
		</div>
		<div><img src="http://<?=$img_url?>/mobile/line.jpg" class="line"></div>
		<div class="contents">
			<ul style="overflow: hidden">
				<li style="width:50%;float: left;padding-right:2%;box-sizing: border-box">
					<img src="http://<?=$img_url?>/mobile/cc_tit.jpg" style="width:43%">
					<a href="tel:1811-7335"><img src="http://<?=$img_url?>/mobile/footer_call.jpg" style="width:95%;margin:4% 0 2% 0"></a>
					<p class="f4" style="color:#2a76ce;margin-bottom:5%">클릭 시 바로 통화 가능합니다.</p>
					<p class="f4" style="font-weight:bold">평일 09:00 ~ 18:00<br>(점심시간 12:30 ~ 13:30 제외)</p>
					<p class="f4">주말 및 공휴일 고객센터 휴무</p>
				</li>
				<li style="width:50%;float: left;padding-left:1%;box-sizing: border-box">
					<img src="http://<?=$img_url?>/mobile/money_tit.jpg" style="width:77%">
					<p class="f2" style="color:#2a76ce;margin:4% 0 2% 0">IBK 기업은행</p>
					<p class="f1">664-019737-01-020</p>
					<p class="f4">예금주 : 미스터퀀트(주)</p>
					<div class="f5" style="background-color:#f8f8f8;border-radius: 10px; color:#2a76ce;padding:4%;margin-top:3%">무통장입금 하신 경우 입금자확인을 위해 미스터로또씨로 꼭 연락주시기 바랍니다.</div>
				</li>
			</ul>
		</div>
		<div class="f4" style="border-top:1px solid #111; border-bottom:1px solid #111; text-align: center;padding:1% 0">
			<span><a href="<?=$mobile_dir?>/agree/join1.php">이용약관</a></span>
			<span style="margin:0 3%"><a href="<?=$mobile_dir?>/agree/join2.php">개인정보 처리방침</a></span>
			<span><a href="<?=$mobile_dir?>/agree/join3.php">마케팅 정보 수신 동의</a></span>
		</div>
		<div style="background-color: #333;color:#ccc;text-align: center;padding:2% 0" class="f5">
			<p>케이큐&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TEL : 1811-7335&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FAX : 02-2067-3090</p>
			<p>대표이사 : 조정윤&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;개인정보책임관리자 : 조정윤&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;사업자등록번호 : 547-88-01224</p>
			<p>주소 : 서울특별시 금천구 가산디지털1로 142, 1118호(가산동, 가산더스카이밸리 1차)</p>
			<p class="f5" style="padding-top:1%;color:#666">COPYRIGHT ⓒ 2018 Mr.quant All rights reserved.</p>
		</div>
		<div style="background-color:#222;color:#888;text-align: center; padding:2% 4%" class="f5">* 당사의 분석 시스템은 전체 로또번호 조합 중 등급별 압축 필터링한 조합 정보제공만을 목적으로 하며, 당첨 확정 서비스가 아니므로 서비스 이용 과정에서 기대이익을 얻지 못하거나 발생한 손해 등에 대한 최종책임은 서비스 이용자 본인에게 있습니다.</div>
		
		
	<script src="http://<?=$js_url?>/mobile/swiper.min.js"></script>
	<script>
		var swiper22 = new Swiper('.swiper-container3', {
			slidesPerView:5,
			spaceBetween:15,
			centeredSlides: true,
			loop: true,
			//effect: 'coverflow',
			loopAdditionalSlides: 2,
			autoplay: {
				delay: 2500,
				disableOnInteraction: false,
			},
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
		  navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		  },
		});
	    var swiper = new Swiper('.swiper-container', {
	      slidesPerView: 3,
	      spaceBetween: 5,
	      pagination: {
	        el: '.swiper-pagination',
	        clickable: true,
	      },
	    });
	  </script>
	</body>
</html>
<?
if($_SERVER['REMOTE_ADDR']=="183.109.79.201"){
?>
<script type="text/javascript" src="https://openmain.pstatic.net/js/openmain.js"></script>
<div class="nv-openmain"  data-type="W2" ></div>

<?
}
@dbClose($dbc);
?>