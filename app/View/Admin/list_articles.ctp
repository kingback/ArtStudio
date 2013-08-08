<p>
<a target='_blank' class='btn btn-success' href="/admin/publisher" >新建主页/招生简章</a> &nbsp;&nbsp;&nbsp;&nbsp;
<a target='_blank' class='btn btn-success' href="/admin/createNews" >新建新闻</a> &nbsp;&nbsp;&nbsp;&nbsp;
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
		<th>选择</th>
		<th>文章类型</th>
		<th>文章题目</th>
		<th>修改时间</th>
		<th>文章预览</th>
		<th>修改文章</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($articles as $article): ?>
		<tr>
		<td><input type="checkbox" name="checkbox" value="<?php echo $article['_id'];?>"></td>
		<td> 
			<?php if ($article['type'] == '主页') { echo "<font color='red'>主页</font>";} ?>
			<?php if ($article['type'] == '新闻') { echo "<font color='green'>新闻</font>";} ?>
			<?php if ($article['type'] == '招生简章') { echo "<font color='blue'>招生简章</font>";} ?>
		</td>
		<td><?php echo $article['title']; ?></td>
		<td><?php echo date('Y-m-d h:i:s', $article['modifyTime']->sec); ?></td>
		<td><a target="_blank" class="btn btn-success" href='/main/article?id=<?php echo $article['_id']; ?>'>预览文章</a></td>
		<?php if ($article['type'] == '新闻'): ?>
		<td><a class="btn btn-danger" href='/admin/createNews?id=<?php echo $article['_id']; ?>'>修改文章</a></td>
		<?php else: ?>
		<td><a class="btn btn-danger" href='/admin/publisher?id=<?php echo $article['_id']; ?>'>修改文章</a></td>
		<?php endif; ?>
		</tr>
	<?php endforeach; ?>
	</body>
</table>
