<?php  if(isset($_SESSION['user']) && $_SESSION['user']['active'] ==1) {  ?>
<div class="whitetext">
	<?php if(isset($info)) { echo '<h2>'.$info.'</h2>'; } ?>
	<div class="word-break" id="comment" data-time="">
		<?php while($row = mysqli_fetch_assoc($comments)) {$comment[] = (int)$row['id'];?>
			<div class="comment">
				Заголовок: <?=spechar($row['name']);?>
				<br>Тема: <?=spechar($row['theme']);?>
				<br>Комментарий: <?=nl2br(spechar($row['text']));?>
				<br>
			</div>
		<?php } ?>
	</div>
	<form action="/modules/comment/add.php" method="post" onsubmit="return addComment();">
		<table>
			<tr>
				<td>Заголовок:</td>
				<td><input type="text" id="x" name="commentheader" value="<?php if(isset($_POST['commentheader'])) {	echo spechar($_POST['commentheader']);} ?>" ></td>
				<td><?php if(isset($errors['commentheader'])) {	echo $errors['commentheader'];} ?></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type="text" id="y" name="email" value="<?php if(isset($_POST['email'])) {	echo spechar($_POST['email']);} ?>" ></td>
				<td><?php if(isset($errors['email'])) {	echo $errors['email'];} ?></td>
			</tr>
			<tr>
				<td>Тема:</td>
				<td><input type="text" name="theme" id="z" value="<?php if(isset($_POST['theme'])) {	echo spechar($_POST['theme']);}  ?>" ></td>
				<td><?php if(isset($errors['theme'])) {	echo $errors['theme'];}?></td>
			</tr>
			<tr>
				<td>Comment:</td>
				<td><textarea name="comment" id="t" ><?php if(isset($errors['comment'])) {	echo spechar($_POST['comment']);}?></textarea></td>
				<td><?php if(isset($errors['comment'])) {echo $errors['comment'];}?></td>
			</tr>
		</table>
		<input type="submit" name="sendreg" onclick="count_second()" value="Оставить комментарий" >
	</form>
	<?php } else { ?>
		<div class="whitetext">
			<p><?php if(isset($info)) {echo $info;} ?></p>
			<div class="word-break" id="comment">
				<?php while($row = mysqli_fetch_assoc($comments)) {	$comment[] = (int)$row['id'];?>
					<div class="comment">
						Заголовок: <?=	spechar($row['name']);?>
						<br>Тема: <?=	spechar($row['theme']);?>
						<br>Комментарий: <?=	nl2br(spechar($row['text']));?>
						<br>
					</div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
	<script>
		var last_comm_id = '<?php echo $comment[0];?>';
		var timerId = setTimeout(function checkComment() {
			$.ajax({
				url: '/comment/check', // Обращение по УРЛ к какому-то файлу
				type: 'POST', // Каким способом передаем(Гет или Пост)
				cache: false, // Кеширование ответа(Запоминание, к примеру в чатах нужно использовать false)
				data: { id: last_comm_id }, //Передача данных
				success: function (msg) {
					if (msg !== 'no') {
						var response = JSON.parse(msg);
						for (var key in response) {
							last_comm_id = response[key].id;
							var div = document.createElement('div');
							div.className = "comment";
							div.innerHTML = "Заголовок: " + escapeHtml(response[key].name) + "\n" +
								"\t\t\t\t\t<br>Тема: " + escapeHtml(response[key].theme) + "\n" +
								"\t\t\t\t\t<br>Комментарий: " + escapeHtml(response[key].text) + " \n" +
								"\t\t\t\t\t<br>";
							var parentElem = document.getElementById('comment');
							parentElem.insertBefore(div,document.getElementById('comment').firstChild);
						}
					} else {

					}
				},
			});
			timerId = setTimeout(checkComment, 5000);
		}, 5000);
	</script>
	<div class="load" id="window">
		<p>
			Подождите немного, идет загрузка...
		</p>
	</div>
	<a href="#" >Gigigig</a>
</div>