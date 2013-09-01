<link rel="stylesheet" href="/min?b=video/css&f=video-min.css" />
<script src="/min?f=video/js/config-min.js"></script>

<!-- 主内容 {{-->
<div class="g-bd">
	<!-- 面包屑 {{-->
	<div class="g-bread">
		<em>当前位置：</em><a href="/" target="_self">首页</a><span>&gt;</span><em>视频播放</em>
	</div>
	<!-- 面包屑 }}-->

	<!-- 视频列表 {{-->
	<section class="video-play">
	<h1><?php echo $name; ?></h1>
	<div class="video-flash">
	<embed src="<?php echo $url;?>" allowFullScreen="true" quality="high" width="800" height="500" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>
	</div>
	</section>
	<!-- 视频列表 }}-->

</div>
<!-- 主内容 }}-->

