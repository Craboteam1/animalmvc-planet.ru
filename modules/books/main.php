<?php
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



/*
foreach($cats as $id=>$cat) {
	foreach($cat as $id1=>$cat2) {
		echo $id1.$cat2;
		$book[$ids1[$id]]['cat'][] = $cat;
	}
}
/* $book[$ids1[$row['id']]]['cat'][] = $row['cat_name'];
 * Получаешь данные из первой таблицы и запихиваешь в массив. Далее к ней подключаешь данные из второй
SELECT `author_id`
FROM `таблица связей`
WHERE `book_id` IN (1,2,3,4)
всё что тебе надо - после первого запроса к книгам получить ID книг, которые будут выводиться на странице. Далее их в переменную (массив), и для второго запроса, который идёт ниже - собрать через implode, чтобы на выходе получился такой вот вид, как я тебе показал
и с третьей таблицей точно так же
*/