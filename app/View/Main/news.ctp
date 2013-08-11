<link rel="stylesheet" href="/min?b=news/css&f=news-min.css" />
<script src="/min?f=news/js/config-min.js"></script>

<!-- 主内容 {{-->
<div class="g-bd">
	<!-- 面包屑 {{-->
	<div class="g-bread">
		<em>当前位置：</em><a href="#">首页</a><span>&gt;</span><em>画室新闻</em>
	</div>
	<!-- 面包屑 }}-->

	<!-- 新闻页面 {{-->
	<article class="n-main">
	<script>
	    <?php $i = 0 ?>
		window.NewsData = [
		<?php foreach ($newses as $news): ?>		
		<?php if ($i != 0) { echo ","; } ?>
		{
            "url": "<?php echo $news['url'];?>",
            "image": "<?php echo $news['image'];?>",
            "title": "<?php echo $news['title'];?>",
            "desc": "<?php echo $news['desc'];?>",
            "date": "<?php echo $news['date'];?>"
        }
        <?php $i++; ?>
		<?php endforeach; ?>
		];
	</script>
	<script type="text/template" id="J_news_temp">
		<div class="news-item">
			<div class="news-image">
				<a href="{url}"><img src="{image}" /></a>
			</div>
			<div class="news-detail">
				<h3 class="news-title">{title}</h3>
				<p class="news-date">{date}</p>
				<p class="news-desc">{desc}</p>
				<div class="news-more">
					<a href="{url}">more</a>
				</div>
			</div>
		</div>
	</script>
	<div class="waterfall clearfix"></div>
	</article>
	<!-- 新闻页面 }}-->
</div>
<!-- 主内容 }}-->
