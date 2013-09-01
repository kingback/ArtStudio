<link rel="stylesheet" href="/min?b=video/css&f=video-min.css" />
<script src="/min?f=video/js/config-min.js"></script>

<!-- 主内容 {{-->
<div class="g-bd">
	<!-- 视频教学 {{-->
	<div class="gl-hd">
		<h2>教学视频</h2>
		<div class="gl-tab clearfix">
		<a target="_self" href="/main/video" <?php if ($cur_type == -1) echo "class='gl-tab-selected'"; ?>>全部</a>
<?php foreach ($video_names as $type => $name): ?>
			<span>|</span>
			<a target="_self" href="/main/video?type=<?php echo $type;?>" <?php if ($cur_type == $type) echo "class='gl-tab-selected'"; ?>><?php echo $name;?></a>
<?php endforeach; ?>
		</div>                    
	</div>
	<!-- 视频教学 }}-->

	<!-- 面包屑 {{-->
	<div class="g-bread">
		<em>当前位置：</em><a href="/" target="_self">首页</a><span>&gt;</span><em>教学视频</em>
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
		<li class="g-paginator-prev"><a target="_self" href="/main/video?page=<?php echo $pre_page; ?>"></a></li>
		<?php $i = 1; ?>
		<?php for (; $i <= $pages; $i++):?>
		<?php if ($i > 3) break; ?>
		<?php if ($i == $cur_page): ?>
		<li class="g-paginator-num g-paginator-selected">
		<?php else: ?>
		<li class="g-paginator-num">
		<?php endif; ?>
		<a target="_self" href="/main/video?page=<?php echo $i; ?>"><?php echo $i; ?></a>
		</li>
		<?php endfor; ?>
		<?php if ($pages > 6): ?>
		<?php $i = $pages - 3; ?>
		<li class="g-paginator-ellipsis"><span>...</span></li>
		<?php endif; ?>
		<?php if ($pages > 3): ?>
		<?php for (; $i <= $pages; $i++):?>
		<li class="g-paginator-num"><a target="_self" href="/main/video?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
		<?php endfor; ?>
		<?php endif; ?>
		<li class="g-paginator-next"><a target="_self" href="/main/video?page=<?php echo $next_page; ?>"></a></li>
	</ol>
</div>
</section>
<!-- 视频列表 }}-->

</div>
<!-- 主内容 }}-->
