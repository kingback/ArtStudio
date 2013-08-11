<link rel="stylesheet" href="/min?b=signup/css&f=signup-min.css" />
<script src="/min?f=signup/js/config-min.js"></script>

<!-- 主内容 {{-->
<div class="g-bd">
	<!-- 面包屑 {{-->
	<div class="g-bread">
		<em>当前位置：</em><a href="#">首页</a><span>&gt;</span><em>网上报名</em>
	</div>
	<!-- 面包屑 }}-->

	<!-- 报名页面 {{-->
	<article class="s-main">
	<header>
	<h1>网上报名</h1>
	</header>

	<div class="address clearfix">
		<!-- 地图信息 {{-->
		<section class="map">
		<p><a href="/signup/img/mapbig.png"><img src="/signup/img/mapo.png" alt="周达画室地图" /></a></p>
		</section>
		<!-- 地图信息 }}-->

		<!-- 乘车路线 {{-->
		<section class="path">
		<h2>乘车路线</h2>
		<ul>
			<li class="clearfix">
			<p>北京站 —— 周达画室</p>
			<a href="http://api.map.baidu.com/direction?origin=北京站&destination=北京周达画室&mode=transit&region=北京&output=html">查看详情</a>
			</li>
			<li class="clearfix">
			<p>北京西站 —— 周达画室</p>
			<a href="http://api.map.baidu.com/direction?origin=北京西站&destination=北京周达画室&mode=transit&region=北京&output=html">查看详情</a>
			</li>
			<li class="clearfix">
			<p>北京南站 —— 周达画室</p>
			<a href="http://api.map.baidu.com/direction?origin=北京南站&destination=北京周达画室&mode=transit&region=北京&output=html">查看详情</a>
			</li>
			<li class="clearfix">
			<p>首都机场 —— 周达画室</p>
			<a href="http://api.map.baidu.com/direction?origin=首都机场&destination=北京周达画室&mode=transit&region=北京&output=html">查看详情</a>
			</li>
			<li class="clearfix">
			<p>中央美术学院 —— 周达画室</p>
			<a href="http://api.map.baidu.com/direction?origin=中央美术学院&destination=北京周达画室&mode=transit&region=北京&output=html">查看详情</a>
			</li>
		</ul>
		</section>
		<!-- 乘车路线 }}-->

		<!-- 报名热线 {{-->
		<section class="s-phone">
		<h2>报名热线</h2>
		<p>13439931362</p>
		</section>
		<!-- 报名热线 }}-->
	</div>

	<section class="form">
	<form action="/main/addStudent" method="post" class="clearfix" id="s-form" target="_self">
		<div class="required-info">
			<ul>
				<li>
				<label for="f-name" class="label">* 姓名：</label>
				<div class="elem">
					<input type="text" name="name" id="f-name" class="elem-txt" />
				</div>
				<p class="info"></p>
				<div class="valid"></div>
				</li>
				<li class="item-radio">
				<div class="label">* 性别：</div>
				<div class="elem">
					<label><input type="radio" name="sex" checked="checked" value="male" /><span>男</span></label>
					<label><input type="radio" name="sex" value="female" /><span>女</span></label>
				</div>
				<p class="info"></p>
				<div class="valid"></div>
				</li>
				<li class="item-select">
				<div class="label">* 出生日期：</div>
				<div class="elem" id="f-birthday">
					<label><select id="f-birthday_selectyear"><option value="">-</option></select><span>年</span></label>
					<label><select id="f-birthday_selectmonth"><option value="">-</option></select><span>月</span></label>
					<label><select id="f-birthday_selectday"><option value="">-</option></select><span>日</span></label>
					<input type="text" name="birthday" id="birthday" class="elem-txt hidden" />
				</div>
				<p class="info"></p>
				<div class="valid"></div>
				</li>
				<li>
				<label for="f-highschool" class="label">* 所在高中：</label>
				<div class="elem">
					<input type="text" name="highschool" id="f-highschool" class="elem-txt" />
				</div>
				<p class="info"></p>
				<div class="valid"></div>
				</li>
				<li>
				<label for="f-telephone" class="label">* 手机号码：</label>
				<div class="elem">
					<input type="text" name="telephone" id="f-telephone" class="elem-txt" />
				</div>
				<p class="info"></p>
				<div class="valid"></div>
				</li>
				<li>
				<label for="f-qq" class="label">* QQ：</label>
				<div class="elem">
					<input type="text" name="qq" id="f-qq" class="elem-txt" />
				</div>
				<p class="info"></p>
				<div class="valid"></div>
				</li>
				<li>
				<label for="f-email" class="label">* 邮箱：</label>
				<div class="elem">
					<input type="text" name="email" id="f-email" class="elem-txt" />
				</div>
				<p class="info"></p>
				<div class="valid"></div>
				</li>
			</ul>
		</div>
		<div class="optional-info">
			<ul>
				<li>
				<div id="avartar" class="avartar">
					<div class="avartar-image">
						<p><img src="/signup/img/avartar.png" /></p>
					</div>
					<div class="avartar-unload clearfix">
						<div class="avartar-unload-btn">
							<a href="javascript:void(0)"><input type="file" name="avartar" id="avartar-unload-ipt" /></a>
						</div>
						<span>（可选）</span>
					</div>
				</div>
				</li>
				<li>
				<label for="f-volk" class="label">民族：</label>
				<div class="elem">
					<input type="text" name="volk" id="f-volk" class="elem-txt" />
					<span>（可选）</span>
				</div>
				<p class="info"></p>
				</li>
				<li>
				<label for="f-household" class="label">户籍：</label>
				<div class="elem">
					<input type="text" name="household" id="f-household" class="elem-txt" />
					<span>（可选）</span>
				</div>
				<p class="info"></p>
				</li>
			</ul>
		</div>
		<div class="submit-btn">
			<button type="submit">提交</button>
		</div>
	</form>
	</section>
	</article>
	<!-- 报名页面 }}-->
</div>
<!-- 主内容 }}-->

