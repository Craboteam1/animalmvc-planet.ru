<?php
/*
$res = q($link,"
	SELECT *
	FROM `meta`
	WHERE '".mi($_GET['module'])."_".mi($_GET['page'])."'
	LIMIT 1
");
$row = mysqli_fetch_assoc($res);
CORE::$META = $row;
*/
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
if(isset($_SESSION['user'])) {
	$res = q( "
		SELECT *
		FROM `Users`
		WHERE `id` = ".(int)$_SESSION['user']['id']."
		LIMIT 1
	");
	$_SESSION['user'] = mysqli_fetch_assoc($res);
	if($_SESSION['user']['active'] != 1) {
		include './modules/cab/exit.php';
	}
}

if(isset($_COOKIE['hash'],$_COOKIE['id'])) {
	if(!isset($_SESSION['user'])) {
		$res = q( "
			SELECT *
			FROM `Users`
			WHERE `id`              = '".(int)$_COOKIE['id']."'
			AND   `hash`            = '".es($_COOKIE['hash'])."'
			AND   `ip`              = '".es($_SERVER['REMOTE_ADDR'])."'
			AND   `HTTP_USER_AGENT` = '".es($_SERVER['HTTP_USER_AGENT'])."'		
		");

		if($res->num_rows) {
			$_SESSION['user'] = $res->fetch_assoc();
			$_SESSION['status'] = 'OK';
		}
		else {
			setcookie('hash', '', time() - 3600, '/');
			setcookie('id', '', time() - 3600, '/');
		}
	}
}
