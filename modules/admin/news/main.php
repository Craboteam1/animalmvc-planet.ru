<?php
$news = q("
SELECT *
FROM `news`
ORDER BY `id` DESC
");
if(isset($_POST['delete'])) {
	foreach($_POST['ids'] as $k => $v) {
		$_POST['ids'][$k] = (int)$v;
	}
	$ids = implode(',', $_POST['ids']);
	q("
		DELETE FROM `news`
		WHERE `id` IN (".$ids.")
	");
	$_SESSION['info'] = 'Новость была успешно удалена';
	header("Location: /admin/news");
	exit();
}

if(isset($_GET['key2'], $_GET['key3']) && $_GET['key2'] = 'delete') {
	q( "
		DELETE FROM `news`
		WHERE `id` = ".$_GET['key3']."
	");
	$_SESSION['info'] = 'Новость была успешно удалена';
	header("Location: /admin/news");
	exit();
}
if(isset($_SESSION['info'])) {
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
} elseif(isset($_SESSION['info1'])) {
	$info1 = $_SESSION['info1'];
	unset($_SESSION['info1']);
}