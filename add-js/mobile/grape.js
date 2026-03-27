function dataAjax(){
	var lgurl = "/m/info/lotto.php";
	var form_data = {
		sseq : $("#sseq").val(),
		eseq : $("#eseq").val(),
		mode : "data_grape"
	};
	$.ajax({
		type	:	"POST",
		url		:	lgurl,
		data : form_data,
		async: false,
		dataType : "json",
		cache: false,
		success : function(data){
			
			grape_func(data);
		},
		error: function(request, status, error) {
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);

		}
	});
}
function grape_func(data){
	var tit = data['titles'];
	var per = data['percent'];
	var vdat = [];
	var dd = {};
	
	$.each(per, function(key, value){
		var dd = {"values":[per[key]],"text":[tit[key]]};
		vdat.push(dd);		
	});
	
	var dbs = vdat;
    var myConfig = {
      type: "pie",
      globals: {
        fontFamily: 'sans-serif'
      },
      legend: {
        verticalAlign: 'middle',
        toggleAction: 'remove',
        marginRight: 60,
        width: 100,
        alpha: 0.1,
        borderWidth: 0,
        highlightPlot: true,
        item: {
          fontColor: "#373a3c",
          fontSize: 12
        }
      },
      backgroundColor: "#fff",
      palette: ["#0099CC", "#007E33", "#FF8800", "#CC0000", "#33b5e5", "#00C851", "#ffbb33", "#ff4444"],
      plot: {
        refAngle: 270,
        detach: false,
        valueBox: {
          fontColor: "#fff"
        },
        highlightState: {
          borderWidth: 2,
          borderColor: "#000"
        }
      },
      tooltip: {
        placement: 'node:out',
        borderColor: "#373a3c",
        borderWidth: 2
      },
      labels: [{
        text: "",
        fontSize: 14,
        textAlign: "left",
        fontColor: "#373a3c"

      }],
		
      series : dbs

    };


    zingchart.render({
      id: 'grape',
      data: myConfig,
      height: 300,
      width: 450
    });


    zingchart.node_click = function(p) {

      var SHIFT_ACTIVE = p.ev.shiftKey;
      var sliceData = mySeries[p.plotindex];
      isOpen = (sliceData.hasOwnProperty('offset-r')) ? (sliceData['offset-r'] !== 0) : false;
      if (isOpen) {
        sliceData['offset-r'] = 0;
      } else {
        if (!SHIFT_ACTIVE) {
          for (var i = 0; i < mySeries.length; i++) {
            mySeries[i]['offset-r'] = 0;
          }
        }
        sliceData['offset-r'] = 20;
      }

      zingchart.exec('grape', 'setdata', {
        data: myConfig
      });
    }
}