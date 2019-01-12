<div class="whitetext">
	<form action="" method="post">
	<?php
	if(isset($_POST['num1'])) {
		if($_POST['num1'] == 1 || $_POST['num1'] == 2 || $_POST['num1'] == 3) {
			if($_POST['num1'] == rand(1, 3)) {
				$_SESSION['client'] = $_SESSION['client'] - rand(1, 4);
				echo 'Ваше ХП: '.$_SESSION['client'].'<br>'.'ХП Противника: '.$_SESSION['server'].'<br>';
			}
			elseif($_POST['num1'] !== rand(1, 3)) {
				$_SESSION['server'] = $_SESSION['server'] - rand(1, 4);
				echo 'Ваше ХП: '.$_SESSION['client'].'<br>'.'ХП Противника: '.$_SESSION['server'].'<br>';
			}
		}
	}
	?>
	Введите число от 1 до 3: <input type="text" name="num1">
	<input type="submit">
</form>
</div>