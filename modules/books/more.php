<?php

$books = q("
	SELECT *
	FROM `books`
	WHERE `id` = '".(int)$_GET['key1']."'
	LIMIT 1
");
if(!mysqli_num_rows($books)) {
	$_SESSION['info'] = 'Данного товара не существует';
	header("Location: /admin/books");
	exit();
} else {
	while($row1 = $books->fetch_assoc()) {
		$book[$row1['id']] = $row1;
		unset($row1);
	}
	$books->close();
	$res = q("
	SELECT *
	FROM `books2books_cat`
	WHERE `book_id` = '".(int)$_GET['key1']."'
");

	while($row2 = $res->fetch_assoc()) {
		$id1[] = $row2['cat_id'];
		$ids1[$row2['cat_id']] = $row2['book_id'];
		$book[$row2['book_id']]['cat'][$row2['cat_id']] = '';
		unset($row2);
	}

	$res->close();
	$ids2 = implode(',', $id1);
	$res2 = q("
	SELECT *
	FROM `books_cat`
	WHERE `id` IN (".$ids2.") 
");
	while($row = $res2->fetch_assoc()) {
		$cats[$row['id']] = $row['cat_name'];
		unset($row);
	}
	$res2->close();
	foreach($book as $item => $v) {
		foreach($v['cat'] as $key => $value) {
			$book[$item]['cat'][$key] = $cats[$key];
		}
	}

	$similar = q("
		SELECT *
		FROM `books`
		WHERE `author` = '".es($book[$_GET['key1']]['author'])."'
		AND `id` != '".(int)$_GET['key1']."'
	");

}