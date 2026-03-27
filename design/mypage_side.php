<?php include('header2.php')?>

<style>
	.sub_wrap {overflow: hidden}
	.side_banner {width:205px ;float: left}
	.side_banner h1 {font-size:26px;padding-bottom:20px; font-weight:400; display:block}
	.sub_contents {width:1055px; float: left;margin-left:20px}
	.sub_contents h1 {font-size:26px;padding-bottom:20px; font-weight:400; display:block}
	.mypage_side {border:4px solid #d9d9d9}
	.mypage_side ul {padding:20px 30px;border-bottom:1px solid #d9d9d9}
	.mypage_side ul h4 a {line-height:28px;font-weight:500; }
	.mypage_side ul li {padding-left:10px;line-height:28px}
	.mypage_side ul li a:hover {font-weight:500; color:#2a539a}
	.mypage_side img {vertical-align: middle;padding-bottom:4px}
	
	/* mix list */
	.sub_contents .mypage_table {border-top:2px solid #111;}
	.sub_contents .mypage_table th {font-size:13px; font-weight:600; line-height: 44px;}
	.sub_contents .mypage_table tr th,.sub_contents .mypage_table tr td {border-bottom:1px solid #d9d9d9;text-align:center;}
	.sub_contents .mypage_table tr td {padding:10px 0}
	.sub_contents .mypage_table tr td img {vertical-align: middle;margin:0 5px}
	.sub_contents .mypage_table tr td:nth-child(2) {text-align:center; }
	.sub_contents .mypage_table tr td:last-child {font-weight:500}
	
	/*.sub_contents .mypage_table tr td:nth-child(2):after {content:url(http://image.mrlotto.co.kr/new.jpg);position: relative;width:100px; height:100px;top:3px;left:15px;}*/
	
	.sub_contents .mypage_table .paging ul {overflow: hidden;}
	.sub_contents .mypage_table .paging a {color: inherit;text-decoration: none;float:left;border:1px solid #d9d9d9;margin-left:-1px;width:30px;height:30px;text-align: center}
	.sub_contents .mypage_table .paging {width:205px;margin:0 auto;margin-top:30px}
	.sub_contents .mypage_table .paging li:first-child a {border-radius: 4px 0px 0px 4px;margin-left:0;color:#d9d9d9}
	.sub_contents .mypage_table .paging li:last-child a {border-radius: 0px 4px 4px 0px;color:#d9d9d9}
	.sub_contents .mypage_table .paging a:hover {color:#2a539a !important;font-weight:500; border-bottom:2px solid #2a539a}
	
	.mix_contents {border:4px solid #d9d9d9;margin-bottom:20px; display:flex; }
	.mix_contents ul {padding:35px 70px}
	.mix_contents ul:first-child {width:694px;flex:3;border-right:1px solid #d9d9d9;}
	.mix_contents ul:first-child li table tr:first-child td:nth-child(4) span, .mix_contents ul:first-child li table tr:first-child td:nth-child(5) span {font-size:20px;font-weight:500; background-color:#f8f8f8;border-radius: 100px;padding:10px}
	.mix_contents ul:first-child li table tr:last-child td:first-child span {font-size:28px; color:#2a539a;font-weight:400;padding-right:5px;}
	.mix_contents ul:first-child li table tr:last-child td span {font-weight:400;padding-right:5px;}
	.mix_contents ul:first-child li table tr:last-child td {font-size:18px}
	
	.mix_contents ul:last-child {width:480px; background-color:#f8f8f8;flex:2}
	.mix_contents ul li table tr td {vertical-align: middle; text-align: center}
	.mix_contents ul:last-child li table tr:first-child td:last-child span {letter-spacing: -1px !important;padding-right:0 !important}
	.mix_contents ul:last-child li table tr td {font-size:20px;line-height:43px;}
	.mix_contents ul:last-child li table tr td:first-child {text-align:left; font-weight:400; font-size:18px}
	.mix_contents ul:last-child li table tr td:last-child {text-align:right}
	.mix_contents ul:last-child li table tr td:last-child span {font-weight:500; padding-right:10px;letter-spacing: 0}
	.mix_contents ul:last-child li table tr:last-child td span {color:#2a539a; letter-spacing: 0}
	
	.mix_contents ul li table tr td {}
	
	.class1 img {width:35px; height:40px}
	.class2 img, .class3 img {width:35px; height:39px}


	/* coupon list */
	#coupon_list tr td:nth-child(2) {font-weight:400 !important;}
	#coupon_list tr td:nth-child(4) {letter-spacing: 0}
	#coupon_list a {border-radius: 4px;font-size:13px;color:#fff;background: rgb(42,83,154);background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);font-weight:400;padding:7px 24px;}
	#coupon_list .coupon_date {color:#2a539a; font-weight:400}
	#coupon_list tr td:nth-child(3) span {padding-left:3px;color:#999 !important; font-size:15px; letter-spacing: 0}
	#coupon_list .coupon_end {background-color:#f8f8f8; color:#aaa;}
	#coupon_list .coupon_end td:last-child a {background:#d3d3d3 !important; color:#888; font-weight:400; padding:7px 12px}
	
	.coupon_tab, .mypage_tab {margin-bottom:10px}
	.coupon_tab a, .mypage_tab a {width:193px; height:50px;cursor: pointer;text-align:center;border-radius: 4px;color:#111;font-size:18px;font-weight: 400;border:1px solid #d9d9d9;background-color:#fff}
	.coupon_tab a.on {width:193px; height:50px;cursor: pointer;text-align:center;background: rgb(42,83,154);
background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);border-radius: 4px;color:#fff;font-size:18px;font-weight: 330; border:none;padding-left:15px;position: relative}
	.coupon_tab a.on:before {position: absolute;content: '';background:url('http://image.mrlotto.co.kr/arrow.png') no-repeat;top:21px;left:35px; height:30px;width:60px;}
	.coupon_tab a.on2 {width:193px; height:50px;cursor: pointer;text-align:center;background: rgb(42,83,154);
background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);border-radius: 4px;color:#fff;font-size:18px;font-weight: 300; border:none;padding-left:15px;position: relative}
	.coupon_tab a.on2:before {position: absolute;content: '';background:url('http://image.mrlotto.co.kr/arrow.png') no-repeat;top:21px;left:53px; height:30px;width:60px;}
	
	
	.coupon_tab a, .mypage_tab a {display: inline-block;width:193px; height:50px;cursor: pointer;text-align:center;border-radius: 4px;color:#111;font-size:18px;font-weight: 400;border:1px solid #d9d9d9;background-color:#fff;padding-top:12px}
	.coupon_tab a.on {display: inline-block;width:193px; height:50px;cursor: pointer;text-align:center;background: rgb(42,83,154);
background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);border-radius: 4px;color:#fff;font-size:18px;font-weight: 300; border:1px solid #2a5aad;padding-left:15px;position: relative}
	.coupon_tab a.on:before {position: absolute;content: '';background:url('http://image.mrlotto.co.kr/arrow.png') no-repeat;top:21px;left:35px; height:30px;width:60px;}
	.coupon_tab a.on2 {width:193px; height:50px;cursor: pointer;text-align:center;background: rgb(42,83,154);
background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);border-radius: 4px;color:#fff;font-size:18px;font-weight: 300; border:1px solid #2a5aad;padding-left:15px;position: relative;}
	.coupon_tab a.on2:before {position: absolute;content: '';background:url('http://image.mrlotto.co.kr/arrow.png') no-repeat;top:21px;left:53px; height:30px;width:60px;}
	
	
	.mypage_tab a.on {display: inline-block;width:193px; height:50px;cursor: pointer;text-align:center;background: rgb(42,83,154);
background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);border-radius: 4px;color:#fff;font-size:18px;font-weight: 300; border:1px solid #2a5aad;padding-left:15px;position: relative}
	.mypage_tab a.on:before {position: absolute;content: '';background:url('http://image.mrlotto.co.kr/arrow.png') no-repeat;top:21px;left:53px; height:30px;width:60px;}
	.mypage_tab a.on2 {width:193px; height:50px;cursor: pointer;text-align:center;background: rgb(42,83,154);
background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);border-radius: 4px;color:#fff;font-size:18px;font-weight: 300; border:1px solid #2a5aad;padding-left:15px;position: relative;}
	.mypage_tab a.on2:before {position: absolute;content: '';background:url('http://image.mrlotto.co.kr/arrow.png') no-repeat;top:21px;left:53px; height:30px;width:60px;}
	
	
	.coupon_register {background-color: #edeef3;padding:110px 265px 100px 265px}
	.coupon_register input {width:100%;height:46px; padding-left:10px;font-size:13px;border-radius: 4px; border:none}
	.coupon_register a {margin:0 auto;margin-top:30px;display:block;text-align:center;background: rgb(42,83,154);
background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);width:246px; height:60px;border-radius: 4px;color:#fff;font-size:24px;cursor: pointer;border:none;padding-top:16px}


	/* servie list */
	#service_list tr td:nth-child(4) {;background-color: #f8f8f8; font-weight:300; letter-spacing: 0}
	#service_list tr td:first-child {letter-spacing: 0}
	#service_list tr td span {color:#2a539a !important; letter-spacing: 0}
	#service_list tr td:nth-child(3) {letter-spacing: 0;}

	/* servie2 list */
	#service_list2 tr td:first-child, #service_list2 tr td:last-child, #service_list2 tr td span, #service_list2 tr td:nth-child(3) {font-weight:300; letter-spacing: 0}
	
	
	#service_list td:nth-child(5) a {border-radius: 4px;font-size:13px;color:#fff;background: rgb(42,83,154);background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);font-weight:400;padding:7px 24px;}
	
	
	/* modify2 */
	.modify1 {background-color: #f8f8f8;padding:55px 250px 100px 250px; }
	.modify1 table tr td:first-child {font-weight:400}
	.modify1 input {width:100%; height:46px; border:1px solid #d9d9d9;padding-left:10px;font-size:13px}
	.modify1 a {margin:0 auto;margin-top:50px;display:block;text-align:center;background: rgb(42,83,154);width:193px;height:50px;
background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);padding:12px 20px;border-radius: 4px;color:#fff;font-size:18px;cursor: pointer;border:1px solid #2a539a}
	.modify1 input.email {width:160px; }
	.modify1 select {width:193px; height:46px;border:1px solid #d9d9d9;padding-left:10px;font-size:13px;background-color:#fff; border-radius: 0}
	
	select{
	-moz-appearance:none; /* Firefox */ 
	-webkit-appearance:none; /* Safari and Chrome */ 
	appearance:none;
	background:url('http://image.mrlotto.co.kr/select_icon.png') 93% 50% no-repeat;
	}
	select::-ms-expand { display:none; }
	
	
	/* modify1 */
	.modify2 {padding:90px 130px 100px 130px; }
	.modify2 input {width:382px; height:46px;border-radius: 4px;border: none;padding-left:10px;font-size:15px;line-height:44px}
	.modify2 table {background-color:#f8f8f8; padding:40px 80px;}
	.modify2 .txt {font-size:20px; text-align: center; margin-bottom:20px}
	.modify2 table tr td:first-child {font-weight:400;}
	.modify2 table tr td:last-child a {font-weight:400;background: rgb(42,83,154);background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);color:#fff;border-radius: 4px; font-size:15px;margin-left:5px;padding:10px 35px; vertical-align: top;border:1px solid #2a539a}
	
	
	/* withdraw1 */
	.withdraw1 {padding:90px 130px 100px 130px; }
	.withdraw1 input {width:382px; height:46px;border-radius: 4px;border: none;padding-left:10px;font-size:15px;line-height:44px}
	.withdraw1 table {background-color:#f8f8f8; padding:40px 80px;}
	.withdraw1 .txt {font-size:20px; text-align: center; margin-bottom:20px}
	.withdraw1 table tr td:first-child {font-weight:400;}
	.withdraw1 table tr td:last-child a {font-weight:400;background: rgb(42,83,154);background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%); color:#fff; border-radius: 4px; font-size:15px;margin-left:5px;padding:10px 35px; vertical-align: top;border:1px solid #2a539a}
	
	/* withdraw2 */
	.withdraw2 {padding:20px 150px 100px 150px; }
	.withdraw2 table {margin:0 auto;text-align:center; padding:40px 100px; }
	.withdraw2 table tr td:first-child {font-weight:400}
	.withdraw2 table tr:last-child td:last-child {font-weight:400; padding-left:10px;}
	.withdraw2 input {width:100%; height:46px; border:1px solid #d9d9d9;padding-left:10px;font-size:13px}
	.withdraw2 a {margin:0 auto;margin-top:50px;display:block;text-align:center;background: rgb(42,83,154);
background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);width:193px; height:50px;border-radius: 4px;color:#fff;font-size:18px;padding:12px 35px; vertical-align: top;border:1px solid #2a539a}
	.withdraw2 input.email {width:160px; }
	.withdraw2 select {width:193px; height:46px;border:1px solid #d9d9d9;padding-left:10px;font-size:13px;background-color:#fff; border-radius: 0}
	.withdraw_txt {text-align:center; font-size:24px;font-weight:500;color:#2a539a;border:4px solid #d9d9d9;padding:32px 0}
	.withdraw_txt div {text-align:center; font-size:15px; color:#111;padding-left:5px;padding-top:10px;line-height:150%}
	.withdraw_txt div a {border:none;background:#8d8d8d !important; padding:6px 30px;width:300px;height:35px;font-size:15px;margin-top:15px}
	
	.mypage1_select {margin-bottom:10px}
	.mypage1_select select {width:100px; height:24px;border:1px solid #d9d9d9;padding-left:10px;font-size:13px;background-color:#fff; border-radius: 0; color:#111;}
	
	.choice_contents {width:510px;border:4px solid #2a539a;box-sizing: border-box; float: left; }
	.choice_contents .choice_tit {background-color: #2a539a; color:#fff; font-size:20px;text-align: center;line-height:63px}
	.choice_contents .choice_number a {border:1px solid #d9d9d9;display: inline-block;width:40px; height:40px; font-weight:500;font-size:20px; text-align: center;line-height: 36px;border-radius: 4px}
	.choice_contents .choice_number a:hover {color:#2a539a;border:1px solid #2a539a;background-color:#edeef3}
	.choice_contents .choice_number ul {width:475px; overflow: hidden;margin:0 auto;margin-bottom:14px}
	.choice_contents .choice_number ul:first-child {margin-top:50px}
	.choice_contents .choice_number ul:last-child {margin-bottom:50px}
	.choice_contents .choice_number ul li {float: left;margin-right:14px}
	.choice_contents .choice_number ul li:last-child {margin-right:0px}
	
	.choice_contents2 select {line-height:50px;height:52px;width:170px;font-size:16px;padding-left:10px;margin-left:15px;border:1px solid #d9d9d9}
	.choice_contents2 .choice_ball {float:left;background:url('http://image.mrlotto.co.kr/choice_bg1.jpg');height:360px; width:530px;margin-left:15px;margin-top:15px; position: relative}
	.choice_contents2 .choice_ball .choice_ball_1 {position: absolute;top:190px; left:71px;}
	.choice_contents2 .choice_ball .choice_ball_2 {position: absolute;top:120px; left:227px;}
	.choice_contents2 .choice_ball .choice_ball_3 {position: absolute;top:190px; right:77px;}
	
	.choice_button {text-align:center;margin-top:50px}
	.choice_button a {display:inline-block;margin-left:10px;font-weight:300;color:#fff; cursor: pointer; font-size:18px;background: rgb(42,83,154);background: linear-gradient(0deg, rgba(42,83,154,1) 0%, rgba(41,104,213,1) 100%);border:none; border-radius: 4px;width:193px; height:50px;padding:13px 35px}
	
	.choice_title {background-color:#f8f8f8;line-height:28px;padding:20px 30px;margin-bottom:30px;text-align:justify; }
	
</style>


	
	<!--sub title start-->
	<div class="sub_wrap">
		<div class="side_banner">
			<h1>마이페이지</h1>
			<div class="mypage_side">
				<ul>
					<h4><a href="/design/mypage_mix.php">조합 내역&nbsp;&nbsp;<img src="http://image.mrlotto.co.kr/more.jpg"></a></h4>
					<li><a href="/design/mypage_mix.php">내 조합 내역</a></li>
					<li><a href="/design/number.php">초이스 넘버링</a></li>
				</ul>
				<ul>
					<h4><a href="/design/mypage_coupon1.php">쿠폰&nbsp;&nbsp;<img src="http://image.mrlotto.co.kr/more.jpg"></a></h4>
					<li><a href="/design/mypage_coupon1.php">내 쿠폰 보관함</a></li>
					<li><a href="/design/mypage_coupon2.php">쿠폰 등록</a></li>
				</ul>
				<ul>
					<h4><a href="/design/mypage_service1.php">서비스 설정&nbsp;&nbsp;<img src="http://image.mrlotto.co.kr/more.jpg"></a></h4>
					<li><a href="/design/mypage_service1.php">결제 내역</a></li>
					<li><a href="/design/mypage_service2.php">환불 내역</a></li>
				</ul>
				<ul>
					<h4><a href="/design/mypage_modify1.php">회원 정보 관리&nbsp;&nbsp;<img src="http://image.mrlotto.co.kr/more.jpg"></a></h4>
					<li><a href="/design/mypage_modify1.php">나의 정보 수정</a></li>
					<li><a href="/design/mypage_withdraw1.php">탈퇴 관리</a></li>
				</ul>
			</div>
		</div>
		<div class="sub_contents">
		
		
		