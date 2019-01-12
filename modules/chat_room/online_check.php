<?php

$user_online = q("
	SELECT `login`,`id`,`img`,`access`
	FROM `Users`
	WHERE `lastactive` > NOW() - INTERVAL 1 MINUTE
	AND `active` = 1
");

if($user_online->num_rows) {
	while($row1 = $user_online->fetch_assoc()) {
		$user[$row1['id']] = $row1;
	}
} else {
	echo 'no';
	exit();
}
if(!mysqli_num_rows($user_online)) {
	echo 'no';
	exit();
} else {
	echo json_encode($user);
	exit();
}