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
        $this->set('title_for_layout', '画室荣誉管理');
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
        $this->set('title_for_layout', '所有图片');
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
		$album = $collection->findOne(array('_id' => $id));
		$this->set('title', $album['title']);
		$this->set('desc', $album['desc']);
		$images = array();
		if (isset($album['images'])) {
			$images = $album['images'];
		}
		$cover = "";
		if (isset($album['cover'])) {
			$cover = $album['cover'];
		}
		$this->set('id', $id);
		$this->set('cover', $cover);
		$this->set('images', $images);
		$this->set('base_url', $this->grid_base_url);
		$this->set('title_for_layout', '修改相册图片');
	}

	public function createAlbum()
	{
		if ($this->request->is('post')) {
			$title = $this->_get_argument('title');
			$desc = $this->_get_argument('desc');
			$category = $this->_get_argument('category');
			$id = md5($title . $desc . time());
			$album = array('title' => $title, 'desc' => $desc, '_id' => $id, 'category' => $category);
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
			$newdata = array('$set' => array('title' => $title, 'desc' => $desc, 'category' => $category));
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
			if (isset($album['cover'])) {
				$id = $album['cover'];
				$covers[$album_id] = $album['images'][$id]['small'];
			} else {
				$covers[$album_id] = false;
			}
		}
		$this->set('albums', $albums);
		$this->set('covers', $covers);
		$this->set('base_url', $this->grid_base_url);
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
		$this->set('base_url', $this->grid_base_url);
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
		}
		$this->set('title_for_layout', '文章发布');
		$this->set('id', $id);
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

	public function createNews()
	{
		$id = $this->_get_argument('id', -1);
		$content = "";
		$title = "";
		$type = "";
		$summary = "";
		$image = false;
		if ($id != -1) {
			$article_col = $this->get_collection($this->db_name, $this->article_collection);
			$article = $article_col->findOne(array('_id' => new MongoId($id)));
			$news_col = $this->get_collection($this->db_name, $this->news_collection);
			$news = $news_col->findOne(array('articleId' => $id));
			$content = $article['content'];
			$title = $article['title'];
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
		$this->set('image', $image);
		$this->set('base_url', $this->grid_base_url);
	}

	public function video()
	{
		$collection = $this->get_collection($this->db_name, $this->video_collection);
		$videos = $collection->find();
		$this->set('title_for_layout', '视频管理');
		$this->set('videos', $videos);
		$this->set('base_url', $this->grid_base_url);
	}
}
