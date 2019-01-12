<form action="" method="post">
	<div class="left-side">
		<input type="checkbox" name="cat[1]" value="1" >О Науке
		<input type="checkbox" name="cat[2]" value="2" >Криминал
		<input type="checkbox" name="cat[3]" value="3" >Политичиские
		<input type="submit" name="submit" value="Выбрать категорию">
	</div>
	<div class="whitetext">
		<?php if(isset($info)) { ?>
			<h1><?=$info; ?></h1>
		<?php } ?>

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
					<a href="/news/more/<?=$row['id'];?>">
					<?=spechar($row['header'])?>
					</a>
				</b>
				<br>
					Категория: <?=spechar($res['cat_name']);?>
				<p>
					<?=spechar($row['description']) ?>
				</p>
				<span class="spanwhitetext clearfix"><?=$row['date'];?></span> <br>
				<a href="/news/more/<?=$row['id'];?>">Подробнее...</a>
				<hr>
			</div>
		<?php } ?>
		<div class="paginator">
			<?php
			if(isset($page2left)) {
				echo $page2left;
			}
			if(isset($page1left)) {
				echo $page1left;
			}
			if(isset($page)) {
				echo '<span class="checked">'.$page.'</span>';
			}
			if(isset($page1right)) {
				echo $page1right;
			}
			if(isset($page2right)) {
				echo $page2right;
			}
			?>
			<?php
			/*
			echo $page2left.$page1left.'<span class="checked">'.$page.'</span>'.$page1right.$page2right;
			*/
			?>
		</div>
	</div>
</form>