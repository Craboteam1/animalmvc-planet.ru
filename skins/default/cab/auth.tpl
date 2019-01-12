<div class="whitetext">
	<?php if(isset($info)) {echo '<h1>'.$info.'</h1>';} ?>
	<?php if(isset($info1)) {echo '<h3>'.$info1.'</h3>';} ?>
	<?php if(!isset($_SESSION['status']) || $_SESSION['status'] != 'OK' ) {  ?>
	<form action="" method="post">
		<table>
			<tr>
				<td>Login*:</td>
				<td><input type="text" name="login" value="<?php if(isset($_POST['login'])) { spechar($_POST['login']);} ?>" ></td>
			</tr>
			<tr>
				<td>Password*:</td>
				<td><input type="password" name="pass" value="<?php if(isset($_POST['pass'])) {spechar($_POST['pass']);}  ?>" ></td>
			</tr>
		</table>
		<input type="checkbox" name="auto-auth">Запомнить вас?<br>
		<input type="submit" name="auth">
	</form>
	<?php  } else { ?>
		<h2>Добро пожаловать, <?php echo $_SESSION['user']['login']?>, Вы успешно авторизировались</h2>
		<?php if(isset($_SESSION['user']['img'])) {?>
			Ваш Аватар: <img src="<?php if(!empty($_SESSION['user']['img'])){ echo $_SESSION['user']['img']; } else { echo '/uploaded/no-img.png'; }?>"><br>
		<?php } ?>
		<a href="/cab/exit">Выйти из профиля</a>
	<?php } ?>
</div>
