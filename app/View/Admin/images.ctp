<?php $this->Html->script('/admin/js/images.js', array('inline' => false)); ?>
<?php $this->Html->css('/admin/css/images.css',null, array('inline' => false)); ?>

<div class="well">
<form class="form-inline" id = "uploadImage" method="POST" enctype="multipart/form-data" action="/adminapi/uploadImages">
	<fieldset>
		<legend>上传图片</legend>
	<label>选择图片</label>
	<input type="file" name="pics[]" multiple/>
	<button type="submit" class="btn btn-info">确定上传</button>
	</fieldset>
</form>
</div>

<p>
<a target='_blank' class='btn btn-danger' onclick="deletePics()">删除选中图片</a> &nbsp;&nbsp;&nbsp;&nbsp;
<a target='_blank' class='btn' onclick="selectAll()">全选</a>&nbsp;
<a target='_blank' class='btn' onclick="dselectAll()">全部取消</a>&nbsp;
<a target='_blank' class='btn' onclick="rselectAll()">反选</a>&nbsp;
</p>
<table class="table table-bordered table-hover responsive-utilities">
	<thead>
	<tr>
		<th></th>
		<th>大图地址</th>
		<th>小图地址</th>
		<th>图片预览</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($files as $file): ?>
		<tr>
		<td><input type="checkbox" name="checkbox" value="<?php echo $file['id'];?>"></td>
		<td><a href='<?php echo $file['large_url']; ?>'><?php echo $file['large']; ?></td>
		<td><a href='<?php echo $file['small_url']; ?>'><?php echo $file['small']; ?></td>
		<td><img src='<?php echo $file['small_url']?>' style='max-height:100px'/></td>
		</tr>
	<?php endforeach; ?>
	</body>
</table>

