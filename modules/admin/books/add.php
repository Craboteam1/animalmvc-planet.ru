<?php
$cats = q("
		SELECT *
		FROM `books_cat`
	");
if(isset($_POST['add'], $_POST['name'], $_POST['cost'], $_POST['about'], $_POST['author'])) {
	$errors = [];
	if(empty($_POST['name'])) {
		$errors['name'] = 'Вы не ввели название книги!';
	}
	if(empty($_POST['cost'])) {
		$errors['cost'] = 'Пожалуйста, введите цену книги!';
	}
	if(empty($_POST['about'])) {
		$errors['about'] = 'Вы не написали аннотацию\короткое описание к книге!';
	}
	if(empty($_POST['author'])) {
		$errors['author'] = 'Вы не указали автора!';
	}
	if(empty($_POST['cat'])) {
		$errors['cat'] = 'Выберите хотя бы 1 категорию!';
	}
	if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
		if(!Upl::upload($_FILES)) {
			$errors['file'] = Upl::$error;
		}
		else {
			Upl::resize(140, 180);
			$name = Upl::$name;
		}
	}
	if(!count($errors)) {
		foreach($_POST as $k => $v) {
			$_POST[$k] = trimALL($v);
		}
		q("
			INSERT INTO `books` SET
			`name`        = '".es($_POST['name'])."',
			`cost`        = '".es($_POST['cost'])."',
			`about`       = '".es($_POST['about'])."',
			`author`      = '".es($_POST['author'])."',
			`img`         = '".es($name)."'
		");
		$id = q("
			SELECT `id`
			FROM `books`
			WHERE `name` = '".es($_POST['name'])."'
		");
		$row1 = mysqli_fetch_assoc($id);

		foreach($_POST['cat'] as $category) {
			q("
				INSERT INTO `books2books_cat` SET
				`book_id` = '".(int)$row1['id']."',
				`cat_id`  = '".(int)$category."'
			");
		}
		$_SESSION['info'] = 'Новая книга была успешно добавлена';
		header("Location: /admin/books");
		exit();
	}

}


