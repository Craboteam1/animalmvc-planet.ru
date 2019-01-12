<?php
error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
session_start();
$t = microtime(true);

// Конфиг сайта
include_once './config.php';
include_once './libs/default.php';
include_once './variables.php';

// FRONT-CONTROLLER
ob_start();
if(!file_exists('./'.Core::$CONT.'/'.$_GET['module'].'/'.$_GET['page'].'.php') || !file_exists('./skins/'.Core::$SKINS.'/'.$_GET['module'].'/'.$_GET['page'].'.tpl')) {
	header("Location: /errors/404");
	exit();
}
// PAGE_MODEL
include './'.Core::$CONT.'/allpages.php';
include './'.Core::$CONT.'/'.$_GET['module'].'/'.$_GET['page'].'.php';
// PAGE_MODEL END

// PAGE_VIEW
include './skins/'.Core::$SKINS.'/'.$_GET['module'].'/'.$_GET['page'].'.tpl';
// PAGE_VIEW END
$content = ob_get_contents();
ob_end_clean();

if(isset($_GET['ajax'])) {
	echo $content;
	exit;
}

include './skins/'.CORE::$SKINS.'/static/index.tpl';
// END FRONT-CONTROLLER
exit;
