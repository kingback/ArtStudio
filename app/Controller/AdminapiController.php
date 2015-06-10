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

	public function addHonour()
	{
		if ($this->request->is('post')) {
			$collection = $this->get_collection($this->db_name, $this->honour_collection);
			$name = $this->_get_argument('name');
			$school = $this->_get_argument('school');
			$year = $this->_get_argument('year');
			// add a record
			$document = array('name' => $name, 'school' => $school, 'year' => intval($year));
			$collection->insert($document);
		} 
		$this->redirect('/admin/honour');
	}

	public function addHonours()
	{
		var_dump($_FILES);
		if (!isset($_FILES['file'])) {
			$this->_setErrMsgAndExit("can't find upload file", 400);
		}
		$tmp_filename = $_FILES['file']['tmp_name'];

		var_dump($tmp_filename);
		App::import('Vendor', 'phpExcel/PHPExcel');
		$objPHPExcel = PHPExcel_IOFactory::load($tmp_filename);
		$honours = $objPHPExcel->getActiveSheet()->toArray();
		var_dump($honours);
		$collection = $this->get_collection($this->db_name, $this->honour_collection);
		foreach ($honours as $honour) {
			if ($honour[0] && $honour[1] && $honour[2]) {
				$document = array('name' => $honour[0], 'school' => $honour[1], 'year' => intval($honour[2]));
				$collection->insert($document);
			}
		}
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
		$ids_str = $this->_get_argument('ids');
		$ids = explode(',', $ids_str);

		var_dump($ids);
		$collection = $this->get_collection($this->db_name, $this->honour_collection);
		foreach ($ids as $id) {
			$res = $collection->remove(array('_id' => new MongoId($id)));
			var_dump($res);
		}
	}

	public function deleteSignup()
	{
		$ids_str = $this->_get_argument('ids');
		$ids = explode(',', $ids_str);

		var_dump($ids);
		$collection = $this->get_collection($this->db_name, $this->signup_collection);
		foreach ($ids as $id) {
			$res = $collection->remove(array('_id' => new MongoId($id)));
			var_dump($res);
		}
	}

	/*
	public function uploadAlbumImages()
	{
		var_dump($_FILES);
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
	 */

	public function uploadAlbumImage()
	{
		$data_name = 'Filedata';
		var_dump($_FILES[$data_name]);
		if (!isset($_FILES[$data_name])) {
			return;
		}
		$id = $this->_get_argument('id');

		$filename = $_FILES[$data_name]['tmp_name'];
		$name = $_FILES[$data_name]['name'];
		$type = $_FILES[$data_name]['type'];
		$this->_is_image($type, $name);

		$album_dir = $this->album_image_dir . $id . '/';
		$small_file = $this->make_photo_thumb($filename, $this->max_small_pic_size);
		$large = $this->_save_image($filename, $album_dir);
		$small = $this->_save_image($small_file, $album_dir);
		$pic_id = md5($large);
		$pic = array('large' => $large, 'small' => $small, 'name' => $name, 'desc' => $name);

		// FIXME: data may lost
		$albums = $this->get_collection($this->db_name, $this->album_collection);
		$album = $albums->findOne(array('_id' => $id));
		$images = array();
		if (isset($album['images'])) {
			$images = $album['images'];
		}
		$images[$pic_id] = $pic;
		var_dump($images);
		$newdata = array('$set' => array('images' => $images));
		$albums->update(array('_id' => $id), $newdata);
		echo json_encode($album);
	}

	// 单张上传图片
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
		$large = $this->_save_image($filename);
		$small = $this->_save_image($small_file);
		$pic = array('large' => $large, 'small' => $small);

		$collection = $this->get_collection($this->db_name, $this->pic_collection);
		$res = $collection->insert($pic);

		$info['large'] = $large;
		$info['small'] = $small;
		echo json_encode($info);
	}

	// 批量上传图片, /admin/images
	public function uploadImages()
	{
		$larges = array();
		$smalls = array();
		$collection = $this->get_collection($this->db_name, $this->pic_collection);
		for ($i = 0; $i < count($_FILES['pics']['name']); $i++) {
			$filename = $_FILES['pics']['tmp_name'][$i];
			$name = $_FILES['pics']['name'][$i];
			$type = $_FILES['pics']['type'][$i];

			// check if upload file is image
			$this->_is_image($type, $name);

			$small_file = $this->make_photo_thumb($filename, $this->max_small_pic_size);
			$large = $this->_save_image($filename);
			$small = $this->_save_image($small_file);
			$pic = array('large' => $large, 'small' => $small);
			var_dump($pic);
			$res = $collection->insert($pic);
			$larges[] = $large;
			$smalls[] = $small;
		}

		$info['larges'] = $larges;
		$info['smalls'] = $smalls;
		echo json_encode($info);
	}

	// 批量删除图片 /admin/allImages
	/*
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
	 */

	// 批量删除带小图的图片 /admin/images
	public function deletePics()
	{
		$ids_str = $this->_get_argument('ids');
		$ids = explode(',', $ids_str);

		var_dump($ids);
		$collection = $this->get_collection($this->db_name, $this->pic_collection);
		foreach ($ids as $id) {
			$mongo_id = new MongoId($id);
			$cursor = $collection->find(array('_id' => $mongo_id));
			foreach ($cursor as $file) {
				var_dump($file);
				$large = $file['large'];
				$small = $file['small'];
				var_dump($large);
				var_dump($small);
				$this->_delete_image($large);
				$this->_delete_image($small);
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
		foreach ($ids as $id) {
			$album_dir = $this->_get_album_dir($id);
			$small = $images[$id]['small'];
			$large = $images[$id]['large'];
			$this->_delete_image($large);
			$this->_delete_image($small);
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
		$school = $this->_get_argument('school');

		if (!isset($_FILES['imgFile'])) {
			echo json_encode(array('msg' => 'no image for teacher'));
			$this->_setStatusAndExit(400);
		}
		$tmp_filename = $_FILES['imgFile']['tmp_name'];
		$filename = $_FILES['imgFile']['name'];
		$type = $_FILES['imgFile']['type'];
		$this->_is_image($type, $name);

		$compressed_file = $this->make_photo_thumb($tmp_filename, 300);
		$image = $this->_save_image($compressed_file, $this->teacher_image_dir);
		
		$collection = $this->get_collection($this->db_name, $this->teacher_collection);
        //$count = $collection->stats()->count;
        $count = count($collection->find());
        $teacher = array('name' => $name, 'title' => $title, 'desc' => $desc, 'image' => $image, 'school' => $school, '_index' => $count);
        
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
		$type = $this->_get_argument('type');
		$id = $this->_get_argument('id', -1);
		$newdata = array('title' => $title, 'content' => $content, 'modifyTime' => new MongoDate(), 'type' => $type);
		$collection = $this->get_collection($this->db_name, $this->article_collection);
		if ($id != -1) {
			$res = $collection->update(array('_id' => new MongoId($id)), array('$set' => $newdata));
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
		$article_col = $this->get_collection($this->db_name, $this->article_collection);
		$news_col = $this->get_collection($this->db_name, $this->news_collection);
		foreach ($ids as $id) {
			$res = $article_col->remove(array('_id' => new MongoId($id)));
			var_dump($res);
			$res = $news_col->remove(array('articleId' => $id));
			var_dump($res);
		}
	}

	public function modifyNews()
	{
		var_dump($_POST);
		var_dump($_FILES);
		$content = $this->_get_argument('content');
		$title = $this->_get_argument('title');
		$summary = trim($this->_get_argument('summary'));
		$date = $this->_get_argument('date');
		$id = $this->_get_argument('id', -1);
		$type = "新闻";
        
        if ($date != '') {
            $mgdate = new MongoDate(strtotime($date.' 00:00:00'));
        } else {
            $mgdate = new MongoDate();
        }

		// save article
		$newdata = array('title' => $title, 'content' => $content, 'modifyTime' => new MongoDate(), 'type' => $type);
		$article_col = $this->get_collection($this->db_name, $this->article_collection);
		if ($id != -1) {
			$res = $article_col->update(array('_id' => new MongoId($id)), array('$set' => $newdata));
			echo json_encode($res);
			if (!$res['ok']) {
				echo json_encode($res);
			}
		} else {
			$newdata['_id'] = new MongoId();
			$id = $newdata['_id']->{'$id'};
			$res = $article_col->insert($newdata);
			echo json_encode($res);
		}

		$image_file = -1;
		if (isset($_FILES['Filedata'])) {
			echo "image!!";
			$filename = $_FILES['Filedata']['tmp_name'];
			$name = $_FILES['Filedata']['name'];
			$type = $_FILES['Filedata']['type'];
			// save news cover image
			$this->_is_image($type, $name);

			$small_file = $this->make_photo_thumb($filename, $this->max_small_pic_size);
			$image_file = $this->_save_image($small_file, $this->news_image_dir);
			var_dump($small_file);
			var_dump($image_file);
		}

		// save news info
		$news_data = array('articleId' => $id, 'summary' => $summary, 'title' => $title, 'date' => $mgdate);
		if ($image_file != -1) {
			$news_data['image'] = $image_file;
		}
		var_dump($news_data);
		$news_col = $this->get_collection($this->db_name, $this->news_collection);
		$res = $news_col->update(array('articleId' => $id), array('$set' => $news_data), array('upsert' => true));
		echo json_encode($res);
	}

	public function addVideo()
	{
		$name = $this->_get_argument('name');
		$url = $this->_get_argument('url');
		$desc = $this->_get_argument('desc');
		$type = $this->_get_argument('type');

		if (!isset($_FILES['imgFile'])) {
			echo json_encode(array('msg' => 'no image for video'));
			$this->_setStatusAndExit(400);
		}
		$tmp_filename = $_FILES['imgFile']['tmp_name'];
		$filename = $_FILES['imgFile']['name'];
		$file_type = $_FILES['imgFile']['type'];
		$this->_is_image($file_type, $filename);

		$compressed_file = $this->make_photo_thumb($tmp_filename, 300);
		$image = $this->_save_image($compressed_file, $this->video_image_dir);

		$video = array('name' => $name, 'url' => $url, 'desc' => $desc, 'image' => $image, 'type' => $type);
		$collection = $this->get_collection($this->db_name, $this->video_collection);
		$res = $collection->insert($video);
		echo json_encode($res);
	}

	public function deleteVideo()
	{
		$ids_str = $this->_get_argument('ids');
		$ids = explode(',', $ids_str);

		var_dump($ids);
		$collection = $this->get_collection($this->db_name, $this->video_collection);
		foreach ($ids as $id) {
			$res = $collection->remove(array('_id' => new MongoId($id)));
			var_dump($res);
		}
	}

	public function modifyVideo()
	{
		$ids_str = $this->_get_argument('ids');
		$names_str = $this->_get_argument('names');
		$urls_str = $this->_get_argument('urls');
		$descs_str = $this->_get_argument('descs');
		$ids = json_decode($ids_str);
		$names = json_decode($names_str);
		$urls = json_decode($urls_str);
		$descs = json_decode($descs_str);

		$collection = $this->get_collection($this->db_name, $this->video_collection);
		$cnt = count($ids);
		for ($i = 0; $i < $cnt; $i++) {
			$newdata = array('$set' => array('name' => $names[$i], 'url' => $urls[$i], 'desc' => $descs[$i]));
			$res = $collection->update(array('_id' => new MongoId($ids[$i])), $newdata);
			if (!$res['ok']) {
				$this->_setErrMsgAndExit($res['err'], 500);
			}
		}
	}

	public function markHonour()
	{
		$ids_str = $this->_get_argument('ids');
		$ids = explode(',', $ids_str);

		var_dump($ids);
		$collection = $this->get_collection($this->db_name, $this->honour_collection);
		$newdata = array('$set' => array('mark' => 1));
		foreach ($ids as $id) {
			$res = $collection->update(array('_id' => new MongoId($id)), $newdata);
			if (!$res['ok']) {
				$this->_setErrMsgAndExit($res['err'], 500);
			}
		}
	}

	public function unmarkHonour()
	{
		$ids_str = $this->_get_argument('ids');
		$ids = explode(',', $ids_str);

		var_dump($ids);
		$collection = $this->get_collection($this->db_name, $this->honour_collection);
		$newdata = array('$set' => array('mark' => 0));
		foreach ($ids as $id) {
			$res = $collection->update(array('_id' => new MongoId($id)), $newdata);
			if (!$res['ok']) {
				$this->_setErrMsgAndExit($res['err'], 500);
			}
		}
	}

	public function deleteAlbum()
	{
		$ids_str = $this->_get_argument('ids');
		$ids = explode(',', $ids_str);

		var_dump($ids);
		$collection = $this->get_collection($this->db_name, $this->album_collection);
		foreach ($ids as $id) {
			$album = $collection->findOne(array('_id' => $id));
			$res = $collection->remove(array('_id' => $id));
			var_dump($res);
			if (isset($album['images'])) {
				foreach ($album['images'] as $image) {
					$this->_delete_image($image['large']);
					$this->_delete_image($image['small']);
				}
			}

			$album_dir = $this->image_base_dir . $this->album_image_dir . $id;
			rmdir($album_dir);
		}
	}

	public function markNews()
	{
		$ids_str = $this->_get_argument('ids');
		$mark = $this->_get_argument('mark');
		$mark = intval($mark);
		$ids = explode(',', $ids_str);

		var_dump($ids);
		$collection = $this->get_collection($this->db_name, $this->news_collection);
		$newdata = array('$set' => array('mark' => $mark));
		foreach ($ids as $id) {
			$res = $collection->update(array('articleId' => $id), $newdata);
			var_dump($res);
			if (!$res['ok']) {
				$this->_setErrMsgAndExit($res['err'], 500);
			}
		}
	}
}
