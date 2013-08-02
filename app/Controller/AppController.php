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
	protected $grid_db = "pic";
	protected $grid_db_file = "fs.files";
	protected $grid_base_url = "http://localhost:4444/gridfs/";

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

	protected function save_pic($upload_pic)
	{
		$mimeType = 'image/';
		$file = $_FILES[$upload_pic];
		if (!$this->starts_with($file['type'], $mimeType)) {
			return false;
		}
		$grid = $this->get_grid_fs();
		$pic_name = $this->generate_name($file['tmp_name']);
		$res = $grid->storeUpload($upload_pic, $pic_name);
		return $pic_name;
	}

	protected function save_file($filename, $type)
	{
		$mimeType = 'image/';
		if (!$this->starts_with($type, $mimeType)) {
			return false;
		}
		$grid = $this->get_grid_fs();
		$pic_name = $this->generate_name($filename);
		$res = $grid->storeFile($filename, array('filename' => $pic_name));
		return $pic_name;
	}

	protected function get_file_url($file_name)
	{
		return $this->grid_base_url . $file_name;
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
}
