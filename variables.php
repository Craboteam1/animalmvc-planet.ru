<?php$allowed = array('activate','main','history','specialoffers','goods','add','update','auth','exit','allpages','404','more','addcat','check','online_check','execute','manage'); //PHP$allowedphpfiles = array('game','errors','admin','cab','login','program','comment','goods','allpages','main','users','static','books','user_javascript','chat_room'); //DIRECTORIESif(!isset($_GET['module'])) {	$_GET['module'] = 'static';} else {	$res = q("		SELECT *		FROM `pages`		WHERE `module` = '".es($_GET['module'])."'		LIMIT 1	");	if(!$res->num_rows) {		header("Location: /errors/404");		exit();	} else {		$staticpage = $res->fetch_asoc();		$res->close();		if($staticpage['static'] == 0) {			$_GET['module'] = 'staticpage';			$_GET['page'] = 'main';		}	}}if(isset($_GET['route'])) {	$temp = explode('/',$_GET['route']);	if($temp[0] == 'admin') {		CORE::$CONT = CORE::$CONT.'/admin';		CORE::$SKINS = 'admin';		unset($temp[0]);	}	$i = 0;	foreach($temp as $k=>$v) {		if($i == 0) {			if(!empty($v)) {				$_GET['module'] = $v;			}		} elseif($i == 1) {			if(!empty($v)) {				$_GET['page'] = $v;			}		} else {			$_GET['key'.($k-1)] = $v;		}		++$i;	}}if(!isset($_GET['page'])) {	$_GET['page'] = 'main';}if(!in_array($_GET['page'],$allowed)) {	header("Location: /errors/404");	exit();}/*if(!isset($_GET['module'])) {	$_GET['module'] = 'static';} elseif(!in_array($_GET['module'], $allowedphpfiles) && CORE::$SKINS != 'admin') {	header("Location: /errors/404");	exit();}*/if(isset($_POST)) {	$_POST = trimALL($_POST);}