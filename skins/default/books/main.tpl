<div class="books-main">
	<?php if(isset($info)) { ?>
		<h1><?=$info; ?></h1>
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
		</span>
		<a href="/books/more/<?=(int)$v['id'];?>" class="button">Купить</a>
	</div>
<?php } ?>
</div>
<!-- Сначала запрос в ****_cat (Получаем id) -> Потом запрос ко второму чтобы получить ****_id где cat_id = id(Из прошлого запроса) -> 3-ий запрос в таблицу books SELECT * FROM `***` WHERE `id` IN (book_id;cat_id) -->