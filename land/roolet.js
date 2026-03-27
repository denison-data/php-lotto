var $container;	// 컨테이너 태그
var $parent;	// 부모 태그
var $rlImage;	// 이미지 태그
var result="";		// 당첨 결과

var childImage = new Array();
var isExecute = false;

$(function(){
	$container = jQuery("#container").eq(0);
	$parent = $container.children("div");
	$rlImage = $parent.children("img");

	$parent.each(function(i){
		childImage[i] = jQuery(this).html();
	});

	$rlImage.each(function(i){
		var imgSrc = jQuery(this).attr("src");
	});

});

function roolet() {

	if(isExecute==false) {
		rooletExecute(6);
	} else {
		alert("이미 처리되었습니다.");
	}
}

function rooletExecute(num) {
	$parent.each(function(i){
		//jQuery(this).animate({"top":"-="+jQuery(this).height()*(num+1)},4000+(i*200));
		jQuery(this).delay((i+1)*10).animate({"top":"-="+jQuery(this).height()*(num+1)},4000+(i*200) );
		//jQuery(this).attr({"width":"100%"});
	});

	for(var j=0;j<num;j++) {
		$parent.each(function(i){
			jQuery(this).append(childImage[i]);

			if(j+1==num) {
/*
				var rand = rnd(1,fileName.length-1);
				jQuery(this).append("<img src='" + filePath[rand]+fileName[rand] + fileExt[rand]+"' />");
				result += fileName[rand] + ", ";
*/
				var rand = rnd(0,3);
				jQuery(this).append("<img src='"+ jQuery(this).children().eq(rand).attr("src") +"' width=25%/>");
				result += jQuery(this).children().eq(rand).attr("src")  + ", ";

			}
		});
	}
	/*
	jQuery("body").append("<br/>당첨결과 : ");
		result = result.substring(0, result.lastIndexOf(", "));
	jQuery("body").append( result );
	*/
	isExecute = true;
}


function rnd(startNumber,endNumber) {
	var randValue = Math.floor(Math.random()*endNumber+startNumber);
	return randValue;
}