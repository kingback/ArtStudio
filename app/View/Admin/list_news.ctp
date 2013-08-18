<p>
<a target='_blank' class='btn btn-primary' href="/admin/createNews" >新建新闻</a> &nbsp;&nbsp;&nbsp;&nbsp;
</p>

<p>
<a target='_blank' class='btn btn-danger' onclick="deleteArticle()">删除选中文章</a> &nbsp;&nbsp;&nbsp;&nbsp;
<a target='_blank' class='btn btn-info' onclick="markNews('1')">标记选中新闻首页显示</a> &nbsp;
<a target='_blank' class='btn btn-warning' onclick="markNews('0')">取消选中新闻首页显示</a> &nbsp;&nbsp;&nbsp;&nbsp;
<a target='_blank' class='btn' onclick="selectAll()">全选</a>&nbsp;
<a target='_blank' class='btn' onclick="dselectAll()">全部取消</a>&nbsp;
<a target='_blank' class='btn' onclick="rselectAll()">反选</a>&nbsp;
</p>
<table class="table table-bordered table-hover responsive-utilities">
	<thead>
	<tr>
		<th></th>
		<th>类型</th>
		<th>题目</th>
		<th>修改时间</th>
		<th>预览</th>
		<th>修改</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($newses as $news): ?>
		<tr>
		<td><input type="checkbox" name="checkbox" value="<?php echo $news['articleId'];?>"></td>
		<td>
			<?php if (isset($news['mark']) && $news['mark'] > 0): ?>
			<span class="badge badge-important">首页显示</span>
			<?php endif?>
		</td>
		<td><?php echo $news['title']; ?></td>
		<td><?php echo date('Y-m-d h:i:s', $news['date']->sec); ?></td>
		<td><a target="_blank" class="btn btn-info" href='/main/article?id=<?php echo $news['articleId']; ?>'>预览</a></td>
		<td><a class="btn btn-warning" href='/admin/createNews?id=<?php echo $news['articleId']; ?>'>修改</a></td>
		</tr>
	<?php endforeach; ?>
	</body>
</table>

<?php $this->Html->script('/admin/js/article.js', array('inline' => false)); ?>
<?php $this->Html->css('/admin/css/article.css',null, array('inline' => false)); ?>
