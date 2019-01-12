<?php
class Upl {
	static $name = '';
	static $error = '';
	static function upload($uploadarray) {
		$array = ['image/gif', 'image/jpeg', 'image/png'];
		$array2 = ['jpg', 'jpeg', 'gif', 'png'];
		if($uploadarray['file']['error'] == 0) {
			if( $uploadarray['file']['size'] > 6000000000) {
				self::$error = 'Размер изображения нам не подходит.';
				return false;
			}
			// На белую страницу
			else {
				preg_match('#\.([a-z]+)$#ui', $uploadarray['file']['name'], $matches);
				if(isset($matches[1])) {
					$matches[1] = mb_strtolower($matches[1]);
					$temp = getimagesize($uploadarray['file']['tmp_name']);

					self::$name = '/uploaded/'.date('Ymd-His').'img'.rand(10000, 9999999).$matches[0];

					if(!in_array($matches[1], $array2)) {
						self::$error = 'Не подходит расширение изображения';
						return false;
					}
					elseif(!in_array($temp['mime'], $array)) {
						self::$error = 'Не подходит тип файла, можно загружать изображения';
						return false;
					}
					elseif(!move_uploaded_file($uploadarray['file']['tmp_name'], '.'.self::$name)) {
						self::$error = 'Изображение не загружено! Ошибка';

						return false;
					}
					else {
						$error = 'OK';
					}
				} else {
					self::$error = 'Данный файл не является картинкой. Принимаемые типы файлов: jpg, gif, png';

					return false;
				}
			}
		}
		return true;
	}
	static  function resize($width,$height) {
		/*
		$width = 100;
		$height = 100;
		*/
		$temp = getimagesize('.'.Upl::$name);

		list($width_orig, $height_orig) = getimagesize('.'.Upl::$name);

		if($width && ($width_orig < $height_orig)) {
			$width = ($height / $height_orig) * $width_orig;
		} else {
			$height = ($width / $width_orig) * $height_orig;
		}
		$image_p = imagecreatetruecolor($width, $height);
		if($temp['mime'] == 'image/jpeg') {
			$image = imagecreatefromjpeg('.'.Upl::$name);
		} elseif($temp['mime'] == 'image/png') {
			$image = imagecreatefrompng('.'.Upl::$name);
		} elseif($temp['mime'] == 'image/gif') {
			$image = imagecreatefromgif('.'.Upl::$name);
		}

		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
		imagejpeg($image_p, '.'.Upl::$name, 100);
	}
}