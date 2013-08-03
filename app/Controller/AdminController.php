<?php
class AdminController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'admin';
	}

	public function index()
	{
	}

	public function addHonour()
	{
		if ($this->request->is('post')) {
			$collection = $this->get_collection($this->db_name, $this->honour_collection);
			$name = $this->_get_argument('name');
			$school = $this->_get_argument('school');
			$year = $this->_get_argument('year');
			// add a record
			$document = array('name' => $name, 'school' => $school, 'year' => $year);
			$collection->insert($document);
		} 
		$this->redirect('/admin/honour');
	}

	public function honour()
	{
		$collection = $this->get_collection($this->db_name, $this->honour_collection);
		$honours = $collection->find()->sort(array('year' => -1));
		$this->set('honours', $honours);
	}

	public function all_images()
	{
		$collection = $this->get_collection($this->grid_db, $this->grid_db_file);
		$cursor = $collection->find();
		$files = array();
		foreach ($cursor as $file) {
			$f = array();
			$f['filename'] = $file['filename'];
			$f['url'] = $this->get_file_url($f['filename']);
			$f['id'] = $file['_id'];
			$files[] = $f;
		}
		//var_dump(count($files));
		$this->set('files', $files);
	}

	public function images()
	{
		$collection = $this->get_collection($this->db_name, $this->pic_collection);
		$cursor = $collection->find();
		$files = array();
		foreach ($cursor as $file) {
			$f = array();
			$f['large'] = $file['large'];
			$f['large_url'] = $this->get_file_url($f['large']);
			$f['small'] = $file['small'];
			$f['small_url'] = $this->get_file_url($f['small']);
			$f['id'] = $file['_id'];
			$files[] = $f;
		}
		//var_dump($files);
		$this->set('files', $files);
	}

	public function signup()
	{
		$collection = $this->get_collection($this->db_name, $this->signup_collection);
		$students = $collection->find();
		$this->set('students', $students);
	}

	public function uploadAlbumImages()
	{
		$id = $this->_get_argument('id');
		$collection = $this->get_collection($this->db_name, $this->album_collection);
		$album = $collection->findOne(array('_id' => $id));
		$this->set('title', $album['title']);
		$this->set('desc', $album['desc']);
		$images = array();
		if (isset($album['images'])) {
			$images = $album['images'];
		}
		$this->set('id', $id);
		$this->set('images', $images);
		$this->set('base_url', $this->grid_base_url);
	}

	public function createAlbum()
	{
		if ($this->request->is('post')) {
			$title = $this->_get_argument('title');
			$desc = $this->_get_argument('desc');
			$id = md5($title . $desc . time());
			$album = array('title' => $title, 'desc' => $desc, '_id' => $id);
			var_dump($album);
			$collection = $this->get_collection($this->db_name, $this->album_collection);
			$res = $collection->insert($album);
			var_dump($res);

			$cursor = $collection->find(array('_id' => $id));
			foreach ($cursor as $a) {
				var_dump($a);
			}
			$this->redirect(array('controller' => 'admin', 'action' => 'uploadAlbumImages', '?' => array('id' => $id)));
		}
	}

	public function listAlbums()
	{
		$albums_col = $this->get_collection($this->db_name, $this->album_collection);
		$albums = $albums_col->find();
		$this->set('albums', $albums);
	}
}
