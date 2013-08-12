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
			<a href="/main/playVideo?name=<?php echo $video['name'];?>&url=<?php echo $video['url'];?>">
			<figure>
			<div class="video-image">
			<img src="<?php echo $video['image'];?>" />
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
		<li class="g-paginator-prev"><a href="/main/video?page=<?php echo $pre_page; ?>"></a></li>
		<?php $i = 1; ?>
		<?php for (; $i <= $pages; $i++):?>
		<?php if ($i > 3) break; ?>
		<?php if ($i == $cur_page): ?>
		<li class="g-paginator-num g-paginator-selected">
		<?php else: ?>
		<li class="g-paginator-num">
		<?php endif; ?>
		<a href="/main/video?page=<?php echo $i; ?>"><?php echo $i; ?></a>
		</li>
		<?php endfor; ?>
		<?php if ($pages > 6): ?>
		<?php $i = $pages - 3; ?>
		<li class="g-paginator-ellipsis"><span>...</span></li>
		<?php endif; ?>
		<?php if ($pages > 3): ?>
		<?php for (; $i <= $pages; $i++):?>
		<li class="g-paginator-num"><a href="/main/video?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
		<?php endfor; ?>
		<?php endif; ?>
		<li class="g-paginator-next"><a href="/main/video?page=<?php echo $next_page; ?>"></a></li>
	</ol>
</div>
</section>
<!-- 视频列表 }}-->

</div>
<!-- 主内容 }}-->

