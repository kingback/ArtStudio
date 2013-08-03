<a target='_blank' class='btn btn-info' href="/admin/createAlbum">新建相册</a>
<table class="table table-bordered table-striped responsive-utilities">
	<thead>
	<tr>
		<th>相册名称</th>
		<th>相册封面</th>
		<th>相册描述</th>
		<th>管理相册</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($albums as $album): ?>
		<tr>
		<td><?php echo $album['title']; ?></td>
		<td><img src='<?php echo $base_url; echo $covers[$album['_id']]; ?>' style='max-height:100px'/></td>/>
		<td><?php echo $album['desc']; ?></td>
		<td><a href="/admin/uploadAlbumImages?id=<?php echo $album['_id']; ?>">管理相册</a></td>
		<td><?php ?></td>
		</tr>
	<?php endforeach; ?>
	</body>
</table>
