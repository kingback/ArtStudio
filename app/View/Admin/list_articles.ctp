<p>
<a target='_blank' class='btn btn-success' href="/admin/publisher" >新建文章</a> &nbsp;&nbsp;&nbsp;&nbsp;
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
		<th>文章id</th>
		<th>文章题目</th>
		<th>修改文章</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($articles as $article): ?>
		<tr>
		<td><input type="checkbox" name="checkbox" value="<?php echo $article['_id'];?>"></td>
		<td><?php echo $article['_id'];?></td>
		<td><?php echo $article['title']; ?></td>
		<td><a href='/admin/publisher?id=<?php echo $article['_id']; ?>'>修改文章</a></td>
		</tr>
	<?php endforeach; ?>
	</body>
</table>
