<?php

if(!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) {
	if($_GET['route'] != 'admin')  {
		header("Location: /admin");
		exit();
	}
}