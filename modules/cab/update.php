<?php
if(isset($_SESSION['user']) && $_SESSION['user']['active'] == 1) {
	$array = ['image/gif', 'image/jpeg', 'image/png'];
	if(isset($_POST['add'],$_POST['login'])) {
		$errors = [];
		if(empty($_POST['login'])) {
			$errors['login'] = 'Вы не ввели название товара!';
		}
		elseif(mb_strlen($_POST['login']) < 2) {
			$errors['login'] = 'Логин слишком короткий!';
		}
		elseif(mb_strlen($_POST['login']) > 15) {
			$errors['login'] = 'Логин слишком длинный!';
		}
		/*
		if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
			if(!Upl::upload($_FILES['file'])) {
				$error['file'] = Upl::$error;
			} else {
				Upl::resize('/upload/1000x800/users',1000,800);
				Upl::resize('/upload/150x150/users',150,150);
				$filename = Upl::$name;
			}
		}
		$error = array(
			'Размер изображения нам не подходит.',
			'Не подходит расширение изображения',
			'Не подходит тип файла, можно загружать изображения',
			'Изображение не загружено! Ошибка',
			'Данный файл не является картинкой. Принимаемые типы файлов: jpg, gif, png'
		);
		$name = Upl::upload($_FILES);
		Upl::resize($name,100,100);
		if(in_array($name,$error)) {
			$_SESSION['info'] = $name;
			header("Location: /cab/auth");
			exit();
		} else {
			$_SESSION['info'] = 'Изображение загружено нормально';
		}
*/
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
			foreach($_POST as $k => $v) {
				$_POST[$k] = trim($v);
			}
			q( "
				UPDATE `Users` SET
				`login` = '".es($_POST['login'])."'
				WHERE `id` = '".$_SESSION['user']['id']."'
				AND `active` = 1
			");

			if(isset($name)) {
					q( "
						UPDATE `Users` SET
						`img` = '".es($name)."'
						WHERE `id` = '".$_SESSION['user']['id']."'
						AND `active` = 1
					");
				}
				$_SESSION['info1'] = 'Ваш профиль был успешно обновлен';
				header("Location: /cab/auth");
				exit();
			}
		}

	$id = q("
			SELECT *
			FROM `Users`
			WHERE `id` = '".$_SESSION['user']['id']."'
			LIMIT 1
		");
	if(!mysqli_num_rows($id)) {
		$_SESSION['info1'] = 'Такой пользователь отстуствует';
		header("Location: /cab/auth");
		exit();
	}
	$row = mysqli_fetch_assoc($id);
} else {
	header("Location: /cab/auth");
	exit();
}
