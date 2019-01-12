<div class="whitetext">
	<?php if(isset($info)) { ?>
		<h1><?=$info; ?></h1>
	<?php } ?>
	<form action="" method="post">

	<?php while($row = $goods->fetch_assoc()) {	 ?>
		<img src="<?php if(!empty($row['img'])){ echo $row['img']; } else { echo '/uploaded/20180920-220359img8722846.jpg'; }?>">
				<div class="good-box">
					<b>
						<?=(int)($row['id'])?>.
						<?=spechar($row['name']);?>
						<?php
						if($row['item'] > 0) {
							echo '<span class="greentext">Есть в наличии!</span>';
						} else {
							echo '<span class="redtext">Нету в наличии!</span>';
						}
						?>
						<span class="spanwhitetext"><?=$row['date'];?></span> <br>
					</b>
						Описание: <?=es($row['description']) ?> <br>
						Цена: <span class="cost"> <?=(int)$row['cost'] ?> UAH </span>
					<hr>
				</div>
	<?php } ?>
	</form>
</div>

<!-- -->