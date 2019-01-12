<?php
if(isset($_SESSION['user']) && $_SESSION['user']['active'] == 1) {
	if(isset($_POST['name'], $_POST['access'], $_POST['text'])) {
		$errors = [];
		if(empty($_POST['name'])) {
			$errors['name'] = 'Вы не ввели заголовок комментария!';
		}
		if(empty($_POST['text'])) {
			$errors['text'] = 'Пожалуйста, введите тему комментария!';
		}

		if(!count($errors)) {
			foreach($_POST as $k => $v) {
				$_POST[$k] = trim($v);
			}

			q( "
			INSERT INTO `Chat` SET
				`name`  = '".es($_POST['name'])."',
				`text`  = '".es($_POST['text'])."',
				`access` = '".es($_POST['access'])."'
			");

		}
	}
} else {
	$info = 'Авторизируйтесь, чтобы иметь возможность оставлять комментарии';
	echo 'SOMETHING gone wrong';
	exit();
}
$messages = q( "
	SELECT `id`
	FROM `Chat`
	ORDER BY `id` DESC
	LIMIT 1
");
$id = 1;
while($row1 = $messages ->fetch_assoc()) {
	$comment[$id] = $row1;
	++$id;
	unset($row1);
}

if(!mysqli_num_rows($messages)) {
	echo 'no';
	exit();
} else {
	echo json_encode($comment);
	exit();
}