<link rel="stylesheet" href="/min?b=honour/css&f=honour-min.css" />
<script src="/min?f=honour/js/config-min.js"></script>

<!-- 主内容 {{-->
<div class="g-bd">
	<!-- 面包屑 {{-->
	<div class="g-bread">
		<em>当前位置：</em><a href="/main">首页</a><span>&gt;</span><em>画室成绩</em>
	</div>
	<!-- 面包屑 }}-->

	<!-- 光荣榜 {{-->
	<section class="honour">
	<div class="honour-image">
		<img src="/honour/img/focus.png" />
	</div>
	<div class="honour-tabview">
		<ol class="honour-tab-list clearfix">
			<?php  for ($i = 0; $i < count($years); $i++): ?>
			<li class="honour-tab honour-tab-<?php echo $i + 1;?> <?php if ($i == 0): ?>yui3-mytabview-tab-selected<?php endif; ?>"><strong><?php echo $years[$i]; ?>年</strong><b></b></li>
			<?php endfor; ?>
		</ol>
		<?php if (count($years) > 0): ?>
		<h2><strong><?php echo $years[0]; ?>年</strong><span>画室成绩</span><em>（据不完全统计）</em></h2>
		<?php endif; ?>
		<div class="honour-view">
			<?php for ($i = 0; $i < count($years); $i++): ?>
				<?php if ($i == 0): ?>
				<div class="honour-panel yui3-mytabview-panel-show">
				<?php else: ?>
				<div class="honour-panel">
					<script type="text/template" class="yui3-mytabview-lazyload"/>
				<?php endif; ?>
					<div class="honour-scroller">
						<table>
							<tr>
								<th class="student">考生姓名</th>
								<th class="school">通过学校</th>
							</tr>
							<?php foreach ($honours[$years[$i]] as $stu): ?>
							<tr>
								<td class="student"><?php echo $stu['name']; ?></td>
								<?php if (isset($stu['mark']) && $stu['mark'] > 0): ?>
								<td class="school star">
									<?php else:?>
									<td class="school">
										<?php endif; ?>
										<p><?php echo $stu['school']; ?></p>
									</td>
								</tr>
								<?php endforeach; ?>
							</table>
						</div>
						<?php if ($i > 0): ?>
					</script>
					<?php endif; ?>
				</div>
				<?php endfor; ?>
			</div>
			<p class="honour-view-note">※ 以上数据系不完全统计</p>
		</div>
		</section>
		<!-- 光荣榜 }}-->

	</div>
	<!-- 主内容 }}-->

