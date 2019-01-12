<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Заголовок страницы</title>
	<meta name="description" content="Описание страницы">
	<meta name="keywords" content="Ключевые слова через запятую">
	<link href="/css/normalize.css" rel="stylesheet">
	<link href="/css/style.css" rel="stylesheet">
	<link rel="shortcut icon">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
	<script src="/js/script_main_v1.js"></script>
	<?php if(count(CORE::$CSS)) {echo implode("\n",CORE::$CSS);} ?>
	<?php if(!empty(CORE::$JS)) {echo '<script src="'.CORE::$JS.'"></script>'; } ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<header>
	<nav class="main-menu">
		<div class="logo clearfix"><a href="/" class="logo-link"></a></div>
		<div>
			<a href="/books" class="active"><span class="marker-active"></span>Books</a>
			<div class="drop-menu">
				<a href="<?php if(!isset($_SESSION['user'])) { echo '/static/history';} else { echo '/chat_room';} ?>"><?php if(!isset($_SESSION['user'])) { echo 'history';} else { echo 'chat';} ?></a>
				<a href="<?php if(!isset($_SESSION['user'])) { echo '/static/history';} else { echo '/cab/update';} ?>">stuff</a>
				<div class="drop-drop-menu">
					<a href="/news/main/1">news <span class="marker-2"></span></a>
					<div class="drop-menu-1">
						<a href="/user_javascript">Js-Dz</a>
						<a href="/static/history">archive</a>
					</div>
				</div>
			</div>
		</div>
		<a href="/comment" class="un-active"><span class="marker-un-active"></span>Comments</a>
		<a href="<?php if(!isset($_SESSION['user'])) { echo '/game';} else { echo '/admin';} ?>" class="un-active"><span class="marker-un-active"></span><?php if(!isset($_SESSION['user'])) { echo 'game'; } else {echo '*(For teacher)admin';} ?></a>
		<a href="<?php if(!isset($_SESSION['user'])) { echo '#';} else { echo '/static/history';} ?>" class="un-active" onclick="hide()" <?php if(!isset($_SESSION['user'])) { echo 'onclick="hide()"';}?>><span class="marker-un-active"></span><?php if(!isset($_SESSION['user'])) { echo 'login'; } else {echo 'History';} ?></a>
		<a href="<?php if(!isset($_SESSION['user'])) { echo '/cab';} else { echo '/cab/exit';}?>" class="un-active"><span class="marker-un-active"></span><?php if(!isset($_SESSION['user'])) { echo 'registation'; } else {echo 'exit';} ?></a>
	</nav>
</header>

<main class="main-content">
	<div class="content">
		<?php if(!isset($_SESSION['user'])) { ?>
			<div class="whitetext" id="modal-window">
				<form action="" method="post" onsubmit="return del()">
					<table>
						<tr>
							<td>Login*:</td>
							<td><input type="text" name="login" value="<?php if(isset($_POST['login'])) { spechar($_POST['login']);} ?>" ></td>
						</tr>
						<tr>
							<td>Password*:</td>
							<td><input type="password" name="pass" value="<?php if(isset($_POST['pass'])) {spechar($_POST['pass']);}  ?>" ></td>
						</tr>
					</table>
					<input type="submit" name="auth">
				</form>
			</div>
		<?php } ?>
		<?php
			echo $content;
		?>
	</div>
</main>
<footer>
	<div class="border-pic absolute-fix"></div>
	<?php
	$date = date('Y');
	if(CORE::$DATEOFCREATION == $date) {
		echo '<p>SAFARI PARK &copy; ' .CORE::$DATEOFCREATION. ' <a href="#">PRIVACY POLICY</a></p><div class="soc-media-link"><a href="https://www.facebook.com" class="sprite sprite-icon-1"></a><a href="https://twitter.com" class="sprite sprite-icon-2"></a></div>';
	} else {
		echo '<p>SAFARI PARK &copy;' .CORE::$DATEOFCREATION. - $date. ' <a href="#">PRIVACY POLICY</a></p><div class="soc-media-link"><a href="https://www.facebook.com" class="sprite sprite-icon-1"></a><a href="https://twitter.com" class="sprite sprite-icon-2"></a></div>';
	}
	?>
</footer>
</body>
</html>
