<form method="POST" action="/admin/modifyAlbum?id=<?php echo $id; ?>">
	<fieldset>
		<legend>修改相册</legend>
		<label>相册名字</label>
		<input name ="title" type="text" value="<?php echo $title; ?>"></input>
		<label>相册类型</label>
		<select name="category">
			<?php foreach ($categories as $category): ?>
			<option <?php if ($category['name'] == $album_category) echo "selected=selected"; ?>><?php echo $category['name']; ?></option>
			<?php endforeach;?>
		</select>
		<br/>
		<label>相册描述</label>
		<textarea rows="10" class="span9" name="desc"><?php echo $desc; ?></textarea>
		<br/>
		<button type="submit" class="btn btn-info">修改相册</button>
	</fieldset>
</form>
