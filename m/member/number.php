<?
include($_SERVER[DOCUMENT_ROOT].'inc/func/common.php');
include(BASE_DIR.'inc/html/head_m.html');
include(BASE_DIR.'inc/html/head_m_member.html');
login_check_m();

login_level("p");
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
			$("#"+$(this).attr("id")).attr("src","http://<?=$img_url?>/choice_ball.jpg");
		});
		$(".choice_number > ul > li > a").removeClass("num_plus");
	});
	$("#save").on("click",function(){
		var sel_type = $("#save_type").val();
		
		var param = _SELECT;
		var gurl = "<?=$mobile_dir?>/member/chose_process.php";
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
	var gurl = "<?=$mobile_dir?>/member/chose_process.php";
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
			//$("#c_"+num).css({"background-color":"white","border":"1px solid #d9d9d9","display":"inline-block","width":"40px","font-weight":"500","font-size":"20px","text-align":"center","line-height":"36px","border-radius":"4px"});
			return false;
		}
		_SELECT[pmode][_SELECT[pmode].length]=ball;	
		
	}
	setSelected(pmode);
}
function setSelected(_pmode){
	var _html = "";
	/*초기화*/
	$("img[id^='num']").each(function(i,el) {
		$("#"+$(this).attr("id")).attr("src","http://<?=$img_url?>/choice_ball.jpg");
	});
	if(_SELECT[_pmode].length > 0){
		//_SELECT[_pmode].sort(function(a, b){return a-b});//sort
		for(var i = 0; i < _SELECT[_pmode].length; i++){			
			if(_SELECT[_pmode][i]){
				$("#num"+i).attr("src","http://<?=$img_url?>/mobile/ball_"+_SELECT[_pmode][i]+".png");
			} else {
				$("#num"+i).attr("src","http://<?=$img_url?>/choice_ball.jpg");
			
			}
		}
	} 
}
</script>
<div class="contents sub">
	<h2><img src="http://<?=$img_url?>/mobile/mix_tit.jpg"></h2>
	<div class="sub_menu_button">
		<a href="mypage.php">내 조합 내역</a><a href="" class="on">초이스 넘버링</a>
	</div>
	<p style="margin-top:4%">지정 혹은 제외하길 원하는 숫자를 최대 3개까지 선택하여 조합 서비스에 반영합니다. 지정 숫자와 제외 숫자는 동시에 이용 불가능합니다.<br>* 주의사항 : 번호 지정 시 꼭! 저장 버튼을 눌러야 서비스가 적용되며 화요일까지 저장하셔야 해당 주 조합 서비스에 반영됩니다. 수요일 이후 선택 시는 해당 주 조합에는 반영되지 않으며 그 다음 주 조합 서비스부터 반영됩니다.</p>
</div>
<div class="contents2 mypage1_sel">
	<select name="save_type" id="save_type">
		<option value="fixnum">지정 할 번호</option>
		<option value="expert">제외 할 번호</option>
	</select>
</div>
	<div class="contents choice_box">
		<div class="choice_box1">
			<div><p><br><span>1번</span> 선택</p><img src="http://<?=$img_url?>/mobile/lottoball.jpg" id="num0"></div>
			<div><p><span>2번</span> 선택</p><img src="http://<?=$img_url?>/mobile/lottoball.jpg" id="num1"></div>
			<div><p><br><span>3번</span> 선택</p><img src="http://<?=$img_url?>/mobile/lottoball.jpg" id="num2"></div>
		</div>
	</div>
	<div class="contents">
		<div class="choice_box_tit">필터링 번호 3가지를 선택해 주세요.</div>
		<div class="choice_box2">
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
		<div><a href="javascript:;" id="save" class="blue_bt search_bt">저장</a></div>
	</div>

<?
include(BASE_DIR.'inc/html/foot_m.html');
?>
