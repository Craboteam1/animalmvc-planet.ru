console.log('Script have been loaded successfully!');
function hide(x) {
	var y = document.getElementById(x);
	var z = document.getElementById('checked');
	if(y.style.display == 'block') {
		z.innerHTML = 'Открыть модальное окно';
		y.style.display = 'none';
		document.body.style.background = '';
	} else {
		z.innerHTML = 'Закрыть модальное окно';
		y.style.display = 'block';
		document.body.style.background = 'rgba(0, 0, 0, 0.2)';
	}
}
function show(x) {
	var y = document.getElementById(x);
	if(y.style.display == 'block') {
		y.style.display = 'none';
		} else {
		y.style.display = 'block';
		document.body.style.top = '';
	}

}
function del() {
	var l = document.getElementById('login');
	if (l.value.length < 5) {
		alert('Вы не заполнили поле Логин. Минимум шесть символов. Вы ввели ТОЛЬКО:'+ l.value.length+'') ;
		return false;
	} else {
		alert('Форма успешно отправлена!') ;
		return true;
	}
}