<?php
class MainController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'zd';
	}

	public function index()
	{
		$this->set('body_class', 'zds-index');
		$this->set('page', 1);
		// code...
	}

	public function signup()
	{
		$this->set('body_class', 'zds-signup');
		$this->set('page', 8);
	}

	public function addStudent()
	{
		$this->autoRender = false;
		$this->response->header('Content-Type: text/javascript');
		$name = $this->_get_argument('name');
		$sex = $this->_get_argument('sex');
		$birthday = $this->_get_argument('birthday');
		$highschool = $this->_get_argument('highschool');
		$telephone = $this->_get_argument('telephone');
		$qq = $this->_get_argument('qq');
		$email = $this->_get_argument('email');
		$volk = $this->_get_argument('volk');
		$household = $this->_get_argument('household');
		$stu = array(
			'name' => $name,
			'sex' => $sex,
			'birthday' => $birthday,
			'highschool' => $highschool,
			'telephone' => $telephone,
			'qq' => $qq,
			'email' => $email,
			'volk' => $volk,
			'household' => $household
		);
		//var_dump($stu);
		$collection = $this->get_collection($this->db_name, $this->signup_collection);
		$res = $collection->update(array('name' => $name, 'telephone' => $telephone), $stu, array('upsert' => true));
		echo json_encode($res);
		$this->response->send();
		exit();
	}

	public function honour()
	{
		$this->set('body_class', 'zds-honour');
		$this->set('page', 3);
		$collection = $this->get_collection($this->db_name, $this->honour_collection);
		$years = $collection->distinct('year');
		rsort($years);
		$honours = array();
		foreach ($years as $year) {
			$cur_year = $collection->find(array('year' => $year));
			$honours[$year] = $cur_year;
		}
		$this->set('honours', $honours);
		$this->set('years', $years);
	}

	public function video()
	{
		$this->set('body_class', 'zds-video');
		$this->set('page', 3);
	}

	public function allGallery()
	{
		$albums_col = $this->get_collection($this->db_name, $this->album_collection);
		$albums = $albums_col->find();
		$info = array();
		foreach ($albums as $album) {
			$info[] = $this->copyAlbum($album);
		}
		
		$categories_col = $this->get_collection($this->db_name, $this->album_category_collection);
		$categories = $categories_col->find();
		$this->set('body_class', 'zds-gallery');
		$this->set('page', 5);
		$this->set('albums', $info);
		$this->set('categories', $categories);
		$this->set('base_url', $this->grid_base_url);
	}

	public function gallery()
	{
		$category = $this->_get_argument('category');
		$albums_col = $this->get_collection($this->db_name, $this->album_collection);
		$albums = $albums_col->find(array('category' => $category));
		$info = array();
		foreach ($albums as $album) {
			$info[] = $this->copyAlbum($album);
		}
		$categories_col = $this->get_collection($this->db_name, $this->album_category_collection);
		$categories = $categories_col->find();
		$category_desc = "";
		foreach ($categories as $cate) {
			if ($cate['name'] == $category) {
				$category_desc = $cate['desc'];
				break;
			}
		}
		$this->set('body_class', 'zds-gallery');
		$this->set('page', 5);
		$this->set('albums', $info);
		$this->set('categories', $categories);
		$this->set('cur_category', $category);
		$this->set('category_desc', $category_desc);
		$this->set('base_url', $this->grid_base_url);
	}
}
