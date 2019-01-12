<?php
$news = q("
	SELECT *
	FROM `news`
	WHERE `id` = '".(int)$_GET['key1']."'
	LIMIT 1
");
$row = $news->fetch_assoc();
$news->close();
$row2 = q("
	SELECT `cat_name`
	FROM `news_cat`
	WHERE `id` = '".(int)$row['cat']."'
");
$res = $row2->fetch_assoc();
$row2->close();
