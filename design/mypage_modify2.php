<?php include('mypage_side.php')?>


			
			<h1>나의 정보 수정</h1>
			<div>
				<div class="modify1">
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<col width="100px">
						<col width="300px">
						<tr>
							<td>이름</td>
							<td><input type="text" placeholder="저장된 이름 영역(입력 불가, 비활성화 시켜주세요)"></td>
						</tr>
						<tr>
							<td style="height:15px"></td>
						</tr>
						<tr>
							<td>아이디</td>
							<td><input type="text" placeholder="저장된 아이디 영역(입력 불가, 비활성화 시켜주세요)"></td>
						</tr>
						<tr>
							<td style="height:15px"></td>
						</tr>
						<tr>
							<td>비밀번호</td>
							<td><input type="password" placeholder="최소 8자 이상 / 영,숫,특수문자 포함해서 입력해 주세요"></td>
						</tr>
						<tr>
							<td>비밀번호 재확인</td>
							<td><input type="password" style="margin-top:-1px"></td>
						</tr>
						<tr>
							<td style="height:15px"></td>
						</tr>
						<tr>
							<td>휴대폰 번호</td>
							<td><input type="text" placeholder="저장된 휴대폰 번호"></td>
						</tr>
						<tr>
							<td style="height:15px"></td>
						</tr>
						<tr>
							<td>이메일 주소</td>
							<td>
								<input type="text" class="email">&nbsp;&nbsp;@ &nbsp;
								<select>
									<option>hanmail.net</option>
									<option>nate.com</option>
									<option>naver.com</option>
								</select>
							</td>
						</tr>
					</table>
					<a href="">수정 완료</a>
				</div>
			</div>
		</div>
		<!--sub contents end-->
	</div>
	<!--sub title end-->

<?php include('footer.php')?>