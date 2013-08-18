<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php echo $title_for_layout; ?>
		</title>
		<link href="/admin/css/bootstrap-combined.min.css" rel="stylesheet">
		<link href="/admin/css/bootstrap-google.css" rel="stylesheet">
		<style>
			body {
				padding-top: 10px; /* 60px to make the container go all the way to the bottom of the topbar */
			}
			.table {
				background-color: #fff;
				font:14px arial;
			}
			.navbar-inverse .navbar-inner {
				background: #1170AB;
				background-image: -webkit-linear-gradient(top, #0A4366, #083754);
				background-image: -moz-linear-gradient(top, #0A4366, #083754);
				background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0A4366), to(#083754));
				background-image: -webkit-linear-gradient(top, #0A4366, #083754);
				background-image: -o-linear-gradient(top, #0A4366, #083754);
				background-image: linear-gradient(to bottom, #0A4366, #083754);
			}
			.navbar .brand{
				font-size: 24px;
			}
			.navbar .nav > li > a {
				color: #DDD;
				font-size: 18px;
			}
			.navbar .nav .active > a, .navbar .nav .active > a:hover {
				background-color: #083754;
			}
		</style>
		<!--<?php echo $this->fetch('css'); ?>-->
	</head>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar" style="background-color:#666">
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="/admin">网站管理</a>
				<div class="nav-collapse collapse">
					<ul class="nav">
						<li <?php if ($title_for_layout == "画室荣誉管理") echo 'class="active"' ?>><a href="/admin/honour">画室荣誉管理</a></li>
						<li <?php if ($title_for_layout == "图片管理") echo 'class="active"' ?>><a href="/admin/images">图片管理</a></li>
						<li <?php if ($title_for_layout == "相册管理") echo 'class="active"' ?>><a href="/admin/listAlbums">相册管理</a></li>
						<li <?php if ($title_for_layout == "注册管理") echo 'class="active"' ?>><a href="/admin/signup">注册管理</a></li>
						<li <?php if ($title_for_layout == "教师管理") echo 'class="active"' ?>><a href="/admin/teachers">教师管理</a></li>
						<li <?php if ($title_for_layout == "文章管理") echo 'class="active"' ?>><a href="/admin/listArticles">文章管理</a></li>
						<li <?php if ($title_for_layout == "新闻管理") echo 'class="active"' ?>><a href="/admin/listNews">新闻管理</a></li>
						<li <?php if ($title_for_layout == "视频管理") echo 'class="active"' ?>><a href="/admin/video">视频管理</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>


	<div class="container" style="background-color: #666">
		<div class="hero-unit" style="background-color: #eee;">
			<?php $session = $this->Session->flash(); ?>
			<?php if ($session): ?>
			<div class="alert alert-error">
				<?php echo $session; ?>
			</div>
			<?php endif; ?>

			<?php echo $this->fetch('content'); ?>
		</div>
	</div>

	<script src="/admin/js/jquery.js"></script>
	<script src="/admin/js/jquery.form.js"></script> 
	<script src="/admin/js/bootstrap.min.js"></script>
	<script src="/admin/js/holder.js"></script>
	<script src="/admin/js/admin.js"></script>
	<?php echo $this->fetch('script'); ?>
</body>
</html>
<!--
vim:ft=html
-->
