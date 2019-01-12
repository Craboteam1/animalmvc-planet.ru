<div class="whitetext">
	<form action="" method="post" enctype="multipart/form-data">
		<?php if(!empty($row['img'])) { ?>
			<div class="img-add clearfix">
				<p>Обложка книги:</p>
				<img src="<?=$row['img'];?>">
			</div>
		<?php } ?>
		<table>
			<tr>
				<td>Название книги*:</td>
				<td><input type="text" name="name" value="<?php if(isset($_POST['name'])){ echo spechar($_POST['name']);} ?>" ></td>
				<td><?php if(isset($errors['name'])){ echo $errors['name'];} ?></td>
			</tr>
			<tr>
				<td>Цена(Указывать только числа!)*:</td>
				<td><input type="text" name="cost" value="<?php if(isset($_POST['cost'])){ echo spechar($_POST['cost']);}  ?>" ></td>
				<td><?php if(isset($errors['cost'])){ echo $errors['cost'];}?></td>
			</tr>
			<tr>
				<td>Аннотация\Описание к книге*:</td>
				<td><textarea name="about" cols="80" rows="10"><?php if(isset($_POST['about'])) { echo spechar($_POST['about']);}?></textarea></td>
				<td><?php if(isset($errors['about'])) {echo $errors['about'];}?></td>
			</tr>
			<tr>
				<td>Автор книги*:</td>
				<td><input type="text" name="author" value="<?php if(isset($_POST['author'])){ echo spechar($_POST['author']);}  ?>" ></td>
				<td><?php if(isset($errors['author'])){ echo $errors['author'];}?></td>
			</tr>
		</table>
		Выберите Категорию(и):<br>
		<?php while($row = $cats->fetch_assoc()) { ?>
			<input type="checkbox" name="cat[]" value="<?=$row['id']?>" ><?=$row['cat_name']?><br>
		<?php } ?>
		<?php if(isset($errors['cat'])){ echo $errors['cat'];}?>
		<div class="img-add clearfix">
			<input type="file" name="file" accept="image/png image/gif image/jpg image/jpeg">
		</div>
		<p>* - Поля объязательные для заполнения!</p>
		<input type="submit" name="add" value="Добавить новый товар">

	</form>
</div>