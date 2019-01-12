<?php

$cats = q("
	SELECT *
	FROM `books_cat`
");
if(isset($_POST['add'], $_POST['name'], $_POST['cost'], $_POST['about'], $_POST['author'])) {
	$errors = array();
	if(empty($_POST['name'])) {
		$errors['name'] = 'Название книги не может быть пустым!';
	}
	if(empty($_POST['cost'])) {
		$errors['cost'] = 'Цена книги не может быть пустой!';
	}
	if(empty($_POST['about'])) {
		$errors['about'] = 'Аннотация книги не может быть пустым!';
	}
	if(empty($_POST['author'])) {
		$errors['author'] = 'Изготовитель не указан!';
	}

	if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
		if(!Upl::upload($_FILES)) { // Мы загрузили файл
			$_SESSION['info1'] = Upl::$error;
			header("Location: /admin/books");
			exit();
		}
		else {
			Upl::resize(140, 180);
			$name = Upl::$name;
		}
	}
	if(!count($errors)) {
		foreach($_POST as $k=>$v) {
			$_POST[$k] = trimALL($v);
		}	

		q("
			UPDATE `books` SET
			`name`        = '".es($_POST['name'])."',
			`cost`        = '".es($_POST['cost'])."',
			`about`       = '".es($_POST['about'])."',
			`author`      = '".es($_POST['author'])."'
			WHERE `id` = '".(int)$_GET['key2']."'
		");
		if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
			q("
				UPDATE `books` SET
				`img` = '".es($name)."'
				WHERE `id` = '".(int)$_GET['key2']."'
			");
		}
		q("
			DELETE FROM `books2books_cat`
			WHERE `book_id` = '".$_GET['key2']."'
		");
		foreach($_POST['cat'] as $category) {
			q("
				INSERT INTO `books2books_cat` SET
				`book_id` = '".(int)$_GET['key2']."',
				`cat_id`  = '".(int)$category."'
			");
		}
		$_SESSION['info'] = 'Данные о товаре успешно обновлены';
		header("Location: /admin/books");
		exit();
	}
}

$books = q("
	SELECT *
	FROM `books`
	WHERE `id` = '".(int)$_GET['key2']."'
	LIMIT 1
");
$chosencats = q("
	SELECT *
	FROM `books2books_cat`
	WHERE `book_id` = '".(int)$_GET['key2']."'
");

if(!$books->num_rows) {
	$_SESSION['info'] = 'Данного товара не существует';
	header("Location: /admin/books");
	exit();
}

$row  = $books->fetch_assoc();
while($row1 = $chosencats->fetch_assoc()) {
	$checked[$row1['cat_id']] = $row1['cat_id'];
}

if(isset($_POST['name'])) {
	$row['name'] = $_POST['name'];
}
if(isset($_POST['cost'])) {
	$row['cost'] = $_POST['cost'];
}
if(isset($_POST['about'])) {
	$row['about'] = $_POST['about'];
}
if(isset($_POST['author'])) {
	$row['author'] = $_POST['author'];
}
if(isset($_POST['cat'])) {
	$row['cat_id'] = $_POST['cat'];
}
