function escapeHtml(text) {
	var map = {
		'&': '&amp;',
		'<': '&lt;',
		'>': '&gt;',
		'"': '&quot;',
		"'": '&#039;',
		')': '\)',
		'(': '\('
	};

	return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}
String.prototype.replaceArray = function(find, replace) {
	var replaceString = this;
	var regex;
	for (var i = 0; i < find.length; i++) {
		regex = new RegExp(find[i], "g");
		replaceString = replaceString.replace(regex, replace[i]);
	}

	return replaceString;
};
/*
var find = [name+',',"0_O", "T_T",":3",":D",':\\)',':\\('];
var replace = ['<span class="personal-message>"'+name+'</span>','<img src="/img/icons8-surprised-50.png">', '<img src="/img/icons8-crying-50.png">','<img src="/img/icons8-in-love-50.png">','<img src="/img/icons8-lol-50.png">','<img src="/img/icons8-happy-50.png">','<img src="/img/icons8-sad-50.png">'];
/*
textarea = textarea.replaceArray(find, replace);
alert(textarea);
*/

function deleteThis(id) { //DYNAMIC

	$.ajax({
		url: '/chat_room/update', // Обращение по УРЛ к какому-то файлу
		type: 'POST', // Каким способом передаем(Гет или Пост)
		cache: false, // Кеширование ответа(Запоминание, к примеру в чатах нужно использовать false)
		data: {id: id}, //Передача данных
		success: function (msg) {
			ids = 'mess_'+id;
			$('#'+ids).remove();
			var er = document.getElementById('error');
			er.style.display = 'block';
			er.innerHTML = 'Сообщение удалено.';
			setTimeout(function () {
				er.style.display = 'none';
			},7000);
			return false;
		}
	});
	return false;
}


function emoji(emoji) {
	var mess = document.getElementById('x');
	if(emoji == 'happy') {
		mess.value += ':)';
	}
	if(emoji == 'sad') {
		mess.value += ':(';
	}
	if(emoji == 'lol') {
		mess.value += ':D';
	}
	if(emoji == 'love') {
		mess.value += ':3';
	}
	if(emoji == 'cry') {
		mess.value += 'T_T';
	}
	if(emoji == 'wow') {
		mess.value += '0_O';
	}
}
function addressedTo(name) {
	var mess = document.getElementById('x');
	mess.value = name+', '+mess.value;
}
var isSending = 0;
function addMessage(name) {
	var x = document.getElementById('x').value; //Комментарий
	var y = document.getElementById('y'); // Name
	var z = y.style.color;
	if (isSending) {
		isSending = 1;
		return true;
	}
	if (x.length < 6) {
		var er = document.getElementById('error');
		er.style.display = 'block';
		er.innerHTML = 'В вашем сообщении столько же смысла, сколько и в вашей жизни';
		setTimeout(function () {
			er.style.display = 'none';
		},7000);
		return false;
	} else {

		$.ajax({
			url: '/chat_room/add', // Обращение по УРЛ к какому-то файлу
			type: 'POST', // Каким способом передаем(Гет или Пост)
			cache: false, // Кеширование ответа(Запоминание, к примеру в чатах нужно использовать false)
			data: {text: x, name: name, access: z}, //Передача данных
			success: function (msg) {
				if (msg !== 'no') {
					var response = JSON.parse(msg);
					isSending = 0;
					var find = [name+',',"0_O\s?", "T_T\s?",":3\s?",":D\s?",':\\)\s?',':\\(\s?'];
					var replace = ['<span class="personal-message">'+name+', </span>','<img src="/img/icons8-surprised-50.png">', '<img src="/img/icons8-crying-50.png">','<img src="/img/icons8-in-love-50.png">','<img src="/img/icons8-lol-50.png">','<img src="/img/icons8-happy-50.png">','<img src="/img/icons8-sad-50.png">'];
					var result = escapeHtml(x).replaceArray(find,replace);
					var div = document.createElement('div');
					div.id = 'mess_'+response[1].id;
					div.className = "messages";
					if(z == 'red'){
						div.innerHTML = '<div class="deleteThis" onclick="deleteThis('+response[1].id+')"><img src="/img/icons8-delete-filled-24.png" ></div> ' +
							'<span style="color:' + escapeHtml(z) + '" class="addressed" onclick="addressedTo(\''+escapeHtml(name)+'\')" id="access_'+response[1].id+'">' +
							escapeHtml(name) + ': </span>' +
							'<div id="text_'+response[1].id+'" class="text">' + result + '</div>' +
							'<div class="manage" onclick="openTab(\''+escapeHtml(name)+'\',\''+escapeHtml(z)+'\',\''+escapeHtml(x)+'\','+escapeHtml(response[1].id)+')"><img src="/img/icons8-redact-50.png">' +
							'</div> <br>';
					} else {
						div.innerHTML = '<span style="color:' + escapeHtml(z) + '" class="addressed" onclick="addressedTo(\''+escapeHtml(name)+'\')" id="access_'+response[1].id+'">' +
							escapeHtml(name) + ': </span><div id="text_'+response[1].id+'" class="text">' + result + '</div><br>';
					}
					var parentElem = document.getElementById('chat');
					parentElem.insertBefore(div, document.getElementById('chat').firstChild);
					$('form textarea').val('');
				}
			},
			error: function () {
				isSending = 0;
				return false;
			}
		});
		return false;
	}
}
/*
function deleteMess(id) {
		$('#mess').remove();
}
*/
function manageThis(id,name) {
	var text = document.getElementById('new-message').value;
	if (text.length < 6) {
		var er = document.getElementById('error');
		er.style.display = 'block';
		er.innerHTML = 'В вашем сообщении столько же смысла, сколько и в вашей жизни';
		setTimeout(function () {
			er.style.display = 'none';
		},7000);
		return false;
	} else {
	$.ajax({
		url: '/chat_room/manage', // Обращение по УРЛ к какому-то файлу
		type: 'POST', // Каким способом передаем(Гет или Пост)
		cache: false, // Кеширование ответа(Запоминание, к примеру в чатах нужно использовать false)
		data: {id: id,text: text, user: name}, //Передача данных
		success: function (msg) {
			var find = [current_user_name+',',"0_O\s?", "T_T\s?",":3\s?",":D\s?",':\\)\s?',':\\(\s?'];
			var replace = ['<span class="personal-message">'+current_user_name+', </span>','<img src="/img/icons8-surprised-50.png">', '<img src="/img/icons8-crying-50.png">','<img src="/img/icons8-in-love-50.png">','<img src="/img/icons8-lol-50.png">','<img src="/img/icons8-happy-50.png">','<img src="/img/icons8-sad-50.png">'];
			var result = escapeHtml(text).replaceArray(find,replace);
			var object = document.getElementById('text_'+id);
			object.innerHTML = result;
			var er = document.getElementById('error');
			er.style.display = 'block';
			er.innerHTML = 'Сообщение изменено.';
			document.getElementById("new-message").value = "";
			var close_object = document.getElementById('manage');
			close_object.style.display = 'none';
			setTimeout(function () {
				er.style.display = 'none';
			},7000);
			return false;
		}
	});
	return false;
}
}

