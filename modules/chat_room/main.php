<?php
CORE::$JS = '/js/script_chat_room_v1.js';
if(isset($_SESSION['user']) && $_SESSION['user']['active'] == 1) {
	if(isset($_POST['mess'])) {
		$errors = [];
		if(empty($_POST['mess'])) {
			$errors['mess'] = 'Вы не ввели заголовок комментария!';
		}
		if($_SESSION['user']['access'] == 4 || $_SESSION['user']['access'] == 5) {
			$access = 'red';
		} else {
			$access = 'blue';
		}
		if(!count($errors)) {
			foreach($_POST as $k => $v) {
				$_POST[$k] = trim($v);
			}
			q( "
			INSERT INTO `Chat` SET
				`name`  = '".es($_SESSION['user']['login'])."',
				`text`  = '".es($_POST['mess'])."',
				`access` = '".es($access)."'
			");
			$_SESSION['info'] = 'Ваш комментарий был успешно добавлен';
			header("Location: /chat_room");
			exit();
		}
	}


	q("
	UPDATE `Users` SET
	`lastactive` = NOW()
	WHERE `id` = '".(int)$_SESSION['user']['id']."'
	AND `active` = 1
");
} else {
	$info = 'Авторизируйтесь, чтобы иметь возможность оставлять комментарии';

}
$messages = q( "
	SELECT *
	FROM `Chat`
	ORDER BY `id` DESC	
");
$logs = q("
	SELECT *
	FROM `chat-logs`
	ORDER BY `id` DESC
");
if(isset($_SESSION['info'])) {
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
} elseif(isset($_SESSION['info1'])) {
	$info1 = $_SESSION['info1'];
	unset($_SESSION['info1']);
}