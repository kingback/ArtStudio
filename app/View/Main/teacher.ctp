<link rel="stylesheet" href="/min?b=teacher/css&f=teacher-min.css" />
<script src="/min?f=teacher/js/config-min.js"></script>

<!-- 主内容 {{-->
<div class="g-bd">
	<!-- 面包屑 {{-->
	<div class="g-bread">
		<em>当前位置：</em><a href="/main" target="_self">首页</a><span>&gt;</span><em>教师介绍</em>
	</div>
	<!-- 面包屑 }}-->

	<!-- 教师页面 {{-->
	<article class="tc-main">
	<div class="tc-hd">
		<h2>教师介绍</h2>
		<p>北京周达画室坐落于中国宋庄画家村，宋庄历史悠久、文化底蕴丰富和富于包容性的文化艺术氛围成为了周达画室又一新特色，附近美术馆、画廊林立，既丰富学生课余生活又能提高学生艺术修养。</p>
	</div>
	<ul class="tc-list clearfix">
		<?php foreach ($teachers as $teacher): ?>
		<li class="clearfix" id="teacher-<?php echo $teacher['id']; ?>">
		<div class="tc-image">
    		<div class="tc-imagecon">
        		<img src="<?php echo $base_url, $teacher['image']; ?>" alt="<?php $teacher['name'];?>" />
    		</div>
		</div>
		<div class="tc-detail">
			<h3 class="tc-name"><?php echo $teacher['name']; ?></h3>
			<p class="tc-title"><?php echo $teacher['title']; ?></p>
			<p class="tc-desc"><?php echo $teacher['desc']; ?></p>
		</div>
		</li>
		<?php endforeach; ?>
	</ul>
	</article>
	<!-- 教师页面 }}-->
</div>
<!-- 主内容 }}-->

