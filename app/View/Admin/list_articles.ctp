<p>
<a target='_blank' class='btn btn-primary' href="/admin/publisher" >新建主页/招生简章</a> &nbsp;&nbsp;&nbsp;&nbsp;
<a target='_blank' class='btn btn-primary' href="/admin/createNews" >新建新闻</a> &nbsp;&nbsp;&nbsp;&nbsp;
</p>

<p>
<a target='_blank' class='btn btn-danger' onclick="deleteArticle()">删除选中文章</a> &nbsp;&nbsp;&nbsp;&nbsp;
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
	<?php foreach ($articles as $article): ?>
		<tr>
		<td><input type="checkbox" name="checkbox" value="<?php echo $article['_id'];?>"></td>
		<td>
			<?php if ($article['type'] == '主页'): ?> 
				<span class="label label-important">主页</span>
			<?php endif; ?>
			<?php if ($article['type'] == '新闻'): ?> 
				<span class="label label-info">新闻</span>
			<?php endif; ?>
			<?php if ($article['type'] == '招生简章'): ?> 
				<span class="label label-warning">招生简章</span>
			<?php endif; ?>
		</td>
		<td><?php echo $article['title']; ?></td>
		<td><?php echo date('Y-m-d h:i:s', $article['modifyTime']->sec); ?></td>
		<td><a target="_blank" class="btn btn-info" href='/main/article?id=<?php echo $article['_id']; ?>'>预览</a></td>
		<?php if ($article['type'] == '新闻'): ?>
		<td><a class="btn btn-warning" href='/admin/createNews?id=<?php echo $article['_id']; ?>'>修改</a></td>
		<?php else: ?>
		<td><a class="btn btn-warning" href='/admin/publisher?id=<?php echo $article['_id']; ?>'>修改</a></td>
		<?php endif; ?>
		</tr>
	<?php endforeach; ?>
	</body>
</table>
