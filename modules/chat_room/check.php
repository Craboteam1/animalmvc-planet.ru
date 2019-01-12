<?php
$messages = [];

if(isset($_POST['id'])) {
	$checklast = q("
		SELECT *
		FROM `Chat`
		WHERE `id` > '".(int)$_POST['id']."'
		AND `name` <> '".es($_SESSION['user']['login'])."'
	");

}

$checklogs = q("
	SELECT *
	FROM `chat-logs`
	WHERE `id` > '".(int)$_POST['logs_id']."'
");

if($checklast->num_rows) {

	$id = 1;
	while($row1 = $checklast->fetch_assoc()) {
		$messages['new'][$id] = $row1;
		++$id;
	}

}

$id1 = 1;


if($checklogs->num_rows) {
	while($row2 = $checklogs->fetch_assoc()) {
		$messages['logs'][$id1] = $row2;
		++$id1;
	}

}


$update = q("
	UPDATE `Users` SET
	`lastactive` = NOW()
	WHERE `id` = '".(int)$_SESSION['user']['id']."'
");

/*
$resetlogs = q("
	DELETE
	FROM `chat-logs`
");
*/

if(!count($messages)) {
	echo 'no';
	exit();
} else {
	echo json_encode($messages);
	exit();
}