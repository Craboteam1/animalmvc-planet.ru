<div class="whitetext">
	<form action="" method="post" >
		<table>
			<tr>
				<td>Название категории*:</td>
				<td><input type="text" name="cat_name" value="<?php if(isset($_POST['cat_name'])){ echo spechar($_POST['cat_name']);} ?>" ></td>
				<td><?php if(isset($errors['cat_name'])){ echo $errors['cat_name'];} ?></td>
			</tr>
		</table>
		<input type="submit" name="add" value="Добавить новую категорию">
	</form>
</div>