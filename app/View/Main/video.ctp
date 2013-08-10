<head>
<link rel="stylesheet" href="/min?b=video/css&f=video-min.css" />
<script src="/min?f=video/js/config-min.js"></script>
</head>

<!-- 主内容 {{-->
<div class="g-bd">
	<!-- 面包屑 {{-->
	<div class="g-bread">
		<em>当前位置：</em><a href="#">首页</a><span>&gt;</span><em>教学视频</em>
	</div>
	<!-- 面包屑 }}-->

	<!-- 视频列表 {{-->
	<section class="video">
	<ul class="video-list clearfix">
		<?php $i = 0; ?>
		<?php foreach ($videos as $video): ?>
		<?php $i++; if ($i % 3 == 0): ?>
			<li class="last">
		<?php else: ?>
			<li>
		<?php endif; ?>
		<a href="#">
			<figure>
			<div class="video-image">
			<img src="<?php echo $base_url, $video['image'];?>" />
				<div class="video-mask"></div>
				<span class="video-play"></span>
			</div>
			<figcaption><?php echo $video['name']; ?></figcaption>
			</figure>
		</a>
		</li>
		<?php endforeach; ?>
	</ul>
	<div class="g-paginator clearfix">
		<ol class="clearfix">
			<li class="g-paginator-prev"><a href="#"></a></li>
			<li class="g-paginator-num g-paginator-selected"><a href="#">1</a></li>
			<li class="g-paginator-num"><a href="#">2</a></li>
			<li class="g-paginator-num"><a href="#">3</a></li>
			<li class="g-paginator-ellipsis"><span>...</span></li>
			<li class="g-paginator-num"><a href="#">8</a></li>
			<li class="g-paginator-num"><a href="#">9</a></li>
			<li class="g-paginator-num"><a href="#">10</a></li>
			<li class="g-paginator-next"><a href="#"></a></li>
		</ol>
	</div>
	</section>
	<!-- 视频列表 }}-->

</div>
<!-- 主内容 }}-->

