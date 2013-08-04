<link rel="stylesheet" href="/min?b=gallery/css&f=gallery-min.css" />
<script src="/min?f=gallery/js/config-min.js"></script>

<!-- 主内容 {{-->
<div class="g-bd">
	<!-- 作品欣赏tab {{-->
	<div class="gl-hd">
		<h2>作品欣赏</h2>
		<div class="gl-tab clearfix">
			<a href="#" class="gl-tab-selected">全部</a>
			<span>|</span>
			<a href="#">造型班</a>
			<span>|</span>
			<a href="#">设计班</a>
			<span>|</span>
			<a href="#">综合班</a>
		</div>                    
	</div>
	<!-- 作品欣赏tab }}-->

	<!-- 面包屑 {{-->
	<div class="g-bread">
		<em>当前位置：</em><a href="#">首页</a><span>&gt;</span><a href="#">作品欣赏</a><span>&gt;</span><em>全部</em>
	</div>
	<!-- 面包屑 }}-->

	<div class="all-albums">
		<ul class="clearfix">
			<?php foreach ($albums as $album): ?>
			<li class="album-item" data-albumid="<?php echo $album['id']; ?>">
			<div class="album-cover">
				<a href="javascript:void(0);" target="_self" title="造型班">
					<?php if (isset($album['cover'])): ?>
					<img src="<?php echo $base_url, $album['cover']['small']; ?>" style="max-height:210px; max-width:149px" />
					<?php else: ?>
					<img src="/gallery/img/gf.png" />
					<?php endif;?>
				</a>
			</div>
			<h3 class="album-title"><strong><?php echo $album['title']; ?></strong><em>（<?php echo $album['image_num']; ?>张）</em></h3>
			<p class="album-eng">portrait sketch</p>
			</li>
			<?php endforeach;?>
		</ul>
	</div>

</div>
<!-- 主内容 }}-->
