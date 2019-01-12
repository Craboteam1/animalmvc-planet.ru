<h1>
	<?php
		if($_GET['action'] == 'win'){
			echo 'Сударь, да вы молодец. Поздравляю с Победой!';
		} elseif($_GET['action'] == 'loose') {
			echo 'Сударь, вы проиграли!';
		}
	?>
</h1>
