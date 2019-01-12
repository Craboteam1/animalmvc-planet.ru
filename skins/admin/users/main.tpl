<h1><?php echo @$info; ?></h1>
<p class="header-text">Пользователи:</p>

<form method="post">
	<div class="search-box">
		Поиск: <input type="text" name="search">
		<input type="submit" name="OK" value="Найти">
	</div>
</form>
<?php if(isset($_POST['OK'])) {?>
	<?php while($row = mysqli_fetch_assoc($res)) {?>
		<div class="found-box">
			Совпадения по запросу:
			<b>
				<?=(int)($row['id'])?>.
				Login: <?=spechar($row['login']);?>
			</b>
			<span class="redtext">
				<a href="/admin/users/update/<?=(int)($row['id'])?>">Редактировать</a>
				<a href="/admin/users/main/delete/<?=$row['id']; ?>">Удалить </a>
			</span>
			<hr>
		</div>
	<?php }  ?>
<?php } else { ?>

<?php while($row = mysqli_fetch_assoc($users)) {?>
	<div>
		<b>
			<?=(int)($row['id'])?>.
			Login: <?=spechar($row['login']);?>
		</b>
		<span class="redtext">
			<a href="/admin/users/update/<?=(int)($row['id'])?>">Редактировать</a>
			<a href="/admin/users/main/delete/<?=$row['id']; ?>">Удалить </a>
		</span>
		<hr>
	</div>
<?php } ?>
<?php } ?>
