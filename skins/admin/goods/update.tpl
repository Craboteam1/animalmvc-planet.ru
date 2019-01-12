<div class="whitetext">
	<form action="" method="post" enctype="multipart/form-data">
		<?php if(!empty($row['img'])) { ?>
		<div class="img-add clearfix">
			<p>Фото товара:</p>
			<img src="<?=$row['img'];?>">
		</div>
		<?php } ?>
		<table>
			<tr>
				<td>Название товара*:</td>
				<td><input type="text" name="name" value="<?php if(isset($row['name'])){ echo spechar($row['name']);} ?>" ></td>
				<td><?php if(isset($errors['name'])){ echo $errors['name'];} ?></td>
			</tr>
			<tr>
				<td>Цена(Указывать только числа!)*:</td>
				<td><input type="text" name="cost" value="<?php if(isset($row['cost'])){ echo spechar($row['cost']);}  ?>" ></td>
				<td><?php if(isset($errors['cost'])){ echo $errors['cost'];}?></td>
			</tr>
			<tr>
				<td>Описание товара*:</td>
				<td><input type="text" name="description" value="<?php if(isset($row['description'])){ echo spechar($row['description']);}  ?>" ></td>
				<td><?php if(isset($errors['description'])){ echo $errors['description'];}?></td>
			</tr>
			<tr>
				<td>Изготовитель*:</td>
				<td><input type="text" name="prod" value="<?php if(isset($row['prod'])){ echo spechar($row['prod']);}  ?>" ></td>
				<td><?php if(isset($errors['prod'])){ echo $errors['prod'];}?></td>
			</tr>
			<tr>
				<td>Указать количество товара*:</td>
				<td><input type="text" name="item" value="<?php if(isset($row['item'])){ echo spechar($row['item']);}  ?>" ></td>
				<td><?php if(isset($errors['prod'])){ echo $errors['prod'];}?></td>
			</tr>
		</table>
		<div class="img-add clearfix">
			<input type="file" name="file" accept="image/png image/gif image/jpg image/jpeg">
		</div>
		<select name="cat">
			<?php foreach($category as $value) {  ?>
				<option  <?php if(isset($row['cat']) && $row['cat'] == $value) { echo 'selected';} ?>><?=$value; ?></option>
			<?php }  ?>
			<?php if(isset($errors['cat'])){ echo $errors['cat'];} ?>
		</select>
		<p>* - Поля объязательные для заполнения!</p>
		<input type="submit" name="add" value="Добавить новый товар">
	</form>
</div>