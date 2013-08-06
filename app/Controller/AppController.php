<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	protected $db_name = 'test';
	protected $honour_collection = 'honour';
	protected $signup_collection = 'signup';
	protected $pic_collection = 'pics';
	protected $album_collection = 'album';
	protected $album_category_collection = 'albumCategory';
	protected $teacher_collection = 'teacher';
	protected $article_collection = 'article';
	protected $grid_db = "pic";
	protected $grid_db_file = "fs.files";
	protected $grid_base_url = "http://localhost:4444/gridfs/";
	protected $max_small_pic_size = 300;

	protected function get_connection()
	{
		$port = 27017;
		$mongo_url = "localhost";
		$mongo_host = "mongodb://$mongo_url:$port";
		return new MongoClient($mongo_host);
	}

	protected function starts_with($haystack, $needle)
	{
		$length = strlen($needle);
		return (substr($haystack, 0, $length) === $needle);
	}

	protected function ends_with($haystack, $needle)
	{
		$length = strlen($needle);
		if ($length == 0) {
			return true;
		}   
		return (substr($haystack, -$length) === $needle);
	}

	protected function get_collection($db_name, $collection)
	{
		// connect
		$connection = $this->get_connection();

		// select a database
		$db = $connection->selectDB($db_name);

		// select a collection (analogous to a relational database's table)
		return $db->$collection;
	}

	/**
	 * Get the value of the name from the request _GET | _POST
	 * Set status to 400 if no value is find and the default value is null
	 * 
	 * @param $name
	 * @param $default The default value of the $name
	 * @return $value
	 **/
	protected function _get_argument($name, $default = null) {
		$values = $this->_get_arguments($name);
		$len = count($values);
		if ( 0 < $len ) {
			return $values[$len - 1];
		}
		if (null == $default) {
			echo "can't find $name";
			$this->_setStatusAndExit(400);
		}
		return $default;
	}

	protected function _get_arguments($name)
	{
		$values = array();
		if ( isset($_GET[$name]))
		{
			$values[] = $_GET[$name];
		}
		if ( isset($_POST[$name]))
		{
			$values[] = $_POST[$name];
		}
		return $values;
	}

	protected function _setStatusAndExit($code) {
		$this->response->statusCode($code);
		$this->response->send();
		exit(); 
	}

	protected function get_grid_fs()
	{
		$connection = $this->get_connection();
		$db = $connection->selectDB($this->grid_db); // Connect to Database
		return $db->getGridFS();
	}

	protected function get_file_url($file_name)
	{
		return $this->grid_base_url . $file_name;
	}

	protected function copyAlbum($album)
	{
		$al = array();
		$al['id'] = $album['_id'];
		$al['desc'] = $album['desc'];
		$al['title'] = $album['title'];
		if (isset($album['cover'])) {
			$cover_id = $album['cover'];
			$al['cover']['large'] = $album['images'][$cover_id]['large'];
			$al['cover']['small'] = $album['images'][$cover_id]['small'];
		}
		$images = array();
		$al['image_num'] = 0;
		if (isset($album['images'])) {
			foreach ($album['images'] as $image_id => $image) {
				$image['id'] = $image_id;
				$images[] = $image;
			}
			$al['image_num'] = count($images);
		}
		$al['images'] = $images;
		return $al;
	}

	protected function is_image($type)
	{
		if (!$this->starts_with($type, 'image/')) {
			return false;
		}
		return true;
	}

	protected function save_file($filename)
	{
		$grid = $this->get_grid_fs();
		$stored_name = $this->generate_name($filename);
		$res = $grid->storeFile($filename, array('filename' => $stored_name));
		return $stored_name;
	}

	protected function generate_name($filename)
	{
		$mimeType = 'image/';
		$image_size = getimagesize($filename);
		$pic_name = md5($filename . time());
		$pic_name .= '-' . $image_size[0] . '-' . $image_size[1];

		$type = substr($image_size['mime'], strlen($mimeType));

		$pic_name .= ".$type";

		return $pic_name;
	}

	protected function make_photo_thumb($src_file, $max_size) {
		if (!function_exists('imagecreatefromjpeg')) {
			echo "gd not installed";
			return false;
		}
		$data = @getimagesize($src_file);
		$src_w = $data[0];
		$src_h = $data[1];
		if ($src_w <= $max_size && $src_h <= $max_size) {
			return $src_file;
		}
		if ($src_w >= $src_h) {
			$dst_w = $max_size;
			$dst_h = round($max_size * $src_h / $src_w);
		} else {
			$dst_h = $max_size;
			$dst_w = round($max_size * $src_w / $src_h);
		}
		switch ($data[2]) {
		case 1: //图片类型，1是GIF图
			$im = @ImageCreateFromGIF($src_file);
			break;
		case 2: //图片类型，2是JPG图
			$im = @imagecreatefromjpeg($src_file);
			break;
		case 3: //图片类型，3是PNG图
			$im = @ImageCreateFromPNG($src_file);
			break;
		}
		$src_w = ImageSX($im);
		$src_h = ImageSY($im);
		$new_im = imagecreatetruecolor($dst_w, $dst_h);//生成一张要生成的黑色背景图 ，比例为计算出来的新图片比例
		if(function_exists("imagecopyresampled")) {
			imagecopyresampled($new_im, $im, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);  //复制按比例缩放的原图到 ，新的黑色背景中。    
		} else {
			imagecopyresized($new_im, $im, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);  //复制按比例缩放的原图到 ，新的黑色背景中。    
		}

		$name = $src_file . '_small';
		imagejpeg($new_im, $name);
		imagedestroy($im);
		imagedestroy($new_im);
		return $name;
	}
}
