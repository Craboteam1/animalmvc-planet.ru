<?php
$checklast = q("
	SELECT *
	FROM `Comments`
	WHERE `id` > '".(int)$_POST['id']."'
	AND `user` <> '".es($_SESSION['user']['login'])."'
");
$id = 1;
if(mysqli_num_rows($checklast)) {
	while($row1 = $checklast->fetch_assoc()) {
		$comment[$id] = $row1;
		++$id;
		unset($row1);
	}
} else {
	echo 'no!';
}
if(!mysqli_num_rows($checklast)) {
	echo 'no';

} else {
	echo json_encode($comment);
	exit();
}