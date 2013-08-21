<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js ie ie6 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 7]><html class="no-js ie ie7 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 8]><html class="no-js ie ie8 lte9 lte8"> <![endif]-->
<!--[if IE 9]><html class="no-js ie ie9 lte9"> <![endif]-->
<!--[if gt IE 9]><html class="no-js"><![endif]-->
<!--[if !IE]><!--><html><!--<![endif]-->
    <head>
        <title>周达画室</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <meta name="format-detection" content="telephone=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        
        <!-- TODO combo -->
        <link rel="stylesheet" href="/min?b=global/css&f=global-min.css" />
        <script src="/min?f=global/js/modernizr-min.js,yui/build/yui/yui-min.js,global/js/gconfig-min.js"></script>
        
        <base target="_blank" />
    </head>
	<body class="<?php echo $body_class; ?>">
	    <!--[if lte IE 7]>
        <div class="upgrade-browser">
            <p>亲~您正在使用过时的浏览器，享受更棒的浏览体验，建议您更新<a href="http://windows.microsoft.com/zh-cn/internet-explorer/download-ie" class="upgrade-browser-ie">最新的IE浏览器</a><a href="http://chrome.google.com" class="upgrade-browser-chrome">Chrome浏览器</a></p>
        </div>
        <![endif]-->
        <header class="g-hd" id="g-hd">
            <hgroup class="clearfix ">
                <h1 class="g-logo" id="g-logo">
                    <a href="#" target="_top"><img src="/global/img/logo.png" alt="周达画室" /></a>
                </h1>
                <p>一切用实力说话</p>
            </hgroup>
            <div class="g-signup clearfix">
                <a href="/main/signup" class="g-signup-link">火热报名</a>
                <a href="http://wpa.qq.com/msgrd?v=3&uin=278953129&site=qq&menu=yes" class="g-signup-qq"><strong>QQ咨询</strong><em>278953129</em></a>
                <span class="g-signup-phone">全国报名热线1343993136</span>
            </div>
        </header>
        <nav class="g-nav" id="g-nav">
            <h2 class="g-sublogo">
                <a href="/" target="_self"><span>http://zhoudams.com/</span></a>
            </h2>
            <ul>
			<li<?php if($page == 1):?> class="selected"<?php endif; ?>><a href="/main/index" target="_self">首&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;页</a><b></b></li>
			<li<?php if($page == 2): ?> class="selected"<?php endif; ?>><a href="/main/studioInfo" target="_self">画室简介</a><b></b></li>
			<li<?php if($page == 3): ?> class="selected"<?php endif; ?>><a href="/main/honour" target="_self">画室成绩</a><b></b></li>
			<li<?php if($page == 4): ?> class="selected"<?php endif; ?>><a href="/main/teacher" target="_self">教师介绍</a><b></b></li>
			<li<?php if($page == 5): ?> class="selected"<?php endif; ?>><a href="/main/allGallery" target="_self">作品欣赏</a><b></b></li>
			<li<?php if($page == 6): ?> class="selected"<?php endif; ?>><a href="/main/article?id=5214de736f211a9a4c672733" target="_self">招生简章</a><b></b></li>
			<li<?php if($page == 7): ?> class="selected"<?php endif; ?>><a href="/main/article?id=5214d65e6f211a9a4c738432" target="_self">学生管理</a><b></b></li>
			<li<?php if($page == 8): ?> class="selected"<?php endif; ?>><a href="/main/signup" target="_self">网上报名</a><b></b></li>
			<li<?php if($page == 9): ?> class="selected"<?php endif; ?>><a href="/main/news" target="_self">画室新闻</a><b></b></li>
            </ul>
            <div class="g-weibo">
                <a href="http://weibo.com/u/2942681411">关注周达</a>
            </div>
        </nav>
        <script>
            ZD.use('zdglobal');
        </script>
        

<?php echo $content_for_layout; ?>
        
        
        <div class="g-floatbar">
            <a class="g-floatbar-qq" href="http://wpa.qq.com/msgrd?v=3&uin=278953129&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:278953129:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a>
            <a class="g-floatbar-sqq" href="http://wpa.qq.com/msgrd?v=3&uin=278953129&site=qq&menu=yes">QQ咨询</a>
            <a class="g-floatbar-apply" href="/main/signup">网上报名</a>
            <a class="g-floatbar-back" href="#">返回顶部</a>
        </div>
        <footer class="g-ft">
            <div class="g-friend clearfix">
                <h3>友情链接</h3>
                <ul class="clearfix">
                    <li><b></b><a href="http://www.cafa.edu.cn">中央美术学院</a></li>
                    <li><b></b><a href="http://www.caa.edu.cn">中国美术学院</a></li>
                    <li><b></b><a href="http://www.ad.tsinghua.edu.cn">清华大学美术学院</a></li>
                    <li><b></b><a href="http://www.scfai.edu.cn">四川美术学院</a></li>
                    <li class="g-friend-last"><b></b><a href="http://www.gzarts.edu.cn/2013/">广州美术学院</a></li>
                    
                    <li><b></b><a href="http://www.xafa.com.cn">西安美术学院</a></li>
                    <li><b></b><a href="http://www.lumei.edu.cn">鲁迅美术学院</a></li>
                    <li><b></b><a href="http://www.tjarts.edu.cn">天津美术学院</a></li>
                    <li><b></b><a href="http://www.hifa.edu.cn">湖北美术学院</a></li>
                    <li class="g-friend-last"><b></b><a href="http://www.bfa.edu.cn">北京电影学院</a></li>
                    
                    <li><b></b><a href="http://www.chntheatre.edu.cn">中央戏剧学院</a></li>
                    <li><b></b><a href="http://www.nacta.edu.cn">中国戏曲学院</a></li>
                    <li><b></b><a href="http://www.sta.edu.cn">上海戏剧学院</a></li>
                    <li><b></b><a href="http://www.njarti.edu.cn">南京艺术学院</a></li>
                    <li class="g-friend-last"><b></b><a href="http://www.sytu.edu.cn">江南大学</a></li>
                    
                    <li><b></b><a href="http://www.pladaily.com.cn/item/jlwydzt-new/wytt/jfjysxy/">解放军艺术学院</a></li>
                    <li><b></b><a href="http://www.sdada.edu.cn">山东工艺美术学院</a></li>
                    <li><b></b><a href="http://www.cuc.edu.cn">中国传媒大学</a></li>
                    <li><b></b><a href="http://www.jci.edu.cn">景德镇陶瓷学院</a></li>
                    <li class="g-friend-last"><b></b><a href="http://www.biftedu.com">北京服装学院</a></li>
                    
                    <li><b></b><a href="http://www.bigc.edu.cn">北京印刷学院</a></li>
                    <li><b></b><a href="http://www.ruc.edu.cn">中国人民大学</a></li>
                    <li><b></b><a href="http://www.cnu.edu.cn">首都师范大学</a></li>
                    <li><b></b><a href="http://www.bjut.edu.cn">北京工业大学</a></li>
                </ul>
            </div>
            <p class="g-copyright">Copyright &copy; 2013 周达画室</p>
        </footer>
        <script>
            ZD.use('main');
        </script>
    </body>
</html>
