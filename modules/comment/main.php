<?php
CORE::$JS = '/js/script_comment_v1.js';
if(isset($_SESSION['user']) && $_SESSION['user']['active'] == 1) {
	if(isset($_POST['commentheader'], $_POST['email'], $_POST['theme'], $_POST['comment'])) {
		$errors = [];
		if(empty($_POST['commentheader'])) {
			$errors['commentheader'] = 'Вы не ввели заголовок комментария!';
		}
		if(empty($_POST['theme'])) {
			$errors['theme'] = 'Пожалуйста, введите тему комментария!';
		}
		if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = 'Вы не заполнили E-mail!';
		}
		if(empty($_POST['comment'])) {
			$errors['comment'] = 'Хороший комментарий, но пустой';
		}

		if(!count($errors)) {
			foreach($_POST as $k => $v) {
				$_POST[$k] = trim($v);
			}
			q( "
			INSERT INTO `Comments` SET
				`name`  = '".es($_POST['commentheader'])."',
				`user`  = '".es($_SESSION['user']['login'])."',
				`theme` = '".es($_POST['theme'])."',
				`email` = '".es($_POST['email'])."',
				`text`  = '".es($_POST['text'])."'
			");
			$_SESSION['info'] = 'Ваш комментарий был успешно добавлен';
			header("Location: /comment");
			exit();
		}
	}
} else {
	$info = 'Авторизируйтесь, чтобы иметь возможность оставлять комментарии';

}
$comments = q( "
	SELECT *
	FROM `Comments`
	ORDER BY `id` DESC	
");
if(isset($_SESSION['info'])) {
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
} elseif(isset($_SESSION['info1'])) {
	$info1 = $_SESSION['info1'];
	unset($_SESSION['info1']);
}
