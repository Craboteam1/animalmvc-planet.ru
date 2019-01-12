<?php

$users = q( "
	SELECT *
	FROM `Users`
	ORDER BY `id` DESC
	");
if(isset($_GET['key2'], $_GET['key3']) && $_GET['key2'] = 'delete') {
	q( "
		DELETE FROM `Users`
		WHERE `id` = ".(int)$_GET['key3']."
	");
	$_SESSION['info'] = 'Пользователь был успешно удален';
	header("Location: /admin/users");
	exit();
}
if(isset($_SESSION['info'])) {
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
}
if(isset($_POST['search'], $_POST['OK'])) {
	$_SESSION['search'] = 'OK';
	$res = q("
		SELECT * 
		FROM `Users` 
		WHERE `login` LIKE '%".es($_POST['search'])."%'
		ORDER BY `id` DESC
	");

	if(!mysqli_num_rows($res)) {
		$_SESSION['info'] = 'Совпадений нет';
		header("Location: /admin/users");
		exit();
	}
}