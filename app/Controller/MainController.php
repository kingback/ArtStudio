<?php
class MainController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'zd';
	}

	public function index()
	{

		$focusImages = array();
		$focusImages[] = array('src' => '/images/default/617704b4447d389b4c204f7635e0a878-600-400.png', 'alt' => '北京周达画室火热招生中', 'link' => '/main/signup');
		$focusImages[] = array('src' => '/images/default/c9e72a14c5b1e88006e511e110ddf066-600-400.jpeg', 'alt' => '热烈祝贺北京周达画室再创佳绩', 'link' => '/main/honour');
		$focusImages[] = array('src' => '/images/default/5ab1443551424d6ef3ac52516dc09d9b-600-400.jpeg', 'alt' => '复读生优惠', 'link' => '/main/article?id=5210d04c6f211a9a4c88579c');
		$focusImages[] = array('src' => '/images/default/3f685531154ca2f887cc9c4f4813931e-600-400.jpeg', 'alt' => '丰富多彩的课余生活', 'link' => '/main/news');
		$focusImages[] = array('src' => '/images/default/e80a1a18da861b3eaaf6821239f8fe39-600-400.jpeg', 'alt' => '招生简章', 'link' => '/main/recruitInfo');
		$this->set('focusImages', $focusImages);

		$mainTeachers = array();
		$mainTeachers[] = array('name' => '文筱波', 'school' => '中央美术学院', 'title' => '造型主教', 'id' => 'teacher-521082b36f211a9a4cf8776e', 'img' => '/images/default/a9ea42227621ef81ea9e198bfd8bc81f-120-240.png');
		$mainTeachers[] = array('name' => '王允昌', 'school' => '清华美术学院', 'title' => '设计主教', 'id' => 'teacher-521083ba6f211a9a4ca2cfa9', 'img' => '/images/default/610f7d555f5ca0d4bc839db90f2eed19-120-240.png');
		$mainTeachers[] = array('name' => '李迪', 'school' => '中央美术学院', 'title' => '综合班素描主教', 'id' => 'teacher-520f4c136f211a673fbaa178', 'img' => '/images/default/f15c42fae57c8c567e10be5213b799ad-120-240.png');
		$mainTeachers[] = array('name' => '郝爽', 'school' => '中央美术学院', 'title' => '综合班素描主教', 'id' => 'teacher-521084e56f211a934c0315f4', 'img' => '/images/default/b7902eec79bffe836284fae1d717d828-120-240.png');
		$mainTeachers[] = array('name' => '董丹丹', 'school' => '中央美术学院', 'title' => '色彩主教', 'id' => 'teacher-5210af2b6f211ae452f75f96', 'img' => '/images/default/eaafbda627d271df144ede46f85e2889-120-240.png');
		$this->set('mts', $mainTeachers);

		$otherTeachers = array();
		$otherTeachers[] = array('name' => '廖雅文', 'school' => '中央美术学院', 'title' => '综合班色彩主教', 'id' => 'teacher-5210b04a6f211a9a4c799f12', 'img' => '/images/default/b717387ab19ac42d9f2038e3099a785a-115-115.png');
		$otherTeachers[] = array('name' => '李锦', 'school' => '中央美术学院', 'title' => '设计主教', 'id' => 'teacher-5210b0ab6f211ae452754fec', 'img' => '/images/default/8482e448ba2cec0933f68b8f82722c24-115-115.png');
		$otherTeachers[] = array('name' => '胡杨静妮', 'school' => '中央美术学院', 'title' => '造型主教', 'id' => 'teacher-5210b1326f211a9a4ce1a874', 'img' => '/images/default/052a5a934bb14ede76aed6e6173167ed-115-115.png');
		$otherTeachers[] = array('name' => '李俊', 'school' => '广州美院', 'title' => '综合班素描主教', 'id' => 'teacher-5210ca836f211ae452f815ed', 'img' => '/images/default/2101fea955aeb9fe8850fb6956c9cf8f-115-115.jpeg');
		$otherTeachers[] = array('name' => '程钊', 'school' => '北京服装学院', 'title' => '速写主教', 'id' => 'teacher-5210cb106f211a984c3ea289', 'img' => '/images/default/376ef3a8ef0b7f98b99ba37fced31837-115-115.jpeg');
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
		    if ($album['category'] != '其他') {
    			$info[] = $this->copyAlbum($album, null);
		    }
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
		$this->set('body_class', 'zds-teacher');
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
        if ($article && $article['type'] == '新闻') {
    		$this->set('page', 9);
        } else {
    		$this->set('page', -1);
        }
		$this->set('body_class', 'zds-article');
	}

	public function studioInfo()
	{
		$collection = $this->get_collection($this->db_name, $this->article_collection);
		$article = $collection->findOne(array('type' => '主页'));
		$this->_set_article_info($article);
		$this->set('page', 2);
		$this->set('body_class', 'zds-studio');
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
    
    public function studentManage()
    {
        $collection = $this->get_collection($this->db_name, $this->article_collection);
        $article = $collection->findOne(array('type' => '学生管理'));
        $this->_set_article_info($article);
        $this->set('page', 7);
        $this->set('body_class', 'zds-stdmanage');
        $this->render('/Main/article');
    }

	public function news()
	{
		$news_col = $this->get_collection($this->db_name, $this->news_collection);
		$newses = $news_col->find()->sort(array('date' => -1));
		$res = $this->_copy_news($newses, 1);
		$this->set('newses', $res);
		$this->set('page', 10);
		$this->set('body_class', 'zds-news');
	}

	public function studioEnv()
	{
		$this->set('body_class', 'zds-env');
		$this->set('page', 9);

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
		$this->set('body_class', 'zds-intro');
		$this->set('page', -1);

		$slides = array();
		$slides[] = array('/images/default/687dd75cb5210ade5b8220de6d39019e-390-630.png','周达');
		//$slides[] = array('/images/default/2585c514a3c3a20dce79e0bad5dfc726-451-600.jpeg','安妮.海瑟薇');
		//$slides[] = array('/images/default/df3b4a17ddb4801e6e24d78f6a34fd11-720-1018.jpeg','13纪念日');
		//$slides[] = array('/images/default/e1a5f7187922e2e5f4d07af1960d72d7-1000-1481.jpeg','甘道夫');
		$this->set('slides', $slides);

		$prizes = array();
        $prizes[] = array(
            'year' => '2007',
            'title' => '布摺',
            'imgUrl' => '/images/default/5e3e63e615c06f602967999c18dd39dc-425-604.jpeg',
        );
        $prizes[] = array(
            'year' => '2008',
            'title' => '油画静物',
            'imgUrl' => '/images/default/80bbd515f1d4e30e3f86834fc3942517-425-312.jpeg',
        );
        $prizes[] = array(
            'year' => '2009',
            'title' => '男人体',
            'imgUrl' => '/images/default/2eec02b54cbf18c44ca40c8c44a48961-425-274.jpeg',
        );
        $prizes[] = array(
            'year' => '2010',
            'title' => '无题',
            'imgUrl' => '/images/default/d1a7b75cb41ce7a6ed8a7deee150f3f3-425-509.jpeg',
        );
        $prizes[] = array(
            'year' => '2011',
            'title' => '千里之行',
            'imgUrl' => '/images/default/32455254869b3596a42d2b14a334df5d-425-398.jpeg',
        );
        $prizes[] = array(
            'year' => '2012',
            'title' => '2012作品',
            'imgUrl' => '/images/default/47bd8dc3659e14a81a66948b743d2788-425-283.jpeg',
        );
        
		$this->set('prizes', $prizes);

		$type = 'zd';
		$albums_col = $this->get_collection($this->db_name, $this->album_collection);
		$album = $albums_col->findOne(array('type' => $type));
		$this->set('zdAlbumId', $album['_id']);
	}

	public function playVideo()
	{
		$this->set('body_class', 'zds-video');
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
		$this->set('body_class', 'zds-video');
		$this->set('page', -1);
		$this->set('types', $types);
	}

	protected function _get_video_names()
	{
		$types = array();
		$types['drawing'] = '素描教学';
		$types['color'] = '色彩教学';
		$types['sketch'] = '速写教学';
		//$types['creation'] = '设计教学';
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
		/*$types[] = array(
			'type' => 'creation',
			'name' => '设计教学',
			'imgUrl' => 'http://img04.taobaocdn.com/tfscom/T1a7_iXmXhXXb1upjX.jpg_200x200.jpg',
		);*/
		return $types;
	}
}
