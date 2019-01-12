console.log('connected');
function hide() {
	var y = document.getElementById('modal-window');
	console.log('work');
	if(y.style.display == 'block') {
		console.log('worksss');
		y.style.display = 'none';
	} else {
		y.style.display = 'block';
	}
}

function del() {
	var l = document.getElementById('login');
	if (l.value.length < 5) {
		alert('Вы не заполнили поле Логин. Минимум шесть символов. Вы ввели ТОЛЬКО:'+ l.value.length+'') ;
		return false;
	} else {
		alert('Вы успешно вошли!') ;
		return true;
	}
}