<?php
if(isset($_POST['login'],$_POST['pass'])) {
	$res = q("
		SELECT *
		FROM `Users`
		WHERE `login` = '".es($_POST['login'])."'
		 AND `password` = '".myHash($_POST['pass'])."'
		 AND `active` = 1
		 LIMIT 1
	");
	if(mysqli_num_rows($res)) {
		q("
			UPDATE `Users` SET
		  	`ip`           = '".es($_SERVER['REMOTE_ADDR'])."',
		  	`HTTP_USER_AGENT` = '".es($_SERVER['HTTP_USER_AGENT'])."'
			WHERE `login`  = '".es($_POST['login'])."'
			AND `password` = '".myHash($_POST['pass'])."'
			AND `active`   = 1
			LIMIT 1
		");
		$_SESSION['user'] = mysqli_fetch_assoc($res);
		$_SESSION['status'] = 'OK';
	}
}
if(isset($_POST['auto-auth'])) {
	if(isset($_SESSION['user']) && $_SESSION['user']['active'] == 1) {
		setcookie('hash', myHash($_SESSION['user']['id'].$_SESSION['user']['email'].$_SESSION['user']['login']), time() + 3600 * 24 * 30, '/');
		setcookie('id', (int)$_SESSION['user']['id'], time() + 3600 * 24 * 30, '/');
		header("Location: /cab/auth");
		exit();
	} else {
		$info = 'У вас нет прав';
	}
}
if(isset($_COOKIE['hash'],$_COOKIE['id']) && $_COOKIE['hash'] == myHash($_SESSION['user']['id'].$_SESSION['user']['email'].$_SESSION['user']['login']) && $_COOKIE['id'] == (int)$_SESSION['user']['id']) {
	q( "
	 		UPDATE `Users` SET
			`hash` = '".es($_COOKIE['hash'])."'
			WHERE `id` = ".(int)$_COOKIE['id']."
			AND `login` = '".es($_SESSION['user']['login'])."'
		");
}
include 'main.php';

