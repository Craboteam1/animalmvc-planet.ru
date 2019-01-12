<script type="text/javascript" src="/js/script_v1.js"></script>
<div class="whitetext">
	<!--
		<a href="#" onclick="hide('showme')" class="button" id="checked">Открыть модальное окно</a>
	<div id="showme">
		<h3>Привет, я первое модальное окно этого ученика!</h3>
		<a href="#" onclick="hide('showme')" class="close"></a>
	</div>
	-->
	<a href="#" onclick="show('registration-form')" class="button">Войти</a>
	<div id="registration-form">
		<form id="reg" action="" onsubmit="return del();">
			Логин: <input type="text" id="login" value=""> <br>
			Пароль: <input type="password" name="password"> <br>
			<input type="submit" name="submit" value="Зарегистрироваться">
		</form>
	</div>
</div>