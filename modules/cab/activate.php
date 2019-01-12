<?php
if(isset($_GET['key1'],$_GET['key2'])) {
	q("
		UPDATE `Users` SET
		`active` = 1
		WHERE `id` = ".(int)$_GET['key1']."
		AND `hash` = '".es($_GET['key2'])."'
	");
	$info = 'Вы активны на сайте';
} else {
	$info = 'Вы прошли по неверной ссылке';
}