
<form action="" method="post">
	<table>
		<tr>
			<td>Логин пользователя:</td>
			<td><input type="text" name="login" value="<?php if(isset($row['login'])){ echo spechar($row['login']);} ?>" ></td>
			<td><?php if(isset($errors['login'])){ echo $errors['login'];} ?></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="text" name="email" value="<?php if(isset($row['email'])){ echo spechar($row['email']);} ?>" ></td>
			<td><?php if(isset($errors['email'])){ echo $errors['email'];} ?></td>
		</tr>
		<tr>
			<td>Возраст:</td>
			<td><input type="text" name="age" value="<?php if(isset($row['age'])){ echo spechar($row['age']);}  ?>" ></td>
			<td><?php if(isset($errors['age'])){ echo $errors['age'];}?></td>
		</tr>
		<tr>
			<td>Права:</td>
			<td><input type="radio" name="access" value="5" <?php if(isset($row['access']) && $row['access'] == 5) {echo 'checked';}?>>Админ</td>
			<td><input type="radio" name="access" value="0" <?php if(isset($row['access']) && $row['access'] == 0) {echo 'checked';}?>>Обычный пользователь</td>
		</tr>
		<tr>
			<td>Доступ:</td>
			<td><input type="radio" name="active" value="1" <?php if(isset($row['active']) && $row['active'] == 1) {echo 'checked';}?>>Открытый</td>
			<td><input type="radio" name="active" value="0" <?php if(isset($row['active']) && $row['active'] != 1) {echo 'checked';}?>>Закрытый</td>
		</tr>
		<tr>
			<td><b>Ip:</b></td>
			<td><?=$row['ip'];?> </td>
		</tr>
	</table>
	<input type="submit" name="add" value="Отредактировать пользователя">
</form>
