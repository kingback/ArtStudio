<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php echo $title_for_layout; ?>
		</title>
		<style>
			body {
				padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
				font:14px arial;
			}
			.table {
				background-color: #fff;
				font:14px arial;
			}
		</style>
		<link href="/admin/css/bootstrap.min.css" rel="stylesheet">
		<link href="/admin/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="/admin/css/docs.css" rel="stylesheet">
		<link href="/admin/css/prettify.css" rel="stylesheet">
		<link href="/admin/css/bootstrap-combined.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" media="screen" href="/admin/css/bootstrap-datetimepicker.min.css">
		<script src="/admin/js/jquery.js"></script>
	</head>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar" style="background-color:#666">
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="/admin">网站管理</a>
				<div class="nav-collapse collapse">
					<ul class="nav">
						<li <?php if ($title_for_layout == "画室荣誉管理") echo 'class="active"' ?>><a href="/admin/honour">画室荣誉管理</a></li>
						<li <?php if ($title_for_layout == "图片管理") echo 'class="active"' ?>><a href="/admin/images">图片管理</a></li>
						<li <?php if ($title_for_layout == "相册管理") echo 'class="active"' ?>><a href="/admin/listAlbums">相册管理</a></li>
						<li <?php if ($title_for_layout == "注册管理") echo 'class="active"' ?>><a href="/admin/signup">注册管理</a></li>
						<li <?php if ($title_for_layout == "教师管理") echo 'class="active"' ?>><a href="/admin/teachers">教师管理</a></li>
						<li <?php if ($title_for_layout == "文章管理") echo 'class="active"' ?>><a href="/admin/listArticles">文章管理</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>


	<div class="container" style="background-color: #666">
		<div class="hero-unit" style="background-color: #eee; margin:40px">
			<?php $session = $this->Session->flash(); ?>
			<?php if ($session): ?>
			<div class="alert alert-error">
				<?php echo $session; ?>
			</div>
			<?php endif; ?>

			<?php echo $this->fetch('content'); ?>
		</div>
	</div>

	<script src="/admin/js/jquery.form.js"></script> 
	<script src="/admin/js/bootstrap.min.js"></script>
	<script src="/admin/js/holder.js"></script>
	<script src="/admin/js/prettify.js"></script>
	<script src="/admin/js/bootstrap-datetimepicker.min.js"></script>
	<script src="/admin/js/admin.js"></script>
</body>
</html>
<!--
vim:ft=html
-->
