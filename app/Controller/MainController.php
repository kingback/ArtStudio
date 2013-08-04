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

	public function gallery()
	{
		$albums_col = $this->get_collection($this->db_name, $this->album_collection);
		$albums = $albums_col->find();
		$info = array();
		foreach ($albums as $album) {
			/*
			if (isset($album['cover'])) {
				$cover_id = $album['cover'];
				$album['cover']['large'] = $album['images'][$cover_id]['large'];
				$album['cover']['small'] = $album['images'][$cover_id]['small'];
			}
			$album['image_num'] = 0;
			$album['image_num'] = count($album['images']);
			 */
			$info[] = $this->copyAlbum($album);
		}
		$this->set('body_class', 'zds-signup');
		$this->set('page', -1);
		$this->set('albums', $info);
		$this->set('base_url', $this->grid_base_url);
	}
}
