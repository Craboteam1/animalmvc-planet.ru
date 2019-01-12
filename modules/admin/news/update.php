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
			UPDATE `news` SET
			`header`       = '".es($_POST['header'])."',
			`description`  = '".es($_POST['description'])."',
			`text`         = '".es($_POST['text'])."',
			`cat`          = '".(int)$_POST['cat']."',
			`date`         = NOW()
			WHERE `id` = '".(int)$_GET['key2']."'
		");
		$_SESSION['info'] = 'Новость была обновлена';
		header("Location: /admin/news");
		exit();
	}
}
$news = q("
	SELECT *
	FROM `news`
	WHERE `id` = '".$_GET['key2']."'
");

if(!mysqli_num_rows($news)) {
	$_SESSION['info'] = 'Данной новости не существует';
	header("Location: /admin/news");
	exit();
}

$row = mysqli_fetch_assoc($news);

if(isset($_POST['header'])) {
	$row['header'] = $_POST['header'];
}
if(isset($_POST['text'])) {
	$row['text'] = $_POST['text'];
}
if(isset($_POST['description'])) {
	$row['description'] = $_POST['description'];
}
if(isset($_POST['cat'])) {
	$row['cat'] = $_POST['cat'];
}

