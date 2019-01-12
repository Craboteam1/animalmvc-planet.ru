function escapeHtml(text) {
	var map = {
		'&': '&amp;',
		'<': '&lt;',
		'>': '&gt;',
		'"': '&quot;',
		"'": '&#039;'
	};

	return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

function Appearance() {
	var x = document.getElementById('window');
	$('form input[type="text"], form input[type="password"], form textarea').val('');
	if(x.style.display === 'none') {
		x.style.display = 'block';
	} else {
		x.style.display = 'none';
	}
}

function count_second() {
	document.getElementById('window').style.display = 'block';
	setTimeout(function(){Appearance()},900);
}
var isSending = 0;
function addComment() {
	var x = document.getElementById('x').value; //Заголовок
	var y = document.getElementById('y').value; //Емейл
	var z = document.getElementById('z').value; //Тема
	var t = document.getElementById('t').value; //Комментарий
	if(isSending) {
		isSending = 1;
		return true;
	}
	$.ajax({
		url: '/comment/add', // Обращение по УРЛ к какому-то файлу
		type: 'POST', // Каким способом передаем(Гет или Пост)
		cache: false, // Кеширование ответа(Запоминание, к примеру в чатах нужно использовать false)
		data: {name: x, email: y, theme: z, text: t}, //Передача данных
		success: function (msg) {
			if (msg !== 'no') {
				isSending = 0;
				var div = document.createElement('div');
				div.className = "comment";
				div.innerHTML = "Заголовок: " + escapeHtml(x) + "\n" +
					"\t\t\t\t\t<br>Тема: " + escapeHtml(z) + "\n" +
					"\t\t\t\t\t<br>Комментарий: " + escapeHtml(t) + " \n" +
					"\t\t\t\t\t<br>";
				var parentElem = document.getElementById('comment');
				parentElem.insertBefore(div,document.getElementById('comment').firstChild);
				$('form input[type="text"],  form textarea').val('');
			}
		},
		error: function () {
			isSending = 0;
			return false;
		}
	});
	return false;
}
/*
function checkComment() {
	var id = document.getElementById('hide').innerHTML;
$.ajax({
	url: '/comment/check', // Обращение по УРЛ к какому-то файлу
	type: 'POST', // Каким способом передаем(Гет или Пост)
	cache: false, // Кеширование ответа(Запоминание, к примеру в чатах нужно использовать false)
	//Передача данных
	success: function (msg) {
		if (msg !== 'no') {
			var response = JSON.parse(msg);
			for (var key in response) {
				last_comm_id = response[key].id;
				var div = document.createElement('div');
				div.className = "comment";
				div.innerHTML = "Заголовок: " + escapeHtml(response[key].name) + "\n" +
					"\t\t\t\t\t<br>Тема: " + escapeHtml(response[key].theme) + "\n" +
					"\t\t\t\t\t<br>Комментарий: " + escapeHtml(response[key].text) + " \n" +
					"\t\t\t\t\t<br>";
				var parentElem = document.getElementById('comment');
				parentElem.insertBefore(div,document.getElementById('comment').firstChild);
			}
		}
	},
	data: { id: id },
});
}


function  myAjax() {
	$.ajax({
		url: '/comment/add', // Обращение по УРЛ к какому-то файлу
		type: 'POST', // Каким способом передаем(Гет или Пост)
		cache: false, // Кеширование ответа(Запоминание, к примеру в чатах нужно использовать false)
		data: {key1: 'value1', key2: 'value2'}, //Передача данных
		success: function (msg) {
			if (msg !== 'no') {
				var response = JSON.parse(msg);

				for (var key in response) {
					var div = document.createElement('div');
					div.className = "comment";
					div.innerHTML = "Заголовок: " + escapeHtml(response[key].name) + "\n" +
						"\t\t\t\t\t<br>Тема: " + escapeHtml(response[key].theme) + "\n" +
						"\t\t\t\t\t<br>Комментарий: " + escapeHtml(response[key].text) + " \n" +
						"\t\t\t\t\t<br>";
					var parentElem = document.getElementById('comment');
					parentElem.appendChild(div);
					var nowtime = new Date().getTime();
					$('#comment').attr('data-time', nowtime);
				}
			} else {
				return false;
			}
		},
	});
}

*/