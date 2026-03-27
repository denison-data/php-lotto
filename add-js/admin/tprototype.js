var sort_reverse = 1;
var sort_table = new Array;

String.prototype.number_format=function(){
return this.replace(/(\d)(?=(?:\d{3})+(?!\d))/g,'$1,');
}

String.prototype.trim = function() {
  return this.replace(/^\s+|\s+$/g, "");
}

String.prototype.strip_tags = function(){
	return this.replace(/<\/?[^>]+>/gi, '');
}

String.prototype.only_number = function(){
	return this.replace(/[^0-9\.]/gi, '');
}

String.prototype.only_number_dot = function(){
	return this.replace(/[^0-9\.]/gi, '');
}

String.prototype.only_eng_number = function(){
	return this.replace(/[^0-9A-Za-z]/gi, '');
}


function $(_str) {
	return document.getElementById(_str)?document.getElementById(_str):null;
}

function realOffset(_e) {
	var T = 0, L = 0;
	do {
		T += _e.offsetTop  || 0;
		L += _e.offsetLeft || 0;
		_e = _e.offsetParent;
	} while (_e);
	return [L, T];
}

function toggleLayer(_obj) {
	if(typeof _obj == 'string') {
		_obj = $(_obj);
	}

	if (_obj.style.display == 'none') {
		_obj.style.display = 'block';
	} else {
		_obj.style.display = 'none';
	}

}

function openWin(url,width,height,scrollbar) {  
	var now = new Date();
	if (url.split('?').length > 1) {
		url += '&ts=' + now.getTime();
	} else {
		url += '?ts=' + now.getTime();
	}

	url += '&win_width=' + width + '&win_height=' + height;

  var owin = window.open(url, 'newpop'+width, 'width='+width+', height='+height+', fullscreen=no, scrollbars='+scrollbar+', status=yes');

  try { owin.focus(); }catch(e){}

  return owin;
}


function salert (_obj, _ment) {
	var div;
	if (!$("salert")) {
		div = document.createElement("DIV");
		div.id = 'salert';
		div.onclick = function () {this.style.display = 'none';}
		if ($("content")) {
			$("content").appendChild(div);
		} else {
			document.body.appendChild(div);
		}
	} else {
		div = $("salert");
	}

	div.innerHTML = _ment;
	div.style.display = 'block';
	if (_obj == null) {
		div.style.left = (parseInt((document.documentElement&&document.documentElement.scrollWidth)||document.body.scrollWidth) / 2) - (div.offsetWidth / 2);
		div.style.top = ((parseInt((document.documentElement&&document.documentElement.scrollHeight)||document.body.scrollHeight)) / 2) - (div.offsetHeight / 2) + (document.body.scrollTop);
		div.style.padding = 20 + 'px';
	} else {
		div.style.left = realOffset(_obj)[0] + 'px';
		div.style.top = realOffset(_obj)[1] + 'px';
	}
}

function optionLayerAlert (_ment, _replace_url) {
	var tranbg;
	var salert;

	if ($("tranbg")) {
		tranbg = $("tranbg");
	} else {
		tranbg = document.createElement("DIV");
		tranbg.id = 'tranbg';
		document.body.appendChild(tranbg);
	}

	if (_replace_url == 'reload') {
		tranbg.onclick = function () {location.replace(location.href);}
	} else {
		tranbg.onclick = function () {location.replace(_replace_url);}
	}

	selectDisable('none');
	tranbg.style.display = 'block';
	tranbg.style.height = document.documentElement.clientHeight + 'px';

	if (!$("salert")) {
		salert = document.createElement("DIV");
		salert.id = 'salert';
		document.body.appendChild(salert);
	} else {
		salert = $("salert");
	}

	if (_replace_url == 'reload') {
		salert.onclick = function () {location.replace(location.href);}
	} else {
		salert.onclick = function () {location.replace(_replace_url);}
	}

	salert.innerHTML = _ment;
	salert.style.display = 'block';
	salert.zIndex = -100;
	salert.style.left = (parseInt((document.documentElement&&document.documentElement.scrollWidth)||document.body.scrollWidth) / 2) - (salert.offsetWidth / 2) + 'px';
	salert.style.top = ((parseInt((document.documentElement&&document.documentElement.scrollHeight)||document.body.scrollHeight)) / 2) - (salert.offsetHeight / 2) + (document.body.scrollTop) + 'px';
	salert.style.padding = 20 + 'px';
}

