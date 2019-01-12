<?php

if(isset($_POST['login'], $_POST['email'], $_POST['password'], $_POST['age'])) {
	$errors = [];
	if(empty($_POST['login'])) {
		$errors['login'] = 'Вы не ввели заголовок комментария!';
	}
	elseif(mb_strlen($_POST['login']) < 2) {
		$errors['login'] = 'Логин слишком короткий!';
	}
	elseif(mb_strlen($_POST['login']) > 15) {
		$errors['login'] = 'Логин слишком длинный!';
	}
	if(empty($_POST['password'])) {
		$errors['password'] = 'Пожалуйста, введите тему комментария!';
	}
	elseif(mb_strlen($_POST['password']) < 6) {
		$errors['password'] = 'Пароль должен быть длинее 5-и символов';
	}
	if(empty($_POST['age'])) {
		$errors['age'] = 'Вы не указали свой возраст!';
	}
	if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Вы не заполнили E-mail!';
	}
	if(!count($errors)) {
		$res = q( "
		SELECT `id`
		FROM `Users`
		WHERE `login` = '".es($_POST['login'])."'
		LIMIT 1
	");
		if(mysqli_num_rows($res)) {
			$errors['login'] = 'Такой логин уже занят';
		}
	}
	if(!count($errors)) {
		$res = q( "
		SELECT `id`
		FROM `Users`
		WHERE `email` = '".es($_POST['email'])."'
		LIMIT 1
	");
		if(mysqli_num_rows($res)) {
			$errors['email'] = 'Такой E-mail уже занят';
		}
	}

	if(!count($errors)) {
		foreach($_POST as $k => $v) {
			$_POST[$k] = trim($v);
		}
		q( "
			INSERT INTO `Users` SET
			`login`           = '".es($_POST['login'])."',
			`password`        = '".myHash($_POST['password'])."',
			`email`           = '".es($_POST['email'])."',
			`age`             = '".es($_POST['age'])."',
			`hash`            = '".myHash($_POST['login'].$_POST['age'])."',
			`ip`              = '".es($_SERVER['REMOTE_ADDR'])."',
			`HTTP_USER_AGENT` = '".es($_SERVER['HTTP_USER_AGENT'])."'
			");

		$id = DB::_()->insert_id;
		$_SESSION['info'] = 'Потведрите email!';
		Mail::$to = $_POST['email'];
		Mail::$subject = 'Вы зарегестрировались на сайте';
		Mail::$text = '
		Пройдите по ссылке для активации вашего аккаунта: '.CORE::$DOMAIN.'/cab/activate/'.$id.'/'.myHash($_POST['login'].$_POST['age']).'
	';
		Mail::send();
	header("Location: /cab");
		exit();
	}
}
if(isset($_SESSION['info'])) {
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
} elseif(isset($_SESSION['info1'])) {
	$info1 = $_SESSION['info1'];
	unset($_SESSION['info1']);
}
