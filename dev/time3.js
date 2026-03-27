const timeLimitValue = 60; // 1분 
var timeLimit = 3599; 
var min, sec;


// 1초 간격으로 함수 호출
var timerObj = setInterval(callTimer, 1000);

function callTimer(){

	min = parseInt(timeLimit/60);
	sec = parseInt(timeLimit%60);

	const displayTime = min.toString().padStart(2,"0") + " : " + sec.toString().padStart(2,"0");
	var reday = displayTime.split(':');
	var hos = reday[0].split('');
   var mins = reday[1].split('');
	 
		$('.date3').html(hos[0]);
		$('.date4').html(hos[1]);
		$('.date5').html(mins[1]);
		$('.date6').html(mins[2]);
	timeLimit -= 1;

	if(timeLimit < -1) {
		//alert("시간초과");

		clearInterval(timerObj);
		timeLimit = timeLimitValue;
 		return;
	}
}