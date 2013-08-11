<link rel="stylesheet" href="/min?b=env/css&f=env-min.css" />
<script src="/min?f=env/js/config-min.js"></script>


<!-- 主内容 {{-->
<div class="g-bd">
	<!-- 面包屑 {{-->
	<div class="g-bread">
		<em>当前位置：</em><a href="/">首页</a><span>&gt;</span><em>画室环境</em>
	</div>
	<!-- 面包屑 }}-->

	<!-- 画室环境 {{-->
	<article class="env-main">
	<ul class="env-list clearfix">
		<?php foreach ($albums as $album):  ?>
		<li class="env-item" data-albumid="<?php echo $album['id']; ?>">
		<div class="env-image">
		<img src="<?php echo $album['cover']['small']; ?>" alt="<?php echo $album['title']; ?>" />
		</div>
		<h3 class="env-title"><?php echo $album['title'];?></h3>
		</li>
		<?php endforeach; ?>
	</ul>
	</article>
	<!-- 画室环境 }}-->
</div>
<!-- 主内容 }}-->
