var mr_lotto = location.origin;

var naver_client_id = "KEWz31KwXWWepXcBUSWp";
var naver_client_secret = "Gxs2y8KuVv";
var naver_callback_url = mr_lotto + "/member/callback_naver_join.php";

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
function selectbox_hidden(layer_id) 
{ 
	
	
	var ly = layer_id;
	var ck = get_cookie("it_ck_pop_"+ly);
	if(ck=="done"){
		$("#pop"+ly).hide();
	}
	
} 
/*
function selectbox_hidden(layer_id) 
{ 
	var ly = eval(layer_id); 
	
	var ly_left  = ly.offsetLeft; 
	var ly_top    = ly.offsetTop; 
	var ly_right  = ly.offsetLeft + ly.offsetWidth; 
	var ly_bottom = ly.offsetTop + ly.offsetHeight; 

	var el; 
	console.log(ly);
	return false;
	for (i=0; i<document.forms.length; i++) { 

		for (k=0; k<document.forms[i].length; k++) { 
			el = document.forms[i].elements[k];    
			if (el.type == "select-one") { 
				var el_left = el_top = 0; 
				var obj = el; 
				if (obj.offsetParent) { 
					while (obj.offsetParent) { 
						el_left += obj.offsetLeft; 
						el_top  += obj.offsetTop; 
						obj = obj.offsetParent; 
					} 
				} 
				el_left  += el.clientLeft; 
				el_top    += el.clientTop; 
				el_right  = el_left + el.clientWidth; 
				el_bottom = el_top + el.clientHeight; 

				if ( (el_left >= ly_left && el_top >= ly_top && el_left <= ly_right && el_top <= ly_bottom) || 
					(el_right >= ly_left && el_right <= ly_right && el_top >= ly_top && el_top <= ly_bottom) || 
					(el_left >= ly_left && el_bottom >= ly_top && el_right <= ly_right && el_bottom <= ly_bottom) || 
					(el_left >= ly_left && el_left <= ly_right && el_bottom >= ly_top && el_bottom <= ly_bottom) ) 
					el.style.visibility = 'hidden'; 
			} 
		} 
	} 
} 
*/