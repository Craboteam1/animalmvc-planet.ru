<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Заголовок страницы</title>
	<meta name="description" content="Описание страницы">
	<meta name="keywords" content="Ключевые слова через запятую">
	<link href="./css/normalize.css" rel="stylesheet">
	<link href="/skins/admin/static/css/style.css" rel="stylesheet">
	<?php if(count(CORE::$CSS)) {echo implode("\n",CORE::$CSS);} ?>
	<?php if(!empty(CORE::$JS)) {echo '<script src="'.CORE::$JS.'"></script>'; } ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<?php if(isset($_SESSION['user']) && $_SESSION['user']['access'] == 5) { ?>
<header>
	<nav class="main-menu">
		<div class="logo clearfix"><a href="/" class="logo-link"></a></div>
		<div>
			<a href="/" class="active">на главную</a>
			<div class="drop-menu">
				<a href="/admin/static">text</a>
				<a href="/admin/static">s text</a>
				<div class="drop-drop-menu">
					<a href="/admin/static">s text</a>
					<div class="drop-menu-1">
						<a href="/admin/static">s text</a>
						<a href="/admin/static">sample text</a>
					</div>
				</div>
			</div>
		</div>
		<a href="/admin/goods" class="un-active">Goods</a>
		<a href="/admin/users" class="un-active">users</a>
		<a href="/admin/news" class="un-active">News</a>
		<a href="/admin/books">books</a>
	</nav>
</header>
<?php } ?>
<main class="whitetext">
	<?php
		echo $content;
	?>
</main>
<footer>
	<div class="border-pic absolute-fix"></div>
	<p>2018 Craboteam1.CMS &copy;</p>
</footer>
</body>
</html>
