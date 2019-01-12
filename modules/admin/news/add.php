<?php
$category = array(1,2,3);
if(isset($_POST['header'],$_POST['description'],$_POST['text'],$_POST['cat'])) {
	$errors = [];
	if(empty($_POST['header'])) {
		$errors['header'] = 'Заголовок новости не может быть пустым!';
	}
	if(empty($_POST['description'])) {
		$errors['description'] = 'Краткое оглавление не может быть пустым!';
	}
	if(empty($_POST['text'])) {
		$errors['text'] = 'Пожалуйста, введите саму новость!';
	}
	if(empty($_POST['cat'])) {
		$errors['cat'] = 'Категория не указана!';
	}
	if(!count($errors)) {
		foreach($_POST as $k => $v) {
			$_POST[$k] = trim($v);
		}
		q("
			INSERT INTO `news` SET
			`header`      = '".es($_POST['header'])."',
			`text`        = '".nl2br(es($_POST['text']))."',
			`cat`         = '".(int)$_POST['cat']."',	
			`description` = '".es($_POST['description'])."',
			`date`        = NOW()
		");
		$_SESSION['info'] = 'Новость была добавлена';
		header("Location: /admin/news");
		exit();
	}
}