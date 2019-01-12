<div class="whitetext">
	<h1><?php if(isset($info)) {echo $info;} ?></h1>
	<form action="" method="post">
		<table>
			<tr>
				<td>Login*:</td>
				<td><input type="text" name="login" value="<?php if(isset($_POST['login'])) {echo spechar($_POST['login']);} ?>" ></td>
				<td><?php if(isset($errors['login'])) {echo $errors['login'];} ?></td>
			</tr>
			<tr>
				<td>Password*:</td>
				<td><input type="password" name="password" value="<?php if(isset($_POST['password'])) {echo spechar($_POST['password']); } ?>" ></td>
				<td><?php if(isset($errors['password'])) {echo $errors['password']; }?></td>
			</tr>
			<tr>
				<td>Email*:</td>
				<td><input type="text" name="email" value="<?php if(isset($_POST['email'])) {echo spechar($_POST['email']); } ?>" ></td>
				<td><?php if(isset($errors['email'])) {echo $errors['email']; } ?></td>
			</tr>
			<tr>
				<td>Age*:</td>
				<td><input type="text" name="age" value="<?php if(isset($_POST['age'])) {echo spechar($_POST['age']); }?>" ></td>
				<td><?php if(isset($errors['age'])) {echo $errors['age']; } ?></td>
			</tr>
		</table>
		<p>* - Поля необхидимые к заполнению</p>
		<input type="submit" name="sendreg" value="Зарегестрироваться">
	</form>
</div>

