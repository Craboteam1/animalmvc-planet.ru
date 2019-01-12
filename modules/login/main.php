<?php
if(isset($_POST['login'], $_POST['pass'], $_POST['email'])) {
	if(isset($_POST['submit-auto']) && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
		setcookie('access',1);
		setcookie('login',$_POST['login'],time()+3600,'/');
		setcookie('password',$_POST['pass'],time()+3600,'/');
		setcookie('email',$_POST['email'],time()+3600,'/');
		header("Location: /login");
		exit();
	}

	if(isset($_POST['exit'])) {
		setcookie('access', 0);
		setcookie('login',$_POST['login'],time()-3600,'/');
		setcookie('password',$_POST['pass'],time()-3600,'/');
		setcookie('email',$_POST['email'],time()-3600,'/');
		header("Location: /login");
		exit();
	}
}
