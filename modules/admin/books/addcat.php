<?php
if(isset($_POST['cat_name'])) {
	$errors = [];
	if(empty($_POST['cat_name'])) {
		$errors['cat_name'] = 'Введите название категории!';
	}
	if(!count($errors)) {
		foreach($_POST as $k => $v) {
			$_POST[$k] = trimALL($v);
		}
		$check = q("
			SELECT *
			FROM `books_cat`
			WHERE `cat_name` = '".es($_POST['cat_name'])."'
		");
		if($check->num_rows) {
			$errors['cat_name'] = 'Такая категория уже существует!';
		} else {
			q("
				INSERT INTO `books_cat` SET
				`cat_name` = '".$_POST['cat_name']."'
			");
			$_SESSION['info'] = 'Новая категория была успешно добавлена';
			header("Location: /admin/books");
			exit();
		}
	}
}