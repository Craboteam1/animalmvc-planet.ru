<?php if(isset($_SESSION['user']) && $_SESSION['user']['access'] == 5) {?>

<div class="div-content">
	<h1>Главная страница</h1>
</div>
<?php } else { include './skins/default/cab/auth.tpl'; }?>