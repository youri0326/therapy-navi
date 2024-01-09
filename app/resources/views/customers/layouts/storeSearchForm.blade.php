<form action="{{route('customer.storeSearch')}}" method="GET">
		<table class="input-table">
			<tr>
				<th>地域※必須</th>
				<td>
					<input type="text" size="25" name="address" >
				</td>
			</tr>
			<tr>
				<th>駅名</th>
				<td>
					<input type="text" size="25" name="station" >
				</td>
			</tr>
			<tr>
				<th>店名</th>
				<td>
					<input type="password" size="25" name="storename" >
				</td>
			</tr>
			<tr>
				<th>その他</th>
				<td>
					<input type="password" size="25" name="comment">
				</td>
			</tr>
		</table>
		<input type="submit" value="検索">
	</form>