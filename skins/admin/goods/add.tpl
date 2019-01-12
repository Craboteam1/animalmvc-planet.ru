	<div class="whitetext">
		<form action="" method="post" enctype="multipart/form-data">
			<table>
				<tr>
					<td>Название товара*:</td>
					<td><input type="text" name="name" value="<?php if(isset($_POST['name'])) { echo spechar($_POST['name']);} ?>" ></td>
					<td><?php if(isset($errors['name'])) { echo $errors['name'];} ?></td>
				</tr>
				<tr>
					<td>Цена(Указывать только числа!)*:</td>
					<td><input type="text" name="cost" value="<?php if(isset($_POST['cost'])) {echo spechar($_POST['cost']);}  ?>" ></td>
					<td><?php if(isset($errors['cost'])) {echo $errors['cost'];}?></td>
				</tr>
				<tr>
					<td>Описание товара*:</td>
					<td><input type="text" name="description" value="<?php if(isset($_POST['description'])) { echo spechar($_POST['description']);}  ?>" ></td>
					<td><?php if(isset($errors['description'])){echo $errors['description'];}?></td>
				</tr>
				<tr>
					<td>Изготовитель*:</td>
					<td><input type="text" name="prod" value="<?php if(isset($_POST['prod'])){echo spechar($_POST['prod']);}  ?>" ></td>
					<td><?php if(isset($errors['prod'])){ echo $errors['prod'];}?></td>
				</tr>
				<tr>
					<td>Указать количество товаров*:</td>
					<td><input type="text" name="item" value="<?php if(isset($_POST['item'])){ echo spechar($_POST['item']); } ?>" ></td>
					<td><?php if(isset($errors['item'])){ echo $errors['item'];}?></td>
				</tr>
			</table>
			<div class="img-add clearfix">
				<input type="file" name="file" accept="image/png image/gif image/jpg image/jpeg"><br>
				<?php if(isset($errors['file'])){ echo $errors['file'];}?>
			</div>
			<select name="cat">
				<?php foreach($category as $value) {  ?>
					<option  <?php if(isset($_POST['cat']) && $_POST['cat'] == $value) { echo 'selected = "selected" ';} ?>><?=$value; ?></option>
				<?php }  ?>
				<?php if(isset($errors['cat'])){ echo $errors['cat'];}?>
			</select>
			<p>* - Поля объязательные для заполнения!</p>
			<input type="submit" name="add" value="Добавить новый товар">
		</form>
	</div>