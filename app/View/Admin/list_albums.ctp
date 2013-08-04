<p>
<a target='_blank' class='btn btn-success' href="/admin/createAlbum" >新建相册</a>
<a target='_blank' class='btn btn-success' href="/admin/albumCategories" >管理相册类别</a>
</p>
<table class="table table-bordered table-hover responsive-utilities">
	<thead>
	<tr>
		<th>相册名称</th>
		<th>相册封面</th>
		<th>相册描述</th>
		<th>相册类别</th>
		<th>管理相册</th>
		<th>修改相册信息</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($albums as $album): ?>
		<tr>
		<td><?php echo $album['title']; ?></td>
		<td><img src='<?php echo $base_url; echo $covers[$album['_id']]; ?>' style='max-height:100px'/></td>
		<td><?php echo $album['desc']; ?></td>
		<td><?php if (isset($album['category'])) echo $album['category']; ?></td>
		<td><a class="btn btn-info" href="/admin/uploadAlbumImages?id=<?php echo $album['_id']; ?>">管理相册</a></td>
		<td><a class="btn btn-info" href="/admin/modifyAlbum?id=<?php echo $album['_id']; ?>">修改相册信息</a></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
