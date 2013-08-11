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
		$newses = $news_col->find()->sort(array('date' => -1));
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

		$this->set('body_class', 'zds-index');
		$this->set('page', 1);
		$this->set('base_url', $this->grid_base_url);
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
		$collection = $this->get_collection($this->db_name, $this->video_collection);
		$videos = $collection->find();
		$this->set('base_url', $this->grid_base_url);
		$this->set('videos', $videos);
		$this->set('body_class', 'zds-video');
		$this->set('page', 3);
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
		$this->set('base_url', $this->grid_base_url);
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
		$this->set('base_url', $this->grid_base_url);
	}

	public function teacher()
	{
		$this->set('body_class', 'zds-gallery');
		$this->set('page', 4);
		$this->set('base_url', $this->grid_base_url);
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
}
