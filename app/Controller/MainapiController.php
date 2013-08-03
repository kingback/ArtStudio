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

	private function copyAlbum($album)
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
		if (isset($album['images'])) {
			foreach ($album['images'] as $image) {
				$images[] = $image;
			}
		}
		$al['images'] = $images;
		return $al;
	}
}
