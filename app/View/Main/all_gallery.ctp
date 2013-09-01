<link rel="stylesheet" href="/min?b=gallery/css&f=gallery-min.css" />
<script src="/min?f=gallery/js/config-min.js"></script>

<!-- 主内容 {{-->
<div class="g-bd">
	<!-- 作品欣赏tab {{-->
	<div class="gl-hd">
		<h2>作品欣赏</h2>
		<div class="gl-tab clearfix">
			<a href="/main/allGallery" class="gl-tab-selected">全部</a>
			<?php foreach ($categories as $category): ?>
			<?php if ($category['name'] == '其他') continue;?>
			<span>|</span>
			<a href="/main/gallery?category=<?php echo $category['name']; ?>" target="_self"><?php echo $category['name']; ?></a>
			<?php endforeach;?>
		</div>                    
	</div>
	<!-- 作品欣赏tab }}-->

	<!-- 面包屑 {{-->
	<div class="g-bread">
		<em>当前位置：</em><a href="/" target="_self">首页</a><span>&gt;</span><a href="/main/allGallery">作品欣赏</a><span>&gt;</span><em>全部</em>
	</div>
	<!-- 面包屑 }}-->

	<div class="all-albums">
		<ul class="clearfix">
		    <?php 
		      $albumCount = 0;
              $albumFirst = " album-item-first";
              $albumLast = " album-item-last";
		    ?>
			<?php foreach ($albums as $album): ?>
			<li class="album-item<?php $albumCount++; if ($albumCount % 4 == 1) { echo $albumFirst; } elseif ($albumCount % 4 == 0) { echo $albumLast; } ?>" data-albumid="<?php echo $album['id']; ?>">
			<div class="album-cover">
			    <p>
				<a href="javascript:void(0);" target="_self" title="<?php echo $album['title']; ?>">
					<?php if (isset($album['cover'])): ?>
					<img src="<?php echo $album['cover']['small']; ?>" />
					<?php else: ?>
					<img src="/gallery/img/gf.png" />
					<?php endif;?>
				</a>
				</p>
			</div>
			<h3 class="album-title"><strong><?php echo $album['title']; ?></strong><em>（<?php echo $album['image_num']; ?>张）</em></h3>
			</li>
			<?php endforeach;?>
		</ul>
	</div>

</div>
<!-- 主内容 }}-->
