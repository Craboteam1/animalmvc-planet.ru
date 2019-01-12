<?php

$category = ['Всё для отдыха', 'Бытовая техника', 'Игрушки', 'Электроника'];
if(isset($_POST['add'], $_POST['name'], $_POST['cost'], $_POST['description'], $_POST['cat'], $_POST['prod'])) {
	$errors = [];
	if(empty($_POST['name'])) {
		$errors['name'] = 'Вы не ввели название товара!';
	}
	if(empty($_POST['cost'])) {
		$errors['cost'] = 'Пожалуйста, введите цену товара!';
	}
	if(empty($_POST['description'])) {
		$errors['description'] = 'Вы не заполнили описание товара!';
	}
	if(empty($_POST['cat'])) {
		$errors['cat'] = 'Вы не указали новую категорию!';
	}
	if(empty($_POST['prod'])) {
		$errors['prod'] = 'Вы не указали изготовителя!';
	}
	if(empty($_POST['item'])) {
		$_POST['item'] = 0;
	}
	if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
		if(!Upl::upload($_FILES)) { // Мы загрузили файл
			$errors['file'] = Upl::$error;
		}
		else {
			Upl::resize(1000, 800);
			Upl::resize(100, 100);
			$name = Upl::$name;
		}
	}
	if(!count($errors)) {
		foreach($_POST as $k => $v) {
			$_POST[$k] = trim($v);
		}
		q("
			INSERT INTO `goods` SET
			`name`        = '".es($_POST['name'])."',
			`cost`        = '".es($_POST['cost'])."',
			`description` = '".es($_POST['description'])."',
			`cat`         = '".es($_POST['cat'])."',
			`prod`        = '".es($_POST['prod'])."',
			`item`        = '".(int)($_POST['item'])."',
			`img`         = '".es($name)."',
			`date`        = NOW()
		");

		$_SESSION['info'] = 'Новый товар был успешно добавлен';
		header("Location: /admin/goods");
		exit();
	}

}


include CORE::$CONT.'/goods/main.php';

