<?php
if(isset($_POST['cat'],$_POST['submit'])) {
	$cat = implode(',', $_POST['cat']);

	$news = q("
		SELECT *
		FROM `news`
		WHERE `cat` IN (".$cat.")
		ORDER BY `id` DESC
");
	if(!$news->num_rows) {
		$_SESSION['info'] = 'Новостей в этой категории пока нету :(';
		header("Location: /news");
		exit();
	}
} else {
	if(isset($_GET['key1'])) {
		$num = 3;
		$page = (int)$_GET['key1'];
		$result = q("
			SELECT COUNT(*) 
			FROM `news`
		");
		$posts = mysqli_fetch_assoc($result);
		$total = intval(($posts['COUNT(*)'] - 1) / $num) + 1;
		if(empty($page) || $page < 0 || !is_int($page)) {
			$page = 1;
		}
		if($page > $total) {
			$page = $total;
		}
		$start = $page * $num - $num;
		if($page - 2 > 0) {
			$page2left = ' <a href= /news/main/'.($page - 2).' class="button">'.($page - 2).'</a> | ';
		}
		if($page - 1 > 0) {
			$page1left = '<a href= /news/main/'.($page - 1).' class="button">'.($page - 1).'</a> | ';
		}
		if($page + 2 <= $total) {
			$page2right = ' | <a href= /news/main/'.($page + 2).' class="button">'.($page + 2).'</a>';
		}
		if($page + 1 <= $total) {
			$page1right = ' | <a href= /news/main/'.($page + 1).' class="button">'.($page + 1).'</a>';
		}
		$news = q("
			SELECT * 
			FROM `news` 
			LIMIT $start, $num
		");

	}
}
if(isset($_SESSION['info'])) {
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
} elseif(isset($_SESSION['info1'])) {
	$info1 = $_SESSION['info1'];
	unset($_SESSION['info1']);
}
/*
 if($page != 1) {
		$pervpage = '<a href= "/news/main/1" class="button"> << </a> <a href= "./news/'.($page - 1).'" class="button"> < </a> ';
}
if($page != $total) {
	$nextpage = ' <a href= /news/main/'.($page + 1).' class="button">> </a> <a href= ./news/'.$total.' class="button"> >> </a>';
}
 */