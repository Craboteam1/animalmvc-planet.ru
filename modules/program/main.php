<?php
if(!isset($_GET['link'])) {
	$_GET['link'] = '';
}
$files = scandir('./modules/program'.$_GET['link']);



