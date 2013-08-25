<?php
class AdminController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'admin';
	}

	public function index()
	{

        $this->set('title_for_layout', '主页管理');
	}


	public function honour()
	{
		$collection = $this->get_collection($this->db_name, $this->honour_collection);
		$honours = $collection->find()->sort(array('year' => -1));
        $this->set('title_for_layout', '画室荣誉管理');
		$this->set('honours', $honours);
	}

	public function images()
	{
		$collection = $this->get_collection($this->db_name, $this->pic_collection);
		$cursor = $collection->find();
		$files = array();
		foreach ($cursor as $file) {
			$f = array();
			$f['large'] = $file['large'];
			$f['large_url'] = $this->_get_image_url($f['large']);
			$f['small'] = $file['small'];
			$f['small_url'] = $this->_get_image_url($f['small']);
			$f['id'] = $file['_id'];
			$files[] = $f;
		}

		$this->set('files', $files);
        $this->set('title_for_layout', '图片管理');
	}

	public function signup()
	{
		$collection = $this->get_collection($this->db_name, $this->signup_collection);
		$students = $collection->find();
		$this->set('students', $students);
        $this->set('title_for_layout', '注册管理');
	}

	public function uploadAlbumImages()
	{
		$id = $this->_get_argument('id');
		$collection = $this->get_collection($this->db_name, $this->album_collection);
		$raw_album = $collection->findOne(array('_id' => $id));

		$like_col = $this->get_collection($this->db_name, $this->pic_like_collection);
		$likes = $like_col->findOne(array('_id' => $id));

		$album = $this->copyAlbum($raw_album, $likes);

		$cover = "";
		if (isset($raw_album['cover'])) {
			$cover = $raw_album['cover'];
		}

		$this->set('title', $album['title']);
		$this->set('desc', $album['desc']);
		$this->set('cover', $cover);
		$this->set('id', $id);
		$this->set('images', $album['images']);
		$this->set('base_url', $this->image_base_url);
		$this->set('title_for_layout', '修改相册图片');
	}

	public function createAlbum()
	{
		if ($this->request->is('post')) {
			$title = $this->_get_argument('title');
			$desc = $this->_get_argument('desc');
			$category = $this->_get_argument('category');
			$type = $this->_get_argument('type');
			$id = md5($title . $desc . time());
			$album = array('title' => $title, 'desc' => $desc, '_id' => $id, 'category' => $category, 'type' => $type);
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
		$this->set('title_for_layout', '创建相册');
		$collection = $this->get_collection($this->db_name, $this->album_category_collection);
		$categories = $collection->find();
		$this->set('categories', $categories);
	}

	public function modifyAlbum()
	{
		$id = $this->_get_argument('id');
		$albums = $this->get_collection($this->db_name, $this->album_collection);
		if ($this->request->is('post')) {
			$title = $this->_get_argument('title');
			$desc = $this->_get_argument('desc');
			$category = $this->_get_argument('category');
			$type = $this->_get_argument('type');
			$newdata = array('$set' => array('title' => $title, 'desc' => $desc, 'category' => $category, 'type' => $type));
			var_dump($newdata);
			$res = $albums->update(array('_id' => $id), $newdata);
			var_dump($res);
			$this->redirect(array('controller' => 'admin', 'action' => 'listAlbums'));
		} else {
			$album = $albums->findOne(array('_id' => $id));
			$this->set('id', $id);
			$this->set('title', $album['title']);
			$this->set('desc', $album['desc']);
			if (isset($album['category'])) {
				$this->set('album_category', $album['category']);
			} else {
				$this->set('album_category', '');
			}
			$collection = $this->get_collection($this->db_name, $this->album_category_collection);
			$categories = $collection->find();
			$this->set('categories', $categories);
			$this->set('title_for_layout', '修改相册信息');
		}
	}

	public function listAlbums()
	{
		$albums_col = $this->get_collection($this->db_name, $this->album_collection);
		$albums = $albums_col->find()->sort(array('category' => 1));
		$covers = array();
		foreach ($albums as $album) {
			$album_id = $album['_id'];
			$covers[$album_id] = false;
			if (isset($album['cover'])) {
				$id = $album['cover'];
				if (isset($album['images'][$id])) {
					$covers[$album_id] = $album['images'][$id]['small'];
				}
			} 
		}
		$this->set('albums', $albums);
		$this->set('covers', $covers);
		$this->set('base_url', $this->image_base_url);
		$this->set('title_for_layout', '相册管理');
	}

	public function albumCategories()
	{
		$collection = $this->get_collection($this->db_name, $this->album_category_collection);
		$categories = $collection->find();
		$this->set('title_for_layout', '相册类型管理');
		$this->set('categories', $categories);
	}

	public function teachers()
	{
		$collection = $this->get_collection($this->db_name, $this->teacher_collection);
		$teachers = $collection->find();
		$this->set('title_for_layout', '教师管理');
		$this->set('base_url', $this->image_base_url);
		$this->set('teachers', $teachers);
	}

	public function publisher()
	{
		$id = $this->_get_argument('id', -1);
		$content = "";
		$title = "";
		$type = "";
		if ($id != -1) {
			$collection = $this->get_collection($this->db_name, $this->article_collection);
			$article = $collection->findOne(array('_id' => new MongoId($id)));
			$content = $article['content'];
			$title = $article['title'];
			$type = $article['type'];
		} else {
			$type = $this->_get_argument('type');
		}
		$this->set('title_for_layout', '文章发布');
		$this->set('id', $id);
		$this->set('type', $type);
		$this->set('title', $title);
		$this->set('content', $content);
	}

	public function listArticles()
	{
		$collection = $this->get_collection($this->db_name, $this->article_collection);
		$articles = $collection->find()->sort(array('type' => 1));
		$this->set('title_for_layout', '文章管理');
		$this->set('articles', $articles);
	}

	public function listNews()
	{
		$collection = $this->get_collection($this->db_name, $this->news_collection);
		$newses = $collection->find()->sort(array('date' => -1));
		$this->set('title_for_layout', '新闻管理');
		$this->set('newses', $newses);
	}

	public function createNews()
	{
		$id = $this->_get_argument('id', -1);
		$content = "";
		$title = "";
		$type = "";
		$summary = "";
        $mgdate = new MongoDate();
        $date = date('Y-m-d', $mgdate->sec);
		$image = false;
		if ($id != -1) {
			$article_col = $this->get_collection($this->db_name, $this->article_collection);
			$article = $article_col->findOne(array('_id' => new MongoId($id)));
			$news_col = $this->get_collection($this->db_name, $this->news_collection);
			$news = $news_col->findOne(array('articleId' => $id));
			$content = $article['content'];
			$title = $article['title'];
            $date = date('Y-m-d', $news['date']->sec);
			$summary = $news['summary'];
			if (isset($news['image'])) {
				$image = $news['image'];
			}
		}
		$this->set('title_for_layout', '新闻发布');
		$this->set('id', $id);
		$this->set('title', $title);
		$this->set('content', $content);
		$this->set('summary', $summary);
		$this->set('date', $date);
		$this->set('image', $image);
		$this->set('base_url', $this->image_base_url);
	}

	public function video()
	{
		$collection = $this->get_collection($this->db_name, $this->video_collection);
		$videos = $collection->find()->sort(array('type' => 1));
		$this->set('title_for_layout', '视频管理');
		$this->set('videos', $videos);
		$this->set('base_url', $this->image_base_url);
	}

	protected function setXlsProperty($objPHPExcel)
	{
		$objPHPExcel->getProperties()->setCreator("zd")
			->setLastModifiedBy("zd")
			->setTitle("Office 2007 XLSX Test Document")
			->setSubject("Office 2007 XLSX Test Document")
			->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("Test result file");
	}

	protected function addXlsRow(& $objPHPExcel, $sheet, $rowNo, $values)
	{
		$cnt = count($values);
		for ($i = 0; $i < $cnt; $i++) {
			$col = chr(65 + $i) . $rowNo;
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue($col, $values[$i]);
		}
	}

	public function downloadSignupXls()
	{
		App::import('Vendor', 'phpExcel/PHPExcel');
		$this->autoRender = false;

		$objPHPExcel = new PHPExcel();

		// Set document properties
		$this->setXlsProperty($objPHPExcel);

		$collection = $this->get_collection($this->db_name, $this->signup_collection);
		$students = $collection->find();
		$header = array(
			'名字',
			'性别',
			'生日',
			'高中',
			'电话',
			'qq',
			'email',
			'民族',
			'籍贯',
		);
		$this->addXlsRow($objPHPExcel, 0, 1, $header);
		$i = 2;
		foreach ($students as $student) {
			$stu = array();
			$stu[] = $student['name'];
			$stu[] = $student['sex'];
			$stu[] = $student['birthday'];
			$stu[] = $student['highschool'];
			$stu[] = $student['telephone'];
			$stu[] = $student['qq'];
			$stu[] = $student['email'];
			$stu[] = $student['volk'];
			$stu[] = $student['household'];
			$this->addXlsRow($objPHPExcel, 0, $i, $stu);
			++$i;
		}
		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Signup');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="signup.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		$this->response->send();
		exit();
	}
}
