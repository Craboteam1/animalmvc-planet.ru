<div class="whitetext">
	<?php
	if(isset($_COOKIE['access'])) {
		if($_COOKIE['access'] == 1) {
			echo $_COOKIE['password'].'<br>'.$_COOKIE['login'].'<br>'.$_COOKIE['email'].'<br>';
		}
	}
	if(isset($_COOKIE['access'])) {
		if($_COOKIE['access'] == 0) {
			echo 'Вы успешно вышли';
		}
	}
	?>
	<form action="" method="post">
		Login:<label><input type="text" name="login"></label><br>
		Passw:<label><input type="password" name="pass"></label><br>
		Email:<label><input type="text" name="email"></label><br>
		<input type="submit" name="submit-auto" value="Send">
		<?php
		if(isset($_COOKIE['access'])) {
			if($_COOKIE['access'] == 1) {
				echo '<input type="submit" name="exit" value="Выход">';
			}
		}
		?>
	</form>
</div>