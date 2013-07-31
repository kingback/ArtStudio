<form method="POST" enctype="multipart/form-data" action="/admin/uploadImage">
    上传文件: <input type="file" name="pic"/>
    <input type="submit"/>
</form>


<table cellspacing="1" cellpadding="0" class="help-msg-table">
	<tbody>
	<tr>
		<th>图片地址</th>
		<th>图片预览</th>
	</tr>
	<?php foreach ($files as $file): ?>
		<tr>
		<td><a href='<?php echo $file['url']; ?>'><?php echo $file['filename']; ?></td>
		<td><img src='<?php echo $file['url']?>' style='max-height:100px'/></td>
		</tr>
	<?php endforeach; ?>
	</body>
</table>
