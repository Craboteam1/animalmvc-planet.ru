<div class="whitetext">
	<form action="" method="post">
		<table>
			<tr>
				<td>Заголовок новости*:</td>
				<td><input type="text" name="header" size="90" value="<?php if(isset($_POST['header'])){ echo spechar($_POST['header']);} ?>" ></td>
				<td><?php if(isset($errors['header'])){ echo $errors['header'];} ?></td>
			</tr>
			<tr>
				<td>Короткое оглавление*:</td>
				<td><input type="text" name="description" size="90" value="<?php if(isset($_POST['description'])){ echo spechar($_POST['description']);}  ?>" ></td>
				<td><?php if(isset($errors['description'])){ echo $errors['description'];}?></td>
			</tr>
			<tr>
				<td>Текст*:</td>
				<td><textarea name="text" cols="100" rows="30"><?php if(isset($_POST['text'])) {	echo spechar($_POST['text']);}?></textarea></td>
				<td><?php if(isset($errors['text'])) {echo $errors['text'];}?></td>
			</tr>
		</table>
		Категории:<br>
		1 - Наука;<br>
		2 - Криминал;<br>
		3 - Политика;<br>
		<select name="cat">
			<?php foreach($category as $value) {  ?>
				<option  <?php if(isset($row['cat']) && $row['cat'] == $value) { echo 'selected';} ?>><?=$value; ?></option>
			<?php }  ?>
			<?php if(isset($errors['cat'])){ echo $errors['cat'];} ?>
		</select>
		<p>* - Поля объязательные для заполнения!</p>
		<input type="submit" name="add" value="Добавить">
	</form>
</div>