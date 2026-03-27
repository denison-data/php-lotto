function od_date(sdate,edate){
	$( "#"+sdate ).datepicker({
		buttonImageOnly : true,             // 버튼 이미지만 표시할지 여부
		dateFormat: "yymmdd",             // 날짜의 형식
		changeMonth: true,                  // 월을 이동하기 위한 선택상자 표시여부
		//minDate: 0,                       // 선택할수있는 최소날짜, ( 0 : 오늘 이전 날짜 선택 불가)
		onClose: function( selectedDate ) {
			// 시작일(fromDate) datepicker가 닫힐때
			// 종료일(toDate)의 선택할수있는 최소 날짜(minDate)를 선택한 시작일로 지정
			$("#"+edate).datepicker( "option", "minDate", selectedDate );
		}
	});
	$("#"+edate).datepicker({
		buttonImageOnly : true,
		dateFormat: "yymmdd",
		changeMonth: true,
		//minDate: 0, // 오늘 이전 날짜 선택 불가
		onClose: function( selectedDate ) {
			// 종료일(toDate) datepicker가 닫힐때
			// 시작일(fromDate)의 선택할수있는 최대 날짜(maxDate)를 선택한 종료일로 지정
			$("#"+sdate).datepicker( "option", "maxDate",selectedDate);
		}
	});
	$(".ui-datepicker-trigger").attr("title","");
	$(".ui-datepicker-trigger").hide();

}
function prod_data(vmode){
	var dataUrl = "/inc/data/common.php";
	var dataType = {
		mode : "option_data"
	};
	var rData = "";	
	$.ajax({
		type	:	"POST",
		url		:	dataUrl,
		data	:	dataType,
		async: false,
		dataType : "json",
		cache: false,
		success : function(data){

			if(vmode=="option_list"){
				for(var v=0; v<data['data'].length;v++){
					rData += "<option value='"+data['data'][v].Code+"'>"+data['data'][v].Good_name+" "+data['data'][v].Title1+"</option>\n";
				}
			}

			

		},
		error: function(request, status, error) {
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);

		},
		complete : function() {
			
		}
	});
	return rData;
}

function move(ref)
{
    window.location=ref;
}
function CheckForm(formName) {
	var returnChk = true;
	var chkResult = true;
	var defaultAlertText = '필수 입력입니다.';
	var f=document.form1;
	
	if(formName == undefined) {
		var obj = $('input, select, textarea');
	} else {
		var obj = $('form[name='+formName+'] input, form[name='+formName+'] select, form[name='+formName+'] textarea, form[name='+formName+'] span');
	}
	
	$(obj).each(function() {

		var alt = $(this).attr('alt'); //alt 로 경고창 만듬
		
		switch($(this).attr('id')){		
			case 'im' :
				if(returnChk === false || chkResult === false) { return false; }
				
				if(trim($(this).val()) == '') {

					if(alt == '') {
						alert(defaultAlertText);
					} else {
						alert(alt);
					}									
					$(this).focus();			
					
						
					returnChk = false;
					return false;
				}
				
				if(chkResult === false) {
					$(this).focus();
				}		
			break;	
			
		}	
	});
	
	if(returnChk === true && chkResult === true) {
		
		$("#form1").submit();
	} else {

		return false;
	}
}
function trim(tmpStr)
{
	   var atChar;
	  
	   if (tmpStr.length > 0)
	   atChar = tmpStr.charAt(0);
	   while (isSpace(atChar))
	   {
			tmpStr = tmpStr.substring(1, tmpStr.length);
			atChar = tmpStr.charAt(0);
	   }
	   if (tmpStr.length > 0)
	   atChar = tmpStr.charAt(tmpStr.length-1);
	   while (isSpace(atChar))
	   {
			tmpStr = tmpStr.substring(0,( tmpStr.length-1));
			atChar = tmpStr.charAt(tmpStr.length-1);
	   }
	   return tmpStr;
}
function isSpace(inChar)
{
  	return (inChar == ' ' || inChar == '\t' || inChar == '\n');
}