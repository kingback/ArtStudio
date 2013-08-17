<?php 
$types = array(
	'drawing' => '素描',
	'color' => '色彩',
	'creation' => '创作',
	'graphic' => '平面',
	'sketch' => '速写',
	'studioEnv' => '画室环境',
	'zd' => '周达作品',
);
?>
<p>
<a target='_blank' class='btn btn-primary' href="/admin/createAlbum" >新建相册</a>
<a target='_blank' class='btn btn-primary' href="/admin/albumCategories" >管理班级</a>
</p>

<p>
<a target='_blank' class='btn btn-danger' onclick="deleteAlbum()">删除选中相册</a> &nbsp;&nbsp;&nbsp;&nbsp;
<a target='_blank' class='btn' onclick="selectAll()">全选</a>&nbsp;
<a target='_blank' class='btn' onclick="dselectAll()">全部取消</a>&nbsp;
<a target='_blank' class='btn' onclick="rselectAll()">反选</a>&nbsp;
</p>
<table class="table table-bordered table-hover responsive-utilities">
	<thead>
	<tr>
		<th></th>
		<th>名称</th>
		<th>封面</th>
		<th>描述</th>
		<th>类别</th>
		<th>班级</th>
		<th>管理</th>
		<th>修改</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($albums as $album): ?>
		<tr>
		<td><input type="checkbox" name="checkbox" value="<?php echo $album['_id'];?>"></td>
		<td><?php echo $album['title']; ?></td>
		<td>
			<?php if ($covers[$album['_id']] != false): ?>
			<img src='<?php echo $base_url; echo $covers[$album['_id']]; ?>' style='max-height:122px'/>
			<?php else: ?>
			<img style="width:160px; height:122px" class="img-polaroid"  data-src="holder.js/160x122"/>
			<?php endif; ?>
		</td>
		<td><?php echo $album['desc']; ?></td>
		<td><?php echo $types[$album['type']]; ?></td>
		<td><?php if (isset($album['category'])) echo $album['category']; ?></td>
		<td><a class="btn btn-info" href="/admin/uploadAlbumImages?id=<?php echo $album['_id']; ?>">管理相册</a></td>
		<td><a class="btn btn-warning" href="/admin/modifyAlbum?id=<?php echo $album['_id']; ?>">修改相册信息</a></td>
	</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php $this->Html->script('/admin/js/album.js', array('inline' => false)); ?>
