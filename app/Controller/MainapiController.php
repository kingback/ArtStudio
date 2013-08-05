<?php
class MainapiController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->autoRender = false;
		$this->response->header('Content-Type: text/javascript');
	}

	public function afterFilter() {
		parent::afterFilter();
		$this->response->send();
		exit();
	}

	public function listAlbums()
	{
		$albums_col = $this->get_collection($this->db_name, $this->album_collection);
		$albums = $albums_col->find();
		$info = array();
		foreach ($albums as $album) {
			$info[] = $this->copyAlbum($album);
		}
		echo json_encode($info);
	}

	public function albumInfo()
	{
		$album_id = $this->_get_argument('id');
		$albums = $this->get_collection($this->db_name, $this->album_collection);
		$album = $albums->findOne(array('_id' => $album_id));
		$info = $this->copyAlbum($album);
		echo json_encode($info);
	}

	// for editor
	public function uploadImage()
	{
		$filename = $_FILES['imgFile']['tmp_name'];
		$name = $_FILES['imgFile']['name'];
		$type = $_FILES['imgFile']['type'];
		if (!$this->is_image($type)) {
			echo json_encode(array('error' => 1, 'message' => $name . ' is not image file'));
			return;
		}
		$large = $this->save_file($filename, $type);
		$file_url = $this->grid_base_url . $large;
		echo json_encode(array('error' => 0, 'url' => $file_url));
	}
}
