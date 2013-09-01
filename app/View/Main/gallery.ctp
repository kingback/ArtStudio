<link rel="stylesheet" href="/min?b=gallery/css&f=gallery-min.css" />
<script src="/min?f=gallery/js/config-min.js"></script>

<!-- 主内容 {{-->
<div class="g-bd">
	<!-- 作品欣赏tab {{-->
	<div class="gl-hd">
		<h2>作品欣赏</h2>
		<div class="gl-tab clearfix">
			<a href="/main/allGallery" target="_self">全部</a>
			<?php foreach ($categories as $category): ?>
			<?php if ($category['name'] == '其他') continue;?>
			<span>|</span>
			<?php if ($category['name'] == $cur_category ): ?>
			<a href="/main/gallery?category=<?php echo $category['name']; ?>" class="gl-tab-selected" target="_self"><?php echo $category['name']; ?></a>
			<?php else: ?>
			<a href="/main/gallery?category=<?php echo $category['name']; ?>" target="_self"><?php echo $category['name']; ?></a>
			<?php endif; ?>
			<?php endforeach;?>
		</div>                    
	</div>
	<!-- 作品欣赏tab }}-->

	<!-- 面包屑 {{-->
	<div class="g-bread">
	<em>当前位置：</em><a href="/" target="_self">首页</a><span>&gt;</span><a href="/main/allGallery" target="_self">作品欣赏</a><span>&gt;</span><em><?php echo $cur_category; ?></em>
	</div>
	<!-- 面包屑 }}-->

	<article class="gl-main">
	<h1><?php echo $cur_category; ?>简介</h1>
	<p class="gl-desc"><?php echo $category_desc;?></p>
	<div class="gl-albums">
		<ul>
			<?php $i = 0; ?>
			<?php foreach ($albums as $album): ?>
			<?php $i++; ?>
			<li class="album-item clearfix" data-albumid="<?php echo $album['id']; ?>">
			<div class="album-cover">
			    <p>
				<a href="javascript:void(0);" target="_self" title="造型班">
					<?php if (isset($album['cover'])): ?>
					<img src="<?php echo $album['cover']['small']; ?>" />
					<?php else: ?>
					<img src="/gallery/img/gf.png" />
					<?php endif;?>
				</a>
				</p>
			</div>
			<div class="album-detail">
			<h3 class="album-title"><strong><?php echo $album['title'];?></strong><em>（<?php echo $album['image_num'];?>张）</em></h3>
				<div class="album-desc"><?php echo $album['desc'];?></div>
				<p class="album-show"><a href="javascript:void(0);" target="_self">点击欣赏 &gt;</a></p>
			</div>
			<div class="album-index"><em><?php echo $i; ?></em></div>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
	</article>

</div>
<!-- 主内容 }}-->
