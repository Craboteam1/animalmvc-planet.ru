<?php
if(isset($_GET['key2'], $_GET['key3']) && $_GET['key2'] = 'delete') {
	q( "
		DELETE FROM `books`
		WHERE `id` = ".(int)$_GET['key3']."
	");
	q("
		DELETE FROM `books2books_cat`
		WHERE `book_id` = ".(int)$_GET['key3']."
	");
	$_SESSION['info'] = 'Книга была успешно удалена';
	header("Location: /admin/books");
	exit();
}
$books = q("
	SELECT *
	FROM `books`
");

while($row1 = $books ->fetch_assoc()) {
	$ids[] = $row1['id'];
	$book[$row1['id']] = $row1;
	unset($row1);
}

$id = implode(',', $ids);
$res = q("
	SELECT *
	FROM `books2books_cat`
	WHERE `book_id` IN (".$id.")
");

while($row2 = $res->fetch_assoc()) {
	$id1[] = $row2['cat_id'];
	$ids1[$row2['cat_id']] = $row2['book_id'];
	$book[$row2['book_id']]['cat'][$row2['cat_id']] = '';
	unset($row2);
}

$res->close();
$ids2 = implode(',',$id1);
$res2 = q("
	SELECT *
	FROM `books_cat`
	WHERE `id` IN (".$ids2.") 
");
while($row = $res2->fetch_assoc()) {
	$cats[$row['id']] = $row['cat_name'];
	unset($row);
}

foreach($book as $item => $v) {
	foreach($v['cat'] as $key => $value) {
		$book[$item]['cat'][$key] = $cats[$key];
	}
}

if(isset($_SESSION['info'])) {
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
} elseif(isset($_SESSION['info1'])) {
	$info1 = $_SESSION['info1'];
	unset($_SESSION['info1']);
}