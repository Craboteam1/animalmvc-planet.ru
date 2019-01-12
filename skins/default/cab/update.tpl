<div class="whitetext">

	<form action="" method="post" enctype="multipart/form-data">

		<table>
			<tr>
				<td>Изменение логина:</td>
				<td><input type="text" name="login" value="<?php if(isset($row['login'])){ echo spechar($row['login']);} ?>" ></td>
				<td><?php if(isset($errors['login'])) {echo $errors['login'];} ?></td>
			</tr>
		</table>
		<div class="img-add">
			<?php if(isset($_SESSION['user']['img'])) {?>
				<span>Ваш Аватар: </span><img src="<?=$_SESSION['user']['img']?>"><br>
			<?php } ?>
			<input type="file" name="file" accept="image/png image/gif image/jpg image/jpeg">
			<input type="submit" name="add" value="Обновить профиль">
		</div>
	</form>
</div>