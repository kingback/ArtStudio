<form id = "uploadImage" method="POST" enctype="multipart/form-data" action="/adminapi/uploadImages">
	<table class="table table-bordered table-striped responsive-utilities">
    <tr><td>上传文件</td><td><input type="file" name="pics[]" multiple/></td></tr>
    <tr><td><input type="submit"/> </td></tr>
	</table>
</form>


<a target='_blank' class='btn btn-info' onclick="deletePics()">删除选中图片</a>
<a target='_blank' class='btn btn-info' onclick="selectAllPics()">全选</a>
<table class="table table-bordered table-striped responsive-utilities">
	<thead>
	<tr>
		<th>选择图片</th>
		<th>图片地址</th>
		<th>图片预览</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($files as $file): ?>
		<tr>
		<td><input type="checkbox" name="checkbox" value="<?php echo $file['id'];?>"></td>
		<td><a href='<?php echo $file['url']; ?>'><?php echo $file['filename']; ?></td>
		<td><img src='<?php echo $file['url']?>' style='max-height:100px'/></td>
		</tr>
	<?php endforeach; ?>
	</body>
</table>
