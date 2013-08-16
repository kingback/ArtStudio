<link rel="stylesheet" href="/min?b=video/css&f=video-min.css" />
<script src="/min?f=video/js/config-min.js"></script>

<!-- 主内容 {{-->
<div class="g-bd">
	<!-- 面包屑 {{-->
	<div class="g-bread">
		<em>当前位置：</em><a href="#">首页</a><span>&gt;</span><em>教学视频</em>
	</div>
	<!-- 面包屑 }}-->

	<!-- 视频列表 {{-->
	<section class="video-catagory">
	<ul class="clearfix">
<?php foreach ($types as $type): ?>
		<li class="video-catagory-item">
		<div class="video-catagory-image">
		<a href="/main/video?type=<?php echo $type['type']; ?>">
		<img src="<?php echo $type['imgUrl']; ?>" alt="<?php echo $type['name']; ?>" />
			</a>
		</div>
		<h3 class="video-catagory-title"><?php echo $type['name']; ?></h3>
		</li>
<?php endforeach; ?>
	</ul>
	</section>
	<!-- 视频列表 }}-->

</div>
<!-- 主内容 }}-->