function openTab(user,access,msg,id) {
	var elem = document.getElementById('manage');
	if(elem.style.display == 'none') {
		var find = ["0_O\s?", "T_T\s?",":3\s?",":D\s?",':\\)\s?',':\\(\s?'];
		var replace = ['<img src="/img/icons8-surprised-50.png">', '<img src="/img/icons8-crying-50.png">','<img src="/img/icons8-in-love-50.png">','<img src="/img/icons8-lol-50.png">','<img src="/img/icons8-happy-50.png">','<img src="/img/icons8-sad-50.png">'];
		var result = escapeHtml(msg).replaceArray(find,replace);
		var mess = document.getElementById('user-message');
		elem.style.display = 'block';
		mess.innerHTML = '<span style="color:'+escapeHtml(access)+'" id="id">' +
			escapeHtml(user) + ': </span>' + result + '<br>' +
			'<button class="button position" onclick="manageThis('+escapeHtml(id)+',\''+escapeHtml(user)+'\')">Edit';
	} else {
		elem.style.display = 'none';
	}
}

window.onload = function() {
	if (user_access == 5) {
		var timer_Id = setTimeout(function checkComment() {
			$.ajax({
				url: '/chat_room/check', // Обращение по УРЛ к какому-то файлу
				type: 'POST', // Каким способом передаем(Гет или Пост)
				cache: false, // Кеширование ответа(Запоминание, к примеру в чатах нужно использовать false)
				data: {id: last_comm_id, logs_id:last_log_id}, //Передача данных
				success: function (msg) {
					if (msg !== 'no') {
						var response = JSON.parse(msg);

						for (var key in response.new) {
							if (response.new) {
								last_comm_id = response.new[key].id;
								var find = [current_user_name+',',"0_O\s?", "T_T\s?",":3\s?",":D\s?",':\\)\s?',':\\(\s?'];
								var replace = ['<span class="personal-message">'+current_user_name+', </span>','<img src="/img/icons8-surprised-50.png">', '<img src="/img/icons8-crying-50.png">','<img src="/img/icons8-in-love-50.png">','<img src="/img/icons8-lol-50.png">','<img src="/img/icons8-happy-50.png">','<img src="/img/icons8-sad-50.png">'];
								var result = escapeHtml(response.new[key].text).replaceArray(find,replace);
								var div = document.createElement('div');
								div.className = "messages";
								div.id = 'mess_' + response.new[key].id;
								div.innerHTML = '<div class="deleteThis" onclick="deleteThis(' + escapeHtml(response.new[key].id) + ')"><img src="/img/icons8-delete-filled-24.png" ></div> ' +
									'<span style="color:' + escapeHtml(response.new[key].access) + '" ' +
									'onclick="addressedTo(\'' + escapeHtml(response.new[key].name) + '\')" id="access_' + response.new[key].id + '">' +
									escapeHtml(response.new[key].name) + ': </span>' +
									'<div id="text_' + response.new[key].id + '" class="text">' + result + '</div>' +
									'<div class="manage" onclick="openTab(\'' + escapeHtml(response.new[key].name) + '\',\'' + escapeHtml(response.new[key].access) + '\',\'' + escapeHtml(response.new[key].text) + '\',' + escapeHtml(response.new[key].id) + ')">' +
									'<img src="/img/icons8-redact-50.png">' +
									'</div> <br>';
								var parentElem = document.getElementById('chat');
								parentElem.insertBefore(div, document.getElementById('chat').firstChild);
							} else {
								console.log('There is no new messages');
							}
						}
						for (var key1 in response.logs) {
							last_log_id = response.logs[key1].id;
							if (response.logs[key1].action == 'delete') {
								var ids1 = 'mess_' + response.logs[key1].parent;
								$('#' + ids1).remove();
							} else if (response.logs[key1].action == 'manage') {
								var find_change = [current_user_name+',',"0_O\s?", "T_T\s?",":3\s?",":D\s?",':\\)\s?',':\\(\s?'];
								var replace_change = ['<span class="personal-message">'+current_user_name+', </span>','<img src="/img/icons8-surprised-50.png">', '<img src="/img/icons8-crying-50.png">','<img src="/img/icons8-in-love-50.png">','<img src="/img/icons8-lol-50.png">','<img src="/img/icons8-happy-50.png">','<img src="/img/icons8-sad-50.png">'];
								var result_change = escapeHtml(response.logs[key1].managed_text).replaceArray(find_change,replace_change);
								var object = document.getElementById('text_'+response.logs[key1].parent);
								console.log(typeof object);
								if (result_change != null && object != null) {
									object.innerHTML = result_change;
								}
							}
						}
					} else {

					}
				},
			});
			timer_Id = setTimeout(checkComment, 5000);
		}, 5000);
		var timer_Id_1 = setTimeout(function checkUser() {
			$.ajax({
				url: '/chat_room/online_check', // Обращение по УРЛ к какому-то файлу
				type: 'POST', // Каким способом передаем(Гет или Пост)
				cache: false, // Кеширование ответа(Запоминание, к примеру в чатах нужно использовать false)
				data: {}, //Передача данных
				success: function (msg) {
					if (msg) {
						var parentElem = document.getElementById('users-online');
						parentElem.innerHTML = '';
						var response = JSON.parse(msg);
						for (var key in response) {
							if (response[key].access == 5 || response[key].access == 4) {
								color = 'red';
							} else {
								color = 'blue';
							}
							if (response[key].access == 5 || response[key].access == 4) {
								src = '/img/moderator-icon.png';
							} else {
								src = '/img/user-icon.png';
							}

							var div = document.createElement('div');
							div.id = response[key].id;
							div.className = "user";
							div.innerHTML = '<span style="color:' + color + '" class="addressed" onclick="addressedTo(\'' + escapeHtml(response[key].login) + '\')">' +
								escapeHtml(response[key].login) + ' </span> <img src="' + src + '">  ' +
								'<br>';
							parentElem.insertBefore(div, document.getElementById('users-online').firstChild);
						}
					} else {
						return false;
					}
				},
			});
			timer_Id_1 = setTimeout(checkUser, 25000);
		}, 5000);
	} else {
		var timerId = setTimeout(function checkComment() {
			$.ajax({
				url: '/chat_room/check', // Обращение по УРЛ к какому-то файлу
				type: 'POST', // Каким способом передаем(Гет или Пост)
				cache: false, // Кеширование ответа(Запоминание, к примеру в чатах нужно использовать false)
				data: {id: last_comm_id, logs_id:last_log_id}, //Передача данных
				success: function (msg) {
					if (msg !== 'no') {
						var response = JSON.parse(msg);
						for (var key in response.new) {
							if (response.new[key].id) {
								last_comm_id = response.new[key].id;

								var find = [current_user_name+',',"0_O\s?", "T_T\s?",":3\s?",":D\s?",':\\)\s?',':\\(\s?'];
								var replace = ['<span class="personal-message">'+current_user_name+', </span>','<img src="/img/icons8-surprised-50.png">', '<img src="/img/icons8-crying-50.png">','<img src="/img/icons8-in-love-50.png">','<img src="/img/icons8-lol-50.png">','<img src="/img/icons8-happy-50.png">','<img src="/img/icons8-sad-50.png">'];
								var result = escapeHtml(response.new[key].text).replaceArray(find,replace);
								var div = document.createElement('div');
								div.className = "messages";
								div.id = 'mess_' + response.new[key].id;
								div.innerHTML = '<span style="color:' + escapeHtml(response.new[key].access) + '" ' +
									'onclick="addressedTo(\'' + escapeHtml(response.new[key].name) + '\')" id="access_' + escapeHtml(response.new[key].id) + '">' + escapeHtml(response.new[key].name) + ': </span>' +
									'<div id="text_' + escapeHtml(response.new[key].id) + '" class="text">' + result + '</div>' +
									'</div> <br>';
								var parentElem = document.getElementById('chat');
								parentElem.insertBefore(div, document.getElementById('chat').firstChild);
							} else {
								console.log('There is no new messages');
							}
						}
						for (var key1 in response.logs) {
							last_log_id = response.logs[key1].id;
							if (response.logs[key1].action == 'delete') {
								var ids1 = 'mess_' + response.logs[key1].parent;
								$('#' + ids1).remove();
							} else {

								var find_change = [current_user_name+',',"0_O\s?", "T_T\s?",":3\s?",":D\s?",':\\)\s?',':\\(\s?'];
								var replace_change = ['<span class="personal-message">'+current_user_name+', </span>','<img src="/img/icons8-surprised-50.png">', '<img src="/img/icons8-crying-50.png">','<img src="/img/icons8-in-love-50.png">','<img src="/img/icons8-lol-50.png">','<img src="/img/icons8-happy-50.png">','<img src="/img/icons8-sad-50.png">'];
								var result_change = escapeHtml(response.logs[key1].managed_text).replaceArray(find_change,replace_change);
								var object = document.getElementById('text_' + response.logs[key1].parent);
								if(result_change != null) {
									object.innerHTML = result_change;
								}
							}
						}
					} else {

					}
				},
			});
			timerId = setTimeout(checkComment, 5000);
		}, 5000);
		var timerId_1 = setTimeout(function checkUser() {
			$.ajax({
				url: '/chat_room/online_check', // Обращение по УРЛ к какому-то файлу
				type: 'POST', // Каким способом передаем(Гет или Пост)
				cache: false, // Кеширование ответа(Запоминание, к примеру в чатах нужно использовать false)
				data: {}, //Передача данных
				success: function (msg) {
					if (msg) {
						var parentElem = document.getElementById('users-online');
						parentElem.innerHTML = '';
						var response = JSON.parse(msg);
						for (var key in response) {
							if (response[key].access == 5 || response[key].access == 4) {
								color = 'red';
							} else {
								color = 'blue';
							}
							if (response[key].access == 5 || response[key].access == 4) {
								src = '/img/moderator-icon.png';
							} else {
								src = '/img/user-icon.png';
							}

							var div = document.createElement('div');
							div.id = response[key].id;
							div.className = "user";
							div.innerHTML = '<span style="color:' + color + '" class="addressed" onclick="addressedTo(\'' + escapeHtml(response[key].login) + '\')">' +
								escapeHtml(response[key].login) + ' </span> <img src="' + src + '">  ' +
								'<br>';
							parentElem.insertBefore(div, document.getElementById('users-online').firstChild);
						}
					} else {
						return false;
					}
				},
			});
			timerId_1 = setTimeout(checkUser, 25000);
		}, 5000);
	}
};
/*
function imgCreate(src) {
	var img = document.createElement('img');
	img.style.src = src;
	var parentElem = document.getElementById('users-online');
	parentElem.insertBefore(img,document.getElementById('users-online').firstChild);
}
*/