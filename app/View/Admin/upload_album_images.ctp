<script src="/yui/build/yui/yui-min.js"></script>
<script src="/global/js/gconfig-min.js"></script>
<div class="well">
<form class="form-inline" id = "uploadImage" method="POST" enctype="multipart/form-data" action="/adminapi/uploadAlbumImages?id=<?php echo $id;?>">
	<fieldset>
		<legend>上传图片</legend>
	<label>选择图片</label>
	<input type="file" name="pics[]" multiple/>
	<button type="submit" class="btn btn-info">确定上传</button>
	</fieldset>
</form>
<form class="yui3-iuploader-form" action="/adminapi/uploadAlbumImages?id=<?php echo $id;?>"></form>
<script>ZD.use('iuploader');</script>
</div>

<p>
<a target='_blank' class='btn btn-danger' onclick="deleteAlbumPics('<?php echo $id;?>')">删除选中图片</a>&nbsp;
<a target='_blank' class='btn btn-success' onclick="modifyAlbumPics('<?php echo $id;?>')">修改选中图片</a>&nbsp;
<a target='_blank' class='btn btn-warning' onclick="setAlbumCover('<?php echo $id;?>')">设置选中图片为封面</a> &nbsp;&nbsp;&nbsp;&nbsp;
<a target='_blank' class='btn' onclick="selectAll()">全选</a>&nbsp;
<a target='_blank' class='btn' onclick="dselectAll()">全部取消</a>&nbsp;
<a target='_blank' class='btn ' onclick="rselectAll()">反选</a>&nbsp;
</p>
<table class="table table-bordered table-hover responsive-utilities">
	<thead>
	<tr>
		<th>选择</th>
		<th>likes</th>
		<th>图片预览</th>
		<th>查看原图</th>
		<th>图片名字</th>
		<th>图片点评</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($images as $image): ?>
	<div id = "<?php echo $image['id'];?>">
		<tr>
		<td>
			<input type="checkbox" name="checkbox" value="<?php echo $image['id'];?>">
			<?php if ($image['id'] == $cover) { echo "<br><font color='red'>相册封面</font>";} ?>
		</td>
		<td><?php echo $image['like']; ?></td>
		<td><img src='<?php echo $base_url; echo $image['small']?>' style='max-height:100px'/></td>
		<td><a href='<?php echo $base_url; echo $image['large']?>' target=_blank>查看原图</a></td>
		<td><input id='<?php echo $image['id'];?>_name' name ="name" type="text" value="<?php echo $image['name'];?>"></input></td>
		<td><textarea rows="3" class="span3" id='<?php echo $image['id'];?>_desc' name ="desc"><?php echo $image['desc'];?></textarea></td>
		</tr>
		</div>
	<?php endforeach; ?>
	</body>
</table>

<?php $this->Html->script('/admin/js/album.js', array('inline' => false)); ?>
<?php $this->Html->css('/admin/css/album.css',null, array('inline' => false)); ?>
