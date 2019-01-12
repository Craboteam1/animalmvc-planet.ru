<?php
if(isset($_SESSION['user']) && $_SESSION['user']['active'] == 1) {

	if(isset($_POST['name'], $_POST['email'], $_POST['theme'], $_POST['text'])) {
		$errors = [];
		if(empty($_POST['name'])) {
			$errors['commentheader'] = 'Вы не ввели заголовок комментария!';
		}
		if(empty($_POST['theme'])) {
			$errors['theme'] = 'Пожалуйста, введите тему комментария!';
		}
		if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = 'Вы не заполнили E-mail!';
		}
		if(empty($_POST['text'])) {
			$errors['comment'] = 'Хороший комментарий, но пустой';
		}

		if(!count($errors)) {
			foreach($_POST as $k => $v) {
				$_POST[$k] = trim($v);
			}
			q( "
			INSERT INTO `Comments` SET
				`name`  = '".es($_POST['name'])."',
				`user`  = '".es($_SESSION['user']['login'])."',
				`theme` = '".es($_POST['theme'])."',
				`email` = '".es($_POST['email'])."',
				`text`  = '".es($_POST['text'])."'
			");
			echo 'Success';
		}
	}
} else {
	$info = 'Авторизируйтесь, чтобы иметь возможность оставлять комментарии';
	echo 'SOMETHING gone wrong';
	exit();
}
$comments = q( "
	SELECT *
	FROM `Comments`
	ORDER BY `id` DESC
	LIMIT 1
");

$id = 1;
while($row1 = $comments ->fetch_assoc()) {
	$comment[$id] = $row1;
	++$id;
	unset($row1);
}

if(!mysqli_num_rows($comments)) {
	echo 'no';
	exit();
} else {
	echo json_encode($comment);
	exit();
}