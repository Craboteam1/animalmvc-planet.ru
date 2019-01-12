<?php
class Mail {
	static $subject = 'Default';
	static $from = 'admin@craboteam1.school-php.com';
	static $to = 'gengigh@gmail.com';
	static $text = 'Sample text';
	static $headers = '';

	static function testMail() { // Проверка работы писем
		if(mail(self::$to, 'English words', 'english words')) {
			echo 'Mail sent';
		}
		else {
			echo 'Mail is not send';
		}
		exit();
	}

	static function send() {
		self::$subject = '=?utf-8?b?'.base64_encode(self::$subject).'?=';
		self::$headers = "Content-type: text/html; charset=\"utf-8\"\r\n";
		self::$headers = "From: ".self::$from."\r\n";
		self::$headers = "MIME-Version: 1.0\r\n";
		self::$headers = "Date: ".date('D, d M Y h:i:s O')."\r\n";
		self::$headers = "Precedence: bulk\r\n";

		return mail(self::$to, self::$subject, self::$text, self::$headers);
	}
}
