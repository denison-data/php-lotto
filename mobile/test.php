<!doctype html>
<html lang="ko">
	<head>
		<title>미스터로또씨</title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, target-densitydpi=device-dpi, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<!-- Include both jQuery and plugin libs: --> 
		<script type="text/javascript" src="js/jquery.js"></script> 
		<script type="text/javascript" src="js/jquery.omniwindow.js"></script> 
		<link rel="stylesheet" href="http://css.mrlotto.co.kr/mobile/jquery.omniwindow.css?dev=<?=date("YmdHis")?>">
		</head>
	
	<body>
		<!-- Container for an overlay: --> 
		
		<div><a href="" class="ex1">dddddd</a></div>
		
		<div class="ow-overlay ow-closed"></div> 
		
		<div class="modal ow-closed">
		  <h1>Close me!</h1>
		  <a class='close-button' href='#'>X</a>
		</div>
			
		<script>
			var $modal = $('div.modal').omniWindow();
			// ...
			
			$modal.trigger('show');
			// ...
			
			$('.close-button').click(function(e){
			  e.preventDefault();
			  $modal.trigger('hide');
			});
		</script>
	</body>
</html>