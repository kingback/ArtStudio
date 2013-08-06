<?php
class AdminapiController extends AppController {

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

	public function addAlbumCategory()
	{
		$name = $this->_get_argument('name');
		$desc = $this->_get_argument('desc');
		$collection = $this->get_collection($this->db_name, $this->album_category_collection);
		// add a record
		$document = array('desc' => $desc, 'name' => $name);
		$collection->update(array('name' => $name), $document, array('upsert' => true));
	}

	public function modifyAlbumCategory()
	{
		$ids_str = $this->_get_argument('ids');
		$names_str = $this->_get_argument('names');
		$descs_str = $this->_get_argument('descs');
		$ids = json_decode($ids_str);
		$names = json_decode($names_str);
		$descs = json_decode($descs_str);

		$collection = $this->get_collection($this->db_name, $this->album_category_collection);
		$cnt = count($ids);
		for ($i = 0; $i < $cnt; $i++) {
			$name = $names[$i];
			$desc = $descs[$i];
			$document = array('desc' => $desc, 'name' => $name);
			$collection->update(array('name' => $name), $document);
		}
		echo json_encode($res);
	}

	public function deleteAlbumCategory()
	{
		$ids_str = $this->_get_argument('ids');
		$ids = explode(',', $ids_str);

		var_dump($ids);
		$collection = $this->get_collection($this->db_name, $this->album_category_collection);
		foreach ($ids as $id) {
			$res = $collection->remove(array('_id' => new MongoId($id)));
			var_dump($res);
		}
	}

	public function deleteHonour()
	{
		if ($this->request->is('post')) {
			$collection = $this->get_collection($this->db_name, $this->honour_collection);
			$id = $this->_get_argument('id');
			$res = $collection->remove(array('_id' => new MongoId($id)));
		}
	}

	public function uploadAlbumImages()
	{
		if (!isset($_FILES['pics'])) {
			return;
		}
		$id = $this->_get_argument('id');
		$albums = $this->get_collection($this->db_name, $this->album_collection);
		$album = $albums->findOne(array('_id' => $id));
		$images = array();
		if (isset($album['images'])) {
			$images = $album['images'];
		}
		for ($i = 0; $i < count($_FILES['pics']['name']); $i++) {
			$filename = $_FILES['pics']['tmp_name'][$i];
			$name = $_FILES['pics']['name'][$i];
			$type = $_FILES['pics']['type'][$i];
			if (!$this->is_image($type)) {
				echo json_encode(array('msg' => $name . ' is not image'));
				$this->_setStatusAndExit(400);
			}
			$small_file = $this->make_photo_thumb($filename, $this->max_small_pic_size);
			$large = $this->save_file($filename, $type);
			$small = $this->save_file($small_file, $type);
			$pic_id = md5($large);
			$pic = array('large' => $large, 'small' => $small, 'name' => $name, 'desc' => $name);
			//$res = $images_col->insert($pic);
			$images[$pic_id] = $pic;
		}
		$newdata = array('$set' => array('images' => $images));
		$albums->update(array('_id' => $id), $newdata);
		echo json_encode($album);
	}

	public function uploadImage()
	{
		$filename = $_FILES['Filedata']['tmp_name'];
		$name = $_FILES['Filedata']['name'];
		$type = $_FILES['Filedata']['type'];
		if (!$this->is_image($type)) {
			echo json_encode(array('msg' => $name . ' is not image'));
			$this->_setStatusAndExit(400);
		}
		$small_file = $this->make_photo_thumb($filename, $this->max_small_pic_size);
		$large = $this->save_file($filename, $type);
		$small = $this->save_file($small_file, $type);
		$pic = array('large' => $large, 'small' => $small);
		$collection = $this->get_collection($this->db_name, $this->pic_collection);
		$res = $collection->insert($pic);
		$info['large'] = $large;
		$info['small'] = $small;
		echo json_encode($info);
	}

