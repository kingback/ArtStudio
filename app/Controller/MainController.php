<?php
class MainController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'zd';
	}

	public function index()
	{

		$focusImages = array();
		$focusImages[] = array('src' => 'http://jayli.github.io/gallery/yuislide/assets/slide-1.jpg', 'alt' => '焦点图', 'link' => '#');
		$focusImages[] = array('src' => 'http://jayli.github.io/gallery/yuislide/assets/slide-2.jpg', 'alt' => '焦点图', 'link' => '#');
		$focusImages[] = array('src' => 'http://jayli.github.io/gallery/yuislide/assets/slide-3.jpg', 'alt' => '焦点图', 'link' => '#');
		$focusImages[] = array('src' => 'http://jayli.github.io/gallery/yuislide/assets/slide-4.jpg', 'alt' => '焦点图', 'link' => '#');
		$focusImages[] = array('src' => 'http://jayli.github.io/gallery/yuislide/assets/slide-5.jpg', 'alt' => '焦点图', 'link' => '#');
		$this->set('focusImages', $focusImages);

		$mainTeachers = array();
		$mainTeachers[] = array('name' => '文筱波', 'school' => '中央美术学院', 'title' => '造型主教', 'img' => '/index/img/mt1.png');
		$mainTeachers[] = array('name' => '李迪', 'school' => '中央美术学院', 'title' => '综合班素描主教', 'img' => '/index/img/mt2.png');
		$mainTeachers[] = array('name' => '王允昌', 'school' => '清华美术学院', 'title' => '设计主教', 'img' => '/index/img/mt3.png');
		$mainTeachers[] = array('name' => '郝爽', 'school' => '中央美术学院', 'title' => '综合班素描主教', 'img' => '/index/img/mt4.png');
		$mainTeachers[] = array('name' => '董丹丹', 'school' => '中央美术学院', 'title' => '色彩主教', 'img' => '/index/img/mt5.png');
		$this->set('mts', $mainTeachers);

		$otherTeachers = array();
		$otherTeachers[] = array('name' => '文筱波', 'school' => '中央美术学院', 'title' => '造型主教', 'img' => '/index/img/ot1.png');
		$otherTeachers[] = array('name' => '文筱波', 'school' => '中央美术学院', 'title' => '造型主教', 'img' => '/index/img/ot2.png');
		$otherTeachers[] = array('name' => '文筱波', 'school' => '中央美术学院', 'title' => '造型主教', 'img' => '/index/img/ot3.png');
		$otherTeachers[] = array('name' => '文筱波', 'school' => '中央美术学院', 'title' => '造型主教', 'img' => '/index/img/ot1.png');
		$otherTeachers[] = array('name' => '文筱波', 'school' => '中央美术学院', 'title' => '造型主教', 'img' => '/index/img/ot2.png');
		$this->set('ots', $otherTeachers);

		$news_col = $this->get_collection($this->db_name, $this->news_collection);
		$newses = $news_col->find(array('mark' => 1))->sort(array('date' => -1));
		$this->set('newses', $newses);

		$honour_col = $this->get_collection($this->db_name, $this->honour_collection);
		$honours = $honour_col->find(array("year" => 2013));
		$this->set('honours', $honours);

		$article_col = $this->get_collection($this->db_name, $this->article_collection);
		$courseInfos = $article_col->find(array('type' => '开课时间'));
		$applyInfos = $article_col->find(array('type' => '报名须知及注意事项'));
		$this->set('courseInfos', $courseInfos);
		$this->set('applyInfos', $applyInfos);

		$album_col = $this->get_collection($this->db_name, $this->album_collection);
		$albums = $album_col->find()->sort(array('type' => 1));
		$this->set('albums', $albums);

		$video_types = $this->_get_video_types();
		$video_img = array(
			'imgUrl' => '/index/img/show-video.png',
			'alt' => '视频'
		);
		$this->set('videoTypes', $video_types);
		$this->set('videoImage', $video_img);

		$this->set('body_class', 'zds-index');
		$this->set('page', 1);
		$this->set('base_url', $this->image_base_url);
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
		$msg = "注册成功!!";
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

		if (isset($_FILES['avartar'])) {
			$tmp_filename = $_FILES['avartar']['tmp_name'];
			$filename = $_FILES['avartar']['name'];
			$type = $_FILES['avartar']['type'];
			if (!$this->is_image($type)) {
				$msg = "注册失败: $name 不是图片文件";
				$this->redirect(array('controller' => 'main', 'action' => 'signup', '?' => array('msg' => $msg)));
				echo json_encode(array('msg' => $name . ' is not image file, type=' . $type));
				$this->_setStatusAndExit(400);
			}
			$compressed_file = $this->make_photo_thumb($tmp_filename, 300);
			$image = $this->_save_image($compressed_file, $this->signup_image_dir);
			$stu['image'] = $image;
		}

		$collection = $this->get_collection($this->db_name, $this->signup_collection);
		$res = $collection->update(array('name' => $name, 'telephone' => $telephone), $stu, array('upsert' => true));
		$this->redirect(array('controller' => 'main', 'action' => 'signup', '?' => array('msg' => $msg)));
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
		$type = $this->_get_argument('type', -1);
		$page = $this->_get_argument('page', 1);
		$page = intval($page);

		$collection = $this->get_collection($this->db_name, $this->video_collection);
		if ($type != -1) {
			$videos = $collection->find(array('type' => $type));
			$video_num = $collection->count(array('type' => $type));
		} else {
			$videos = $collection->find();
			$video_num = $collection->count();
		}

		$pages = intval($video_num / $this->video_page_size);
		if ($video_num % $this->video_page_size > 0) {
			++ $pages;
		}
		$pre_page = $page > 1? $page - 1: 1;
		$next_page = $page > $pages? $page + 1: $pages;
		$res = $this->_copy_video($videos, $page);

		$video_names = $this->_get_video_names();

		$this->set('video_names', $video_names);
		$this->set('cur_type', $type);
		$this->set('videos', $res);
		$this->set('pages', $pages);
		$this->set('cur_page', $page);
		$this->set('pre_page', $pre_page);
		$this->set('next_page', $next_page);
		$this->set('body_class', 'zds-video');
		$this->set('page', -1);
	}

	public function allGallery()
	{
		$albums_col = $this->get_collection($this->db_name, $this->album_collection);
		$albums = $albums_col->find();
		$info = array();
		foreach ($albums as $album) {
			$info[] = $this->copyAlbum($album, null);
		}

		$categories_col = $this->get_collection($this->db_name, $this->album_category_collection);
		$categories = $categories_col->find();
		$this->set('body_class', 'zds-gallery');
		$this->set('page', 5);
		$this->set('albums', $info);
		$this->set('categories', $categories);
		$this->set('base_url', $this->image_base_url);
	}

	public function gallery()
	{
		$category = $this->_get_argument('category');
		$albums_col = $this->get_collection($this->db_name, $this->album_collection);
		$albums = $albums_col->find(array('category' => $category));
		$info = array();
		foreach ($albums as $album) {
			$info[] = $this->copyAlbum($album, null);
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
		$this->set('base_url', $this->image_base_url);
	}

	public function teacher()
	{
		$this->set('body_class', 'zds-gallery');
		$this->set('page', 4);
		$this->set('base_url', $this->image_base_url);
		$collection = $this->get_collection($this->db_name, $this->teacher_collection);
		$teachers = $collection->find();
		$this->set('teachers', $teachers);
	}

	public function article()
	{
		$id = $this->_get_argument('id');
		$collection = $this->get_collection($this->db_name, $this->article_collection);
		$article = $collection->findOne(array('_id' => new MongoId($id)));
		$this->_set_article_info($article);
		$this->set('page', -1);
		$this->set('body_class', 'zds-article');
	}

	public function studioInfo()
	{
		$collection = $this->get_collection($this->db_name, $this->article_collection);
		$article = $collection->findOne(array('type' => '主页'));
		$this->_set_article_info($article);
		$this->set('page', 2);
		$this->set('body_class', 'zds-article');
		$this->render('/Main/article');
	}

	public function recruitInfo()
	{
		$collection = $this->get_collection($this->db_name, $this->article_collection);
		$article = $collection->findOne(array('type' => '招生简章'));
		$this->_set_article_info($article);
		$this->set('page', 6);
		$this->set('body_class', 'zds-article');
		$this->render('/Main/article');
	}

	public function news()
	{
		$news_col = $this->get_collection($this->db_name, $this->news_collection);
		$newses = $news_col->find()->sort(array('date' => -1));
		$res = $this->_copy_news($newses, 1);
		$this->set('newses', $res);
		$this->set('page', 9);
		$this->set('body_class', 'zds-article');
	}

	public function studioEnv()
	{
		$this->set('body_class', 'zds-article');
		$this->set('page', -1);

		$type = 'studioEnv';
		$albums_col = $this->get_collection($this->db_name, $this->album_collection);
		$albums = $albums_col->find(array('type' => $type));
		$info = array();
		foreach ($albums as $album) {
			$info[] = $this->copyAlbum($album, null);
		}
		$this->set('albums', $info);
	}

	public function zdIntro()
	{
		$this->set('body_class', 'zds-article');
		$this->set('page', -1);

		$slides = array();
		$slides[] = array('http://106.186.25.82/gridfs/f5763c91587cac9714af387ad91f9be5-451-600.jpeg','alt');
		$slides[] = array('http://106.186.25.82/gridfs/06da024d60d95823fea9c85c693ab41f-1000-1481.jpeg','alt');
		$slides[] = array('http://106.186.25.82/gridfs/78a7223a53a1fda9b73556253c43052e-720-1018.jpeg','alt');
		$this->set('slides', $slides);

		$prizes = array();
		$prizes[2007] = array(
			array('http://106.186.25.82/gridfs/f5763c91587cac9714af387ad91f9be5-451-600.jpeg','alt'), 
			array('http://106.186.25.82/gridfs/f5763c91587cac9714af387ad91f9be5-451-600.jpeg','alt'), 
			array('http://106.186.25.82/gridfs/f5763c91587cac9714af387ad91f9be5-451-600.jpeg','alt'), 
		);
		$prizes[2008] = array(
			array('http://106.186.25.82/gridfs/06da024d60d95823fea9c85c693ab41f-1000-1481.jpeg','alt'), 
			array('http://106.186.25.82/gridfs/f5763c91587cac9714af387ad91f9be5-451-600.jpeg','alt'), 
		);
		$prizes[2009] = array(
			array('http://106.186.25.82/gridfs/f5763c91587cac9714af387ad91f9be5-451-600.jpeg','alt'), 
		);
		$prizes[2010] = array(
			array('http://106.186.25.82/gridfs/f5763c91587cac9714af387ad91f9be5-451-600.jpeg','alt'), 
		);
		$prizes[2011] = array(
			array('http://106.186.25.82/gridfs/f5763c91587cac9714af387ad91f9be5-451-600.jpeg','alt'), 
		);
		$prizes[2012] = array(
			array('http://106.186.25.82/gridfs/f5763c91587cac9714af387ad91f9be5-451-600.jpeg','alt'), 
		);
		$this->set('prizes', $prizes);

		$type = 'zd';
		$albums_col = $this->get_collection($this->db_name, $this->album_collection);
		$album = $albums_col->findOne(array('type' => $type));
		$this->set('zdAlbumId', $album['_id']);
	}

	public function playVideo()
	{
		$this->set('body_class', 'zds-article');
		$this->set('page', -1);
		$name = $this->_get_argument('name');
		$url = $this->_get_argument('url');
		$this->set('name', $name);
		$this->set('url', $url);
	}

	// all articles shared the same view {article}
	// this function sets values for view
	private function _set_article_info($article)
	{
		if (empty($article)) {
			$title = "找不到相应文章";
			$content = "无文章";
			$type = "error";
		} else {
			$title = $article['title'];
			$content = $article['content'];
			$type = $article['type'];
		}
		$this->set('title', $title);
		$this->set('type', $type);
		$this->set('content', $content);
	}

	public function videoList()
	{
		$types = $this->_get_video_types();
		$this->set('body_class', 'zds-article');
		$this->set('page', -1);
		$this->set('types', $types);
	}

	protected function _get_video_names()
	{
		$types = array();
		$types['drawing'] = '素描教学';
		$types['color'] = '色彩教学';
		$types['sketch'] = '速写教学';
		$types['creation'] = '设计教学';
		return $types;
	}

	protected function _get_video_types()
	{
		$types = array();
		$types[] = array(
			'type' => 'drawing',
			'name' => '素描教学',
			'imgUrl' => 'http://img04.taobaocdn.com/tfscom/T1a7_iXmXhXXb1upjX.jpg_200x200.jpg',
		);
		$types[] = array(
			'type' => 'color',
			'name' => '色彩教学',
			'imgUrl' => 'http://img04.taobaocdn.com/tfscom/T1a7_iXmXhXXb1upjX.jpg_200x200.jpg',
		);
		$types[] = array(
			'type' => 'sketch',
			'name' => '速写教学',
			'imgUrl' => 'http://img04.taobaocdn.com/tfscom/T1a7_iXmXhXXb1upjX.jpg_200x200.jpg',
		);
		$types[] = array(
			'type' => 'creation',
			'name' => '设计教学',
			'imgUrl' => 'http://img04.taobaocdn.com/tfscom/T1a7_iXmXhXXb1upjX.jpg_200x200.jpg',
		);
		return $types;
	}
}
