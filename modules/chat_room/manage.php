<?php
q("
	INSERT INTO `chat-logs` SET 
		`action` = 'manage',
		`parent` = '".(int)$_POST['id']."',
		`managed_text` = '".es($_POST['text'])."',
		`user` = '".es($_POST['user'])."'
");
$log = q("
	SELECT *
	FROM `chat-logs`
	WHERE `action` = 'manage'
	AND `parent` = '".(int)$_POST['id']."'
");

if(mysqli_num_rows($log)) {
	q("
		UPDATE `Chat` SET
		`text` = '".es($_POST['text'])."'
		WHERE `id` = '".(int)$_POST['id']."'
	");
} else {
	echo 'no';
}