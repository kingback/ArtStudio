<form method="POST" action="/admin/modifyAlbum?id=<?php echo $id; ?>">
	<fieldset>
		<legend>修改相册</legend>
		<label>相册名字</label>
		<input name ="title" type="text" value="<?php echo $title; ?>"></input>
	<br/>
	<label>相册描述</label>
	<textarea rows="10" class="span9" name="desc"><?php echo $desc; ?></textarea>
	<br/>
	<button type="submit" class="btn btn-info">修改相册</button>
	</fieldset>
</form>