function optionLayer(_type, _url, _width, _height) {
	var tranbg;
	var optionwin;


	if ($("tranbg")) {
		tranbg = $("tranbg");
		optionwin = $("optionwin");
	} else {
		tranbg = document.createElement("DIV");
		tranbg.id = 'tranbg';
		tranbg.onclick = function () {optionLayer('none');}
		document.body.appendChild(tranbg);



		optionwin = document.createElement("DIV");
		optionwin.id = 'optionwin';
		optionwin.innerHTML = "<iframe id='op_iframe'  frameborder='0' scrolling='no' ALLOWTRANSPARENCY='true'></iframe>";
		document.body.appendChild(optionwin);
	}

	tranbg.style.display = _type;
	tranbg.style.height = document.documentElement.scrollHeight + 'px';


	if (_type == 'block') {
		now = new Date();

		if (_url.split('?').length > 1) {
			_url += '&ts=' + now.getTime();
		} else {
			_url += '?ts=' + now.getTime();
		}

		_url += '&win_width=' + _width + '&win_height=' + _height;

		$("op_iframe").src = _url;
		$("op_iframe").style.width = _width + 'px';

		if (parseInt((document.documentElement&&document.documentElement.scrollHeight)||document.body.scrollHeight) < _height) {
			$("op_iframe").style.height = parseInt((document.documentElement&&document.documentElement.scrollHeight)||document.body.scrollHeight) + 'px';
		} else {
			$("op_iframe").style.height = _height + 'px';
		}

		$("optionwin").style.left = (parseInt((document.documentElement&&document.documentElement.scrollWidth)||document.body.scrollWidth) / 2) - (_width / 2) + 'px';

		if (((parseInt((document.documentElement&&document.documentElement.scrollHeight)||document.body.scrollHeight)) / 2) - (_height / 2) < 0) {
			$("optionwin").style.top = 0;
		} else {
			$("optionwin").style.top = parseInt(document.documentElement.clientHeight / 2) - parseInt(_height / 2) + document.documentElement.scrollTop + 'px';
		}

	
		selectDisable('none');
		$("optionwin").style.display = 'block';
		
	} else {
		selectDisable('inline');
		$("op_iframe").src = '';
		$("optionwin").style.display = 'none';
	}


}

function allCheck (_obj, _name) {
	for (var i = 0; i < document.getElementsByTagName("INPUT").length; i++) {
		if (document.getElementsByTagName("INPUT")[i].type == 'checkbox' && document.getElementsByTagName("INPUT")[i].name == _name) {
			document.getElementsByTagName("INPUT")[i].checked = _obj.checked;	
		}
	}
}

function selectDisable(_type) {
	try {
		if ($("content")) {
			var obj = $("content");
		} else if ($("pop_content")) {
			var obj = $("pop_content");
		} else if ($("menu_fr")) {
			var obj = $("menu_fr");
		} else {
			return;
		}

		var x = obj.document.getElementsByTagName("SELECT");
		for (i = 0; i < x.length; i++) { x[i].style.display = _type; }

		var x = obj.document.getElementsByTagName("OBJECT");
		for (i = 0; i < x.length; i++) { x[i].style.display = _type; }

	} catch(e) {}
}

function sortTable (_id, _num, _sort_number) {
	var DATA = new Array;
	var SORT = new Array;
	var i, j;

	displayLoading(true);
	
	if (!sort_table[_id + "_rows"]) {
		for (i = 0;;i++) {
			if (!$(_id + "_" + i + "_1")) {
				sort_table[_id + "_rows"] = i - 1;
				break;
			} 
		}
	}

	if (!sort_table[_id + "_cols"]) {
		for (i = 0;;i++) {
			if (!$(_id + "_1_" + i)) {
				sort_table[_id + "_cols"] = i - 1;
				break;
			} 
		}
	}

	for (i = 0; i <= sort_table[_id + "_rows"]; i++) {
		DATA[i] = new Array;
		for (j = 0; j <= sort_table[_id + "_cols"]; j++) {
			DATA[i][j] = $(_id + "_" + i + "_" + j).innerHTML;

			if (j == _num) {
				SORT[i] = $(_id + "_" + i + "_" + j).innerHTML + "||" + i;
			}
		}
	}

	if (_sort_number) {
		SORT.sort(sortNumber);
	} else {
		SORT.sort(sortStringIgnoreCase);
	}

	if (sort_reverse) {
		SORT.reverse();
		sort_reverse = 0;
	} else {
		sort_reverse = 1;
	}

	for (i = 0; i <= sort_table[_id + "_rows"]; i++) {
		var key = SORT[i].split("||")[1];

		for (j = 0; j <= sort_table[_id + "_cols"]; j++) {
			$(_id + "_" + i + "_" + j).innerHTML = DATA[key][j];

			//alert(DATA[key][j]);
			//if(j==20){
			//break;
			//}

		}
	}

	displayLoading(false);
}


function sortStringIgnoreCase(a, b) {
  if (a.toLowerCase() < b.toLowerCase()) return -1;
  if (b.toLowerCase() < a.toLowerCase()) return 1;
  return 0;
}

function sortNumber(a, b) {
	var t1= parseFloat (a.split('||')[0].only_number_dot());
	var t2= parseFloat (b.split('||')[0].only_number_dot());

	return t1-t2;
}


