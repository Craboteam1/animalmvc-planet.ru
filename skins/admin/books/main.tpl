<a href="/admin/books/add" class="button green">Добавить книгу </a>
<a href="/admin/books/addcat" class="button green">Добавить категорию </a>
<div class="books-main">
	<?php if(isset($info)) { ?>
		<h1><?=$info; ?></h1>
	<?php } ?>
	<?php if(isset($info1)) { ?>
		<h1><?=$info1; ?></h1>
	<?php } ?>
	<?php foreach($book as $item => $v) {  ?>
		<div class="book">
			<img src="<?php if(!empty($v['img'])){ echo $v['img']; } else { echo '/uploaded/no-img.png'; }?>" width="140" height="180">
			<a href="#"><?=spechar($v['name']);?></a><br>
			<span class="author"><?=spechar($v['author']);?></span><br>
			<span class="cost">
			Категория книги:<?php foreach($v['cat'] as $key => $value) {
					echo spechar($v['cat'][$key].',');
				}?><br>
			Цена: <?=(int)$v['cost']?> UAH
			<a href="/admin/books/update/<?=(int)$v['id'];?>" class="button">Редактировать книгу</a>
			<a href="/admin/books/main/delete/<?=(int)$v['id'];?>" class="button red">Удалить </a>
		</div>
	<?php } ?>
</div>