<?php

foreach($_POST as $k=>$v) {
	$_POST[$k] = trim($v);
}
if(isset($_POST['login'], $_POST['email'], $_POST['age'])) {
	$errors = [];
	if(empty($_POST['login'])) {
		$errors['login'] = 'Введите имя пользователя!';
	}
	if(empty($_POST['age'])) {
		$errors['age'] = 'Описание товара не может быть пустым!';
	}
	if(empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errors['description'] = 'Описание товара не может быть пустым!';
	}
	if(!count($errors)) {
		q("
			UPDATE `Users` SET
			`login`        	  = '".es($_POST['login'])."',
			`email`           = '".es($_POST['email'])."',
			`age`             = '".es($_POST['age'])."',
			`active`          = '".(int)$_POST['active']."',
			`access`          = '".(int)$_POST['access']."'
			WHERE `id` = '".(int)$_GET['key2']."'
		");

		$_SESSION['info'] = 'Данные о пользователе были изменены';
		header("Location: /admin/users");
		exit();
	}
}
$users = q("
	SELECT *
	FROM `Users`
	WHERE `id` = '".(int)$_GET['key2']."'
	LIMIT 1
");

if(!mysqli_num_rows($users)) {
	$_SESSION['info'] = 'Данного товара не существует';
	header("Location: /admin/users");
	exit();
}
$row = mysqli_fetch_assoc($users);
if(isset($_POST['login'])) {
	$row['login'] = $_POST['login'];
}
if(isset($_POST['age'])) {
	$row['age'] = $_POST['age'];
}
if(isset($_POST['access'])) {
	$row['access'] = $_POST['access'];
}
if(isset($_POST['prod'])) {
	$row['active'] = $_POST['active'];
}


