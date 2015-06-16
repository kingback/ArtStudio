<?php
class MainController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'zd';
	}

	public function index()
	{

		$focusImages = array();
		$focusImages[] = array('src' => '/images/default/7018957cc635121e047042dd89bfabea-600-400.jpeg', 'alt' => '校考冲刺班开讲啦！！！', 'link' => '/main/signup');
		$focusImages[] = array('src' => '/images/default/703bfb24e8c7f77281aed9c84fb42be1-600-400.jpeg', 'alt' => '热烈祝贺北京周达画室再创佳绩', 'link' => '/main/honour');
		$focusImages[] = array('src' => '/images/default/7138a539c8220e3909aa9bbaf39fa40b-600-400.jpeg', 'alt' => '复读生优惠', 'link' => '/main/article?id=5210d04c6f211a9a4c88579c');
		$focusImages[] = array('src' => '/images/default/30b62a52f5c9aefa9fa0201a475e70a2-600-400.jpeg', 'alt' => '丰富多彩的课余生活', 'link' => '/main/news');
		$focusImages[] = array('src' => '/images/default/29b073ea0c0a80554b303e280cfc060b-600-400.jpeg', 'alt' => '招生简章', 'link' => '/main/recruitInfo');
		$this->set('focusImages', $focusImages);

		$mainTeachers = array();
		$mainTeachers[] = array('name' => '文筱波', 'school' => '中央美术学院', 'title' => '造型主教', 'id' => 'teacher-521082b36f211a9a4cf8776e', 'img' => '/images/default/a9ea42227621ef81ea9e198bfd8bc81f-120-240.png');
		$mainTeachers[] = array('name' => '赵连锁', 'school' => '中央美术学院', 'title' => '造型班主教', 'id' => 'teacher-55786bd66f211a8e2f895eb8', 'img' => '/images/default/3d4ee51e8a2f58da994001e2cea02148-120-240.jpeg');
		$mainTeachers[] = array('name' => '陈春雨', 'school' => '天津美院', 'title' => '色彩主教', 'id' => 'teacher-55786b886f211a902f480278', 'img' => '/images/default/262424ca64ca1342f168855163515bbc-120-240.jpeg');
		$mainTeachers[] = array('name' => '贾晓羊', 'school' => '天津美术学院', 'title' => '综合班速写主教', 'id' => 'teacher-55786cf86f211a8e2f9ac315', 'img' => '/images/default/d20f837571b4ed9d7dd6463f392fd828-120-240.jpeg');
		$mainTeachers[] = array('name' => '朱明月', 'school' => '中央美术学院', 'title' => '平面主教', 'id' => 'teacher-55786c3b6f211a902fdad244', 'img' => '/images/default/1635fbdd225ab14066f5a3876adf6c22-120-240.jpeg');
		$this->set('mts', $mainTeachers);

		$otherTeachers = array();
		$otherTeachers[] = array('name' => '郝爽', 'school' => '中央美术学院', 'title' => '综合班素描主教', 'id' => 'teacher-521084e56f211a934c0315f4', 'img' => '/images/default/45e3f2c58b82c21087835c44e1896dc8-115-115.jpeg');
		$otherTeachers[] = array('name' => '孙鹏飞', 'school' => '四川美术学院', 'title' => '综合班色彩主教', 'id' => 'teacher-55786cc96f211a902fb28c79', 'img' => '/images/default/5e3f395638ce72c057261c43f609e42c-115-115.jpeg');
		$otherTeachers[] = array('name' => '宫奇', 'school' => '鲁迅美术学院', 'title' => '综合班素描主教', 'id' => 'teacher-55786d5b6f211a4011698c9b', 'img' => '/images/default/cd0e1913b55f956df0178d762b93c2eb-115-115.jpeg');
		$otherTeachers[] = array('name' => '王宝良', 'school' => '中央美术学院', 'title' => '造型老师', 'id' => 'teacher-55786da96f211a902f5f403b', 'img' => '/images/default/cc69c04f3809193b8fafb9b16d5f7075-115-115.jpeg');
		$otherTeachers[] = array('name' => '徐瑞', 'school' => '清华美院', 'title' => '色彩老师', 'id' => 'teacher-55786c906f211a40110b0b12', 'img' => '/images/default/b8d9901517ee500cda7d5de9dc19914c-115-115.jpeg');
		$this->set('ots', $otherTeachers);

		$news_col = $this->get_collection($this->db_name, $this->news_collection);
		$newses = $news_col->find(array('mark' => 1))->sort(array('date' => -1));
		$this->set('newses', $newses);

		$honour_col = $this->get_collection($this->db_name, $this->honour_collection);
		$honours = $honour_col->find(array("year" => 2015));
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
			'imgUrl' => '/images/default/8bfc261c45240022e9218ad8818fce89-186-236.png',
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
		$msg = "报名成功!!";
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
			if ($this->is_image($type)) {
				//$msg = "注册失败: $name 不是图片文件";
				//$this->redirect(array('controller' => 'main', 'action' => 'signup', '?' => array('msg' => $msg)));
				//echo json_encode(array('msg' => $name . ' is not image file, type=' . $type));
				//	$this->_setStatusAndExit(400);
				$compressed_file = $this->make_photo_thumb($tmp_filename, 300);
				$image = $this->_save_image($compressed_file, $this->signup_image_dir);
				$stu['image'] = $image;
			}
		}

		$collection = $this->get_collection($this->db_name, $this->signup_collection);
		$res = $collection->update(array('name' => $name, 'telephone' => $telephone), $stu, array('upsert' => true));
		$this->redirect(array('controller' => 'main', 'action' => 'signup', '#' => 'msg=' . $msg));
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
		
		$videoArray = $this->_copy_all_video($videos, true);
		$res = $this->_copy_video($videoArray, $page);

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
		$teachers = $collection->find()->sort(array('_index' => 1));
		$this->set('teachers', $teachers);
	}

	public function article()
	{
		$id = $this->_get_argument('id');
		$collection = $this->get_collection($this->db_name, $this->article_collection);
		$article = $collection->findOne(array('_id' => new MongoId($id)));
		$this->_set_article_info($article);
		if ($article && $article['type'] == '新闻') {
			$this->set('page', 10);
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
		$slides[] = array('/images/default/1b2a954c5cbae1856394cdfc5e0cd37c-390-630.jpeg','周达');
		$slides[] = array('/images/default/ea1f68a6186d0474fc3b5aaa0836f7b4-390-630.jpeg','周达');
		$this->set('slides', $slides);

		$prizes = 
			array(
				array(
					'year' => '2007',
					'images' => array(
						array(
							'image' => '/images/default/cf8d070e5a815445d0ed65af254cebc5-425-604.jpeg',
							'desc' => '《布褶》，60cm x 90cm'
						),
						array(
							'image' => '/images/default/45c93c086c7725bbccf605303cc903a8-425-602.jpeg',
							'desc' => '《素描女全身》，60cm x 90cm'
						)
					)
				),
				array(
					'year' => '2008',
					'images' => array(
						array(
							'image' => '/images/default/4aacb9b7aa83f42f41cce084b90a9a9c-425-312.jpeg',
							'desc' => '《油画静物1》，120cm x 80cm'
						),
						array(
							'image' => '/images/default/4e10b11b7b5eeffc83ff06bb6e1f6b5d-425-400.jpeg',
							'desc' => '《油画静物2》，150cm x 150cm'
						),
						array(
							'image' => '/images/default/98c4e9e04d7ca4e9428c5f0c32c60efc-425-730.jpeg',
							'desc' => '《油画静物3》，60cm x 120cm'
						),
						array(
							'image' => '/images/default/f63660ea9a437206dde3bc449d24f4b9-425-603.jpeg',
							'desc' => '《油画静物4》，50cm x 60cm'
						),
						array(
							'image' => '/images/default/423b473fb25e37a2e4706317fa62bce6-425-322.jpeg',
							'desc' => '《油画静物5》，60cm x 80cm'
						),
						array(
							'image' => '/images/default/b060474d9bdd1cfc7dda9cd3cac64cbc-425-518.jpeg',
							'desc' => '《室友》，60cm x 70cm'
						)
					)
				),
				array(
					'year' => '2009',
					'images' => array(
						array(
							'image' => '/images/default/fb23917e7d949300fec9eceaf306d537-425-274.jpeg',
							'desc' => '《男人体》，165cm x 110cm'
						),
						array(
							'image' => '/images/default/5ad9c21b3e948d65be161f1ba574c92e-425-697.jpeg',
							'desc' => '《女人体》，70cm x 140cm'
						),
						array(
							'image' => '/images/default/f4006d13f081291582fe22639c9f66f6-425-605.jpeg',
							'desc' => '《玩具系列1》，60cm x 80cm'
						),
						array(
							'image' => '/images/default/edc740b9e815aa40b16960687d1b48b0-425-612.jpeg',
							'desc' => '《玩具系列2》，60cm x 80cm'
						),
						array(
							'image' => '/images/default/7c5ecacc053c7f56356f0bbbee7cd35f-425-607.jpeg',
							'desc' => '《玩具系列3》，60cm x 80cm'
						),
						array(
							'image' => '/images/default/23abf5f4f21dcf6ba4b03029699e725c-425-574.jpeg',
							'desc' => '《玩具系列4》，60cm x 80cm'
						),
						array(
							'image' => '/images/default/0b4dce490cf465ddcafe70e664af02a3-425-534.jpeg',
							'desc' => '《素描静物》，185cm x 155cm'
						),
						array(
							'image' => '/images/default/ef1ae92213bc0604b1055836472a96a5-425-461.jpeg',
							'desc' => '《无题》，175cm x 120cm'
						)
					)
				),
				array(
					'year' => '2010',
					'images' => array(
						array(
							'image' => '/images/default/e2c3d30f964819529dd8408bbe1c3c94-425-413.jpeg',
							'desc' => '《笑脸系列1》，100cm x 100cm'
						),
						array(
							'image' => '/images/default/18d3a4edd4f0af9b6ee7448b43f60eeb-425-408.jpeg',
							'desc' => '《笑脸系列2》，100cm x 100cm'
						),
						array(
							'image' => '/images/default/28aa711462e12e21d9d9c8657cb35b8c-425-435.jpeg',
							'desc' => '《笑脸系列3》，100cm x 100cm'
						),
						array(
							'image' => '/images/default/2cb1d648e01c8217a849028cd86457ab-425-425.jpeg',
							'desc' => '《笑脸系列4》，100cm x 100cm'
						),
						array(
							'image' => '/images/default/eb1f1f819d6dd722b0d858c161235b30-425-425.jpeg',
							'desc' => '《笑脸系列5》，100cm x 100cm'
						),
						array(
							'image' => '/images/default/78b4b8432b6a87f90dc12a05b285e0f2-425-425.jpeg',
							'desc' => '《笑脸系列6》，100cm x 100cm'
						),
						array(
							'image' => '/images/default/e12db8ccfcf413fd33f532cdafacb685-425-425.jpeg',
							'desc' => '《笑脸系列7》，100cm x 100cm'
						),
						array(
							'image' => '/images/default/08f19a799bead9c34f055f0d3f9a3682-425-425.jpeg',
							'desc' => '《笑脸系列8》，100cm x 100cm'
						),
						array(
							'image' => '/images/default/9739c3d018940e16fe07c88bfd613cd7-425-690.jpeg',
							'desc' => '《书架》，100cm x 70cm'
						)
					)
				),
				array(
					'year' => '2011',
					'images' => array(
						array(
							'image' => '/images/default/4d2dd0adcddd21257da4b5b10494f31d-425-390.jpeg',
							'desc' => '《窗》，170cm x 150cm'
						),
						array(
							'image' => '/images/default/df23ba428509a9f349fab7301c7811b5-425-643.jpeg',
							'desc' => '《回忆的盒子》，105cm x 170cm'
						),
						array(
							'image' => '/images/default/3a748bf59ca0ea993a16ab8719965528-425-283.jpeg',
							'desc' => '《盆景》，50cm x 70cm x 30cm'
						),
						array(
							'image' => '/images/default/bed006aee3413b09a9e53863044e10d4-425-638.jpeg',
							'desc' => '《沐浴》，120cm x 120cm'
						),
						array(
							'image' => '/images/default/f9378e69e3f78a8fceebf06a4cd8c66c-425-432.jpeg',
							'desc' => '《我的书架》，120cm x 120cm x 30cm'
						)
					)

				),
				array(
					'year' => '2012',
					'images' => array(
						array(
							'image' => '/images/default/e06e1e863dde650264563aa83dabf9e2-425-428.jpeg',
							'desc' => '《物是人非系列1》，60cm x 60cm'
						),
						array(
							'image' => '/images/default/5af68f88b25a3e1a427da0d573b6f1c1-425-507.jpeg',
							'desc' => '《物是人非系列2》，60cm x 65cm'
						),
						array(
							'image' => '/images/default/bb1eaa11471f604cb6b75b8ff11b6a64-425-495.jpeg',
							'desc' => '《物是人非系列3》，60cm x 65cm'
						),
						array(
							'image' => '/images/default/d3eae953d6ff75003bd69a6c8a570fec-425-576.jpeg',
							'desc' => '《那时》，270cm x 210cm'
						),
						array(
							'image' => '/images/default/e1d43858b43e95d2b7e3b3448295e4dc-425-612.jpeg',
							'desc' => '《自画像》，80cm x 120cm'
						)
					)
				)
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
		preg_match('/sid\/(\w+)\//i', $url, $matches);
		$id = $matches[1];
		
		$this->set('name', $name);
		$this->set('url', $url);
		$this->set('id', $id);
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
