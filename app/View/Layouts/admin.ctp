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
            }
        </style>
        <link href="/admin/css/bootstrap.min.css" rel="stylesheet">
        <link href="/admin/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="/admin/css/docs.css" rel="stylesheet">
        <link href="/admin/css/prettify.css" rel="stylesheet">
        <link href="/admin/css/bootstrap-combined.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" media="screen" href="/admin/css/bootstrap-datetimepicker.min.css">
    </head>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="/">网站管理</a>
                <div class="nav-collapse collapse">
                    <ul class="nav">
						<li <?php if ($title_for_layout == "empty") echo 'class="active"' ?>><a href="/admin/index">empty</a></li>
                        <li <?php if ($title_for_layout == "画室荣誉管理") echo 'class="active"' ?>><a href="/admin/honour">画室荣誉管理</a></li>
                        <li <?php if ($title_for_layout == "图片管理") echo 'class="active"' ?>><a href="/admin/images">图片管理</a></li>
                        <li <?php if ($title_for_layout == "创建相册") echo 'class="active"' ?>><a href="/admin/createAlbum">创建相册</a></li>
                        <li <?php if ($title_for_layout == "管理相册") echo 'class="active"' ?>><a href="/admin/listAlbums">管理相册</a></li>
                        <li <?php if ($title_for_layout == "注册管理") echo 'class="active"' ?>><a href="/admin/signup">注册管理</a></li>
                        <li <?php if ($title_for_layout == "Manul") echo 'class="active"' ?>><a href="/pages/manul">帮助</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <header class="jumbotron subhead" id="overview">
    <div class="container">
	<h1><?php echo $title_for_layout; ?></h1>
    </div>
    </header>

    <div class="container">
        <?php $session = $this->Session->flash(); ?>
        <?php if ($session): ?>
        <div class="alert alert-error">
            <?php echo $session; ?>
        </div>
        <?php endif; ?>

        <?php echo $this->fetch('content'); ?>
    </div>

    <script src="/admin/js/jquery.js"></script>
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