	public function uploadImages()
	{
		$larges = array();
		$smalls = array();
		$collection = $this->get_collection($this->db_name, $this->pic_collection);
		for ($i = 0; $i < count($_FILES['pics']['name']); $i++) {
			$filename = $_FILES['pics']['tmp_name'][$i];
			$name = $_FILES['pics']['name'][$i];
			$type = $_FILES['pics']['type'][$i];
			if (!$this->is_image($type)) {
				echo json_encode(array('msg' => $name . ' is not image'));
				$this->_setStatusAndExit(400);
			}
			$small_file = $this->make_photo_thumb($filename, $this->max_small_pic_size);
			$large = $this->save_file($filename, $type);
			$small = $this->save_file($small_file, $type);
			$pic = array('large' => $large, 'small' => $small);
			$res = $collection->insert($pic);
			$larges[] = $large;
			$smalls[] = $small;
		}

		$info['larges'] = $larges;
		$info['smalls'] = $smalls;
		echo json_encode($info);
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

	public function deleteImages()
	{
		$ids_str = $this->_get_argument('ids');
		$ids = explode(',', $ids_str);

		var_dump($ids);
		$grid = $this->get_grid_fs();
		foreach ($ids as $id) {
			$res = $grid->delete(new MongoId($id));
			var_dump($res);
		}
	}

	public function deletePics()
	{
		$ids_str = $this->_get_argument('ids');
		$ids = explode(',', $ids_str);

		var_dump($ids);
		$collection = $this->get_collection($this->db_name, $this->pic_collection);
		$grid = $this->get_grid_fs();
		foreach ($ids as $id) {
			$mongo_id = new MongoId($id);
			$cursor = $collection->find(array('_id' => $mongo_id));
			foreach ($cursor as $file) {
				var_dump($file);
				$large = $file['large'];
				$small = $file['small'];
				var_dump($large);
				var_dump($small);
				$res = $grid->remove(array('filename' => $large));
				var_dump($res);
				$res = $grid->remove(array('filename' => $small));
				var_dump($res);
			}
			$res = $collection->remove(array('_id' => $mongo_id));
			var_dump($res);
		}
	}

	public function deleteAlbumPics()
	{
		$ids_str = $this->_get_argument('ids');
		$album_id = $this->_get_argument('id');
		$ids = explode(',', $ids_str);

		var_dump($ids);
		$albums = $this->get_collection($this->db_name, $this->album_collection);
		$album = $albums->findOne(array('_id' => $album_id));
		$images = $album['images'];
		$grid = $this->get_grid_fs();
		foreach ($ids as $id) {
			$small = $images[$id]['small'];
			$large = $images[$id]['large'];
			$res = $grid->remove(array('filename' => $large));
			var_dump($res);
			$res = $grid->remove(array('filename' => $small));
			var_dump($res);
			unset($images[$id]);
		}
		var_dump($images);
		$newdata = array('$set' => array('images' => $images));
		var_dump($album_id);
		var_dump($newdata);
		$res = $albums->update(array('_id' => $album_id), $newdata);
		echo json_encode($res);
	}

	public function setAlbumCover()
	{
		$album_id = $this->_get_argument('id');
		$pic_id = $this->_get_argument('picid');

		$albums = $this->get_collection($this->db_name, $this->album_collection);
		$album = $albums->findOne(array('_id' => $album_id));
		$newdata = array('$set' => array('cover' => $pic_id));
		var_dump($newdata);
		$res = $albums->update(array('_id' => $album_id), $newdata);
		echo json_encode($res);
	}

	public function modifyAlbumPics()
	{
		$id = $this->_get_argument('id');
		$ids_str = $this->_get_argument('ids');
		$names_str = $this->_get_argument('names');
		$descs_str = $this->_get_argument('descs');
		$ids = json_decode($ids_str);
		$names = json_decode($names_str);
		$descs = json_decode($descs_str);
		$albums = $this->get_collection($this->db_name, $this->album_collection);
		$album = $albums->findOne(array('_id' => $id));
		$images = $album['images'];
		$cnt = count($ids);
		for ($i = 0; $i < $cnt; $i++) {
			$images[$ids[$i]]['desc'] = $descs[$i];
			$images[$ids[$i]]['name'] = $names[$i];
		}
		$newdata = array('$set' => array('images' => $images));
		$res = $albums->update(array('_id' => $id), $newdata);
		echo json_encode($res);
	}

	public function addTeacher()
	{
		$name = $this->_get_argument('name');
		$title = $this->_get_argument('title');
		$desc = $this->_get_argument('desc');

		if (!isset($_FILES['imgFile'])) {
			echo json_encode(array('msg' => 'no image for teacher'));
			$this->_setStatusAndExit(400);
		}
		$tmp_filename = $_FILES['imgFile']['tmp_name'];
		$filename = $_FILES['imgFile']['name'];
		$type = $_FILES['imgFile']['type'];
		if (!$this->is_image($type)) {
			echo json_encode(array('msg' => $name . ' is not image file, type=' . $type));
			$this->_setStatusAndExit(400);
		}
		$compressed_file = $this->make_photo_thumb($tmp_filename, 300);
		$image = $this->save_file($compressed_file, $type);

		$teacher = array('name' => $name, 'title' => $title, 'desc' => $desc, 'image' => $image);
		$collection = $this->get_collection($this->db_name, $this->teacher_collection);
		$res = $collection->insert($teacher);
		echo json_encode($res);
	}

	public function deleteTeacher()
	{
		$ids_str = $this->_get_argument('ids');
		$ids = explode(',', $ids_str);

		var_dump($ids);
		$collection = $this->get_collection($this->db_name, $this->teacher_collection);
		foreach ($ids as $id) {
			$res = $collection->remove(array('_id' => new MongoId($id)));
			var_dump($res);
		}
	}

	public function modifyTeacher()
	{
		$ids_str = $this->_get_argument('ids');
		$names_str = $this->_get_argument('names');
		$titles_str = $this->_get_argument('titles');
		$descs_str = $this->_get_argument('descs');
		$ids = json_decode($ids_str);
		$names = json_decode($names_str);
		$titles = json_decode($titles_str);
		$descs = json_decode($descs_str);

		$collection = $this->get_collection($this->db_name, $this->teacher_collection);
		$cnt = count($ids);
		for ($i = 0; $i < $cnt; $i++) {
			$newdata = array('$set' => array('name' => $names[$i], 'title' => $titles[$i], 'desc' => $descs[$i]));
			$res = $collection->update(array('_id' => new MongoId($ids[$i])), $newdata);
			if (!$res['ok']) {
				echo json_encode($res);
			}
		}
	}

	public function modifyArticle()
	{
		$content = $this->_get_argument('content');
		$title = $this->_get_argument('title');
		$id = $this->_get_argument('id', -1);
		$newdata = array('title' => $title, 'content' => $content);
		$collection = $this->get_collection($this->db_name, $this->article_collection);
		if ($id != -1) {
			$res = $collection->update(array('_id' => new MongoId($id)), $newdata);
			echo json_encode($res);
			if (!$res['ok']) {
				echo json_encode($res);
			}
		} else {
			$res = $collection->insert($newdata);
			echo json_encode($res);
		}
	}

	public function deleteArticle()
	{
		$ids_str = $this->_get_argument('ids');
		$ids = explode(',', $ids_str);

		var_dump($ids);
		$collection = $this->get_collection($this->db_name, $this->article_collection);
		foreach ($ids as $id) {
			$res = $collection->remove(array('_id' => new MongoId($id)));
			var_dump($res);
		}
	}
}
