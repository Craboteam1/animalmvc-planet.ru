<div class="books-main">
	<?php if(isset($info)) { ?>
		<h1><?=$info; ?></h1>
	<?php } ?>
	<img src="<?php if(!empty($book[$_GET['key1']]['img'])){ echo $book[$_GET['key1']]['img']; } else { echo '/uploaded/no-img.png'; }?>" width="140" height="180">
	<div class="book-more">
		<a href="#"><?=spechar($book[$_GET['key1']]['name']);?></a><br>
		<span class="author"><?=spechar($book[$_GET['key1']]['author']);?></span><br>
		<span class="cost">
		Категория книги: <?php foreach($book[$_GET['key1']]['cat'] as $key => $value) {
				echo spechar($book[$_GET['key1']]['cat'][$key].',');
			}?><br>
		Цена: <?=(int)$book[$_GET['key1']]['cost']?> UAH
	</span>
		<h2>Аннотация\Описание к книге:</h2>
		<p><?=spechar($book[$_GET['key1']]['about']);?></p>
	<h2>Книги того же автора:</h2>
<?php if(mysqli_num_rows($similar)) { ?>
	<?php while($row3 = $similar->fetch_assoc() ) { ?>
		<div class="book">
			<img src="<?php if(!empty($row3['img'])){ echo $row3['img']; } else { echo '/uploaded/no-img.png'; }?>" width="140" height="180">
			<a href="#"><?=spechar($row3['name']);?></a><br>
			<span class="author"><?=spechar($row3['author']);?></span><br>
			<span class="cost">
				Цена: <?=(int)$row3['cost']?> UAH
			</span>
			<a href="/books/more/<?=spechar($row3['id']);?>" class="button">Купить</a>
		</div>
	<?php } ?>
<?php } else {?>
	У этого автора больше нету книг!
<?php } ?>
	</div>
</div>