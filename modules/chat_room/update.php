<?php


q("
	INSERT INTO `chat-logs` SET 
		`action` = 'delete',
		`parent` = '".(int)$_POST['id']."',
		`managed_text` = '',
		`user` = ''
");
$log = q("
	SELECT *
	FROM `chat-logs`
	WHERE `action` = 'delete'
	AND `parent` = '".(int)$_POST['id']."'
");

if(mysqli_num_rows($log)) {
	$row = $log->fetch_assoc();
		q("
		DELETE FROM `Chat`
		WHERE `id` = '".(int)$_POST['id']."'
	");
		unset($row);
		exit();
} else {
	echo 'no';
	exit();
}

