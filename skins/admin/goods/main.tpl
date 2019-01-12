<div class="whitetext">
	<?php if(isset($info)) { ?>
		<h1><?=$info; ?></h1>
	<?php } ?>
	<?php if(isset($info1)) { ?>
		<h2><?=$info1; ?></h2>
	<?php } ?>
	<a href="/admin/goods/add">Добавить товар</a>
	<form action="" method="post">

	<?php while($row = mysqli_fetch_assoc($goods)) {	 ?>
		<img src="<?php if(!empty($row['img'])){ echo $row['img']; } else { echo '/uploaded/no-img.png'; }?>">
		<div>
			<b>
				<input type="checkbox" name="ids[]" value="<?=$row['id']; ?>">
				<a href="/admin/goods/main/delete/<?=$row['id']; ?>">Удалить </a>
				<a href="/admin/goods/update/<?=$row['id']; ?>">Изменить</a>
				<?=spechar($row['name']);?>
				<?php
				if($row['item'] > 0) {
					echo '<span class="greentext">Есть в наличии!</span>';
				} else {
					echo '<span class="redtext">Нету в наличии!</span>';
				}
				?>
				<span class="spanwhitetext"><?=$row['date'];?></span>
			</b>
			<hr>
		</div>
	<?php } ?>
		<input type="submit" name="delete">
	</form>
</div>

