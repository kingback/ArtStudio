<form id = "uploadImage" method="POST" enctype="multipart/form-data" action="/adminapi/uploadAlbumImages?id=<?php echo $id;?>">
	<table class="table table-bordered table-striped responsive-utilities">
    <tr><td>上传图片</td><td><input type="file" name="pics[]" multiple/></td></tr>
    <tr><td><input type="submit"/> </td></tr>
	</table>
</form>

<a target='_blank' class='btn btn-info' onclick="deleteAlbumPics('<?php echo $id;?>')">删除选中图片</a>
<a target='_blank' class='btn btn-info' onclick="modifyAlbumPics('<?php echo $id;?>')">修改选中图片</a>
<a target='_blank' class='btn btn-info' onclick="selectAll()">全选</a>
<a target='_blank' class='btn btn-info' onclick="dselectAll()">全部取消</a>
<a target='_blank' class='btn btn-info' onclick="rselectAll()">反选</a>
<table class="table table-bordered table-striped responsive-utilities">
	<thead>
	<tr>
		<th>选择</th>
		<th>图片预览</th>
		<th>查看原图</th>
		<th>图片名字</th>
		<th>图片点评</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($images as $image_id => $image): ?>
	<div id = "<?php echo $image_id;?>">
		<tr>
		<td><input type="checkbox" name="checkbox" value="<?php echo $image_id;?>"></td>
		<td><img src='<?php echo $base_url; echo $image['small']?>' style='max-height:100px'/></td>
		<td><a href='<?php echo $base_url; echo $image['large']?>' target=_blank>查看原图</a></td>
		<td><input id='<?php echo $image_id;?>_name' name ="name" type="text" value="<?php echo $image['name'];?>"></input></td>
		<td><textarea rows="3" class="span3" id='<?php echo $image_id;?>_desc' name ="desc"><?php echo $image['desc'];?></textarea></td>
		</tr>
		</div>
	<?php endforeach; ?>
	</body>
</table>
