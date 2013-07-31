<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link href="/css/home.css" type="text/css" rel="stylesheet"></link>
        <link rel="stylesheet" title="Arta" href="/static/highlight/styles/arta.css"></link>
        <script src="/static/jquery.min.js"> </script>
        <script src="/static/highlight/highlight.pack.js"></script>
        <link rel="stylesheet" type="text/css" href="/jqModal/jqModal.css" />
        <script type='text/javascript' src='/jqModal/jqModal.js'></script>
        <script type='text/javascript' src='/js/dashboard.js'></script>

        <script>
            hljs.tabReplace = '    ';
            hljs.initHighlightingOnLoad();
        </script>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $scripts_for_layout;
        ?>
    </head>

    <body>
        <table style="width:100%"><tr>
                <td>
                    <a href="/dashboard/" class="header"><h1 style="margin:6px"><img src="/static/logo64.png"/><span style="position: absolute;padding: 15px; color: black">网站管理</span></h1></a>
                </td>
                <td id="info">
                    <?php if (isset($isLogin))
                    {
                        //echo "<img src= '{$userAvatar}' />";
                        echo "hello, {$username} | <a href='/users/logout'>logout</a>";
                    }
                    ?>
                </td>
            </tr>
        </table>

        <div class="line" style="right: 0pt;"></div>

        <table id="content">
            <tr>
                <td class="left">
                    <div id="menu">
			<h3>控制台</h3>
			<ul>
                        <li><a href="/admin/index">管理APP</a></li>
                        <li><a href="/admin/honour" >画室荣誉管理</a> </li>
                        <li><a href="/dashboard/uploadKey">添加SSH Key</a></li>
                        <li><a href="/dashboard/install">安装App</a></li>
                        <li><a href="/">app排行榜</a></li>
                        <li><a href="/deploy">App上线</a></li>
                        <li><a href="http://readme.iyoudao.net/">帮助</a></li>
                        <li><a href="#"></a></li>
			</ul>
                    </div>
                </td>
                <td>
                    <?php echo $content_for_layout; ?>
                </td>
            </tr>
        </table>
        <!-- footer -->
    </body>
</html>

