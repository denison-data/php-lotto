<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head2.html');
include(BASE_DIR.'inc/html/mypage.html');

login_check();

login_level("p","프리미엄 회원 서비스입니다","/info/sub.php?dep=2");
$max_num = 3;

?>
<style>
.num_plus { color:#2a539a;border:1px solid #2a539a;background-color:#edeef3	}
</style>
<script type="text/javascript">
var _SELECT = {"fixnum":[], "expert":[]};

var arrMaxBall = {"fixnum":<?=$max_num?>, "expert":<?=$max_num?>};

$(document).ready(function(){
	init_setSelected();
	$("#save_type").change(function(){
		//console.log('변경');
		_SELECT = {"fixnum":[], "expert":[]};

		$("img[id^='num']").each(function(i,el) {
			$("#"+$(this).attr("id")).attr("src","http://image.mrlotto.co.kr/choice_ball.jpg");
		});
		$(".choice_number > ul > li > a").removeClass("num_plus");
	});
	$("#save").on("click",function(){
		var sel_type = $("#save_type").val();
		
		var param = _SELECT;
		var gurl = "/member/chose_process.php";
		var form_data = {
			sel_type : sel_type,
			datas  : param,
			mcode : "<?=$_SESSION[code]?>",
			mode : "chose"
		};
		$.ajax({
			type	:	"POST",
			url		:	gurl,
			data : form_data,
			dataType : "json",
			async: true,
			cache: false,
			success : function(data){
				if(data['status']=="0"){
					alert('번호가 셋팅되었습니다');
					top.location.href="./number.php";
				}
				//console.log(data);
			},
			error: function(request, status, error) {
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
		return false;
		
	});
});
function init_setSelected(){
	var gurl = "/member/chose_process.php";
	var form_data = {
		mcode : "<?=$_SESSION[code]?>",
		mode : "chose_list"
	};
	$.ajax({
		type	:	"POST",
		url		:	gurl,
		data : form_data,
		dataType : "json",
		async: true,
		cache: false,
		success : function(data){
			if(data['status']=="0"){
				if(data['dat']['fixnum']){
					_SELECT["fixnum"] = data['dat']['fixnum'].split(",");
					$("#save_type").val("fixnum").attr("selected","selected");
					if(_SELECT["fixnum"].length>0){
						for(var n=0;n<_SELECT["fixnum"].length;n++){
							$("#c_"+_SELECT["fixnum"][n]).addClass("num_plus");							
						}
					}
					
					setSelected("fixnum");
				} else if(data['dat']['except']) {
					_SELECT["expert"] = data['dat']['except'].split(",");
					$("#save_type").val("expert").attr("selected","selected");
					if(_SELECT["expert"].length>0){
						for(var n=0;n<_SELECT["expert"].length;n++){

							$("#c_"+_SELECT["expert"][n]).addClass("num_plus");							
						}
					}	
					setSelected("expert");
				}
			}
			//console.log(data['dat']);
		},
		error: function(request, status, error) {
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
	return false;
}
function chose(num){
	
	var pmode =$("#save_type").val();
	var ball = parseInt(num);
	if($("#c_"+num).hasClass("num_plus")==true){
		
		$("#c_"+num).removeClass("num_plus");
		for(var i=0; i< _SELECT[pmode].length;i++){
			if(_SELECT[pmode][i] == ball){
				_SELECT[pmode].splice(i, 1);
				break;
			}
		}
		//console.log(cnum);
	} else if($("#c_"+num).hasClass("num_plus")==false) {		
		$("#c_"+num).addClass("num_plus");
		if(_SELECT[pmode].length >= arrMaxBall[pmode]){
			$("#c_"+num).removeClass("num_plus");
			$("#c_"+num).css({"background-color":"white","border":"1px solid #d9d9d9","display":"inline-block","width":"40px","font-weight":"500","font-size":"20px","text-align":"center","line-height":"36px","border-radius":"4px"});
			return false;
		}
		_SELECT[pmode][_SELECT[pmode].length]=ball;	
		
	}
	//console.log(_SELECT[pmode]);
	setSelected(pmode);
	
}
function setSelected(_pmode){
	var _html = "";
	/*초기화*/
	$("img[id^='num']").each(function(i,el) {
		$("#"+$(this).attr("id")).attr("src","http://image.mrlotto.co.kr/choice_ball.jpg");
	});
	if(_SELECT[_pmode].length > 0){
		//_SELECT[_pmode].sort(function(a, b){return a-b});//sort
		for(var i = 0; i < _SELECT[_pmode].length; i++){			
			if(_SELECT[_pmode][i]){
				$("#num"+i).attr("src","http://image.mrlotto.co.kr/ball/lotto_ball_"+_SELECT[_pmode][i]+"_1.jpg");
			} else {
				$("#num"+i).attr("src","http://image.mrlotto.co.kr/choice_ball.jpg");
			
			}
		}
	} 
}
</script>
		<h1>초이스 넘버링</h1>
		<div style="overflow: hidden">
			<div class="choice_title">지정 혹은 제외하길 원하는 숫자를 최대 3개까지 선택 가능합니다. 선택 이후에는 시스템에 반영되어 조합이 발송됩니다.<br>( * 주의사항 : 번호 지정 시 수요일까지 저장하셔야 해당 주 조합 서비스에 반영됩니다. 수요일 이후 선택 시는 해당 주 조합에는 반영되지 않으며 그 다음주 조합 서비스부터 반영됩니다. )</div>
			<div class="choice_contents">
				<ul>
					<li>
						<div class="choice_tit">필터링 번호 3가지를 선택해 주세요</div>
						<div class="choice_number">
							<ul>
								<?
								for($g1=1;$g1<=9;$g1++){
								?>
								<li><a href="javascript:;" onclick="javascript:chose('<?=$g1?>');"  id="c_<?=$g1?>"><?=$g1?></a></li>
								<?
								}
								?>
							</ul>
							<ul>
								<?
								for($g2=10;$g2<=18;$g2++){
								?>
								<li><a href="javascript:;" onclick="javascript:chose('<?=$g2?>');"id="c_<?=$g2?>"><?=$g2?></a></li>
								<?
								}
								?>								
							</ul>
							<ul>
								<?
								for($g3=19;$g3<=27;$g3++){
								?>
								<li><a href="javascript:;" onclick="javascript:chose('<?=$g3?>');" id="c_<?=$g3?>"><?=$g3?></a></li>
								<?
								}
								?>
							</ul>
							<ul>
								<?
								for($g4=28;$g4<=36;$g4++){
								?>
								<li><a href="javascript:;" onclick="javascript:chose('<?=$g4?>');" id="c_<?=$g4?>"><?=$g4?></a></li>
								<?
								}
								?>
							</ul>
							<ul>
								<?
								for($g5=37;$g5<=45;$g5++){
								?>
								<li><a href="javascript:;" onclick="javascript:chose('<?=$g5?>');" id="c_<?=$g5?>"><?=$g5?></a></li>
								<?
								}
								?>
							</ul>
						</div>
					</li>
				</ul>
			</div>
			<div class="choice_contents2">
				<ul>
					<li>
						<select name="save_type" id="save_type">
							<option value="fixnum">지정할 번호</option>
							<option value="expert">제외할 번호</option>
						</select>
						<div class="choice_ball">
							<div class="choice_ball_1"><img src="http://image.mrlotto.co.kr/choice_ball.jpg" id="num0"></div>
							<div class="choice_ball_2"><img src="http://image.mrlotto.co.kr/choice_ball.jpg" id="num1"></div>
							<div class="choice_ball_3"><img src="http://image.mrlotto.co.kr/choice_ball.jpg" id="num2"></div>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="choice_button"><a href="javascript:;" id="save">저장</a></div>
	</div>
	<!--sub contents end-->
</div>
<!--sub title end-->


<?
include(BASE_DIR.'inc/html/foot.html');
?>