<?php

if(isset($_POST['delete'],$_POST['ids'])) {
	foreach($_POST['ids'] as $k => $v) {
		$_POST['ids'][$k] = (int)$v;
	}
	$ids = implode(',', $_POST['ids']);
	q("
		DELETE FROM `goods`
		WHERE `id` IN (".$ids.")
	");
	$_SESSION['info'] = 'Товар был успешно удален';
	header("Location: /admin/goods");
	exit();
}

if(isset($_GET['key2'], $_GET['key3']) && $_GET['key2'] = 'delete') {
	q( "
		DELETE FROM `goods`
		WHERE `id` = ".$_GET['key3']."
	");
	$_SESSION['info'] = 'Товар был успешно удален';
	header("Location: /admin/goods");
	exit();
}
$goods = q("
	SELECT *
	FROM `goods`
	ORDER BY `id` DESC
	");
if(isset($_SESSION['info'])) {
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
} elseif(isset($_SESSION['info1'])) {
	$info1 = $_SESSION['info1'];
	unset($_SESSION['info1']);
}

