<div class="whitetext">
	<?php if(isset($info)) { ?>
		<h1><?=$info; ?></h1>
	<?php } ?>
	<form action="" method="post">
		<a href="/admin/news/add">Добавить новость</a>
		<?php while($row = $news->fetch_assoc()) {
			$row2 = q("
					SELECT `cat_name`
					FROM `news_cat`
					WHERE `id` = '".(int)$row['cat']."'
				");
			$res = $row2->fetch_assoc();
			$row2->close();
			?>
			<div class="news-box">
				<b>
					<input type="checkbox" name="ids[]" value="<?=$row['id']; ?>">
					<span class="red-text">
						<a href="/admin/news/main/delete/<?=$row['id']; ?>">Удалить </a>
						<a href="/admin/news/update/<?=$row['id']; ?>">Изменить :</a>
					</span>
					<a href="/admin/news/more/<?=$row['id'];?>">
						<?=spechar($row['header'])?>
					</a>
				</b>
				<br>
				<a href="/admin/news/more/<?=$row['id'];?>">Подробнее...</a>
				<hr>
			</div>
		<?php } ?>
		<input type="submit" name="delete">
	</form>
</div>
