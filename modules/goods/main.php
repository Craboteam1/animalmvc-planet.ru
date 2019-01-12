<?php
$goods = q( "
SELECT *
FROM `goods`
ORDER BY `id` DESC
");

if(isset($_SESSION['info'])) {
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
}
