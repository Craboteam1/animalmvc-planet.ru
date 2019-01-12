<?php

$category = array('Всё для дома', 'Бытовая техника', 'Игрушки', 'Эллектроника');
if(isset($_POST['add'], $_POST['name'], $_POST['cost'], $_POST['description'], $_POST['cat'], $_POST['prod'])) {
	$errors = array();
	if(empty($_POST['name'])) {
		$errors['name'] = 'Название товара не может быть пустым!';
	}
	if(empty($_POST['cost'])) {
		$errors['cost'] = 'Цена товара не может быть пустой!';
	}
	if(empty($_POST['description'])) {
		$errors['description'] = 'Описание товара не может быть пустым!';
	}
	if(empty($_POST['prod'])) {
		$errors['prod'] = 'Изготовитель не указан!';
	}

	if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
		if(!Upl::upload($_FILES)) { // Мы загрузили файл
			$_SESSION['info1'] = Upl::$error;
			header("Location: /admin/goods");
			exit();
		}
		else {
			Upl::resize(1000, 800);
			Upl::resize(100, 100);
			$name = Upl::$name;
		}
	}
	if(!count($errors)) {
		foreach($_POST as $k=>$v) {
			$_POST[$k] = trim($v);
		}
		q("
			UPDATE `goods` SET
			`name`        = '".es($_POST['name'])."',
			`cost`        = '".es($_POST['cost'])."',
			`description` = '".es($_POST['description'])."',
			`cat`         = '".es($_POST['cat'])."',
			`prod`        = '".es($_POST['prod'])."',
			`item`        = '".(int)$_POST['item']."',
			`date`        = NOW()
			WHERE `id` = '".(int)$_GET['key2']."'
		");
		if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
			q("
				UPDATE `goods` SET
				`img` = '".es($name)."'
				WHERE `id` = '".(int)$_GET['key2']."'
			");
		}
		$_SESSION['info'] = 'Данные о товаре успешно обновлены';
		header("Location: /admin/goods");
		exit();
	}
}

$goods = q("
	SELECT *
	FROM `goods`
	WHERE `id` = '".(int)$_GET['key2']."'
	LIMIT 1
");


if(!mysqli_num_rows($goods)) {
	$_SESSION['info'] = 'Данного товара не существует';
	header("Location: /admin/goods");
	exit();
}

$row = mysqli_fetch_assoc($goods);

if(isset($_POST['name'])) {
	$row['name'] = $_POST['name'];
}
if(isset($_POST['cost'])) {
	$row['cost'] = $_POST['cost'];
}
if(isset($_POST['description'])) {
	$row['description'] = $_POST['description'];
}
if(isset($_POST['prod'])) {
	$row['prod'] = $_POST['prod'];
}
if(isset($_POST['item'])) {
	$row['item'] = $_POST['item'];
}
if(isset($_POST['cat'])) {
	$row['cat'] = $_POST['cat'];
}
