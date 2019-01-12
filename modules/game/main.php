<?php

if(!isset($_SESSION['client'], $_SESSION['server'])){
	$_SESSION['client'] = 10;
	$_SESSION['server'] = 10;
}


if($_SESSION['client'] <= 0) {
	header("Location: /modules/game/gameover1.php?action=loose");
	exit();
}
elseif($_SESSION['server'] <= 0) {
	header("Location: /modules/game/gameover1.php?action=win");
	exit();
}
