<link rel="stylesheet" href="/min?f=yui/build/cssnormalize-context/cssnormalize-context-min.css,article/css/article-min.css" />

<!-- 主内容 {{-->
<div class="g-bd">
	<!-- 面包屑 {{-->
	<div class="g-bread">
	<em>当前位置：</em><a href="/" target="_self">首页</a><span>&gt;</span><?php if($type == "新闻") { echo '<a href="/main/news" target="_self">画室新闻</a><span>&gt;</span>'; } ?><em><?php echo $type; ?></em>
	</div>
	<!-- 面包屑 }}-->

	<!-- 文章页面 {{-->
	<article class="article-main yui3-normalized">
	<header class="article-header">
	<h1><?php echo $title; ?></h1>
	</header>
	<!-- 文章内容 {{-->
	<div class="article-content" id="article-content">
		<?php echo $content; ?>
	</div>
	<!-- 文章内容 }}-->
	</article>
	<!-- 文章页面 }}-->
</div>
<!-- 主内容 }}-->
<script>
    (function() {
        var content = document.getElementById('article-content'),
            imgs = content.getElementsByTagName('img');
        
        function insertMask(img) {
            var con = document.createElement('span'),
                mask = document.createElement('span'),
                parent = img.parentNode;
            
            con.className = 'zd-article-imgcon';
            mask.className = 'zd-article-imgmask';
            
            parent.insertBefore(con, img);
            con.appendChild(img);
            con.appendChild(mask);
        }
        
        for (var i = 0, l = imgs.length; i < l; i++) {
            insertMask(imgs[i]);
        }
    })();
</script>