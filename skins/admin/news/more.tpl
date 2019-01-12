<div class="whitetext">
	<h3><?=spechar($row['header']);?></h3>
	<span class="left-side "> Категория: <?=spechar($res['cat_name']);?></span>
	<br>
	<p><?=nl2br(spechar($row['text']));?></p>
	<span class="spanwhitetext clearfix left-side"><?=$row['date'];?></span> <br>
</div>