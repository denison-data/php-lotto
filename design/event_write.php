<?php include('sub_side.php')?>


			
			<h1>이벤트</h1>
			<div>
				<div class="event_title">미스터 로또 이벤트 게시판 입니다.</div>
				<div class="notice_write_table">
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<col width="200px">
						<col width="976px">
						<tr>
							<th>글 제목</th>
							<td><input type="text"></td>
						</tr>
						<tr>
							<th>내용</th>
							<td><textarea></textarea></td>
						</tr>
						<tr>
							<th>파일첨부</th>
							<td><input type="file"></td>
						</tr>
						<tr>
							<th>기한</th>
							<td><input type="date"></td>
						</tr>
					</table>
					<div class="notice_button"><button class="board_button">글쓰기</button><button class="board_cancel_button">취소</button></div>
				</div>
			</div>
		</div>
		<!--sub contents end-->
	</div>
	<!--sub title end-->

<?php include('footer.php')?>